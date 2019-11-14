<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Rewards extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Rewards : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }
		//rewards index
    public function index() {
        $this->data['Rewardsdata'] = $this->common->get_all_record('level_reward', '*', 'id', 'ASC');
	
        //$this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('Rewards/index', $this->data);
    }

    // update a rewards

   

    public function update() {
        
        
        $level_id = base64_decode($this->input->post('level_id'));
	
        if ($this->input->is_ajax_request()) {
            if ($level_id != '' && $level_id != 0) {
                $this->data['Rewardsdata'] = $this->common->selectRecordById('level_reward', $level_id, 'id');
		
                $this->load->view('Rewards/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }

        if ($this->input->method() == 'post') {
           
           
            $this->form_validation->set_rules('price', 'price', 'required');
              if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect('Rewards', 'refresh');
            } else {

             
                $rewards = $this->common->select_data_by_condition('level_reward', array('id' => $level_id), '*', '', '', '', '', array());
               
                    $rewardsData = array(
                    
                    "price" => $this->input->post('price', TRUE),
                     "modified_date" => date('Y-m-d H:i:s'),  
		    "modified_ip" => $this->input->ip_address(),              
                ); 
                
                if ($this->common->update_data($rewardsData, 'level_reward', 'id',$rewards[0]['id'])) {
                    $this->session->set_flashdata('success',' updated successfully.');
                    redirect('Rewards', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating Try later!');
                    redirect('Rewards', 'refresh');
                }
            }
        }
    }

    // status update
    
    public function update_status() {
        if ($this->input->method() == 'post') {

            $id = $this->input->post('slideid');

            $old_status = $this->input->post('old_status');

            if ($old_status == 'Enable') {
                $status = 'Disable';
            } else {
                $status = 'Enable';
            }
            $slide = $this->common->select_data_by_condition('user', array('id' => $id), '*', '', '', '', '', array());

            if (empty($slide)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Users', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'user', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(base_url() . 'Users', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'Users', 'refresh');
                }
            }
        }
    }
		
		
    
}
