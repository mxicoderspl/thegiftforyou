<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'] . ': Dashboard';

        //redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

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

    public function index() {
        $this->data['wallet_balance'] = $this->data['logged_use']['wallet_balance'];

        $this->data['ref_url'] = site_url('Register/new_ref/') . $this->data['logged_use']['referer_code'];

        $this->data['sponser_text'] = 'You don\'t have any sponsor';
        $sponser_user = $this->common->select_data_by_condition('user', array('id' => $this->data['logged_use']['ref_by']), '*', 'id', '1', '', '1', array());

        if (!empty($sponser_user)) {
            $this->data['sponser_text'] = 'Your sponsor is ' . ucfirst($sponser_user[0]['firstname']).' '.ucfirst($sponser_user[0]['lastname']);
        }


        $purchased_block = array();

        $this->data['transaction_status'] = $this->common->select_data_by_id('register_payment', 'user_id', $this->session->userdata('user_id'), 'status', array());

        /* --------------------User's Reward Amount at all level----------------------------------- */

        for ($i = 1; $i <= 11; $i++) {

            $condition_array = array(
                'user_id' => $this->session->userdata('user_id'),
                'level' => $i
            );
            $this->data['totalre'][$i] = $this->common->select_data_by_condition('user_reward', $condition_array, 'sum(amount) as totalamount', '', '', '', '', array());
            if (empty($this->data['totalre'][$i][0]['totalamount'])) {

                $this->data['totalre'][$i][0]['totalamount'] = 0.00;
            }
        }

        /* ------------------------transfered/ deposited balance------- --------------- */
        $condition_array = array(
            'user_id' => $this->session->userdata('user_id'),
            'type' => 'debit'
        );
        $this->data['totaldeposite'] = $this->common->select_data_by_condition('wallet_transaction', $condition_array, 'sum(amount) as totaldeposite', '', '', '', '', array());
        if(empty($this->data['totaldeposite'][0]['totaldeposite'])) {

            $this->data['totaldeposite'][0]['totaldeposite'] = 0.00;
        }
        
	/* -----------------------------  referals ------------------------ */
        $condition_array = array(
            'user_id' => $this->session->userdata('user_id')
        );
        $this->data['referal'] = $this->common->select_data_by_condition('user_reward', $condition_array, 'count(id) as total_referal', '', '', '', '', array());

        /* ---------------------- tickets -------------------------------- */
        $condition_array = array(
            'user_id' => $this->session->userdata('user_id'),
            'status' => 'open'
        );
        $this->data['open_ticket'] = $this->common->select_data_by_condition('support', $condition_array, 'count(id) as total_open', '', '', '', '', array());

        $condition_array = array(
            'user_id' => $this->session->userdata('user_id'),
            'status' => 'close'
        );
        $this->data['close_ticket'] = $this->common->select_data_by_condition('support', $condition_array, 'count(id) as total_close', '', '', '', '', array());

	/* ---------------------- Balance -------------------------------- */
	 $condition_array = array(
            'id' => $this->session->userdata('user_id'),
        );
        $this->data['balance'] = $this->common->select_data_by_condition('user', $condition_array, 'wallet_balance,company_wallet_balance', '', '', '', '', array());

        $this->load->view('dashboard/index', $this->data);
    }

    function checkrequeststatus() {
        $json = array();

        $uid = $this->session->userdata('user_id');
        $re = $this->common->select_data_by_id('register_payment', 'user_id', $uid, '*', array());

        if (!empty($re)) {
            $json['data'] = 1;
            echo json_encode($json);
            die();
        } else {
            $json['data'] = 0;
            echo json_encode($json);
            die();
        }
    }

    function bankdetail() {
        $this->form_validation->set_rules('banknm', 'banknm', 'required');
        $this->form_validation->set_rules('accountnm', 'accountnm', 'required');
        $this->form_validation->set_rules('accountno', 'accountno', 'required');
        $this->form_validation->set_rules('ifsccode', 'ifsccode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'bank_name' => $this->input->post('banknm'),
                'account_name' => $this->input->post('accountnm'),
                'account_no' => $this->input->post('accountno'),
                'ifsc_code' => $this->input->post('ifsccode'),
                'created_date' => date('Y-m-d H:i:s'),
                'created_ip' => $this->input->ip_address(),
                'modified_date' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );
            $result = $this->common->insert_data($data, 'bank_detail');
            if ($result) {
                $this->session->set_flashdata('success', 'Your Bank Detail submitted successfully');
                redirect('Dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps!! Something went wrong.');
                redirect('Dashboard', 'refresh');
            }
        }
    }

    function totalpending() {
        $json = array();
        $block_type_id = $this->input->post('block_type_id');
        $html = '';
        $json['status'] = 'fail';
        if ($block_type_id == '' || $block_type_id == 0) {
            $json['data'] = 'No information found!';
            $json['status'] = 'success';
            echo json_encode($json);
            die();
        }

        $join_str[0] = array('table' => 'eblocks as eb',
            'join_table_id' => 'eb.id',
            'from_table_id' => 'user_reward.bonus_eblock_id',
            'join_type' => 'left'
        );
        $join_str[1] = array('table' => 'block_type as bt',
            'join_table_id' => 'bt.id',
            'from_table_id' => 'eb.block_type_id',
            'join_type' => 'left'
        );
        $user_reward = $this->common->select_data_by_condition('user_reward', array('user_reward.user_id' => $this->session->userdata('user_id'), 'user_reward.pending_bonus_block_qty >' => 0, 'bt.id' => $block_type_id), 'user_reward.id,eb.title,bt.title as title1', 'user_reward.created_date', 'ASC', '', '', $join_str);

        $html .= '<center><labe>You have total ' . count($user_reward) . ' eblocks pending</label><br><br>'
                . '<input type="button" value="Allocate all eblocks now" class="btn btn-default" onclick="allocatealleblocks(' . $block_type_id . ')"></center>';
        $json['data'] = $html;
        $json['status'] = 'success';
        echo json_encode($json);
        die();
    }

    function allocatealleblocks() {
        $json = array();
        $block_type_id = $this->input->post('block_type_id');
        $json['status'] = 'fail';
        $json['msg'] = '';
        if ($block_type_id == '' || $block_type_id == 0 || $block_type_id > 3 || $block_type_id < 1) {
            $json['msg'] = 'No information found!';
            echo json_encode($json);
            die();
        }

        $admin = $this->common->select_data_by_id('admin', 'admin_id', 1, 'regular,silver,gold', array());

        if ($block_type_id == 1) {
            if ($admin[0]['regular'] == 0) {
                $json['msg'] = 'Sorry! Regular eblocks currently disabled!';
                echo json_encode($json);
                die();
            }
        } elseif ($block_type_id == 2) {
            if ($admin[0]['silver'] == 0) {
                $json['msg'] = 'Sorry! Silver eblocks currently disabled!';
                echo json_encode($json);
                die();
            }
        } elseif ($block_type_id == 3) {
            if ($admin[0]['gold'] == 0) {
                $json['msg'] = 'Sorry! Gold eblocks currently disabled!';
                echo json_encode($json);
                die();
            }
        }


        $join_str[0] = array('table' => 'eblocks as eb',
            'join_table_id' => 'eb.id',
            'from_table_id' => 'user_reward.bonus_eblock_id',
            'join_type' => 'left'
        );
        $join_str[1] = array('table' => 'block_type as bt',
            'join_table_id' => 'bt.id',
            'from_table_id' => 'eb.block_type_id',
            'join_type' => 'left'
        );
        $user_reward = $this->common->select_data_by_condition('user_reward', array('user_reward.user_id' => $this->session->userdata('user_id'), 'user_reward.pending_bonus_block_qty >' => 0, 'bt.id' => $block_type_id), 'user_reward.id,user_reward.eblocks_node_id,user_reward.bonus_eblock_id,bt.id as typeid,user_reward.pending_bonus_block_qty', 'user_reward.created_date', 'ASC', '', '', $join_str);
        if (!empty($user_reward)) {
            foreach ($user_reward as $r) {
                $auto_ides_string = array();
                for ($i = 1; $i <= $r['pending_bonus_block_qty']; $i++) {
                    $node_auto_id = $this->add_new_node($r['bonus_eblock_id'], $r['typeid'], 0, 'Bonus', $r['eblocks_node_id']);
                    if ($node_auto_id != '' && $node_auto_id != 0) {
                        $auto_ides_string[] = $node_auto_id;


                        $this->reward($node_auto_id);
                        $this->reward_extra($node_auto_id);
                    }
                }
                $ttqty = $r['pending_bonus_block_qty'] - (count($auto_ides_string));
                if ($ttqty < 0) {
                    $ttqty = 0;
                }
                $this->common->update_data(array('eblocks_auto_ids' => json_encode($auto_ides_string), 'pending_bonus_block_qty' => $ttqty), 'user_reward', 'id', $r['id']);
            }
            $json['status'] = 'success';
            $json['msg'] = 'Thank you! All eblock allocated successfully';
        } else {
            $json['msg'] = 'No pending eblocks found!';
        }


        echo json_encode($json);
        die();
    }

 public function logout() {
        if (isset($this->session->userdata['user_id'])) {
            $this->session->unset_userdata('user_id');
            $this->session->userdata('user_login_log_token');

            $this->session->unset_userdata('user_login_log_token');
            $this->session->sess_destroy();

            redirect('Login', 'refresh');
        } else {
            $this->session->unset_userdata('user_id');

            $this->session->sess_destroy();
            redirect('Login', 'refresh');
        }
    }

  
}
