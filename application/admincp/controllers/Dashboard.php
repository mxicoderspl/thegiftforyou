<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Dashboard.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Dashboard extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Dashboard : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {

	$this->data['userdatas'] = $this->common->select_data_by_id('user', 'status', 'Enable','*');
	 $this->data['disableuserdata'] = $this->common->select_data_by_id('user', 'status', 'Disable','*');
	 $this->data['totaluserdata']= $this->common->get_all_record('user', '*', '', '');
	$this->data['enableuser']= count($this->data['userdatas']);
	$this->data['disableuser']= count($this->data['disableuserdata']);
	$this->data['totaluser']= count($this->data['totaluserdata']);
	$this->data['totaluser']= $this->data['enableuser'] + $this->data['disableuser'] ;
	 $this->data['admindata'] = $this->common->selectRecordById('admin', '1', 'admin_id');
         $this->data['wallet_balance']= $this->data['admindata']['wallet_balance'];
        $this->data['paymentapproveduser'] = count($this->common->select_data_by_condition('register_payment', array('DATE(created_datetime)'=>date('Y/m/d',strtotime("0 days"))), '*', '', '', '', '', array()));	
	 $this->data['lastconfirmcsvfiledate']= $this->common->get_all_record('payment_sheet', 'MAX(created_date) ', '', '');
	$this->data['lastdownloaddate']= $this->data['lastconfirmcsvfiledate']['0']['MAX(created_date)'];
	//print_r($this->data['lastdownloaddate']);
//exit();
       $this->load->view('dashboard/index', $this->data);
    }

    //logout from admin
    function logout() {
        if (isset($this->session->userdata['thegiftsforyou_admin'])) {
            $this->session->unset_userdata('thegiftsforyou_admin');
            $this->session->sess_destroy();
            redirect('Login', 'refresh');
        } else {
            $this->session->unset_userdata('thegiftsforyou_admin');
            $this->session->sess_destroy();
            redirect('Login', 'refresh');
        }
    }

    //check admin name,admin email value is unique in database 
    public function checkExits() {
        $fval = $this->input->post('filed_name');
        switch ($fval) {
            case 'admin_name':
                $fieldName = 'user_name';
                $fieldValue = ($this->input->post('admin_name'));
                break;

            case 'admin_email':
                $fieldName = 'email';
                $fieldValue = ($this->input->post('admin_email'));
                break;

            default:
                $fieldValue = '';
                $fieldName = '';
                break;
        }

        if (trim($fieldValue) != '') {
            $res = $this->common->checkName('admin', $fieldName, $fieldValue, 'admin_id', $this->data['adminID']);
            if (empty($res)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }

    //update record 
    public function editProfile() {
        if ($this->input->is_ajax_request()) {
            $this->data['admin'] = $this->common->selectRecordById('admin', $this->data['adminID'], 'admin_id');
            $this->load->view('dashboard/profile', $this->data);
            return;
        }
        $this->form_validation->set_rules('first_name', 'first_name', 'required');
        $this->form_validation->set_rules('last_name', 'last_name', 'required');
        $this->form_validation->set_rules('user_name', 'user_name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect($this->data['redirect_url'], 'refresh');
        } else {
            $updateData = array(
                "firstname" => $this->input->post('first_name'),
                "lastname" => $this->input->post('last_name'),
                "user_name" => $this->input->post('user_name'),
                "email" => $this->input->post('email'),
                "modified_date" => date('Y-m-d H:i:s'),
                "modified_ip" => $this->input->ip_address()
            );
            $res = $this->common->update_data($updateData, 'admin', 'admin_id', $this->data['adminID']);
            if ($res) {
                $this->session->set_flashdata('success', 'Profile updated successfully.');
                redirect('Dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is error in updated profile. Try later!');
                redirect('Dashboard', 'refresh');
            }
        }
    }

    //password exist
    function pwdexist() {

        $pwd = sha1($this->input->post('old_password'));
        $res = $this->common->select_data_by_id('admin', 'admin_id', $this->data['adminID'], 'password', array());
        $encryptedPassword = $res[0]['password'];
        if ($pwd != '') {
            if ($pwd === $encryptedPassword) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        } else {
            echo 'false';
            die();
        }
    }

    //change password
    public function changepassword() {
        if ($this->input->is_ajax_request()) {
            //$this->data['admin']=$this->common->selectRecordById('admin',$this->data['adminID'],'admin_id');
            $this->load->view('dashboard/changepassword', $this->data);
            return;
        }
        if ($this->input->method() == 'post') {
            $redirect = '';
            $last_url = $this->last_url();
            if ($last_url != '') {
                $redirect = $last_url;
            } else {
                $redirect = 'Dashboard';
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow all validation rules.');
                redirect($redirect, 'refresh');
            }
            $checkAuth = $this->common->selectRecordById('admin', $this->data['adminID'], 'admin_id');
            $password = sha1($this->input->post('old_password'));
            $dbPassword = $checkAuth['password'];
            if ($password !== $dbPassword) {
                $this->session->set_flashdata('error', 'Please enter correct old password.');
                redirect($redirect, 'refresh');
            }
            $newpassword = $this->input->post('new_password');
            $confirmpass = $this->input->post('confirm_password');
            if ($newpassword != $confirmpass) {
                $this->session->set_flashdata('error', 'New password and Confirm password must be same.');
                redirect($redirect, 'refresh');
            }
            $updatedPassword = sha1($newpassword);
            $data = array('password' => $updatedPassword, 'modified_date' => date('Y-m-d H:i:s'));
            if ($this->common->update_data($data, 'admin', 'admin_id', $this->data['adminID'])) {
                //echo $this->last_query();die();
                $this->session->set_flashdata('success', 'Password changed successfully.');
                redirect($redirect, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect($redirect, 'refresh');
            }
        }
    }
    
       
    
      
    

}

/* End of file Dashboard.php */
/* Location: ./application/admincp/controllers/Dashboard.php */
    
