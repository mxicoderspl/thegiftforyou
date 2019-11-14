<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Bankdetail extends MY_Controller {

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
//        $$this->common->select_data_by_id('bank_detail','user_id',$this->session->userdata('user_id'),'*',array());
        return $this->load->view('bankdetail/index', $this->data);
    }

    public function update() {
       
        $userid = $this->session->userdata('user_id');
        $this->form_validation->set_rules('banknm', 'banknm', 'required');
        $this->form_validation->set_rules('accountnm', 'accountnm', 'required');
        $this->form_validation->set_rules('accountno', 'accountno', 'required');
        $this->form_validation->set_rules('ifsccode', 'ifsccode', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            $data = array(
                'user_id' => $userid,
                'bank_name' => $this->input->post('banknm'),
                'account_name' => $this->input->post('accountnm'),
                'account_no' => $this->input->post('accountno'),
                'ifsc_code' => $this->input->post('ifsccode'),
                'modified_date' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );
            $result = $this->common->update_data($data, 'bank_detail', 'user_id',$userid);
            if ($result) {
                $this->session->set_flashdata('success', 'Your Bank Detail updated successfully');
                redirect('Bankdetail', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps!! Something went wrong.');
                redirect('Bankdetail', 'refresh');
            }
        }
    }

}
