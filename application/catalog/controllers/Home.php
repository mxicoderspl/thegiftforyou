<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 
 */
class Home extends CI_Controller {

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
    }

    //view landing page of site
    public function index() {
        $countusersetting = 0; 
         //$count = $this->common->get_count_of_table('user');
	$this->data['totaluser'] = $this->common->get_count_of_table('user');
	$this->data['sliders'] = $this->common->select_data_by_id('slider','status','Enable','*',array());
        $this->data['users'] = $this->common->get_all_record('user', '*','', '');
        
        $this->data['testimonials'] = $this->common->select_data_by_id('testimonial','status','Enable','*',array());
        
        $this->data['about_section']=$this->common->select_data_by_condition('pages', array('page_id'=>1), '*', '', '', '', '', array());
        $this->data['welcome_section']=$this->common->select_data_by_condition('pages', array('page_id'=>2), '*', '', '', '', '', array());

	 $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'wallet_transaction.user_id',
            'join_type' => '',
        );
        $conditions = array();
	 $re = $this->data['users_info'] = $this->common->select_data_by_allcondition('wallet_transaction', $conditions, 'wallet_transaction.user_id,user.referer_code,user.firstname,user.lastname,user.profilepic,sum(amount) as amount', 'wallet_transaction.created_datetime', 'DESC', '10', '', $join_str, 'wallet_transaction.user_id');
        $this->load->view('home/index', $this->data);
    }
	public function finders() {
        $countusersetting = 0; 
         //$count = $this->common->get_count_of_table('user');
	$this->data['totaluser'] = $this->common->get_count_of_table('user');
	$this->data['sliders'] = $this->common->select_data_by_id('slider','status','Enable','image',array());
     
        $this->data['about_section']=$this->common->select_data_by_condition('pages', array('page_id'=>1), '*', '', '', '', '', array());
        $this->data['welcome_section']=$this->common->select_data_by_condition('pages', array('page_id'=>2), '*', '', '', '', '', array());
        $this->load->view('data/finder', $this->data);
    }
    public function view() {
        $countusersetting = 0; 
         //$count = $this->common->get_count_of_table('user');
	$this->data['totaluser'] = $this->common->get_count_of_table('user');
	$this->data['sliders'] = $this->common->select_data_by_id('slider','status','Enable','image',array());
     
        $this->data['about_section']=$this->common->select_data_by_condition('pages', array('page_id'=>1), '*', '', '', '', '', array());
        $this->data['welcome_section']=$this->common->select_data_by_condition('pages', array('page_id'=>2), '*', '', '', '', '', array());
        $this->load->view('data/view', $this->data);
    }


}
