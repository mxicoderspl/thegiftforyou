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
        $this->form_validation->set_rules('state', 'state', 'required');
        $this->form_validation->set_rules('country', 'country', 'required');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'required');


        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('BusinessAccount', 'refresh');
        } else {

            $businessinfo = array(
                'user_id' => $this->session->userdata('user_id'),
                'businessname' => $this->input->post('businessname'),
                'business_type' => $this->input->post('business_type'),
                'email' => $this->input->post('email'),
                'ownername' => $this->input->post('ownername'),
                'phone' => $this->input->post('phone'),
                'addressline1' => $this->input->post('addressline1'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zipcode' => $this->input->post('zipcode'),
                'geolocation' => $this->input->post('geolocation'),
                "created_datetime" => date('Y-m-d H:i:s'),
                "created_ip" => $this->input->ip_address(),
                "modified_datetime" => date('Y-m-d H:i:s'),
                "modified_ip" => $this->input->ip_address(),
            );
            //print_r($businessinfo);exit;
            if ($this->common->insert_data($businessinfo, 'business')) {

                $this->session->set_flashdata('success', 'Your business account registered successfullly..');
//                redirect('Userkyc/index', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Try again!');
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

    public function aboutbusiness() {
        if ($this->input->method() == 'post') {

            $this->form_validation->set_rules('price', 'price', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
                redirect('BusinessAccount', 'refresh');
            } else {
                $price = $this->input->post('price');
                $desc = $this->input->post('description');
                
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
                    }
                } else {
                    $this->session->set_flashdata('error', $imgerror);
                    redirect('BusinessAccount', 'refresh');
                }
                $check_business = $this->common->select_data_by_id('business', 'user_id', $this->session->userdata('user_id'), '', array());

                if (!empty($check_business)) {
                    $Data = array(
                        "image" => $dataimage,
                        "price" => $price,
                        "description" => $desc,
                        "modified_date" => date('Y-m-d H:i:s'),
                        "modified_ip" => $this->input->ip_address(),
                    );
                    if ($this->common->update_data($Data, 'business', 'user_id', $this->session->userdata('user_id'))) {
                        $this->session->set_flashdata('success', 'Business details is added successfully.');
                        redirect('BusinessAccount', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'There is an error occured. Try again !');
                        redirect('BusinessAccount', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Please first fillup Contact details for your business');
                    redirect('BusinessAccount', 'refresh');
                }
            }
        }
        $this->load->view('businessaccount/index1', $this->data);
    }

    /* public function getCountry(){
      $code=$this->input->post('code');
      $str='';
      $country= $this->common->select_data_by_id('country', 'iso', $code, '*', array());
      if(!empty($country)){

      $country_id=$country[0]['id'];
      }
      else{
      $country_id='';
      }
      $countries=$this->common->get_all_record('country', array('id','name'), 'name', 'ASC');
      $str='<option value="">Select country</option>';
      foreach ($countries as $country){

      if($country_id==$country['id']){
      $str .='<option value="'.$country['id'].'" selected>'.$country['name'].'</option>';
      }
      else{
      $str .='<option value="'.$country['id'].'">'.$country['name'].'</option>';
      }

      }

      echo $str;
      die();
      } */
}
