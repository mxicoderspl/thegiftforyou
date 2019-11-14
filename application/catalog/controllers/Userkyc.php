<?php

ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Userkyc extends MY_Controller {
public $kycid;
    public function __construct() {
        parent::__construct();
	
        $this->data['title'] = $this->data['site_name'] . ': KYC';

        //redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['alldetail'] = $this->common->select_data_by_id('kyc_user', 'user_id', $this->data['logged_use']['id'], '*', array());
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
    }

    public function index() {

        $this->data['pan_no'] = $this->common->select_data_by_id('user', 'id', $this->data['logged_use']['id'], 'pan_no', array());

        $kyc = $this->common->select_data_by_id('kyc_user', 'user_id', $this->data['logged_use']['id'], '*', array());
   //print_r($this->data['alldetail']);exit;
        if (!empty($kyc) && $kyc[0]['status'] == "Approved") {
            $this->load->view('kyc/detail', $this->data);
        } else {
            $this->load->view('kyc/index', $this->data);
        }
    }

    public function save() {
        $this->form_validation->set_rules('adhar_no', 'adhar_no', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('Userkyc', 'refresh');
        } else {
            $adharno = $this->input->post('adhar_no');
            $user_id = $this->session->userdata('user_id');
            $kycid = 0;
            /*             * ***********  images upload        ************* */
            $adharimage = $this->upload_adhar_photo();
            $passbookimage = $this->upload_passbook_photo();
	    $pancardimage = $this->upload_pancard_photo();
            $saveData = array(
                'user_id' => $user_id,
                'adhar_no' => $adharno,
                'adhar_photo' => $adharimage,
                'pancard_photo' => $pancardimage,
                'passbook_photo' => $passbookimage,
                'created_datetime' => date('Y-m-d H:i:s'),
                'created_ip' => $this->input->ip_address(),
                'modified_datetime' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );

            //  if($user_detail[0]['mobile_no']!=$updateData['mobileno']){$updateData['mobile_verified']='No';}
            if ($this->common->insert_data($saveData, 'kyc_user')) {
		
		/*************** email sending ****************/
		    $email = $this->security->xss_clean($this->data['logged_use']['email']);
                    $site_logo = base_url() . 'images/logo.png';

                    $year = date('Y');
                    //$activation_link = '<a href="' . site_url('Register/verifyemail/' . $custData['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
                    $mailData = $this->common->select_data_by_id('email_format', 'id', 31, '*', array());
                    $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
                    $mailformat = $mailData[0]['emailformat'];
                    $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))));
                    $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
                    $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
                    $mail_body = $this->load->view('mail', $this->data, true);
                  //print_r($mail_body);exit;

                    $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);
		
                $this->session->set_flashdata('success', 'Your KYC details Submitted successfully.');

            } else {
                $this->session->set_flashdata('error', 'Error occured. Try again!');
            }
            redirect('Userkyc/index', 'refresh');
        }
    }

    public function update() {
        $this->form_validation->set_rules('eadhar_no', 'eadhar_no', 'required');


        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect('Userkyc', 'refresh');
        } else {
            $adharno = $this->security->xss_clean($this->input->post('eadhar_no'));
            $user_id = $this->session->userdata('user_id');
//         
            /*             * ***********  images upload        ************* */
           $kycid = 1;

            $adharimage = $this->upload_adhar_photo();
            $passbookimage = $this->upload_passbook_photo();
	    $pancardimage = $this->upload_pancard_photo();
            $saveData = array(
                
                'adhar_no' => $adharno,
                'adhar_photo' => $adharimage,
                'passbook_photo' => $passbookimage,
		'pancard_photo' => $pancardimage,
		'status' => 'Pending',
                'created_datetime' => date('Y-m-d H:i:s'),
                'created_ip' => $this->input->ip_address(),
                'modified_datetime' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );
		//print_r($saveData);exit;
            
            if ($this->common->update_data($saveData, 'kyc_user','user_id',$user_id)) {

                $this->session->set_flashdata('success', 'Your KYC details Submitted successfully.');
         
            } else {
                $this->session->set_flashdata('error', 'Error occured. Try again!');
            }
            redirect('Userkyc/index', 'refresh');
        }
    }

    public function upload_adhar_photo() {
//echo 'adhar' . $_FILES['eadharimage']['name'];exit;
        if (isset($_FILES['adharimage']['name']) && $_FILES['adharimage']['name'] != null && $_FILES['adharimage']['size'] > 0) {
		
            $config['upload_path'] = $this->config->item('upload_path_adharphoto');
            $config['allowed_types'] = $this->config->item('upload_adharphoto_allowed_types');
            $config['file_name'] = rand(10, 99) . time();
            $this->load->library('upload');
            $this->load->library('image_lib');
            // Initialize the new config
            $this->upload->initialize($config);
            //Uploading Image
            $this->upload->do_upload('adharimage');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();

            if ($imgerror == '') {
                $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                $config['new_image'] = $this->config->item('upload_path_adharphoto_thumb') . $imgdata['file_name'];
                //$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                //$config['thumb_marker'] = '';
                $config['width'] = $this->config->item('adharphoto_thumb_width');
                $config['height'] = $this->config->item('adharphoto_thumb_height');
                $config['max_size'] = '2000';

                //Loading Image Library
                $this->image_lib->initialize($config);
                $dataimage = $imgdata['file_name'];

                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();

                return $dataimage;
            } else {//echo "error in adharphoto";exit;
                $this->session->set_flashdata('error', $imgerror);
                redirect('Userkyc', 'refresh');
            }
        } else {
		$dataimage = $this->common->select_data_by_id('kyc_user', 'user_id', $this->session->userdata('user_id'), 'adhar_photo', array());
            if (!empty($dataimage)) {
                
                return $dataimage[0]['adhar_photo'];
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!please try again');
                redirect('Userkyc', 'refresh');
            }
        }
    }

    public function upload_passbook_photo() {

        if (isset($_FILES['passbookimage']['name']) && $_FILES['passbookimage']['name'] != null && $_FILES['passbookimage']['size'] > 0) {

            $config['upload_path'] = $this->config->item('upload_path_passbookphoto');
            $config['allowed_types'] = $this->config->item('upload_passbookphoto_allowed_types');
            $config['file_name'] = rand(10, 99) . time();
            $this->load->library('upload');
            $this->load->library('image_lib');
            // Initialize the new config
            $this->upload->initialize($config);
            //Uploading Image
            $this->upload->do_upload('passbookimage');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();

            if ($imgerror == '') {
                $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                $config['new_image'] = $this->config->item('upload_path_passbookphoto_thumb') . $imgdata['file_name'];
                //$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                //$config['thumb_marker'] = '';
                $config['width'] = $this->config->item('passbookphoto_thumb_width');
                $config['height'] = $this->config->item('passbookphoto_thumb_height');
                $config['max_size'] = '2000';

                //Loading Image Library
                $this->image_lib->initialize($config);
                $dataimage = $imgdata['file_name'];

                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();

                return $dataimage;
            } else {
                //echo "error in passbookphoto";exit;
                $this->session->set_flashdata('error', $imgerror);
                redirect('Userkyc', 'refresh');
            }
        } else {
	$dataimage = $this->common->select_data_by_id('kyc_user', 'user_id', $this->session->userdata('user_id'), 'passbook_photo', array());
            if (!empty($dataimage)) {
                    return $dataimage[0]['passbook_photo'];
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!please try again');
                redirect('Userkyc', 'refresh');
            }
        }
    }

 public function upload_pancard_photo() {
	
        if (isset($_FILES['pancardimage']['name']) && $_FILES['pancardimage']['name'] != null && $_FILES['pancardimage']['size'] > 0) {
	
            $config['upload_path'] = $this->config->item('upload_path_pancardphoto');
            $config['allowed_types'] = $this->config->item('upload_pancardphoto_allowed_types');
            $config['file_name'] = rand(10, 99) . time();
            $this->load->library('upload');
            $this->load->library('image_lib');
            // Initialize the new config
            $this->upload->initialize($config);
            //Uploading Image
            $this->upload->do_upload('pancardimage');
            //Getting Uploaded Image File Data
            $imgdata = $this->upload->data();
            $imgerror = $this->upload->display_errors();

            if ($imgerror == '') {
                $config['source_image'] = $config['upload_path'] . $imgdata['file_name'];
                $config['new_image'] = $this->config->item('upload_path_pancardphoto_thumb') . $imgdata['file_name'];
                //$config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                //$config['thumb_marker'] = '';
                $config['width'] = $this->config->item('pancardphoto_thumb_width');
                $config['height'] = $this->config->item('pancardphoto_thumb_height');
                $config['max_size'] = '2000';

                //Loading Image Library
                $this->image_lib->initialize($config);
                $dataimage = $imgdata['file_name'];

                //Creating Thumbnail
                $this->image_lib->resize();
                $thumberror = $this->image_lib->display_errors();

                return $dataimage;
            } else {//echo "error in adharphoto";exit;
                $this->session->set_flashdata('error', $imgerror);
                redirect('Userkyc', 'refresh');
            }
        } else {
            $dataimage = $this->common->select_data_by_id('kyc_user', 'user_id', $this->session->userdata('user_id'), 'pancard_photo', array());
            if (!empty($dataimage)) {
                    return $dataimage[0]['pancard_photo'];
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!please try again');
                redirect('Userkyc', 'refresh');
            }
        }
    }

}
