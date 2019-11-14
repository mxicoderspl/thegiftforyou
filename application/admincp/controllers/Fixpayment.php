<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  
 *  
 */

class Fixpayment extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Transaction : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }
		//enable user
    public function index() {
       $this->data['Rewardsdata'] = $this->common->selectRecordById('admin', '1', 'admin_id');
	
        //$this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('fixpayment/index', $this->data);
    }

    // Add user

   

    public function update() {
        
        
        $pay_id = base64_decode($this->input->post('pay_id'));
	
        if ($this->input->is_ajax_request()) {
            if ($pay_id != '' && $pay_id != 0) {
                $this->data['fixpaydata'] = $this->common->selectRecordById('admin', $pay_id, 'admin_id');
		
                $this->load->view('fixpayment/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {
           
           
            $this->form_validation->set_rules('price', 'price', 'required');
              if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect('Fixpayment', 'refresh');
            } else {

             
                $fixpay = $this->common->select_data_by_condition('admin', array('admin_id' => $pay_id), '*', '', '', '', '', array());
               
                    $fixpayData = array(
                    
                    "registration_fee" => $this->input->post('price', TRUE),
                     "modified_date" => date('Y-m-d H:i:s'),  
		    "modified_ip" => $this->input->ip_address(),              
                ); 
                
                if ($this->common->update_data($fixpayData, 'admin', 'admin_id',$fixpay[0]['admin_id'])) {
                    $this->session->set_flashdata('success',' updated successfully.');
                    redirect('Fixpayment', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating Try later!');
                    redirect('Fixpayment', 'refresh');
                }
            }
        }
    }
	// register user payment list page
    public function registerpayment($id='') {
	//$this->data['title'] = ' register_payment: ' . $this->data['app_name'];
       $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
	
	if($id=='Approved'){
	//$this->data['status']='Approved';
	$this->data['startdate']=date('Y-m-d',strtotime("0 days"));
		
	}
	$this->data['img_path'] = $config['upload_path_paymentinfo'] = 'uploads/payimage/';
        $this->load->view('fixpayment/activityfixpayment', $this->data);
    }
	//register user payment data get
    public function registerpaymentdata() {

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'register_payment.user_id',
            'type' => '',
        );
	

        $columns = array  ('user.email','register_payment.document','register_payment.payment_information','register_payment.amount','register_payment.status','register_payment.created_datetime');
        $request = $this->input->get();
        $condition = array();
//print_r($request['from_date']);exit;
       if (!empty($request['user_id'])) {
           
            $condition['user_id'] = base64_decode($request['user_id']);
        }
	 if (!empty($request['status'])) {
           
            $condition['register_payment.status'] = $request['status'];
        }
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "register_payment.id,user.email,register_payment.document,register_payment.payment_information,register_payment.amount,register_payment.status,register_payment.created_datetime";
        echo $this->common->getDataTableSource('register_payment', $columns, $condition, $getfiled, $request, $join_str);

        die();
    }

	// register user status update 
    public function update_status() {
        
        if ($this->input->method() == 'post') {

            $id = $this->input->post('user_id');

            $old_status = $this->input->post('old_status');
	    $new_status = $this->input->post('status');
	    $comment = $this->input->post('comment');
            if ($old_status == $new_status) {
                $status =  $old_status;
		 $this->session->set_flashdata('error', 'There is an error occured. Try again !');
            }
            $payment = $this->common->select_data_by_condition('register_payment', array('id' => $id), '*', '', '', '', '', array());
		
            if (empty($payment)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
            } else {
		if($new_status == 'Declined'){
			if($old_status == 'Approved'){
			 $this->session->set_flashdata('error', 'User payment request already Approved ,do not declined');
                		redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
		}
		}
               $result = $this->common->update_data(array('status' => $new_status,'comment'=>$comment), 'register_payment', 'id', $id);
		$userid= $payment[0]['user_id'];
                if ($result) {
			
			if($new_status == 'Approved'){
				if(!($new_status==$old_status)){
				$results = $this->common->update_data(array('payment_verified' => 'Yes'), 'user', 'id', $userid);
				$this->userPaymentstatusEmail($userid,$new_status);
				$this->userPaymentStatusChangeAdmin($userid,$new_status);
                               $this->distribute_payment($userid);
                                $this->session->set_flashdata('success', 'User account is Active Now');
                    		redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
				}
				else{
				 $this->session->set_flashdata('error', 'User payment request already Approved');
                		redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
				}
			    }
			else {
				if(!($new_status==$old_status) && $new_status =='Declined'){
				$this->userPaymentstatusEmail($userid,$new_status);
				 $this->userPaymentStatusChangeAdmin($userid,$new_status);
				$results = $this->common->update_data(array('payment_verified' => 'No'), 'user', 'id', $userid);
				 $this->session->set_flashdata('success', 'user account is deactive Now');
                    		redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
				}
				else{
				 $this->session->set_flashdata('error', 'User payment request already Declined');
                		redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
				}

			    }
                    $this->session->set_flashdata('success', 'Status is updated successfully.');
                    redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'Fixpayment/registerpayment', 'refresh');
                }
            }
        }
    }
    
    function distribute_payment($user_id){
        
        $user = $this->common->select_data_by_condition('user', array('id' => $user_id), '*', '', '', '', '', array());
        $temp_user=$user;
        $temp_counter=1;
        
        $payment_verified=0;
        if(!empty($user) && $user[0]['ref_by']!=0){
            while ($user[0]['ref_by']!=0){
                $user = $this->common->select_data_by_condition('user', array('id' => $user[0]['ref_by']), '*', '', '', '', '', array());
                if(!empty($user)){
                    $reward = $this->common->select_data_by_condition('level_reward', array('level' => $temp_counter), '*', '', '', '', '', array());
                    if(!empty($reward)){
                        
                        if($temp_counter>=11){
                            break;
                        }
                        
                        if($reward[0]['price']>=0){
			     if($user[0]['status']=='Enable'){
                            $wallet_transaction=array(
                                'user_id'=>$user[0]['id'],
                                'type'=>'credit',
                                'amount'=>$reward[0]['price'],
                                'comment'=>'Referral bonus from '.$temp_user[0]['email'],
                                'created_datetime'=>date('Y-m-d H:i:s'),
                                'created_ip'=>$this->input->ip_address(),
                            );
                            
                            $wallet_transaction_id=$this->common->insert_data_getid($wallet_transaction, 'wallet_transaction');
                            
                            $user_reward=array(
                                'user_id'=>$user[0]['id'],
                                'wallet_transaction_id'=>$wallet_transaction_id,
                                'from_user_id'=>$user_id,
                                'amount'=>$reward[0]['price'],
                                'level'=>$temp_counter,
                                'created_datetime'=>date('Y-m-d H:i:s'),
                                'created_ip'=>$this->input->ip_address(),
                                'modified_datetime'=>date('Y-m-d H:i:s'),
                                'modified_ip'=>$this->input->ip_address()
                            );
                            $this->common->insert_data_getid($user_reward, 'user_reward');
                            
                            $this->common->update_data(array('wallet_balance'=>($user[0]['wallet_balance'] + $reward[0]['price'])), 'user', 'id',$user[0]['id']);
                            
                            //user email
                            
                           $this->distributeUserPaymentEmail($temp_user[0]['id'],$user[0]['email'],$reward[0]['price']);
                            }
                            //admin payment
                            if($temp_counter==1)
                            {
                                $admin_reward = $this->common->select_data_by_condition('level_reward', array('level' => 11), '*', '', '', '', '', array());
		
                                if(!empty($admin_reward)){
                                    if($admin_reward[0]['price']>0){
                                        
                                        $wallet_transaction=array(
                                            'user_id'=>0,
                                            'type'=>'credit',
                                            'amount'=>$admin_reward[0]['price'],
                                            'comment'=>'Referral bonus from '.$temp_user[0]['email'],
                                            'created_datetime'=>date('Y-m-d H:i:s'),
                                            'created_ip'=>$this->input->ip_address(),
                                        );

                                        $wallet_transaction_id=$this->common->insert_data_getid($wallet_transaction, 'wallet_transaction');
                                        
                                         $user_reward=array(
                                            'user_id'=>0,
                                            'wallet_transaction_id'=>$wallet_transaction_id,
                                            'from_user_id'=>$user_id,
                                            'amount'=>$admin_reward[0]['price'],
                                            'level'=>11,
                                            'created_datetime'=>date('Y-m-d H:i:s'),
                                            'created_ip'=>$this->input->ip_address(),
                                            'modified_datetime'=>date('Y-m-d H:i:s'),
                                            'modified_ip'=>$this->input->ip_address()
                                        );
                                        $this->common->insert_data_getid($user_reward, 'user_reward');

                                        $admin_wallet = $this->common->select_data_by_condition('admin', array('admin_id' => 1), '*', '', '', '', '', array());
                                        
                                        
                                        $this->common->update_data(array('wallet_balance'=>($admin_wallet[0]['wallet_balance'] + $admin_reward[0]['price'])), 'admin', 'admin_id',1);

                                        //admin  email
					  $this->distributeUserPaymentEmailadmin($temp_user[0]['id'],$admin_reward[0]['price']);
                                    }
                                }
                                
                            }    
                            
                            
                            
                            $temp_counter++;
                        }
                        
                    }
                }
                
            }
        }
        
        
    }
	//distributed rewards amount sended notify admin
	function distributeUserPaymentEmailadmin($main_userid,$price){
	
		$mainuserdata = $this->common->select_data_by_condition('user', array('id' => $main_userid), '*', '', '', '', '', array());	

		$mailData = $this->common->selectRecordById('email_format', '22', 'id');
		    $amount=$price;
		   $formemail=$mainuserdata[0]['email'];
			
		    $subject = $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    //$email=$sendEmail;
		   $this->data['mail_body'] = str_replace("%fromemail%", $formemail,str_replace("%amount%", $amount, str_replace("%site_name%", $site_name,  stripslashes($mailformat))));
            	    // print_r($mail_body);die();
		    $forgotEmail=$app_email;
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		   // $this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);


			}	

	//send mail user 
	function distributeUserPaymentEmail($main_userid,$sendEmail,$price){
		
		$mainuserdata = $this->common->select_data_by_condition('user', array('id' => $main_userid), '*', '', '', '', '', array());	

		$mailData = $this->common->selectRecordById('email_format', '19', 'id');
		    $amount=$price;
		   $formemail=$mainuserdata[0]['email'];
			
		    $subject = $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $email=$sendEmail;
		   $this->data['mail_body'] = str_replace("%email%", $email,str_replace("%fromemail%", $formemail,str_replace("%amount%", $amount, str_replace("%site_name%", $site_name,  stripslashes($mailformat)))));
            	    // print_r($mail_body);die();
		    $forgotEmail=$sendEmail;
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		   $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
	}

	//status change email for admin
	function userPaymentStatusChangeAdmin($userid,$new_status){
			
	   if($new_status=='Approved'){
		 $mailData = $this->common->selectRecordById('email_format', '25', 'id');
		  
	   }else{
		 $mailData = $this->common->selectRecordById('email_format', '26', 'id');
		  
	   }
		$userinfodatas = $this->common->select_data_by_condition('user', array('id' => $userid), '*', '', '', '', '', array());
		 
		    
		 
		    $subject =  $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $email=$userinfodatas[0]['email'];
		   $this->data['mail_body'] = str_replace("%email%",$email ,str_replace("%site_name%", $site_name, stripslashes($mailformat)));
            	    // print_r($mail_body);die();
		    $forgotEmail= $app_email;
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		   $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
		    
		}
	//status change mail for user
		function userPaymentstatusEmail($userid,$new_status){
			
	   if($new_status=='Approved'){
		$mailData = $this->common->selectRecordById('email_format', '23', 'id');
	   }else{
		$mailData = $this->common->selectRecordById('email_format', '24', 'id');
	   }
		$userinfodata = $this->common->select_data_by_condition('user', array('id' => $userid), '*', '', '', '', '', array());
		
		
		   
		   
		    $subject =  $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $email=$userinfodata[0]['email'];
		   $this->data['mail_body'] = str_replace("%email%",$email,  str_replace("%site_name%", $site_name, stripslashes($mailformat)));
            	     //print_r($mail_body);die();
		    $forgotEmail=$userinfodata[0]['email'];
		    $year= date('Y');
		    $site_logo =   base_url('../images/logo.png'); 
		    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
		    
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
