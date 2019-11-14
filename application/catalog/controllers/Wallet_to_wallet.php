<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallet_to_wallet extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = $this->data['site_name'] . ': Wallet to wallet';

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    // trasaction page 
    public function index() {
        $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
        $this->load->view('wallet_to_wallet/index', $this->data);
    }

    //load user datatable data


    public function getdata() {

        $join_str[0] = array(
            'table' => 'user as u1',
            'join_table_id' => 'u1.id',
            'from_table_id' => 'wallet_to_wallet.to_userid',
            'type' => '',
        );
        $columns = array('wallet_to_wallet.wallet_transaction_id','u1.email', 'wallet_to_wallet.amount', 'wallet_to_wallet.Total_tax', 'wallet_to_wallet.created_date');
        $request = $this->input->get();
        $condition = array(
            'from_userid'=>$this->session->userdata['user_id']
        );
        
        if (!empty($request['user_id'])) {

            $condition['from_userid'] = base64_decode($request['user_id']);
        }
        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) >='] = $request['from_date'];
            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) <='] = $request['to_date'];
        }
        $getfiled = "wallet_to_wallet.id,u1.email as to_username,wallet_to_wallet.wallet_transaction_id,wallet_to_wallet.amount,wallet_to_wallet.Total_tax,wallet_to_wallet.created_date";
        echo $this->common->getDataTableSource('wallet_to_wallet', $columns, $condition, $getfiled, $request, $join_str);
        // print_r($this->db->last_query()); exit();
        die();
    }

public function getdata1() {

        $join_str[0] = array(
            'table' => 'user as u1',
            'join_table_id' => 'u1.id',
            'from_table_id' => 'wallet_to_wallet.from_userid',
            'type' => '',
        );
        $columns = array('wallet_to_wallet.wallet_transaction_id','u1.email', 'wallet_to_wallet.amount', 'wallet_to_wallet.Total_tax', 'wallet_to_wallet.created_date');
        $request = $this->input->get();
        $condition = array(
            'to_userid'=>$this->session->userdata['user_id']
        );
        
        if (!empty($request['user_id'])) {

            $condition['to_userid'] = base64_decode($request['user_id']);
        }
        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) >='] = $request['from_date'];
            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) <='] = $request['to_date'];
        }
        $getfiled = "wallet_to_wallet.id,u1.email as from_username,wallet_to_wallet.wallet_transaction_id,wallet_to_wallet.amount,wallet_to_wallet.Total_tax,wallet_to_wallet.created_date";
        echo $this->common->getDataTableSource('wallet_to_wallet', $columns, $condition, $getfiled, $request, $join_str);
        // print_r($this->db->last_query()); exit();
        die();
    }


}
