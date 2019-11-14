<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Login
 * contains functions related to login and forgot password and OTP verification
 * @author kishan
 */
class Forgotpassword extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $siteNamedata = $this->common->select_data_by_id('settings', 'setting_id', '1', '*', array());
        $this->data['site_name'] = $siteNamedata[0]['setting_value'];

        $siteEmaildata = $this->common->select_data_by_id('settings', 'setting_id', '2', '*', array());
        $this->data['site_email'] = $siteEmaildata[0]['setting_value'];

        $this->data['title'] = $this->data['site_name'] . ': Reset Password';

        //redirect to dashboard if already login
        if ($this->session->userdata('user_id')) {
            redirect('Dashboard', 'refresh');
        }


        //meta keyword and description
        //$this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
       // $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());
// load the library
        $config['assets_dir'] = 'cache/login';
        $config['assets_dir_css'] = 'cache/login/css';
        $config['assets_dir_js'] = 'cache/login/js';  
        //$config['css_dir'] = 'userdash/assets/css';
        //$config['js_dir'] = 'userdash/assets/js';
        $this->load->library('minify',$config);
        //$this->data['header'] = $this->load->view('header', $this->data, TRUE);
        //$this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
    }

    //show login page, contains popup for OTP
    public function index() {
        $forgotEmail = $this->input->post('forgot_email');
        //echo $forgotEmail; die();
        $userData = $this->common->select_data_by_id('user', 'email', $forgotEmail, '*', array());

        if (!empty($userData)) {
            $name = $userData[0]['email'];

            $user_link_unique = $userData[0]['activecode'];

            $link = site_url('Login/resetPassword') . '/' . $user_link_unique;

            $email = $forgotEmail;
            $site_logo =  base_url().'images/logo.png';

            $year = date('Y');
            $activation_link = '<a href="' . $link . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Reset Password</a>';
            $mailData = $this->common->select_data_by_id('email_format', 'id', '15', '*', array());
//            print_r($mailData);exit;
            $subject = $mailData[0]['subject'];
            $mailformat = $mailData[0]['emailformat'];
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo,str_replace("%email%", $email, str_replace("%reset_link%", $activation_link, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat))))));


            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);

            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);
            $this->session->set_flashdata('success', 'Password reset link is sent to your email address');
            redirect('Login', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'The email you entered is not valid.');
            redirect('Login', 'refresh');
        }
    }

    public function emailExits() {
        $email = $this->input->post('email');
        if (trim($email) != '') {
            $res = $this->common->select_data_by_id('users', 'email', $email, 'email', array());
            if (empty($res)) {
                echo 'false';
                die();
            } else {
                echo 'true';
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

}
