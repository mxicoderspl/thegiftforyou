<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaction extends MY_Controller {

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
	// trasaction page 
    public function index() {
        $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
        $this->load->view('Transaction/index', $this->data);
    }

   
   
    //load user datatable data
   

    public function getgrdUserData() {

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'wallet_transaction.user_id',
            'type' => '',
        );
	

        $columns = array  ('user.email','wallet_transaction.type','wallet_transaction.amount','wallet_transaction.comment','wallet_transaction.created_datetime');
        $request = $this->input->get();
        $condition = array();
       if (!empty($request['user_id'])) {
           
            $condition['user_id'] = base64_decode($request['user_id']);
        }
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "wallet_transaction.id,user.email,wallet_transaction.type,wallet_transaction.amount,wallet_transaction.comment,wallet_transaction.created_datetime";
        echo $this->common->getDataTableSource('wallet_transaction', $columns, $condition, $getfiled, $request, $join_str);

        die();
    }

    

   
    

   
   

   

    
    
}


    
