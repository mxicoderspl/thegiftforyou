<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Users extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Users : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
	
    }
		//enable user
    public function index() {
        $this->data['userdata'] = $this->common->select_data_by_id('user', 'status', 'Enable','*');
	 
        $this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('users/index', $this->data);
    }
public function getenableUserData() {

        $columns = array('firstname','lastname', 'mobile_no','email','wallet_blance','status');
        $request = $this->input->get();
        $condition = array('status'=>'Enable');
         if (!empty($request['from_date']) && !empty($request['to_date'])) {
            $condition['DATE(created_date) >='] = $request['from_date'];
            $condition['DATE(created_date) <='] = $request['to_date'];
        }
         
        
        $getfiled = "id,firstname,lastname,mobile_no,email,wallet_blance,status";
        echo $this->common->getDataTableSource('user', $columns, $condition, $getfiled, $request);
        die();
    }
	//disable user
	public function disableuser() {
        $this->data['userdata'] = $this->common->select_data_by_id('user', 'status', 'Disable','*');
	 
        $this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('users/disableindex', $this->data);
    }

    // Add user

    public function add() {

        if ($this->input->method() == 'post') {

            
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpass', 'Confirm Password', 'required|matches[password]');
             $this->form_validation->set_rules('referralcode', 'referralcode', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('Users/add', 'refresh');
            } else {
                
             
		if ($this->input->post('referralcode')) {
                    $ref_detail = $this->common->select_data_by_id('user', 'referer_code', $this->input->post('referralcode'), '*', array());
                    if (empty($ref_detail)) {
                        $this->session->set_flashdata('error', 'Your sponsor code is wrong. Please try again.');
                        redirect('Users/add', 'refresh');
                    }
                  
                }
		
		require_once(BASEPATH . 'Authenticator/rfc6238.php');
                $authenticatore_secrete = TokenAuth6238::generateRandomClue(16);
		
               $investorData['google_code'] = $authenticatore_secrete;
                 $referer_code = str_replace(' ', '', $result = substr($this->input->post('email'), 0, 3)) . rand(1000, 9999);
                $investorData = array(
                   
                    "password" => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                    "email" => $this->input->post('email', TRUE),
                    "mobile_no" => $this->input->post('contact_no'),
                    "status" => 'Disable',
                    "activecode" => time() . rand(100, 999),
                    "referer_code" => $referer_code,
		    "google_code" => $authenticatore_secrete,
		    "ref_by"=> $ref_detail[0]['id'],
                    "created_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_date" => date('Y-m-d H:i:s'),                   
                );
                if ($this->common->insert_data($investorData, 'user')) {
                    $this->session->set_flashdata('success', 'user is added successfully.');
                    redirect('Users/add', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect('Users/add', 'refresh');
                }
            }
        }
        $this->load->view('users/add', $this->data);
    }
	//view user profile//
	 public function view() {
		
		
		$user_id = base64_decode($this->input->post('user_id'));
		
		if ($this->input->is_ajax_request()) {
		    if ($user_id != '' && $user_id != 0) {
		        $this->data['user'] = $this->common->selectRecordById('user', $user_id, 'id');
			
		        $this->load->view('users/view', $this->data);
		    } else {
		        echo '<div class="alert alert-danger">
		               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		               <strong>Record not found with specified id. Try later!</strong>
		           </div>';
		    }
		    return;
		}

	       
	    }
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
	       
		   
		    $condition['from_user_id'] = $request['from_date'];
	       
	       if (!empty($request['from_date']) && !empty($request['to_date'])) {

		    $condition['DATE(created_datetime) >='] = $request['from_date'];
		    $condition['DATE(created_datetime) <='] = $request['to_date'];
		}
		$getfiled="user_reward.id,user_reward.wallet_transaction_id,user_reward.amount,user.referer_code,user.email,user_reward.created_datetime";
		echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request, $join_str);

		die();
	    }
	//get rewards list data by user_id
		public function paymentdividebyidlist($user_id) {
	       
	      //  $user_id = base64_decode($this->input->post('user_id'));

	       
	      
		    if ($user_id != '' && $user_id != 0) {
		       
		        $join_str[0] = array(
		    'table' => 'user',
		    'join_table_id' => 'user.id',
		    'from_table_id' => 'user_reward.user_id',
		    'type' => '',
		);
		
		       $this->data['users'] = $this->common->select_data_by_condition('user_reward', array('from_user_id' => $user_id), 'user.email,user.referer_code,user_reward.amount,user_reward.created_datetime', '', '', '', '', $join_str);
		       
		        $this->load->view('users/paymentlistbyid', $this->data);
		    } else {
		        echo '<div class="alert alert-danger">
		               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		               <strong>Record not found with specified id. Try later!</strong>
		           </div>';
		    }
		    return;
	   
	    
		    }
  // update user
    public function update() {
        
        
        $user_id = base64_decode($this->input->post('user_id'));
	
        if ($this->input->is_ajax_request()) {
            if ($user_id != '' && $user_id != 0) {
                $this->data['user'] = $this->common->selectRecordById('user', $user_id, 'id');
		
                $this->load->view('users/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {

            
            $this->form_validation->set_rules('email', 'email', 'required');
           //$this->form_validation->set_rules('contact_no', 'contact_no', 'required');
           	if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                //redirect($this->data['redirect_url'], 'refresh');
		$this->redirect_back(); 
            } else {

             
                $users = $this->common->select_data_by_condition('user', array('id' => $user_id), '*', '', '', '', '', array());
                
  $investorData = array(
                    
                    "password" => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                    "email" => $this->input->post('email', TRUE),
                    "mobile_no" => $this->input->post('contact_no'),
                    //"country" => ucfirst($this->input->post('country', TRUE)),
                    "status" => $this->input->post('estatus'),
                    "activecode" => time() . rand(100, 999),
                     "modified_date" => date('Y-m-d H:i:s'),  
		    "modified_ip" => $this->input->ip_address(),              
                ); 
               
                if ($this->common->update_data($investorData, 'user', 'id',$users[0]['id'])) {
                    $this->session->set_flashdata('success',	 ' updated successfully.');
                  //  redirect($this->data['redirect_url'], 'refresh');
		  $this->redirect_back(); 
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating Try later!');
                    //redirect($this->data['redirect_url'], 'refresh');
			$this->redirect_back(); 
                }
            }
        }
    }

    // delete User
    function delete() {
        if ($this->input->method() == 'post') {
        $id = $this->input->post('deleteuserid');

            $slider = $this->common->select_data_by_condition('user', array('id' => $id), '*', '', '', '', '', array());
        
            if (empty($slider)) {
                $this->session->set_flashdata('error', 'No information Found !');
                redirect(base_url() . 'Users', 'refresh');
            }

            
            $res = $this->common->delete_data('user', 'id', $id);

            if ($res) {
                $this->session->set_flashdata('success', ' user is deleted successfully.');
                redirect(base_url() . 'Users', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Users', 'refresh');
            }
        }
    }
	// update status
    public function update_status() {
        if ($this->input->method() == 'post') {

            $id = $this->input->post('slideid');

            $old_status = $this->input->post('old_status');

            if ($old_status == 'Enable') {
                $status = 'Disable';
            } else {
                $status = 'Enable';
            }
            $slide = $this->common->select_data_by_condition('user', array('id' => $id), '*', '', '', '', '', array());

            if (empty($slide)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Users', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'user', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(base_url() . 'Users', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'Users', 'refresh');
                }
            }
        }
    }
		// check email exits or not
		public function emailExits() {
        $email = $this->input->post('email');

        if (trim($email) != '') {
            $res = $this->common->check_unique_avalibility('user', 'email', $email, '', '', array());

            if (empty($res)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        } else {
            echo 'true';
            die();
        }
    }
	//user Wallet information added by using this function 
    public function wallet() {
        
        
        $user_id = base64_decode($this->input->post('user_id'));
	
        if ($this->input->is_ajax_request()) {
            if ($user_id != '' && $user_id != 0) {
                $this->data['user'] = $this->common->selectRecordById('user', $user_id, 'id');
		
                $this->load->view('users/editwallet', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {
            
             $this->form_validation->set_rules('newbalance', 'newbalance', 'required');
                 $this->form_validation->set_rules('comment', 'comment', 'required');
           
           	if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                //redirect( $this->data['redirect_url'], 'refresh');
		$this->redirect_back(); 
            } else {

             
                $users = $this->common->select_data_by_condition('user', array('id' => $user_id), '*', '', '', '', '', array());
               
  $investorData = array(
                    "user_id" => $users[0]['id'],
                    "type" => $this->input->post('transaction'),
                    "amount" => $this->input->post('newbalance'),
                    "comment" => $this->input->post('comment'),
                    "created_datetime" => date('Y-m-d H:i:s'),  
		    "created_ip" => $this->input->ip_address(),              
                ); 
               
                if ($this->common->insert_data($investorData, 'wallet_transaction')) {
                    
                    if($this->input->post('transaction')=="credit"){
                        $totalbalance=$users[0]['wallet_blance'] +$this->input->post('newbalance');
			$type='Withdraw';
                    }
                    elseif ($this->input->post('transaction')=="debit") {
                   
                    if($users[0]['wallet_blance']>=$this->input->post('newbalance')){
                       $totalbalance=$users[0]['wallet_blance'] -$this->input->post('newbalance');  
			$type='Deposite';
                    }
                    else{
                       $this->session->set_flashdata('error',	 'wallet balance not sufficient.');
                    redirect($this->data['redirect_url'], 'refresh');
               
                    }
                }
                    
                    
                    $investorData = array(
                     "wallet_blance" => $totalbalance,
                     "modified_date" => date('Y-m-d H:i:s'),  
		    "modified_ip" => $this->input->ip_address(),              
                ); 
               
                if ($this->common->update_data($investorData, 'user', 'id',$users[0]['id'])) {
              
		    $mailData = $this->common->selectRecordById('email_format', '12', 'id');
		    $amount=$totalbalance;
		    $transactionamount=$this->input->post('newbalance');
		    $description=$this->input->post('comment');
			
		    $subject = $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $name=$users[0]['email'];
		   $this->data['mail_body'] = str_replace("%name%", $name,str_replace("%description%", $description,str_replace("%transactionamount%", $transactionamount, str_replace("%type%", $type, str_replace("%amount%", $amount, str_replace("%site_name%", $site_name, str_replace("%siteurl%", $app_email, stripslashes($mailformat))))))));
            	    // print_r($mail_body);die();
		    $forgotEmail=$users[0]['email'];
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="index.html" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
		    $this->session->set_flashdata('success',	 'wallet balance updated successfully.');
                    //redirect( $this->data['redirect_url'], 'refresh');
			$this->redirect_back(); 
                } else {
                    $this->session->set_flashdata('error', 'wallet balance not updated Try later!');
                    //redirect( $this->data['redirect_url'], 'refresh');
			$this->redirect_back(); 
                }     } else {
                    $this->session->set_flashdata('error', 'There is error in updating Try later!');
                   // redirect( $this->data['redirect_url'], 'refresh');
			$this->redirect_back(); 
                }
            }
        }
    }
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
