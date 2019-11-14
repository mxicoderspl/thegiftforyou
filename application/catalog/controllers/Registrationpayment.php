<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registrationpayment extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = $this->data['site_name'] . ': Dashboard';

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
        $this->data['registration_fee'] = $this->data['fixpayamount']['registration_fee'];
    }

    public function index() {
        $user_id = $this->data['logged_use']['id'];
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
        $this->data['register_payment_detail'] = $this->common->select_data_by_id('register_payment', 'user_id', $user_id, '*', array());
//        print_r($this->data['register_payment_detail'] );exit;
        $this->load->view('registerpayment/index', $this->data);
    }

    //load datatable data


    public function getdata() {

        $user_id = $this->data['logged_use']['id'];
        $columns = array('id', 'amount', 'comment', 'status', 'created_datetime');
        $request = $this->input->get();
        $condition = array();


        $condition['user_id'] = $user_id;

        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "id,amount,comment,status,created_datetime";
        echo $this->common->getDataTableSource('register_payment', $columns, $condition, $getfiled, $request, array());

        die();
    }

    function getpaymentinfo() {
//        echo "helo";exit;
        $json = array();
        $id = $this->input->post('id');
        $re = $this->common->select_data_by_id('register_payment', 'id', $id, '*', array());
        if ($re) {
            $json['data'] = $re[0];
            $json['status'] = "success";
        } else {

            $json['status'] = "";
        }
        echo json_encode($json);
        die();
    }

    public function updaterequest() {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {

            $this->form_validation->set_rules('paymentinfo1', 'paymentinfo1', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $registerpaymentid = $this->input->post('rpid');
                $paymentcode = $this->input->post('paymentinfo1');

                $result = $this->common->select_data_by_id('register_payment', 'id', $registerpaymentid, '*', array());

                if (!empty($dataimage)) {
                    $dataimage = $result[0]['document'];
                } else {
                    $dataimage = '';
                }

                if ($result[0]['payment_information'] != $paymentcode) {
                    $status = "Pending";
                } else { 
                    $status = $result[0]['status'];
		    $this->session->set_flashdata('error', 'You have sent the Previous data.');
                    redirect('Registrationpayment', 'refresh');
                }
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
                        $config['new_image'] = $this->config->item('upload_path_paymentinfo_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('paymentinfo_thumb_width');
                        $config['height'] = $this->config->item('paymentinfo_thumb_height');
                        $config['max_size'] = '2000';

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();

			if ($result[0]['document'] != '') {
                        	if (file_exists($this->config->item('upload_path_paymentinfo') . $result[0]['document'])) {
                            		@unlink($this->config->item('upload_path_paymentinfo') . $result[0]['document']);
                        	}
                        	if (file_exists($this->config->item('upload_path_paymentinfo_thumb') . $result[0]['document'])) {
                            		@unlink($this->config->item('upload_path_paymentinfo_thumb') . $result[0]['document']);
                        	}
                    	}
                    }else {
                        $this->session->set_flashdata('error', $imgerror);
                        redirect('Registrationpayment', 'refresh');
                    } 
                }

                $data = array(
                    "modified_date" => date('Y-m-d H:i:s'),
                    "payment_information" => $paymentcode,
                    "document" => $dataimage,
                    "status" => $status,
                    "amount" => $this->data['registration_fee'],
                    "modified_ip" => $this->input->ip_address(),
                );

                $userdata = $this->common->update_data($data, 'register_payment', 'id', $registerpaymentid);
                if ($userdata) {
                    $this->session->set_flashdata('success', 'Registration Amount Payed request resent successfully..');
                    redirect('Registrationpayment', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'invalid information!..  ');
            redirect('Dashboard', 'refresh');
        }
    }

    function viewrewarddetail() {
        $this->load->view('rewards/rewardinfo', $this->data);
    }
    
    function showrewardinfo() {
        $user_id = $this->data['logged_use']['id'];
        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user_reward.user_id',
            'from_table_id' => 'user.id',
            'join_type' => ''
        );
        
        $columns = array('user_reward.amount', 'user.email', 'user_reward.created_datetime');

        $request = $this->input->get();
        $condition = array();

        $condition['from_user_id'] = $user_id;

        if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_datetime) >='] = $request['from_date'];
            $condition['DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "user_reward.id,user_reward.amount,user.email,user_reward.created_datetime";

        echo $this->common->getDataTableSource('user_reward', $columns, $condition, $getfiled, $request,$join_str,'');

        die();
    }

}
