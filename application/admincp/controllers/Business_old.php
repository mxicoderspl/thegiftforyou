<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Setting.php file contains functions for managing general setting of site.
 */

class Business extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Business Plan : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    //load listing bank info setting view
    public function index() {
        //Addingg Setting Result to variable
       // $this->data['Bankinfo'] = $this->common->select_data_by_condition('settings', array('type' => 'Bankinfo','status'=>'Enable'), '*', '', '', '', '', array());//$this->common->get_all_record('settings', '*', 'setting_id', 'ASC');
	  //$this->data['Bankinfo'] = $this->common->get_all_record('level_reward', '*', 'id', 'ASC');
	$condition=array();
           // $condition['DATE('.$this->db->dbprefix.'wallet_transaction.created_datetime) >'] = $payment_sheet[0]['end_time'];
           // $condition['wallet_transaction.created_datetime <='] = date('Y-m-d H:i:s');
            //$condition['type']='credit';
           // $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'level_reward',
                'join_table_id' => 'level_reward.level',
                'from_table_id' => 'business_plan.reward_id',
                
            );
            
            $this->data['business']=$this->common->select_data_by_condition('business_plan', array(), 'level_reward.level,level_reward.price,business_plan.*', '', '', '', '', $join_str);
            //$wallet_transaction=$this->common->select_data_by_allcondition('business_plan', array(), 'level_reward.id,level_reward.price,business_plan.*', '', '', '', $join_str);
            //print_r($this->data['business']); exit();
        $this->load->view('business/index', $this->data);
    }

    //update general bankinfo setting record
    function update() {
        $this->data['product']=$this->common->get_all_record('product', '*', '', '');
        //print_r($this->data['product']); exit();
        $setting_id = base64_decode($this->input->post('setting_id'));
        //print_r($setting_id);exit();
        if ($this->input->is_ajax_request()) {
            if ($setting_id != '' && $setting_id != 0) {
                $condition=array('business_plan.id' => $setting_id);
                $join_str[0] = array(
                'table' => 'level_reward',
                'join_table_id' => 'level_reward.level',
                'from_table_id' => 'business_plan.reward_id',
                
            );
            
            $this->data['business']=$this->common->select_data_by_condition('business_plan', $condition, 'level_reward.level,level_reward.price,business_plan.*', '', '', '', '', $join_str);
           // print_r( $this->data['business']); exit();
               //print_r($this->db->last_query()); exit();
                $this->load->view('business/edit', $this->data);
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
             $this->form_validation->set_rules('personno', 'field_value', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {
                if ($setting_id != '' && $setting_id != 0) {
                    $person_no = $this->input->post('personno');
                    $product = $this->input->post('product');
                    if(empty($product)){
                        $product_list='';
                    } else {
                        $product_list = implode(',', $product);
                        
                    }
                    
                    $business = array('person_number' => $person_no,'product_list' => $product_list);
                    //$settingInfo = $this->common->selectRecordById('settings', $setting_id, 'setting_id');
                    //$settingName = $settingInfo['setting_name'];
                    if ($this->common->update_data($business, "business_plan", "id", $setting_id)) {
                        $this->session->set_flashdata('success',  ' updated successfully.');
                        redirect('Business', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is error in updating  Try later!');
                        redirect('Business', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
                    redirect('Business', 'refresh');
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
                $this->load->view('business/viewbyid', $this->data);
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
