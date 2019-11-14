<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'] . ': Dashboard';

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
        $this->data['fixpayamount'] = $this->common->selectRecordById('admin', '1', 'admin_id');
        $this->data['registration_fee'] = $this->data['fixpayamount']['registration_fee'];
        $this->data['registrasationpayment'] = $this->common->selectRecordById('user', $this->session->userdata('user_id'), 'id');

        $this->data['paymentverifiedstatus'] = $this->data['registrasationpayment']['payment_verified'];
        $this->data['paymentdata'] = $this->common->selectRecordById('register_payment', $this->session->userdata('user_id'), 'user_id');

        $this->data['paymentstatus'] = $this->data['paymentdata']['status'];
        $this->data['paymentcomment'] = $this->data['paymentdata']['comment'];
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
    }

    public function index() {
        $this->load->view('profile/index', $this->data);
    }

    public function update() {
        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('mobile_no', 'mobile_no', 'required');

        if ($this->data['logged_use']['auth_enable'] == 'Yes') {
            if (!$this->verify_google_auth($this->input->post('authcode'))) {
                $this->session->set_flashdata('error', 'Authetication code invalid!');
                redirect('profile', 'refresh');
            }
        }
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('profile', 'refresh');
        } else {
            $user_id = $this->session->userdata('user_id');
            $profilepic = $this->common->select_data_by_id('user','id',$user_id,'profilepic',array());
            $dataimage = $profilepic[0]['profilepic'];
//            print_r( $dataimage);exit;
            /*             * ***********    propfile pic upload        ************* */
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != null && $_FILES['image']['size'] > 0) {

                $config['upload_path'] = $this->config->item('upload_path_profilepic');
                $config['allowed_types'] = $this->config->item('upload_profilepic_allowed_types');
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

                if ($imgerror == '') {
                    $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                    $config['new_image'] = $this->config->item('upload_path_profilepic_thumb') . $imgdata['file_name'];
                    //$config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    //$config['thumb_marker'] = '';
                    $config['width'] = $this->config->item('profilepic_thumb_width');
                    $config['height'] = $this->config->item('profilepic_thumb_height');
                    $config['max_size'] = '2000';

                    //Loading Image Library
                    $this->image_lib->initialize($config);
                    $dataimage = $imgdata['file_name'];

                    //Creating Thumbnail
                    $this->image_lib->resize();
                    $thumberror = $this->image_lib->display_errors();
                } else {
                    $this->session->set_flashdata('error', $imgerror);
                    redirect('Profile', 'refresh');
                }
            }

            $updateData = array(
		'firstname'=>$this->input->post('firstname', TRUE),
                'lastname'=>$this->input->post('lastname', TRUE),
                'email' => $this->input->post('email', TRUE),
                'mobile_no' => $this->input->post('mobile_no', TRUE),
                'profilepic' => $dataimage,
                'modified_date' => date('Y-m-d H:i:s')
            );
     
            //  if($user_detail[0]['mobile_no']!=$updateData['mobileno']){$updateData['mobile_verified']='No';}
            if ($this->common->update_data($updateData, 'user', 'id', $user_id)) {

                $this->session->set_flashdata('success', 'Your Profile Updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Error occured. Try again!');
            }
            redirect('Profile/index', 'refresh');
        }
    }

}
