<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  
 *  
 */

class Fixpayment extends CI_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
         $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $this->data['title'] = 'Fixpayment : ' ;
        //Load header and save in variable
         // load the library
        $config['assets_dir'] = 'cache/login';
        $config['assets_dir_css'] = 'cache/login/css';
        $config['assets_dir_js'] = 'cache/login/js';  
        //$config['css_dir'] = 'userdash/assets/css';
        //$config['js_dir'] = 'userdash/assets/js';
        $this->load->library('minify',$config);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
      
         $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
         $this->data['registration_fee']= $this->data['fixpayamount']['registration_fee'];
        
    }
		//enable user
    public function index() {
       
        $this->data['ragi_id']=$this->session->userdata('regi_id');
        $this->session->unset_userdata('regi_id');
                 
        $this->load->view('fixpayment/index', $this->data);
    }

    // Add user

   

    public function pay() {
        $user_id=$this->session->userdata('user_id');
         if($user_id){ 
                 /*$config['upload_path']          = './uploads/payimage/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');

                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    exit();
                  //  $this->load->view('upload', $error);
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    print_r('done');
                    exit();
                    $this->load->view('success', $data);
                }   */ if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

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
                        $config['new_image'] = $this->config->item('upload_path_paymentinfo_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('slider_thumb_width');
                        $config['height'] = $this->config->item('slider_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                        $dataimage = '';
                    }
                } else {
                    $this->session->set_flashdata('error', $imgerror);
                    redirect('Dashboard', 'refresh');
                }   
                $payData = array(
                     "user_id"=>$user_id,
                    "created_date" => date('Y-m-d H:i:s'),
         	    "modified_date" => date('Y-m-d H:i:s'),      	
                    "created_ip" => $this->input->ip_address(),
                   "payment_information"=>$this->input->post('Paymentinfo'),
                    "document"=> $dataimage,
                   "amount"=>  $this->data['registration_fee'],
                    "status" => 'Pending',
                    "modified_ip"=>$this->input->ip_address(),
                );
                $userdata = $this->common->insert_data_getid($payData, "register_payment");
                if($userdata){
                    $this->session->set_flashdata('success', ' Registration Amount successfully pay..');
                    redirect('Dashboard', 'refresh');
                }
                
                }
        else {
            $this->session->set_flashdata('error', 'invalid information!..  ');
                    redirect('Fixpayment', 'refresh');
        }
    }
}
        
