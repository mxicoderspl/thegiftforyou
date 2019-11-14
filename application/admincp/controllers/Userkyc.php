<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  
 *  
 */

class Userkyc extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Transaction : ' . $this->data['app_name'];

        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }

    public function index() {
        //$this->data['user'] = $this->common->get_all_record('user', '*', '', '');
	 $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
	
//     print_r($this->data['user']);exit;
        $this->load->view('kyc/index', $this->data);
    }

    public function kycusersdata() {

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'kyc_user.user_id',
            'type' => '',
        );

        $columns = array('user.firstname', 'kyc_user.adhar_no', 'kyc_user.adhar_photo', 'kyc_user.passbook_photo', 'kyc_user.pancard_photo', 'kyc_user.status', 'kyc_user.created_datetime');
        $request = $this->input->get();
        $condition = array();

        if (!empty($request['user_id'])) {

            $condition['user_id'] = base64_decode($request['user_id']);
        }
        if (!empty($request['status'])) {

            $condition['kyc_user.status'] = $request['status'];
        }
        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "kyc_user.id,kyc_user.user_id,user.firstname,kyc_user.adhar_photo,kyc_user.passbook_photo,kyc_user.pancard_photo,kyc_user.status,kyc_user.created_datetime";
        echo $this->common->getDataTableSource('kyc_user', $columns, $condition, $getfiled, $request, $join_str);

        die();
    }

    public function update_status() {
		
        if ($this->input->method() == 'post') {
		$user_id = $this->input->post('user_id');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_rules('comment', 'comment', 'required');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $id = $this->input->post('user_id');
                $new_status = $this->input->post('status');
                $comment = $this->input->post('comment');

                $old_status = $this->common->select_data_by_id('kyc_user', 'user_id', $id, 'status', array());

                if ($old_status[0]['status'] == $new_status) {

                    $this->session->set_flashdata('error', 'There is no changes in status !');
                    redirect(base_url() . 'Userkyc', 'refresh');
                } else {
                    if ($new_status == 'Declined') {
                        if ($old_status[0]['status'] == 'Approved') {
                            $this->session->set_flashdata('error', 'KYC request already Approved ,do not declined');
                            redirect(base_url() . 'Userkyc', 'refresh');
                        }
                    }
                    $result = $this->common->update_data(array('status' => $new_status, 'comment' => $comment), 'kyc_user', 'user_id', $id);

                    if ($result) {
			$this->userkycStatusEmail($user_id,$new_status);
                        $this->session->set_flashdata('success', 'status is updated successfully.');
                        redirect(base_url() . 'Userkyc', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                        redirect(base_url() . 'Userkyc', 'refresh');
                    }
                }
            }
        }
    }

function userkycStatusEmail($userid,$new_status){
			
	   if($new_status=='Approved'){
		 $mailData = $this->common->selectRecordById('email_format', '33', 'id');
		  
	   }else{
		 $mailData = $this->common->selectRecordById('email_format', '34', 'id');
		  
	   }
		$userinfodatas = $this->common->select_data_by_condition('user', array('id' => $userid), '*', '', '', '', '', array());
		 
		    
		 
		    $subject =  $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $email=$userinfodatas[0]['email'];
		    $name=$userinfodatas[0]['firstname'].' '.$userinfodatas[0]['lastname'];
	
		   $this->data['mail_body'] = str_replace("%email%",$email ,str_replace("%site_name%", $site_name, str_replace("%name%", $name,stripslashes($mailformat))));
            	    // print_r($mail_body);die();
		    $forgotEmail=  $email;
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		   $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
		    
		}
	//status change mail for user
		
		function sendEmail($app_name, $app_email, $to_email, $subject, $mail_body) {

			$this->config->load('email', TRUE);
			$this->cnfemail = $this->config->item('email');
			//Loading E-mail Class
			$this->load->library('email');
			$this->email->initialize($this->cnfemail);
			$this->email->from($app_email, $app_name);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
			$this->email->send();
			return;
		    }

}

