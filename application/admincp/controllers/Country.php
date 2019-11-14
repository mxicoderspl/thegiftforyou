<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['app_name'] . ': Country';

        //redirect to dashboard if already login
        
        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
           }

    

    public function index() {

        if ($this->input->method() == 'post') {
		 $check_name = $this->common->select_data_by_id('country', 'name',$this->input->post('title'), '', array());
		//print_R($check_name); exit();
                    if(!empty($check_name))
			{
				$this->session->set_flashdata('error', 'Country already exists, please Enter other Country');
                               redirect('Country', 'refresh');
			}
            $country_arr = array(
                'name' => $this->security->xss_clean($this->input->post('title')),
               'created_date' => date('Y-m-d H:i:s'),
                'created_ip' => $this->input->ip_address(),
               
            );

            $this->common->insert_data($country_arr, 'country');
            $this->session->set_flashdata('success', 'country is successfully added.');
            redirect('Country/index', 'refresh');
        }

        $this->data['support'] = $this->common->get_all_record('country', '*', '', '');
        

        $this->load->view('country/index', $this->data);
    }
    
    
    function update() {
       /// $this->data['product']=$this->common->get_all_record('product', '*', '', '');
        //print_r($this->data['product']); exit();
        $id = base64_decode($this->input->post('setting_id'));
        //print_r($setting_id);exit();
        if ($this->input->is_ajax_request()) {
            if ($id != '' && $id != 0) {
               
                
            
            $this->data['country']= $this->common->selectRecordById('country', $id, 'id');
		
           //print_r( $this->data['business']); exit();
               //print_r($this->db->last_query()); exit();
                $this->load->view('country/edit', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if ($this->input->method() == 'post') {
           // $this->form_validation->set_rules('product', 'field_value', 'required');
             $this->form_validation->set_rules('title', 'Country name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                 redirect('Country', 'refresh');
            } else {
                if ($id != '' && $id != 0) {
                    $name = $this->input->post('title');
                   $check_name = $this->common->select_data_by_id('country', 'name', $name, '', array());
		//print_R($check_name[0]['id']); exit();
                    if(!($check_name[0]['id']==$id))
			{
				$this->session->set_flashdata('error', 'Country already exists, please Enter other Country');
                               redirect('Country', 'refresh');
			}
                    
                    $country = array('name' => $name);
                    //$settingInfo = $this->common->selectRecordById('settings', $setting_id, 'setting_id');
                    //$settingName = $settingInfo['setting_name'];
                    if ($this->common->update_data($country, "country", "id", $id)) {
                        $this->session->set_flashdata('success',  ' updated successfully.');
                        redirect('Country', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is error in updating  Try later!');
                        redirect('Country', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('Country', 'refresh');
                }
                return;
            }
        }
    }
    
    
    function delete() {
        if ($this->input->method() == 'post') {
        $id = $this->input->post('deleteuserid');

            $slider = $this->common->select_data_by_condition('country', array('id' => $id), '*', '', '', '', '', array());
        
            if (empty($slider)) {
                $this->session->set_flashdata('error', 'No information Found !');
                redirect(base_url() . 'Users', 'refresh');
            }

            
            $res = $this->common->delete_data('country', 'id', $id);

            if ($res) {
                $this->session->set_flashdata('success', ' Country is deleted successfully.');
                redirect(base_url() . 'Country', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Country', 'refresh');
            }
        }
    }
	

}
