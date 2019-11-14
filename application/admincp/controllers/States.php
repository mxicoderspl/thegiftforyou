<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class States extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'States: ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    public function index() {
        $this->data['countries'] = $this->common->get_all_record('country', '*', '', '');
	$this->data['states'] = $this->common->get_all_record('states', '*', '', '');
        //$this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('states/index', $this->data);
    }

   public function add(){
	
	if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('state', 'state', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            }else{
		$state = $this->input->post('state');
		$country = $this->input->post('country');
		
		$check_state = $this->common->select_data_by_id('states','name',$state,'*',array());
		$data = array(
                    'name' => $state,
                    'country_id' => $country,
                    'modified_datetime' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address(),
                );
		//print_r($check_state);exit;

                if (empty($check_state)) {
		    $this->common->insert_data($data, 'states');
                    $this->session->set_flashdata('success', 'New State Added successfully.');
                    redirect('States', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'This State is already Exist.!');
                    redirect('States', 'refresh');
                }
	    } 
	}	
   }

public function update() {


        $state_id = base64_decode($this->input->post('state_id'));
        if ($this->input->is_ajax_request()) {
            if ($state_id != '' && $state_id != 0) {
		$this->data['countries'] = $this->common->get_all_record('country', '*', '', '');
                $this->data['state'] = $this->common->selectRecordById('states', $state_id, 'id');
                $this->load->view('states/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('state', 'states', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
		$id = $this->input->post('state_id', TRUE);
                $state = $this->input->post('state', TRUE);
             	 $country = $this->input->post('country', TRUE);
                //$status = $this->input->post('estatus', TRUE);
              
                $data = array(
                    'name' => $state,
                               
                    'country_id' => $country,
                    'modified_datetime' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address(),
                );
	
		$check_state = $this->common->select_data_by_id('states','name',$state,'*',array());
		if(!empty($check_state)){
			 $this->session->set_flashdata('error', 'State is already Exist !');
                    redirect('States', 'refresh');	
		}else{
			if ($this->common->update_data($data, 'states', 'id', $id)) {
                    		$this->session->set_flashdata('success', 'State updated successfully.');
                    		redirect('States', 'refresh');
                	} else {
                    		$this->session->set_flashdata('error', 'There is error in updating State. Try later!');
                    		redirect('States', 'refresh');
                	}
		}
                
            }
        }
    }

}
