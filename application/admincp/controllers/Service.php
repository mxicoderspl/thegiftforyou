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
/*****************  Edit user's business information *********/
	public function edit_business(){
	
	$businessid = base64_decode($_GET['id']);
	
	 $join_str[0] = array(
            'table' => 'states',
            'join_table_id' => 'states.id',
            'from_table_id' => 'business.state',
            'type' => '',
        );
	$join_str[1] = array(
            'table' => 'country',
            'join_table_id' => 'country.id',
            'from_table_id' => 'business.country',
            'type' => '',
        );
	
	$this->data['business_info'] = $this->common->select_data_by_id('business','business.id',$businessid,'business.*,states.name as statename,country.name as countryname',$join_str);
//print_r($this->data['business_info']);exit;
	$this->data['business_type'] = $this->common->select_data_by_condition('business_type', array(), '*', '', '', '', '', array());
        //$this->data['business_email_verified'] = $this->common->select_data_by_condition('business', array(''), 'email_verified', '', '', '', '', array());
        //print_r($this->data['business_type']);exit;
        $this->data['countries'] = $this->common->select_data_by_condition('country', array(), '*', '', '', '', '', array());
	$this->data['state'] = $this->common->select_data_by_condition('states', array(), '*', '', '', '', '', array());
        
		
		$this->load->view('businessaccount/edit_business',$this->data);
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

public function update_business(){
	
	$uid = $this->input->post('userid');

        $this->form_validation->set_rules('businessname', 'businessname', 'required', array('required' => '%s is required'));
        $this->form_validation->set_rules('business_type', 'business_type', 'required');
        $this->form_validation->set_rules('ownername', 'ownername', 'required');

        $this->form_validation->set_rules('email', 'email', 'required|valid_email', array('required' => '%s is required', 'valid_email' => '%s not valid format'));
        $this->form_validation->set_rules('phone', 'phone', 'required');
        $this->form_validation->set_rules('geolocation', 'geolocation', 'required');
        $this->form_validation->set_rules('addressline1', 'addressline1', 'required');
        $this->form_validation->set_rules('city', 'city', 'required');
        $this->form_validation->set_rules('states', 'states', 'required');
        $this->form_validation->set_rules('country', 'country', 'required');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'required');
//       $this->form_validation->set_rules('about', 'about', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('BusinessAccount', 'refresh');
        } else {
	    $business_image = $this->common->select_data_by_id('business','user_id',$uid,'image',array());
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                $config['upload_path'] = $this->config->item('upload_path_business');
                $config['allowed_types'] = $this->config->item('upload_business_allowed_types');
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
                    $config['new_image'] = $this->config->item('upload_path_business_thumb') . $imgdata['file_name'];
                    //$config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    //$config['thumb_marker'] = '';
                    $config['width'] = $this->config->item('business_thumb_width');
                    $config['height'] = $this->config->item('business_thumb_height');

                    //Loading Image Library
                    $this->image_lib->initialize($config);
                    $dataimage = $imgdata['file_name'];

                    //Creating Thumbnail
                    $this->image_lib->resize();
                    $thumberror = $this->image_lib->display_errors();
                } else {
                    $thumberror = '';
                    $dataimage = '';
		    $this->session->set_flashdata('error', $imgerror);
                    redirect('BusinessAccount', 'refresh');
                }
            } else {
                 $dataimage = $business_image[0]['image'];
            }

            $check_business = $this->common->select_data_by_id('business', 'user_id', $uid, '*', array());

            $check_contry = $this->common->select_data_by_id('country','name',$this->input->post('country'),'*',array());
            $check_state = $this->common->select_data_by_id('states','name',$this->input->post('states'),'*',array());

          /*  if(empty($check_contry)){
                $contryId = $this->common->insert_data_getid(array('name'=>$this->input->post('country'),'created_date'=>date('Y-m-d H:i:s'),'modified_date'=>date('Y-m-d H:i:s')), 'country');
                
                if($countryId){
                    $this->common->insert_data(array('country_id'=>$contryId,'name'=>$this->input->post('state'),'created_date'=>date('Y-m-d H:i:s'),'modified_date'=>date('Y-m-d H:i:s')), 'states');
                }
            }else{
			if(empty($check_state)){
				$this->common->insert_data(array('country_id'=>$check_contry[0]['id'],'name'=>$this->input->post('state'),'created_date'=>date('Y-m-d H:i:s'),'modified_date'=>date('Y-m-d H:i:s')), 'states');	
			}
			
		}*/
		//print_R($this->input->post('states')); exit();
            if (!empty($check_business)) {
                $businessinfo = array(
                    
                    'businessname' => $this->input->post('businessname'),
                    'business_type' => $this->input->post('business_type'),
                    'email' => $this->input->post('email'),
                    'ownername' => $this->input->post('ownername'),
                    'phone' => $this->input->post('phone'),
		    'description'=> $this->security->xss_clean($this->input->post('about')),
		    'image'=> $dataimage,
                    'addressline1' => $this->input->post('addressline1'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('states'),
                    'country' => $check_contry[0]['id'],
                    'zipcode' => $this->input->post('zipcode'),
                    'geolocation' => $this->input->post('geolocation'),
                   
                    "modified_datetime" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );
             // print_r($businessinfo);exit;
                if ($this->common->update_data($businessinfo, 'business','user_id',$uid)) {

                    $this->session->set_flashdata('success', 'User Business account Updated successfullly..');
//                redirect('Userkyc/index', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong. Try again!');
                }
            } 
            redirect('Service', 'refresh');
        }
}

 public function getbusinessinfo() {

        $json = array();
        $json['status'] = 'success';
        $id = $this->input->post('id');

        $join_str[0] = array(
            'table' => 'states',
            'join_table_id' => 'states.id',
            'from_table_id' => 'business.state',
            'type' => '',
        );
        $join_str[1] = array(
            'table' => 'country',
            'join_table_id' => 'country.id',
            'from_table_id' => 'business.country',
            'type' => '',
        );
        $join_str[2] = array(
            'table' => 'business_type',
            'join_table_id' => 'business_type.id',
            'from_table_id' => 'business.business_type',
            'type' => '',
        );
        
        $re = $this->common->select_data_by_id('business', 'business.id', $id, 'business.*,business_type.type_name as typename,states.name as statename,country.name as countryname', $join_str);

        $json['business'] = $re[0];
//       print_r($re);exit;

        echo json_encode($json);
        die();
    }
}
