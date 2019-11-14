<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class BusinessAccount extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'] . ': BusinessAccount';

//redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

//meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['username'] = $this->common->select_data_by_id('user', 'id', $this->session->userdata('user_id'), 'email', array());
        $this->data['bank_detail'] = $this->common->select_data_by_id('bank_detail', 'user_id', $this->session->userdata('user_id'), '*', array());

        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);

        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
    }

    public function index() {

        $this->data['business_type'] = $this->common->select_data_by_condition('business_type', array(), '*', '', '', '', '', array());
        //$this->data['business_email_verified'] = $this->common->select_data_by_condition('business', array(''), 'email_verified', '', '', '', '', array());
        //print_r($this->data['business_type']);exit;
        $this->data['countries'] = $this->common->select_data_by_condition('country', array(), '*', '', '', '', '', array());
	 $this->data['state'] = $this->common->select_data_by_condition('states', array(), '*', '', '', '', '', array());
        $this->load->view('businessaccount/index1', $this->data);
    }

    public function business() {

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
                 $this->session->set_flashdata('error', 'Please upload Busness Image');
                redirect('BusinessAccount', 'refresh');
            }

            $check_business = $this->common->select_data_by_id('business', 'user_id', $this->session->userdata('user_id'), '', array());

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
            if (empty($check_business)) {
                $businessinfo = array(
                    'user_id' => $this->session->userdata('user_id'),
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
                    "created_datetime" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_datetime" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );
               // print_r($businessinfo);exit;
                if ($this->common->insert_data($businessinfo, 'business')) {

                    $this->session->set_flashdata('success', 'Your business account registered successfullly..');
//                redirect('Userkyc/index', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong. Try again!');
                }
            } else {
                $this->session->set_flashdata('error', 'You have already registered for one business');
                redirect('BusinessAccount', 'refresh');
            }

            redirect('BusinessAccount', 'refresh');
        }
    }

    public function emailExits() {

        $id = $this->session->userdata('user_id');
        $email = $this->input->post('email');
        if (trim($email) != '') {

            $res = $this->common->check_unique_avalibility('business', 'email', $email, 'user_id', $id, array());

            if (empty($res)) {

                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        } else {
            echo 'true';
            die();
        }
    }
	public function countryExits() {

       
        $country = $this->input->post('contrycode');
//echo $country;die();
        if (trim($country) != '') {

            $res = $this->common->select_data_by_id('country','name',$country,'*',array());
		
            if (empty($res)) {

                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        } else {
            
            die();
        }
    }
	
    public function businessnameexist() {
        $id = $this->session->userdata('user_id');
        $businessname = $this->input->post('businessname');
        if (trim($businessname) != '') {

            $res = $this->common->check_unique_avalibility('business', 'businessname', $businessname, 'user_id', $id, array());

            if (empty($res)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        } else {
            echo 'true';
            die();
        }
    }

   public function getstate() {
        $code = $this->input->post('contrycode');

        $str = '';
        $states = $this->common->select_data_by_id('states', 'name', $code, '*', array());
	
	
        if (!empty($states)) {

            $states_id = $states[0]['id'];
	    $str = '<option value="' . $states[0]['id'] . '" selected>' . $states[0]['name'] . '</option>';
        } else {
            $states_id = '';
		$str = '<option value="">Select State</option>';
        }
       
        echo $str;
        die();
    }
 public function finder() {

        $this->load->view('businessaccount/finder', $this->data);
    }
public function serviceview() {

        $this->load->view('businessaccount/view', $this->data);
    }

}




