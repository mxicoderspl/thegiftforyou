<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceFinder extends MY_Controller {

    public function __construct() {
        parent::__construct();

         $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];

        $this->data['title'] = $this->data['site_name'] . ': Service Finder';

//redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

//meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        $this->data['bank_detail'] = $this->common->select_data_by_id('bank_detail', 'user_id', $this->session->userdata('user_id'), '*', array());

        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
    }

    public function index() {

 $countusersetting = 0; 
         //$count = $this->common->get_count_of_table('user');
	$this->data['totaluser'] = $this->common->get_count_of_table('user');
	$this->data['sliders'] = $this->common->select_data_by_id('slider','status','Enable','image',array());
    
        $this->data['about_section']=$this->common->select_data_by_condition('pages', array('page_id'=>1), '*', '', '', '', '', array());
        $this->data['welcome_section']=$this->common->select_data_by_condition('pages', array('page_id'=>2), '*', '', '', '', '', array());

	$this->data['business_types']=$this->common->get_all_record('business_type','*','','');
	$this->data['business'] = $this->common->select_data_by_condition('business', array(), '*', '', '', 6, '', array());
        $this->load->view('servicefinder/index', $this->data);
    }

}
