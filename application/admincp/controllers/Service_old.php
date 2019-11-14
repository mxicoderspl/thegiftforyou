<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Setting.php file contains functions for managing general setting of site.
 */

class Service extends My_Controller {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Business Service : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);
        
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }

    //load listing bank info setting view
    public function index() {
       
        $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
	     
           // $this->data['business']=$this->common->select_data_by_condition('business_plan', array(), 'level_reward.level,level_reward.price,business_plan.*', '', '', '', '', $join_str);
            
        $this->load->view('service/index', $this->data);
    }
    public function servicedata() {

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'business.user_id',
            'type' => '',
        );
	
	 $join_str[1] = array(
            'table' => 'business_type',
            'join_table_id' => 'business_type.id',
            'from_table_id' => 'business.business_type',
            'type' => '',
        );
        $columns = array  ('user.email','business.businessname','business.ownername','business_type.type_name','business.status','business.created_datetime');
        $request = $this->input->get();
        $condition = array();
       if (!empty($request['user_id'])) {
           
            $condition['user_id'] = base64_decode($request['user_id']);
        }
	 if (!empty($request['status'])) {
           
            $condition['business.status'] = $request['status'];
        }
       if (!empty($request['from_date']) && !empty($request['to_date'])) {
            $condition['DATE('.$this->db->dbprefix.'business.created_datetime) >='] = $request['from_date'];
            $condition['DATE('.$this->db->dbprefix.'business.created_datetime) <='] = $request['to_date'];
            //$condition['business.DATE(created_datetime) >='] = $request['from_date'];
            //$condition['business.DATE(created_datetime) <='] = $request['to_date'];
        }
        $getfiled = "business.id,business.image,user.email,business.businessname,business.ownername,business_type.type_name,business.status,business.created_datetime";
        echo $this->common->getDataTableSource('business', $columns, $condition, $getfiled, $request, $join_str);

        die();
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
            $slide = $this->common->select_data_by_condition('business', array('id' => $id), '*', '', '', '', '', array());

            if (empty($slide)) {
                $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                redirect(base_url() . 'Service', 'refresh');
            } else {
                $result = $this->common->update_data(array('status' => $status), 'business', 'id', $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'status is updated successfully.');
                    redirect(base_url() . 'Service', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect(base_url() . 'Service', 'refresh');
                }
            }
        }
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

        public function giftList(){
        
                
        $this->data['giftlist'] = $this->common->get_all_record('product', '*', '', '');
	 
        $this->data['img_path'] = $this->config->item('upload_path_slider');

        $this->load->view('business/gift_list', $this->data);
   
        }
        function update_gift() {
        $this->data['product']=$this->common->get_all_record('product', '*', '', '');
        //print_r($this->data['product']); exit();
        $setting_id = base64_decode($this->input->post('setting_id'));
        //print_r($setting_id);exit();
        if ($this->input->is_ajax_request()) {
            if ($setting_id != '' && $setting_id != 0) {
                $condition=array('id' => $setting_id);
                
            
            $this->data['business']=$this->common->select_data_by_condition('product', $condition, '*', '', '', '', '', array());
           // print_r( $this->data['business']); exit();
               //print_r($this->db->last_query()); exit();
                $this->load->view('business/add_gift', $this->data);
            } else {
                echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       <strong>Record not found with specified id. Try later!</strong>
                   </div>';
            }
            return;
        }
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('title', 'title', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Please follow validation rules!');
                redirect($this->data['redirect_url'], 'refresh');
            } else {

                $title = $this->input->post('title');
               
                $product = $this->common->select_data_by_condition('product', array('id' => $setting_id), '*', '', '', '', '', array());
                $dataimage = $product[0]['photo'];
               
                if (isset($_FILES['eimage']['name']) && $_FILES['eimage']['name'] != null && $_FILES['eimage']['size'] > 0) {
                   
                    $config['upload_path'] = $this->config->item('upload_path_gift');
                    $config['allowed_types'] = $this->config->item('upload_gift_allowed_types');
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
                        $config['new_image'] = $this->config->item('upload_path_gift_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('gift_thumb_width');
                        $config['height'] = $this->config->item('gift_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                        $dataimage = '';
                    }
                } 
                $data = array(
                    'title' => $title,
                    'photo' => $dataimage,
                   
                    //'modified_date' => date('Y-m-d H:i:s'),
                   
                );

                if ($this->common->update_data($data, 'product', 'id', $product[0]['id'])) {
                    $this->session->set_flashdata('success', $title . ' updated successfully.');
                    redirect('Business/giftList', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is error in updating ' . $title . '. Try later!');
                    redirect('Business/giftList', 'refresh');
                }
            }
        }
    }
    public function gift_add() {

        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('title', 'title', 'required');
            //$this->form_validation->set_rules('link', 'link', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('business/giftList', 'refresh');
            } else {
                $title = $this->input->post('title');
               // $link = $this->input->post('link');
                
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                    $config['upload_path'] = $this->config->item('upload_path_gift');
                    $config['allowed_types'] = $this->config->item('upload_gift_allowed_types');
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
                        $config['new_image'] = $this->config->item('upload_path_gift_thumb') . $imgdata['file_name'];
                        //$config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        //$config['thumb_marker'] = '';
                        $config['width'] = $this->config->item('gift_thumb_width');
                        $config['height'] = $this->config->item('gift_thumb_height');

                        //Loading Image Library
                        $this->image_lib->initialize($config);
                        $dataimage = $imgdata['file_name'];

                        //Creating Thumbnail
                        $this->image_lib->resize();
                        $thumberror = $this->image_lib->display_errors();
                    } else {
                        $thumberror = '';
                        $dataimage = '';
                    }
                } else {
                      
                    $this->session->set_flashdata('error', $imgerror);
                    redirect('business/giftList', 'refresh');
                }
                $Data = array(
                    "title" => $title,
                  //  "link" => $link,
                    "photo" => $dataimage,
                    "created_date" => date('Y-m-d H:i:s'),
                   
                    "modified_date" => date('Y-m-d H:i:s'),
                   
                );
               // print_r($Data);exit();
                if ($this->common->insert_data($Data, 'product')) {
                    $this->session->set_flashdata('success', 'Gifts is added successfully.');
                    redirect('business/giftList', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                    redirect('business/giftList', 'refresh');
                }
            }
        }
        $this->load->view('business/giftList', $this->data);
    }

}
/*  End of file Setting.php 
 *  Location: ./application/controllers/Setting.php 
 */
