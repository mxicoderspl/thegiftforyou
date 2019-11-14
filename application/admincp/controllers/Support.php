<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Dashboard.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Support extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Support : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {
        
        $this->data['support_data']=$this->common->select_data_by_condition('support',array(),'*','created_date','DESC','','',array());	
	        
	//$this->data['support_data']=array();
        /*foreach ($support as $s){
            $s['created_date']=$s['created_date'];
            $this->data['support_data'][]=$s;
        }*/
        $this->load->view('support/index', $this->data);
    }
    
    public function update($id) {
        $id = base64_decode($id);       
        $this->data['support_data']=$this->common->select_data_by_condition('support',array('id'=>$id),'*','created_date','DESC','','',array());	       
        $this->load->view('support/edit', $this->data);
    }
     public function updatedata() {
         $id = $this->input->post('id');   
         $data = array(
              'status'=>'Close',  
              'reply'=>$this->input->post('reply')
            );
            
       
            if($this->common->update_data($data,'support','id',$id)){
                $join_str[0]['table'] = 'user';
                $join_str[0]['join_table_id'] = 'user.id';
                $join_str[0]['from_table_id'] = 'support.user_id';
                $join_str[0]['join_type'] = '';
                $this->data['support_data']=$this->common->select_data_by_condition('support',array('support.id'=>$id),'support.*,user.email','support.created_date','DESC','','',$join_str);

		/**************** sending email ****************/

		$mailData = $this->common->selectRecordById('email_format', '32', 'id');
		$subject =  $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
		    $reply=ucfirst(nl2br($this->data['support_data'][0]['reply'])); 
		    $email=$this->data['support_data'][0]['email'];
			//print_r($this->data['support_data'][0]['reply']);exit;
		   $this->data['mail_body'] = str_replace("%email%",$email,str_replace("%message%",$reply,str_replace("%site_name%", $site_name, stripslashes($mailformat))));
            	    // print_r($mail_body);die();
		    $forgotEmail= $app_email;
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		    $mail_body = $this->load->view('mail', $this->data, true);

			//print_r($mail_body);exit;
		    $this->sendEmail($this->data['app_name'], $app_email, $email, $subject, $mail_body);
             
            	    $this->session->set_flashdata('success','Your Reply Successfully Send to the User');
            	    redirect('Support/index','refresh');
            }else{
                 $this->session->set_flashdata('error','Oops!Error in Update Data');
                redirect('Support/index','refresh');
            }
            
            
    }
function sendEmail($app_name,$app_email,$to_email,$subject,$mail_body)
    {

        //$this->config->load('email', TRUE);
      //  $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
       // $this->email->initialize($this->cnfemail);
        
        $this->email->from($app_email,$app_name);
        
        $this->email->to($to_email);
        
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }
    /*function sendEmail($app_name, $app_email, $to_email, $subject, $mail_body) {
       // echo $app_email."<br>";
       // echo $to_email;exit;
        $to = $to_email;

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <' . $app_email . '>' . "\r\n";

        //echo $mail_body; die();

        mail($to, $subject, $mail_body, $headers);
        
        return;
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        
        $this->email->from($app_email,$app_name);
        
        $this->email->to($to_email);
        
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
        $site_host = 'smtp.gmail.com';
        $site_port = 587;
        $site_user = 'ktdeveloper@gmail.com';
        $site_pass = 'ktdeveloper@141';
 $site_host = 'mail.starlightcoin.io';
        $site_port = 465;
        $site_user = 'register@starlightcoin.io';
        $site_pass = 'register@141';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $site_host;
        $config['smtp_port'] = $site_port;
        $config['smtp_user'] = $site_user;
        $config['smtp_pass'] = $site_pass;
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from($config['smtp_user'], $app_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message($mail_body);
        $this->email->send();
        //echo $this->email->print_debugger();
        //die();
        return;
    }*/

   

}


    
