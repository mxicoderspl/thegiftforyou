<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'] . ': Contact US';
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];
         
        $config['enabled'] = FALSE;
        $config['assets_dir'] = 'cache/home';
        $config['assets_dir_css'] = 'cache/home/css';
        $config['assets_dir_js'] = 'cache/home/js';
        $config['css_dir'] = 'assets/css';
        $config['js_dir'] = 'assets/js';
        $this->load->library('minify', $config);
    }

    //show login page, contains popup for OTP
    public function index() {
//        $address = urlencode($this->data['general_setting'][2]['setting_value']);
//        $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        $response = curl_exec($ch);
//        curl_close($ch);
////        echo '<pre>';print_r($response);die();
//        $response_a = json_decode($response);
//        if (!isset($response_a->results[0])) {
//            $lat = 0;
//            $lng = 0;
//        } else {
//            $lat = $response_a->results[0]->geometry->location->lat;
//            $lng = $response_a->results[0]->geometry->location->lng;
//        }
//
//        $this->data['lat'] = $lat;
//        $this->data['lng'] = $lng;
        $this->load->view('contact/index', $this->data);
    }

    //google reCaptcha chellange check
//    public function captcha_chellange() {
//        if ($this->input->is_ajax_request()) {
//            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//            curl_setopt($ch, CURLOPT_POST, true);
//            $data = array(
//                'secret' => $this->data['general_setting'][6]['setting_value'],
//                'response' => $this->input->post('g-recaptcha-response'),
//                'remoteip' => $this->input->ip_address()
//            );
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//            $result = curl_exec($ch);
//            $resultObj = json_decode($result);
//            curl_close($ch);
//            if (isset($resultObj->success) && $resultObj->success) {
//                echo 'true';
//            } else {
//                echo 'false';
//            }
//            die();
//        }
//    }

    public function send() {
       
        if ($this->input->method() == 'post') {
            //echo '<pre>';print_r($this->input->post());die();
            $this->form_validation->set_rules('fname', 'fname', 'required');
            $this->form_validation->set_rules('lname', 'lname', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Invalid Form Data');
                redirect('contact', 'refresh');
            }
            $name = $this->security->xss_clean($this->input->post('fname') . ' ' . $this->input->post('lname'));
            $email = $this->security->xss_clean($this->input->post('email'));
//            $sub = $this->input->post('subject');
            $message = $this->input->post('message');
            $sitename = $this->data['site_name'];
            $site_logo = base_url() . 'images/logo.png';
            $year = date('Y');
            $mailData = $this->common->select_data_by_id('email_format', 'id', '29', '*', array());
            $subject = $mailData[0]['subject'];
            $mailformat = $mailData[0]['emailformat'];
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%name%", $name, str_replace("%email%", $email, str_replace("%message%", nl2br($message), str_replace("%sitename%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);
		
            $this->sendEmail($name, $this->data['site_email'], $email, $subject, $mail_body);
            $this->session->set_flashdata('success', 'Your contact request is successfully submitted. We will reach you soon.');
        }
        redirect('Home', 'refresh');
    }
    
    function sendEmail($app_name, $app_email, $from_email, $subject, $mail_body) {

        $from = $from_email;

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <' . $from . '>' . "\r\n";


//        mail($to, $subject, $mail_body, $headers);
//        
//        return;
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);
        
        $this->email->from($from);
        
        $this->email->to($app_email,$app_name);
        
        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
       
    }

}
