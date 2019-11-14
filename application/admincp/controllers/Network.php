<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends MY_Controller {

    public function __construct() {
        parent::__construct();

      
         $this->data['title'] = 'Network : ' . $this->data['app_name'];
        //redirect to dashboard if already login
        

        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        $this->data['bank_detail'] = $this->common->select_data_by_id('bank_detail', 'user_id', $this->session->userdata('user_id'), '*', array());

        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
        $this->data['registration_fee'] = $this->data['fixpayamount']['registration_fee'];
        $this->data['registrasationpayment'] = $this->common->selectRecordById('user', $this->session->userdata('user_id'), 'id');

        $this->data['paymentverifiedstatus'] = $this->data['registrasationpayment']['payment_verified'];
        $this->data['paymentdata'] = $this->common->selectRecordById('register_payment', $this->session->userdata('user_id'), 'user_id');

        $this->data['paymentstatus'] = $this->data['paymentdata']['status'];
        $this->data['paymentcomment'] = $this->data['paymentdata']['comment'];
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
    }

    public function index($id) {
//        $this->data['wallet_balance'] = $this->data['logged_use']['wallet_balance'];
//
//        $this->data['ref_url'] = site_url('Register/new_ref/') . $this->data['logged_use']['referer_code'];
//
//        $this->data['sponser_text'] = 'You don\'t have any sponsor';
//        $sponser_user = $this->common->select_data_by_condition('user', array('id' => $this->data['logged_use']['ref_by']), '*', 'id', '1', '', '1', array());
//
//        if (!empty($sponser_user)) {
//            $this->data['sponser_text'] = 'Your sponsor is ' . $sponser_user[0]['referer_code'];
//        }
//
//
//        $purchased_block = array();
//
//        $this->data['transaction_status'] = $this->common->select_data_by_id('register_payment', 'user_id', $this->session->userdata('user_id'), 'status', array());

        /* --------------------User's Reward Amount at all level----------------------------------- */
      
        $this->data['user_iddata']=$id;
          $this->data['dtlreward'] = $this->common->select_data_by_condition('business_plan', array(), 'reward_id,person_number', '', '', '', '', array());
          //print_r($this->data['dtlreward']); exit();  
        for ($i = 0; $i <11; $i++) {

            $condition_array = array(
                'user_id' => $id,
                'level' => $i+1
            );
            
             $this->data['dtluser'][$i] = $this->common->select_data_by_condition('user_reward', $condition_array, '*', '', '', '', '', array());
            $this->data['totaluser'][$i] = count($this->data['dtluser'][$i]);
//            echo $this->db->last_query();exit;
            $this->data['totalrewardamount'][$i] = $this->common->select_data_by_condition('user_reward', $condition_array, 'sum(amount) as totalamount', '', '', '', '', array());
            if (empty($this->data['totalrewardamount'][$i][0]['totalamount'])) {

                $this->data['totalrewardamount'][$i][0]['totalamount'] = 0.00;
            }
        }
//        echo '<pre>';print_r($this->data['dtluser']);exit;
       

        $this->load->view('network/index', $this->data);
    }


    function listofusers() {
         $request = $this->input->get();
        $user_id = $request['userid'];

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'join_type' => '',
        );

        $columns = array('user_reward.id', 'user_reward.amount', 'user_reward.from_user_id', 'user_reward.created_datetime', 'user.email','user.firstname','user.lastname');
        $request = $this->input->get();
        $level = $request['tid'];
//echo $level;die();
        $condition = array(
            'user_reward.user_id' => $user_id,
            'user_reward.level' => $level
        );
        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "user_reward.id,user_reward.amount,user_reward.created_datetime,user.email,user.firstname,user.lastname";
        echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request, $join_str);
        die();
    }

}
