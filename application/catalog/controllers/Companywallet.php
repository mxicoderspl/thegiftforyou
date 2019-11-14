<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companywallet extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = $this->data['site_name'] . ': Company Wallet';

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    public function index() {
	 $this->data['wallet_balance'] = $this->data['logged_use']['wallet_balance'];
      $this->data['conpanyWallet_balance'] = $this->data['logged_use']['company_wallet_balance'];
       
        $this->load->view('companywallet/index', $this->data);
    }

    function transaction() {

        $columns = array('wallet_transaction_id', 'amount', 'type','comment','created_date');
        $request = $this->input->get();
        $condition = array();

        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_date) >='] = $request['from_date'];
            $condition['DATE(created_date) <='] = $request['to_date'];
        }
        $condition['from_userid'] = $this->session->userdata['user_id'];
        $getfiled = "wallet_transaction_id,amount,comment,type,created_date";
        echo $this->common->getDataTableSource('company_wallet', $columns, $condition, $getfiled, $request, array());

        die();
    }

    function countTax() {
        $json = array();
        $amount = $this->input->post('amount');
        $total_tax = $this->common->select_data_by_id('tax', 'status', 'Enable', 'sum(percentage) as total_tax_percent', array());
        $Tax_per = $this->common->select_data_by_id('tax', 'status', 'Enable', 'title,percentage', array());
//        print_r($Tax_per);exit;
        $ttltax = ($amount * $total_tax[0]['total_tax_percent']) / 100;
        $ttlamount = $amount-$ttltax;
        
        $json['tax'] = $Tax_per;
        $json['total_tax'] = $ttltax;
        $json['total_amount'] = $ttlamount;
        echo json_encode($json);
        die();
    }

    function transfer() {
	
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('amount', 'amount', 'required');
//            $this->form_validation->set_rules('comment', 'comment', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $amount = $this->security->xss_clean($this->input->post('amount'));
                //$tax = $this->input->post('tax');

                /*                 * *********** check available amount *************** */
                $wallet_balance = $this->common->select_data_by_id('user', 'id', $this->session->userdata['user_id'], 'wallet_balance,company_wallet_balance', array());
		if($amount <= 0){
		    $this->session->set_flashdata('error', 'Invalid Amount can not transfer');
                    redirect('Companywallet', 'refresh');		
		}
                if ($wallet_balance[0]['company_wallet_balance'] < $amount) {
                    $this->session->set_flashdata('error', 'There is not enough balance in your wallet. Please check your wallet');
                    redirect('Companywallet', 'refresh');
                } else {
                    $data1 = array(
                        'amount' => $amount,
                        'type' => 'Credit',
                        'user_id' => $this->session->userdata['user_id'],
                        'comment' => 'Amount transfered from company wallet',
                        'created_datetime' => date('Y-m-d H:i:s'),
                        'created_ip' => $this->input->ip_address(),
                    );
                    $result = $this->common->insert_data_getid($data1, 'wallet_transaction');
//echo $result;exit;
                    if (!empty($result)) {
                        $data = array(
                            'amount' => $amount,
                            //'total_tax' => $tax,
                            'type' => 'Debit',
                            'wallet_transaction_id' => $result,
                            'from_userid' => $this->session->userdata['user_id'],
			    'comment' => 'Amount transfered from your company wallet',
                            'created_date' => date('Y-m-d H:i:s'),
                            'created_ip' => $this->input->ip_address(),
                            'modified_date' => date('Y-m-d H:i:s'),
                            'modified_ip' => $this->input->ip_address()
                        );

                        $re = $this->common->insert_data($data, 'company_wallet');

                        if ($re) {
				
			    $update_data = array(
                                'wallet_balance' => $wallet_balance[0]['wallet_balance'] + $amount,
                                'company_wallet_balance' => $wallet_balance[0]['company_wallet_balance'] - $amount ,
                            );

                            $this->common->update_data($update_data, 'user', 'id', $this->session->userdata['user_id']);

                            $this->session->set_flashdata('success', 'Your amount transfered successfully!');
                            redirect('Companywallet', 'refresh');
                        } else {
                            $this->session->set_flashdata('error', 'Something went wrong! please Try again');
                            redirect('Companywallet', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Something went wrong! please Try again');
                        redirect('Companywallet', 'refresh');
                    }
                }
            }
        }
    }

}
