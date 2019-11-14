<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallet extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
         $this->data['title'] = $this->data['site_name'] . ': Dashboard';

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    public function index() {
      $this->data['wallet_balance'] = $this->data['logged_use']['wallet_balance'];
      $this->data['conpanyWallet_balance'] = $this->data['logged_use']['company_wallet_balance'];
        $this->load->view('wallet/index', $this->data);
    }

   
   
    //load datatable data
   

    public function getwalletdata() {

  	$user_id = $this->data['logged_use']['id'];
        $columns = array('id', 'type', 'amount', 'comment', 'created_datetime');
        $request = $this->input->get();
	$re = base64_decode($request['wtid']);

        $condition = array();

        $condition['user_id'] = $user_id;
        if (!empty($re)) {

            $condition['id'] = $re;
        }
        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "id,type,amount,comment,created_datetime";
        echo $this->common->getDataTableSource('wallet_transaction', $columns, $condition, $getfiled, $request, array());

        die();
    }

   ///Rewards transaction///
    public function rewards(){
         
        $this->load->view('rewards/index', $this->data);
    }
    public function getrewardsdata() {
     $user_id = $this->data['logged_use']['id'];
	
        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'join_type' => '',
        );

        $columns = array('user_reward.id','user_reward.amount', 'user_reward.from_user_id', 'user_reward.created_datetime','user.email');
        $request = $this->input->get();
        $condition = array();

        $condition['user_id'] = $user_id;

        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "user_reward.id,user_reward.wallet_transaction_id,user_reward.amount,user_reward.created_datetime,user.email";
       echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request, $join_str);



        die();
    }
   
     /*     * ********************* reward Transactions list ********** */

    function listofrewards() {
        $user_id = $this->session->userdata('user_id');

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'join_type' => '',
        );

        $columns = array('user_reward.amount', 'user_reward.from_user_id', 'user_reward.created_datetime', 'user.email');
        $request = $this->input->get();
        $level = $request['tid'];
 
        $condition = array(
            'user_reward.user_id' => $user_id,
            'user_reward.level' => $level
        );
       
        $getfiled = "user_reward.id,user_reward.amount,user_reward.created_datetime,user.email";
        echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request, $join_str);  
	
	die();
    
    }

 function countTax() {
        $json = array();
        $amount = $this->input->post('amount');
        $total_tax = $this->common->select_data_by_id('tax', 'status', 'Enable', 'sum(percentage) as total_tax_percent', array());
        $Tax_per = $this->common->select_data_by_id('tax', 'status', 'Enable', 'title,percentage', array());
//        print_r($Tax_per);exit;
        $ttltax = ($amount * $total_tax[0]['total_tax_percent']) / 100;
        $ttlamount = $amount - $ttltax;

        $json['tax'] = $Tax_per;
        $json['total_tax'] = $ttltax;
        $json['total_amount'] = $ttlamount;
        echo json_encode($json);
        die();
    }

    function transfer() {

        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('amount', 'amount', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $amount = $this->input->post('amount');
                $tax = $this->input->post('tax');

                /*                 * *********** check available amount *************** */
                $wallet_balance = $this->common->select_data_by_id('user', 'id', $this->session->userdata['user_id'], 'wallet_balance,company_wallet_balance', array());
		
		if($amount <= 0){
		    $this->session->set_flashdata('error', 'You can not transfer zero amount');
                    redirect('Companywallet', 'refresh');		
		}
                if ($wallet_balance[0]['wallet_balance'] < $amount) {
                    $this->session->set_flashdata('error', 'There is not enough balance in your wallet. Please check your wallet');
                    redirect('Wallet', 'refresh');
                } else {
                    $data1 = array(
                        'amount' => $amount,
                        'type' => 'Debit',
                        'user_id' => $this->session->userdata['user_id'],
                        'comment' => 'Amount debited by company wallet',
                        'created_datetime' => date('Y-m-d H:i:s'),
                        'created_ip' => $this->input->ip_address(),
                    );
                    $result = $this->common->insert_data_getid($data1, 'wallet_transaction');
//echo $result;exit;
                    if (!empty($result)) {

                        $data = array(
                            'amount' => $amount,
                            'total_tax' => $tax,
                            'type' => 'Credit',
                            'wallet_transaction_id' => $result,
                            'from_userid' => $this->session->userdata['user_id'],
			    'comment' => 'Amount credited from your wallet',
                            'created_date' => date('Y-m-d H:i:s'),
                            'created_ip' => $this->input->ip_address(),
                            'modified_date' => date('Y-m-d H:i:s'),
                            'modified_ip' => $this->input->ip_address()
                        );

                        $re = $this->common->insert_data($data, 'company_wallet');

                        if ($re) {

                            // cut the balance from wallet.
                            $update_data = array(
                                'wallet_balance' => $wallet_balance[0]['wallet_balance'] - $amount,
                                'company_wallet_balance' => $wallet_balance[0]['company_wallet_balance'] + $amount,
                            );

                            $this->common->update_data($update_data, 'user', 'id', $this->session->userdata['user_id']);

                            $this->session->set_flashdata('success', 'Your amount transfered successfully to Company Wallet!');
                            redirect('Wallet', 'refresh');
                        } else {
                            $this->session->set_flashdata('error', 'Something went wrong! please Try again');
                            redirect('Wallet', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Something went wrong! please Try again');
                        redirect('Wallet', 'refresh');
                    }
                }
            }
        }
    }

// get all info of tax charges and user's info

    function getAllinfo() {
        $json = array();
        $mobile = $this->input->post('mobile_no');


        $profile = $this->common->select_data_by_id('user', 'mobile_no', $mobile, '*', array());

        $json['profile'] = $profile[0];

        echo json_encode($json);
        die();
    }

    //check mobile no. exist or not

    function contactExist() {
        $mobile_no = $this->input->post('mobile_no');

        $re = $this->common->select_data_by_id('user', 'mobile_no', $mobile_no, '*', array());
//       print_r($re);exit;
        if (!empty($re)) {
            $json = array();
            $json['cexist'] = 1;
            echo json_encode($json);
            die();
        } else {

            echo 'false';
            die();
        }
    }
 
    
}


    
