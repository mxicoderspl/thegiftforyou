<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
	
        if ($this->session->userdata('user_id')) {
            redirect('Dashboard', 'refresh');
        }

        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $this->data['sem_setting'] = $this->common->select_data_by_condition('sem', array(), 'field_value,field_name,status', 'sem_id', 'ASC', '', '', array());
        //echo "<pre>"; print_r($this->data['sem_setting']); die();
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];
        $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
        $this->data['registration_fee'] = $this->data['fixpayamount']['registration_fee'];
 

        $this->data['title'] = $this->data['site_name'] . ': Signup';

        $config['assets_dir'] = 'cache/login';
        $config['assets_dir_css'] = 'cache/login/css';
        $config['assets_dir_js'] = 'cache/login/js';
       
        $this->load->library('minify', $config);
       
    }

    public function index() {
        $this->data['refby'] = '';
        if ($this->session->userdata('ref_by')) {
            $ref_detail = $this->common->select_data_by_id('user', 'referer_code', $this->session->userdata('ref_by'), '*', array());
            if (!empty($ref_detail)) {
                $this->data['refby'] = $ref_detail[0]['email'];
            }
        } elseif ($this->input->post('ref_by')) {
            $ref_detail = $this->common->select_data_by_id('user', 'referer_code', $this->input->post('ref_by'), '*', array());
            if (!empty($ref_detail)) {
                $this->data['refby'] = $ref_detail[0]['email'];
            }
        }
        $this->load->view('register/index', $this->data);
    }

    public function user_register() {
        if ($this->input->method() == 'post') {

	    $this->form_validation->set_rules('firstname', 'firstname', 'required');
	    $this->form_validation->set_rules('lastname', 'lastname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
	    $this->form_validation->set_rules('mobile_no', 'mobile_no', 'required');
	    $this->form_validation->set_rules('pan_no', 'pan_no', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('cpassword', 'cpassword', 'required');
	   // $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha response', 'required');
          
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('Register', 'refresh');
            } else {
                 $panmsg=$this->panvalidation($this->input->post('pan_no'));
          
           if($panmsg == 'wrong'){
                $this->session->set_flashdata('error', 'Pan number not valid');
                    redirect('Register', 'refresh');
                    die();
             
           }
		$email = $this->input->post('email');
                $mobile_no = $this->input->post('mobile_no');
                $pan_no = $this->input->post('pan_no');
//                $if_exist = $this->common->select_data_by_id('user', 'email', $this->input->post('email'), '*', array());
                $condition_array = array(
                    'email' => $email,
                    'mobile_no'=>$mobile_no,
                    'pan_no' => $pan_no,
                );
                $if_exist = $this->common->select_data_by_condition('user', $condition_array, '*','', '','','',array());
                if ($if_exist) {
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('Register', 'refresh');
                    die();
                }

                $pass = sha1($this->input->post('password'));
		 //upload profilepic 
                //$dataimage = $this->upload_profile();

                /***************generate referal code***************/
                
                $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $res = "";
                for ($i = 0; $i < 10; $i++) {
                    $res .= $chars[mt_rand(0, strlen($chars) - 1)];
                }
                $referer_code = $res;

                $custData = array(
                    "firstname"=>$this->input->post('firstname'),
                    "lastname"=>$this->input->post('lastname'),
                    "email" => $email,
                    "mobile_no"=>$mobile_no,
                    "pan_no"=> $pan_no,
		    //"profilepic"=>$dataimage,
                    "password" => $pass,
                    "created_date" => date('Y-m-d H:i:s'),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "activecode" => time() . rand(100, 999),
                    "referer_code" => $referer_code,
                    "status" => 'Disable',
                    "modified_ip" => $this->input->ip_address(),
                );

                require_once(BASEPATH . 'Authenticator/rfc6238.php');
                $authenticatore_secrete = TokenAuth6238::generateRandomClue(16);
                $custData['google_code'] = $authenticatore_secrete;

                if ($this->session->userdata('ref_by')) {
                    $ref_detail = $this->common->select_data_by_id('user', 'referer_code', $this->session->userdata('ref_by'), '*', array());
                    if (empty($ref_detail)) {
                        $this->session->unset_userdata('ref_by');
                        $this->session->set_flashdata('error', 'Your sponsor code is wrong. Please try again.');
                        redirect('Register', 'refresh');
                    }
                    $custData['ref_by'] = $ref_detail[0]['id'];
                    $this->session->unset_userdata('ref_by');
                } elseif ($this->input->post('ref_by')) {
                    $ref_detail = $this->common->select_data_by_id('user', 'referer_code', $this->input->post('ref_by'), '*', array());
                    if (empty($ref_detail)) {
                        $this->session->set_flashdata('error', 'Your sponsor code is wrong. Please try again.');
                        redirect('Register', 'refresh');
                    }
                    $custData['ref_by'] = $ref_detail[0]['id'];
                }

                $user_id = $this->common->insert_data_getid($custData, "user");


                if ($user_id > 0) {


                    $email = $this->input->post('email');
                    $site_logo = base_url() . 'images/logo.png';

                    $year = date('Y');
                    $activation_link = '<a href="' . site_url('Register/verifyemail/' . $custData['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
                    $mailData = $this->common->select_data_by_id('email_format', 'id', 14, '*', array());
                    $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
                    $mailformat = $mailData[0]['emailformat'];
                    $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%activation_link%", $activation_link, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat))))));
                    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
                    $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
                    $mail_body = $this->load->view('mail', $this->data, true);

                    $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);

                    // New user registration
                    $adminmailData = $this->common->select_data_by_id('email_format', 'id', 16, '*', array());

                    $adminsubject = str_replace('%site_name%', $this->data['site_name'], $adminmailData[0]['subject']);
                    $adminmailformat = $adminmailData[0]['emailformat'];
                    
                    $this->data1['admin_mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%site_name%",$this->data['site_name'], str_replace("%email%", $email, str_replace("%year%", $year, stripslashes($adminmailformat)))));
                    $this->data1['admin_mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
                    $this->data1['admin_mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
                    $adminmail_body = $this->load->view('adminmail', $this->data1, true);
                    
                    $this->sendEmail($this->data['site_name'], $this->data['site_email'], $this->data['site_email'], $adminsubject, $adminmail_body);
                    
                    $this->session->set_flashdata('success', 'You are registered successfully. Please confirm your email id by clicking on link we have send you in email.');
                    redirect('Login', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. please try after again');
                    redirect('Register', 'refresh');
                }
            }
        }
    }
    public function panvalidation($pan_no){
        $value = $pan_no; //PUT YOUR PAN CARD NUMBER HERE
        $pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        $result = preg_match($pattern, $value);
        if ($result) {
        $findme = ucfirst(substr($value, 3, 1));
        $mystring = 'CPHFATBLJG';
        $pos = strpos($mystring, $findme);
        if ($pos === false) {
            $msg = "wrong";
        } else {
            $msg = "good";
        }
        } else {
            $msg = "wrong";
        }
        return $msg;

        
    }

    public function new_ref($code) {

        $this->session->set_userdata('ref_by', $code);

        redirect(site_url('Register'), 'refresh');
    }

    public function username_valid() {
        if ($this->input->method() == 'post') {
            $user_name = $this->input->post('username');
            $user_data = $this->common->select_data_by_id('user', 'username', $user_name, '*', array());
            if (empty($user_data)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
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

        return;
    }

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

    public function verifyemail($id = '') {
        if ($id == '') {
            redirect(site_url('Login'), 'refresh');
        }

        $active_email = $this->common->select_data_by_id('user', 'activecode', $id, '*', array());

//echo "test";die();
        if (empty($active_email)) {
            $this->session->set_flashdata('error', 'Something went wrong.');
            redirect(site_url('Login'), 'refresh');
        }

        $this->common->update_data(array('status' => 'Enable','active_email' => 'Yes','activecode' => time() . rand(100, 999)), 'user', 'id', $active_email[0]['id']);

        $this->session->set_flashdata('success', 'Your account is successfully activated. Thank you!');
        redirect('Login', 'refresh');
    }

  // check pan no exist or not

    public function pan_no_Exist() {
        $pan_no = $this->input->post('pan_no');

        $pan_exist = $this->common->select_data_by_id('user', 'pan_no', $pan_no, '*', array());

        if (empty($pan_exist)) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

    // check mobile no exist or not
    public function mobile_no_Exist() {
        $mobile_no = $this->input->post('mobile_no');

        $mob_exist = $this->common->select_data_by_id('user', 'mobile_no', $mobile_no, '*', array());

        if (empty($mob_exist)) {
            echo 'true';
            die();
        } else {
            echo 'false';
            die();
        }
    }

public function upload_profile() {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

            $config['upload_path'] = $this->config->item('upload_path_profilepic');
            $config['allowed_types'] = $this->config->item('upload_profilepic_allowed_types');
            $config['file_name'] = rand(10, 99) . time();
            $this->load->library('upload');
            $this->load->library('image_lib');
            // Initialize the new config
            $this->upload->initialize($config);
            //Uploading Image
            $this->upload->do_upload('image');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();

            if ($imgerror == '') {
                $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                $config['new_image'] = $this->config->item('upload_path_profilepic_thumb') . $imgdata['file_name'];
                //$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                //$config['thumb_marker'] = '';
                $config['width'] = $this->config->item('profilepic_thumb_width');
                $config['height'] = $this->config->item('profilepic_thumb_height');
                $config['max_size'] = '2000';

                //Loading Image Library
                $this->image_lib->initialize($config);
                $dataimage = $imgdata['file_name'];

                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();

                return $dataimage;
            } else {
                $this->session->set_flashdata('error', $imgerror);
                redirect('Profile', 'refresh');
            }
        } else {
            return $dataimage = '';
        }
    }


}
