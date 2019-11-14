<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Setting.php file contains functions for managing general setting of site.
 */

class Bankinfo extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Bankinfo : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    //load listing bank info setting view
    public function index() {
        //Addingg Setting Result to variable
        $this->data['Bankinfo'] = $this->common->select_data_by_condition('settings', array('type' => 'Bankinfo','status'=>'Enable'), '*', '', '', '', '', array());//$this->common->get_all_record('settings', '*', 'setting_id', 'ASC');
	
        $this->load->view('bankinfo/index', $this->data);
    }

    //update general bankinfo setting record
    function update() {
        $setting_id = base64_decode($this->input->post('setting_id'));
        if ($this->input->is_ajax_request()) {
            if ($setting_id != '' && $setting_id != 0) {
                $this->data['setting'] = $this->common->selectRecordById('settings', $setting_id, 'setting_id');
                $this->load->view('bankinfo/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if ($this->input->method() == 'post') {
            $this->form_validation->set_rules('setting_value', 'field_value', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
                if ($setting_id != '' && $setting_id != 0) {
                    $fieldvalue = ($this->input->post('setting_value', TRUE));
                    $settingdata = array('setting_value' => $fieldvalue);
                    $settingInfo = $this->common->selectRecordById('settings', $setting_id, 'setting_id');
                    $settingName = $settingInfo['setting_name'];
                    if ($this->common->update_data($settingdata, "settings", "setting_id", $setting_id)) {
                        $this->session->set_flashdata('success', $settingName . ' updated successfully.');
                        redirect('Bankinfo', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is error in updating ' . $settingName . '. Try later!');
                        redirect('Bankinfo', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('Bankinfo', 'refresh');
                }
                return;
            }
        }
    }
	 public function bankdata() {
        
        
       $user_id = base64_decode($this->input->post('user_id'));

        if ($this->input->is_ajax_request()) {
            if ($user_id != '' && $user_id != 0) {
                $this->data['user'] = $this->common->selectRecordById('bank_detail', $user_id, 'user_id');
                $this->load->view('bankinfo/viewbyid', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }	
 }
}

/*  End of file Setting.php 
 *  Location: ./application/controllers/Setting.php 
 */
