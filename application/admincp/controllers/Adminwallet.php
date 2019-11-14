<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminwallet extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Transaction : ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }
	//show  a wallet transaction page
    public function index() {
       
        $this->load->view('adminwallet/index', $this->data);
    }

   
   
    //load Wallet data
   

    public function getwalletdata() {

       
	

        $columns = array  ('wallet_transaction.id','wallet_transaction.type','wallet_transaction.amount','wallet_transaction.comment','wallet_transaction.created_datetime');
        $request = $this->input->get();
        $condition = array();
       
           
            $condition['user_id'] = '0';
       
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "wallet_transaction.id,wallet_transaction.type,wallet_transaction.amount,wallet_transaction.comment,wallet_transaction.created_datetime";
        echo $this->common->getDataTableSource('wallet_transaction', $columns, $condition, $getfiled, $request, array());

        die();
    }

   ///Rewards transaction///
    public function rewards(){
        $this->load->view('adminrewards/index', $this->data);
    }

	// rewards transaction data list get
    public function getrewardsdata() {

       
	$join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'type' => '',
        );
	


        $columns = array  ('user_reward.wallet_transaction_id','user_reward.amount','user.email','user_reward.created_datetime');
        $request = $this->input->get();
        $condition = array();
       
           
            $condition['user_id'] = '0';
       
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled="user_reward.id,user_reward.wallet_transaction_id,user_reward.amount,user.referer_code,user.email,user_reward.created_datetime";
        echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request, $join_str);

        die();
    }
   
    

   
   

   

    
    
}


    
