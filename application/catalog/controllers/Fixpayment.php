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
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $this->data['title'] = 'Fixpayment : ';
        //Load header and save in variable
        // load the library
        $config['assets_dir'] = 'cache/login';
        $config['assets_dir_css'] = 'cache/login/css';
        $config['assets_dir_js'] = 'cache/login/js';
        //$config['css_dir'] = 'userdash/assets/css';
        //$config['js_dir'] = 'userdash/assets/js';
        $this->load->library('minify', $config);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);

        $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
        $this->data['registration_fee'] = $this->data['fixpayamount']['registration_fee'];
    }

    //enable user
    public function index() {

        $this->data['ragi_id'] = $this->session->userdata('regi_id');
        $this->session->unset_userdata('regi_id');

        $this->load->view('fixpayment/index', $this->data);
    }

    // Add user

    public function pay() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            
            $this->form_validation->set_rules('paymentinfo', 'paymentinfo', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $paymentcode = $this->input->post('paymentinfo');
                $dataimage = '';
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_paymentinfo');
                    $config['allowed_types'] = $this->config->item('upload_paymentinfo_allowed_types');
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

                    // print_r($imgerror);die();
                    if ($imgerror == '') {
                        $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                        $config['new_image'] = $this->config->item('upload_path_slider_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('slider_thumb_width');
                        $config['height'] = $this->config->item('slider_thumb_height');
                        $config['max_size'] = '2000';

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    }else {
                        $this->session->set_flashdata('error', $imgerror);
                        redirect('Dashboard', 'refresh');
                    } 
                }

                $payData = array(
                    "user_id" => $user_id,
                    "created_datetime" => date('Y-m-d H:i:s'),
                    "modified_date" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "payment_information" => $paymentcode,
                    "document" => $dataimage,
                    "amount" => $this->data['registration_fee'],
                    "status" => 'Pending',
                    "modified_ip" => $this->input->ip_address(),
                );
               
                $userdata = $this->common->insert_data_getid($payData, "register_payment");
                if ($userdata) {
		    
		    /* ------------- sending request *********** */
                    $email = $this->security->xss_clean($this->data['logged_use']['email']);
			
                    $site_logo = base_url() . 'images/logo.png';

                    $year = date('Y');
                    //$activation_link = '<a href="' . site_url('Register/verifyemail/' . $custData['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
                    $mailData = $this->common->select_data_by_id('email_format', 'id', 28, '*', array());
                    $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
                    $mailformat = $mailData[0]['emailformat'];
                    $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))));
                    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
                    $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
                    $mail_body = $this->load->view('mail', $this->data, true);
                   // print_r($subject);print_r($mail_body);exit;
                    
                    $re = $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);
			
                    $this->session->set_flashdata('success', ' Registration Amount Payed request sent successfully..');
                    redirect('Registrationpayment', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'invalid information!..  ');
            redirect('Dashboard', 'refresh');
        }
    }

}
