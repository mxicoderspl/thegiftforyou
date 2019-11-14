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

        $this->load->library('pagination');
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
        $this->data['sliders'] = $this->common->select_data_by_id('slider', 'status', 'Enable', 'image', array());

//        $this->data['about_section'] = $this->common->select_data_by_condition('pages', array('page_id' => 1), '*', '', '', '', '', array());
//        $this->data['welcome_section'] = $this->common->select_data_by_condition('pages', array('page_id' => 2), '*', '', '', '', '', array());

        $this->data['states'] = $this->common->select_data_by_condition('states', array(), '*', '', '', '', '', array());
        $this->data['country'] = $this->common->select_data_by_condition('country', array(), '*', '', '', '', '', array());
        $this->data['business_types'] = $this->common->get_all_record('business_type', '*', '', '');

        $config["base_url"] = site_url('ServiceFinder/index');
        $config["total_rows"] = count($this->common->get_all_record('business', '*', '', ''));
        $config["per_page"] = 2;
        $config["uri_segment"] = 3;
        //$config['first_link'] = false; 
        //$config['last_link']  = false;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

        //bootstrap pagination 
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$this->data["business"] = $this->Countries->fetch_countries($config["per_page"], $page);
//business data...

        $join_str[0] = array(
            'table' => 'business_type',
            'join_table_id' => 'business_type.id',
            'from_table_id' => 'business.business_type',
            'join_type' => '',
        );
        $join_str[1] = array(
            'table' => 'states',
            'join_table_id' => 'states.id',
            'from_table_id' => 'business.state',
            'join_type' => '',
        );
        $join_str[2] = array(
            'table' => 'country',
            'join_table_id' => 'country.id',
            'from_table_id' => 'business.country',
            'join_type' => '',
        );
        $this->data['business'] = $this->common->select_data_by_condition('business', array(), 'business.*,business_type.type_name,states.name as statename,country.name as countryname', 'business.businessname', 'ASC', $config["per_page"], $page, $join_str);
        $this->data["links"] = $this->pagination->create_links();
        // print_r($this->data['business']);exit;
        $this->load->view('servicefinder/index', $this->data);
    }

    function getfiltered() {
        $keyword = $this->security->xss_clean($this->input->post('keyword'));
        $city = $this->security->xss_clean($this->input->post('city'));
        $category = $this->security->xss_clean($this->input->post('category'));
        $state = $this->security->xss_clean($this->input->post('state'));
        $forder = $this->security->xss_clean($this->input->post('filterorder'));

        $data = array();
        $join_str[0] = array(
            'table' => 'business_type',
            'join_table_id' => 'business_type.id',
            'from_table_id' => 'business.business_type',
            'join_type' => '',
        );
        $join_str[1] = array(
            'table' => 'states',
            'join_table_id' => 'states.id',
            'from_table_id' => 'business.state',
            'join_type' => '',
        );
        $join_str[2] = array(
            'table' => 'country',
            'join_table_id' => 'country.id',
            'from_table_id' => 'business.country',
            'join_type' => '',
        );
        $condition = array();

        if (!empty($city)) {
            $condition['city'] = $city;
        }
        if (!empty($state)) {
            $condition['business.state'] = $state;
        }
        if (!empty($category)) {
            $condition['business_type.id'] = $category;
        }
        if (!empty($forder)) {
            $orderby = 'business.businessname';
            $order = $forder;
        } else {
            $orderby = $order = '';
        }
        $re = $this->common->select_data_by_condition('business', $condition, 'business.*,business_type.type_name,states.name as statename', $orderby, $order, '', '', $join_str);
        $alldata = count($re);
//        echo $this->last_query();exit;
//        if (empty($re)) {
//            $data['msg'] = 'No result Found';
//            $data['result'] = $re;
//        } else {
//            $data['result'] = $re;
//        }
        // Pagination Configuration
        $config['base_url'] = site_url('ServiceFinder/index');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $alldata;
        $config["per_page"] = 2;
        $config["uri_segment"] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;

       $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '<li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '<li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // Initialize
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $re1 = $this->common->select_data_by_condition('business', $condition, 'business.*,business_type.type_name,states.name as statename', $orderby, $order, $config["per_page"], $page, $join_str);

        if (empty($re)) {
            $data['msg'] = 'No result Found';
            $data['result'] = $re1;
        } else {
            $data['result'] = $re1;
        }
        $data['pagination'] = $this->pagination->create_links();

        //print_r($data);die();
        echo json_encode($data);
        die();
    }

    /*     * ***************** backup************* */
//    function getfiltered12() {
//        $keyword = $this->security->xss_clean($this->input->post('keyword'));
//        $city = $this->security->xss_clean($this->input->post('city'));
//        $category = $this->security->xss_clean($this->input->post('category'));
//        $state = $this->security->xss_clean($this->input->post('state'));
//        $data = array();
//        $join_str[0] = array(
//            'table' => 'business_type',
//            'join_table_id' => 'business_type.id',
//            'from_table_id' => 'business.business_type',
//            'join_type' => '',
//        );
//        $join_str[1] = array(
//            'table' => 'states',
//            'join_table_id' => 'states.id',
//            'from_table_id' => 'business.state',
//            'join_type' => '',
//        );
//        $join_str[2] = array(
//            'table' => 'country',
//            'join_table_id' => 'country.id',
//            'from_table_id' => 'business.country',
//            'join_type' => '',
//        );
//        $condition = array();
//
//        if (!empty($city)) {
//            $condition['city'] = $city;
//        }
//        if (!empty($state)) {
//            $condition['states.name'] = $state;
//        }
//        if (!empty($category)) {
//            $condition['business_type.id'] = $category;
//        }
//
//        $re = $this->common->select_data_by_condition('business', $condition, 'business.*,business_type.type_name,states.name as statename', '', '', '', '', $join_str);
//
//        if (empty($re)) {
//            $data['msg'] = 'No result Found';
//            $data['result'] = $re;
//        } else {
//            $data['result'] = $re;
//        }
//
//
//        echo json_encode($data);
//        die();
//    }
}
