<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 
 */
class ManageAccount extends MY_Controller {

    public $data;

    public function __construct() {
        parent::__construct();

        //$this->data['google_analytic'] = $this->common->select_data_by_id('seo', 'id', '6', 'value', array());
        //$this->data['google_webmaster'] = $this->common->select_data_by_id('seo', 'id', '7', 'value', array());
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];

        $this->data['title'] = $this->data['site_name'] . ': Home';

        
        if ($this->session->userdata('user_id')) {

            $user = $this->common->select_data_by_condition('user', array('id' => $this->session->userdata('user_id')), '*', '', '', '', '', array());
            $this->data['logged_use'] = $user[0];
        }

        $this->data['sem_setting'] = $this->common->select_data_by_condition('sem', array(), 'field_value,field_name,status', 'sem_id', 'ASC', '', '', array());
       
       $config['enabled'] = FALSE;
        $config['assets_dir'] = 'cache/assetshome';
        $config['assets_dir_css'] = 'cache/assetshome/css';
        $config['assets_dir_js'] = 'cache/assetshome/js';  
        $config['css_dir'] = 'assetshome/css';
        $config['js_dir'] = 'assetshome/js';
         $this->load->library('minify',$config);

 	$this->data['common_header'] = $this->load->view('common_header', $this->data, true);

        $this->data['common_footer'] = $this->load->view('common_footer', $this->data, true);
    }

    //view landing page of site
    public function index() {
        $countusersetting = 0; 
         //$count = $this->common->get_count_of_table('user');
	
        $this->data['about_page']=$this->common->select_data_by_condition('pages', array('page_id'=>3), '*', '', '', '', '', array());
   
        $this->load->view('manageaccount/index', $this->data);
    }

}
