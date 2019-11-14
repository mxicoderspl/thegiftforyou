<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'] . ': Support';

        //redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        
	$this->data['support_email'] = $this->common->select_data_by_id('settings','setting_id',17,'setting_value',array());
	//print_r($this->data['support_email'][0]['setting_value']);exit;
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
           
}

    

    public function index() {
       
        $support = $this->common->select_data_by_condition('support', array('user_id' => $this->session->userdata('user_id')), '*', 'created_date', 'DESC', '', '', array());
        $this->data['support_data'] = array();
        foreach ($support as $s) {
            $s['created_date'] = $s['created_date'];
            $this->data['support_data'][] = $s;
        }

        $this->load->view('support/index', $this->data);
    }

  public function send_query(){
	
	if ($this->input->method() == 'post') {
            $support_arr = array(
                'title' => $this->security->xss_clean($this->input->post('title')),
                'message' => $this->security->xss_clean($this->input->post('message')),
                'created_date' => date('Y-m-d H:i:s'),
                'user_id' => $this->session->userdata('user_id')
            );

            $name = $this->data['name'];
            $email = $this->data['email'];
            $sub = $this->input->post('title');
            $message = $this->input->post('message');
            $sitename = $this->data['site_name'];
            $site_logo = base_url() . 'images/logo.png';
            $year = date('Y');
            $link = '<a href="' . site_url('admincp/Support') . '">Please Click Here For More Details</a>';

            $mailData = $this->common->select_data_by_id('email_format', 'id', '30', '*', array());
            
            $mailformat = $mailData[0]['emailformat'];
	//print_r($mailformat);exit;
	    $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%name%", $name, str_replace("%email%", $email, str_replace("%subject%", $sub, str_replace("%message%", nl2br($message), str_replace("%site_name%", $this->data['site_name'], str_replace("%link%", $link, str_replace("%year%", $year, stripslashes($mailformat)))))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);
		
		//print_r($this->data['site_name']);exit;
            $this->sendEmail($name, $email, $this->data['support_email'][0]['setting_value'], $subject, $mail_body);


            $this->common->insert_data($support_arr, 'support');
            $this->session->set_flashdata('success', 'Your Query request is successfully submitted. We will reach you soon.');
            redirect('support/index', 'refresh');
        }
	} 

}
