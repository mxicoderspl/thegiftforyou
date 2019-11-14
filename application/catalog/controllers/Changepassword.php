<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Changepassword extends MY_Controller {

    public function __construct() {
        parent::__construct();

//redirect to dashboard if already login
		
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }
$this->data['title'] = $this->data['site_name'] . ': Change Password';
//meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        $this->data['bank_detail'] = $this->common->select_data_by_id('bank_detail', 'user_id', $this->session->userdata('user_id'), '*', array());

        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        
    }

    public function index() {
        return $this->load->view('changepassword/index', $this->data);
    }

    public function passwordExits() {
        $uid = $this->session->userdata('user_id');
        $oldpass = $this->input->post('oldpass');

        $pass = sha1($oldpass);

        $userpass = $this->common->select_data_by_id('user', 'id', $uid, 'password', array());

        if ($pass == $userpass[0]['password']) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    public function update() {
        $userid = $this->session->userdata('user_id');
        $this->form_validation->set_rules('oldpass', 'oldpass', 'required');
        $this->form_validation->set_rules('newpass', 'newpass', 'required');
        $this->form_validation->set_rules('confirmpass', 'confirmpass', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect('Changepassword', 'refresh');
        } else {
            $data['password'] = sha1($this->input->post('newpass'));

            $result = $this->common->update_data($data, 'user', 'id', $userid);
            if ($result) {
                $this->session->set_flashdata('success', 'Your Password updated successfully');
                redirect('Changepassword', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Opps!! Something went wrong.');
                redirect('Changepassword', 'refresh');
            }
        }
    }

}
