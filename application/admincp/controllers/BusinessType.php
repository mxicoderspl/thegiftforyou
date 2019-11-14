<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class BusinessType extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Business Types : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {
        $this->data['businessdata'] = $this->common->get_all_record('business_type', '*', '', '');
        //$this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('businesstype/index', $this->data);
    }

public function add(){

        if ($this->input->is_ajax_request()) {
           // if ($type_id != '' && $type_id != 0) {
                $this->data['business_type'] = $this->common->get_all_record('business_type', '*', '', '');
                $this->load->view('businesstype/add', $this->data);
            //} else {
               // echo '<div class="alert alert-danger">
                   //    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 //      <strong>Record not found with specified id. Try later!</strong>
                   //</div>';
            //}
            return;
        }

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('title', 'title', 'required');
            // $this->form_validation->set_rules('elink', 'elink', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
		//$type_id = $this->input->post('slide_id', TRUE);
                $typename = $this->input->post('title', TRUE);
                // $link = $this->input->post('elink', TRUE);
                $status = $this->input->post('status', TRUE);
              
                $data = array(
                    'type_name' => $typename,
                                     
                    'status' => $status,
                    'modified_datetime' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address(),
                );

                if ($this->common->insert_data($data, 'business_type')) {
                    $this->session->set_flashdata('success', 'Business Type Added successfully.');
                    redirect('BusinessType', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in Adding Business type. Try later!');
                    redirect('BusinessType', 'refresh');
                }
            }
        }
	
}

 public function update() {


        $type_id = base64_decode($this->input->post('slide_id'));
        if ($this->input->is_ajax_request()) {
            if ($type_id != '' && $type_id != 0) {
                $this->data['business_type'] = $this->common->selectRecordById('business_type', $type_id, 'id');
                $this->load->view('businesstype/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('etitle', 'etitle', 'required');
            // $this->form_validation->set_rules('elink', 'elink', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
		//$type_id = $this->input->post('slide_id', TRUE);
                $typename = $this->input->post('etitle', TRUE);
                // $link = $this->input->post('elink', TRUE);
                $status = $this->input->post('estatus', TRUE);
              
                $data = array(
                    'type_name' => $typename,
                                     
                    'status' => $status,
                    'modified_datetime' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address(),
                );

                if ($this->common->update_data($data, 'business_type', 'id', $type_id)) {
                    $this->session->set_flashdata('success', 'Business Type updated successfully.');
                    redirect('BusinessType', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating Business type. Try later!');
                    redirect('BusinessType', 'refresh');
                }
            }
        }
    }

public function update_status() {
        if ($this->input->method() == 'post') {

            $id = $this->input->post('slideid');

            $old_status = $this->input->post('old_status');

            if ($old_status == 'Enable') {
                $status = 'Disable';
            } else {
                $status = 'Enable';
            }
            $slide = $this->common->select_data_by_condition('business_type', array('id' => $id), '*', '', '', '', '', array());

            if (empty($slide)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'BusinessType', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'business_type', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(base_url() . 'BusinessType', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'BusinessType', 'refresh');
                }
            }
        }
    }
}
