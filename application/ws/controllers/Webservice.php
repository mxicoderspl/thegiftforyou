<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservice extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        $this->load->model('Webservice_model');
        // $this->load->model('search');
        $this->load->library('user_agent');


        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $this->data['sem_setting'] = $this->common->select_data_by_condition('sem', array(), 'field_value,field_name,status', 'sem_id', 'ASC', '', '', array());
        //echo "<pre>"; print_r($this->data['sem_setting']); die();
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];

        $this->data['registration_fee'] = $this->common->select_data_by_condition('admin', array(), 'registration_fee', '', '', '', '', array());

//        print_r($this->data['registration_fee'][0]['registration_fee']);die();
    }

    public function song() {
        $songs = array(
            "0" => array("id" => 1, "name" => "hello", "album" => "21"),
            "1" => array("id" => 2, "name" => "hello", "album" => "21"),
            "2" => array("id" => 3, "name" => "hello", "album" => "21"),
            "3" => array("id" => 4, "name" => "hello", "album" => "21"),
            "4" => array("id" => 5, "name" => "hello", "album" => "21"),
        );

        echo json_encode($songs);
    }

    public function signup() {

        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not Allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['firstname']) || empty($jsonobj['lastname']) || empty($jsonobj['email']) || empty($jsonobj['mobile_no']) || empty($jsonobj['pan_no']) || empty($jsonobj['password']) || empty($jsonobj['cpassword']) || empty($jsonobj['referral_code'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }
        //check email exist
        if (!$this->check_email_exist($jsonobj['email'])) {
            echo json_encode(array('status' => '402', 'message' => 'EmailId is already Exist.'));
            die();
        }
        //check mobile no exist
        if (!$this->check_mobile_exist($jsonobj['mobile_no'])) {
            echo json_encode(array('status' => '402', 'message' => 'Mobile number is already Exist.'));
            die();
        }

        //check Pancard no exist
        if (!$this->check_pancard_exist($jsonobj['pan_no'])) {
            echo json_encode(array('status' => '402', 'message' => 'PAN number is already Exist.'));
            die();
        }

        //check refferal code exist or not
        $check_ref = $this->common->select_data_by_condition('user', array('referer_code' => $jsonobj['referral_code']), 'id', '', '', '', '', array(), '');

        if (empty($check_ref)) {
            echo json_encode(array('status' => '402', 'message' => 'You have entered wrong refferal code'));
            die();
        }

        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        $jsonobj['referral_code'] = $res;

        $user_register = array(
            "firstname" => $jsonobj['firstname'],
            "lastname" => $jsonobj['lastname'],
            "email" => $jsonobj['email'],
            "mobile_no" => $jsonobj['mobile_no'],
            "pan_no" => $jsonobj['pan_no'],
            "password" => $jsonobj['password'],
            "created_date" => date('Y-m-d H:i:s'),
            "modified_date" => date('Y-m-d H:i:s'),
            "created_ip" => $this->input->ip_address(),
            "activecode" => time() . rand(100, 999),
            "referer_code" => $jsonobj['referral_code'],
            "ref_by" => $check_ref[0]['id'],
            "status" => 'Disable',
            "modified_ip" => $this->input->ip_address(),
        );
        //print_r($user_register);exit;
        $user_id = $this->common->insert_data_getid($user_register, 'user');

        if ($user_id) {

            /*             * ******** sending email *********** */

            $email = $jsonobj['email'];
            $site_logo = base_url('../') . 'images/logo.png';

            $year = date('Y');
            $activation_link = '<a href="' . site_url('../Register/verifyemail/' . $user_register['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
            $mailData = $this->common->select_data_by_id('email_format', 'id', 14, '*', array());
            $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
            $mailformat = $mailData[0]['emailformat'];
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%activation_link%", $activation_link, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);
            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);

            // New user registration
            $adminmailData = $this->common->select_data_by_id('email_format', 'id', 16, '*', array());

            $adminsubject = str_replace('%site_name%', $this->data['site_name'], $adminmailData[0]['subject']);
            $adminmailformat = $adminmailData[0]['emailformat'];

            $this->data1['admin_mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%site_name%", $this->data['site_name'], str_replace("%email%", $email, str_replace("%year%", $year, stripslashes($adminmailformat)))));
            $this->data1['admin_mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data1['admin_mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $adminmail_body = $this->load->view('adminmail', $this->data1, true);
            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $this->data['site_email'], $adminsubject, $adminmail_body);

            echo json_encode(array('status' => '200', 'message' => 'Registration successfull. Activation email has been sent.'));
            die();
        } else {
            echo json_encode(array('status' => '403', 'message' => 'Error Occured!. Please Try again'));
            die();
        }
    }

    /*
     * User Login
     */

    public function login() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not Allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['email']) || empty($jsonobj['password']) || empty($jsonobj['device_type']) || empty($jsonobj['device_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $email = $jsonobj['email'];
        $password = sha1($jsonobj['password']);
        //$remember = $this->input->post('remember');
        $checkAuth = $this->common->select_data_by_id('user', 'email', $email, '*', array());
//echo $this->db->last_query(); die();
        //print_r($checkAuth);exit;
        if (empty($checkAuth)) { //echo "helo error";
            echo json_encode(array('status' => '402', 'message' => 'Invalid data you have entered.'));
            die();
        }
        if ($password != $checkAuth[0]['password']) {
            echo json_encode(array('status' => '402', 'message' => 'Password not match.! Please Try again'));
            die();
        }
        if ($email === $checkAuth[0]['email']) {
            if ($checkAuth[0]['activecode'] == null) {
                echo json_encode(array('status' => '402', 'message' => 'Your email is not verified, verification email was sent to your email.'));
                die();
            } elseif ($checkAuth[0]['status'] == 'Disable') {
                echo json_encode(array('status' => '402', 'message' => 'Your account is disabled by admin. Please contact to support.'));
                die();
            } elseif ($checkAuth[0]['active_email'] == "No") {
                echo json_encode(array('status' => '200', 'message' => 'Please First verify your emailId by clicking on link that send to you.'));
                die();
            }
            $api_token = time() . rand(10000, 99999);
            $user_token_data = array(
                'device_type' => $jsonobj['device_type'],
                'device_id' => $jsonobj['device_id'],
                'created_datetime' => date('Y-m-d H:i:s'),
                'user_id' => $checkAuth[0]['id'],
                'fcm_id' => $jsonobj['fcm_id'],
                'api_token' => $api_token,
                'created_ip' => $this->input->ip_address()
            );

            $this->common->insert_data($user_token_data, 'device');

            echo json_encode(array('status' => '200', 'message' => 'Login Succesfully.', 'user_data' => $checkAuth));
            die();
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Email id or Password is Invalid.'));
            die();
        }
    }

    public function forgot_password() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not Allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['email'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }
        $forgotEmail = $jsonobj['email'];
        $rand = rand(100, 999);

        $userData = $this->common->select_data_by_id('user', 'email', $forgotEmail, '*');


        if (empty($userData)) {
            echo json_encode(array('status' => '402', 'message' => 'The email you entered is not valid.'));
            die();
        } else {
            if ($userData[0]['status'] == 'Disable') {
                echo json_encode(array('status' => '402', 'message' => 'Please Active your account.'));
                die();
            }
            $firstname = $userData[0]['firstname'];
            $lastname = $userData[0]['lastname'];
            $link = base_url('../Login/resetPassword') . '/' . $userData[0]['activecode'];
            $resetlink = "<a href='$link' title='Reset Password' target='_blank'>" . $link . "</a>";
            $site_logo = base_url('../') . 'images/logo.png';
            $mailData = $this->common->select_data_by_id('email_format', 'id', '15', '*', array());
            $subject = $mailData[0]['subject'];
            $mailformat = $mailData[0]['emailformat'];
            //print_r($mailData);exit;
            $year = date('Y');
            $subject = str_replace("%site-name%", $this->data['site_name'], $subject);


            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $userData[0]['email'], str_replace("%reset_link%", $resetlink, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);

            // print_r($mail_body);exit;
            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $forgotEmail, $subject, $mail_body);
            echo json_encode(array('status' => '200', 'message' => 'Reset password link has been successfully sent to your email.'));
            die();
        }
    }

    /*
     * User Can Change password
     */

    public function change_password() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['old_password']) || empty($jsonobj['new_password'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        //check authenticate user...
        $this->user_auth($jsonobj['user_id']);

        $user_data = $this->common->select_data_by_condition('user', array('id' => $jsonobj['user_id']), 'id,password', '', '', '', '', array(), '');
        $old_password = sha1($jsonobj['old_password']);

        if ($old_password != $user_data[0]['password']) {
            echo json_encode(array('status' => '402', 'message' => 'Old password not match !'));
            die();
        }

        if (!empty($user_data)) {
            $update_array = array('password' => sha1($jsonobj['new_password']), 'modified_date' => date('Y-m-d H:i:s'), 'modified_ip' => $this->input->ip_address());

            if ($this->common->update_data($update_array, 'user', 'id', $jsonobj['user_id'])) {
                echo json_encode(array('status' => '200', 'message' => 'Password change successfully.'));
                die();
            } else {
                echo json_encode(array('status' => '403', 'message' => 'An error has occurred. Try again!'));
                die();
            }
        } else {
            echo json_encode(array('status' => '402', 'message' => 'An error has occurred. Try again!'));
            die();
        }
    }

    /**     * ******** Profile ************* */
    function get_profile() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        //check authenticate user...
        $this->user_auth($user_id);

        $user_profile = $this->common->select_data_by_condition('user', array('id' => $user_id), 'firstname,lastname,email,mobile_no,profilepic', '', '', '', '', array());
        if (!empty($user_profile)) {

            $profile_image = $user_profile[0]['profilepic'];
            // $user_data[0]['profile_image'] = base_url() . $this->config->item('user_profile_upload_path') . $user_data[0]['profile_image'];
            $user_profile[0]['profile_image'] = base_url() . $this->config->item('upload_path_profilepic_thumb') . $profile_image;

            echo json_encode(array('status' => '200', 'message' => 'Record Found', 'user_profile_data' => $user_profile));
            die();
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Incorrect User id'));
            die();
        }
    }

    public function update_profile() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not Allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['firstname']) || empty($jsonobj['lastname']) || empty($jsonobj['email']) || empty($jsonobj['mobile_no'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

// check for user token
        $userid = $jsonobj['user_id'];
        $this->user_auth($userid);

        $old_profilepic = $this->common->select_data_by_id('user', 'id', $userid, '*', array());

        $profilepic = $jsonobj['profile_pic'];
//print_r($profilepic);die();
        $upadtedata = array(
            'firstname' => $jsonobj['firstname'],
            'lastname' => $jsonobj['lastname'],
            //'email' => $this->input->post('email'),
            'mobile_no' => $jsonobj['mobile_no'],
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_ip" => $this->input->ip_address(),
        );

        if (isset($profilepic) && !empty($profilepic)) {


            $pic = $this->config->item('upload_path_profilepic') . $old_profilepic[0]['profilepic'];
            $pic_thumb = $this->config->item('upload_path_profilepic_thumb') . $old_profilepic[0]['profilepic'];
            if (file_exists($pic)) {
                unlink($pic);
            }
            if (file_exists($pic_thumb)) {
                unlink($pic_thumb);
            }

            /*             * * encoded image ***** */
            $img = str_replace('data:image/png;base64,', '', $profilepic);
            //  $user_id=$this->session->userdata();
            $img . "<br>";
            //   $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $path = $this->config->item('upload_path_profilepic');
            $path1 = $this->config->item('upload_path_profilepic_thumb');

            $filename = rand(10, 99) . time() . '.png';


            // $filename_array[] = $filename;
            $file = $path . $filename;
            $file1 = $path1 . $filename;
            $success = file_put_contents($file, $data);
            $success1 = file_put_contents($file1, $data);
            $upadtedata['profilepic'] = $filename;
        } else {
            $upadtedata['profilepic'] = $old_profilepic[0]['profilepic'];
        }
        if ($this->common->update_data($upadtedata, 'user', 'id', $userid)) {

            echo json_encode(array('status' => '200', 'message' => 'Profile Updated Successfully.', 'profile_data' => $upadtedata));
            die();
        } else {

            echo json_encode(array('status' => '200', 'message' => 'Something went wrong please try aftersome time.'));
            die();
        }
    }

    public function kyc() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not Allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['adhar_no']) || empty($jsonobj['pancard_no']) || empty($jsonobj['adharimage']) || empty($jsonobj['pancardimage']) || empty($jsonobj['passbookimage'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        } else {
            // check for user token
            $user_id = $jsonobj['user_id'];
            $this->user_auth($user_id);

            $adharno = $jsonobj['adhar_no'];

            $dataexist = $this->common->select_data_by_id('kyc_user', 'user_id', $user_id, 'id', array());
            if (!empty($dataexist)) {
                echo json_encode(array('status' => '402', 'message' => 'KYC Details already Exist'));
                die();
            }
            /*             * ***********  images upload        ************* */

            $adharimg = $this->upload_adhar_photo($jsonobj['adharimage']);
            $passbookimg = $this->upload_passbook_photo($jsonobj['pancardimage']);
            $pancardimg = $this->upload_pancard_photo($jsonobj['passbookimage']);
            $saveData = array(
                'user_id' => $user_id,
                'adhar_no' => $adharno,
                'adhar_photo' => $adharimg,
                'pancard_photo' => $passbookimg,
                'passbook_photo' => $pancardimg,
                'created_datetime' => date('Y-m-d H:i:s'),
                'created_ip' => $this->input->ip_address(),
                'modified_datetime' => date('Y-m-d H:i:s'),
                'modified_ip' => $this->input->ip_address()
            );

            if ($this->common->insert_data($saveData, 'kyc_user')) {

                /*                 * ************* email sending *************** */
                $useinfo = $this->common->select_data_by_id('user', 'id', $user_id, 'email', array());
                $email = $this->security->xss_clean($useinfo[0]['email']);
                $site_logo = base_url('../') . 'images/logo.png';

                $year = date('Y');
                //$activation_link = '<a href="' . site_url('Register/verifyemail/' . $custData['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
                $mailData = $this->common->select_data_by_id('email_format', 'id', 31, '*', array());
                $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
                $mailformat = $mailData[0]['emailformat'];
                $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))));
                $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
                $this->data['mail_footer'] = '<a href="' . site_url('../') . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
                $mail_body = $this->load->view('mail', $this->data, true);

                $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);

                echo json_encode(array('status' => '200', 'message' => 'Kyc Details sent successfully.'));
                die();
            } else {
                echo json_encode(array('status' => '402', 'message' => 'Something went wrong!'));
                die();
            }
        }
    }

    public function get_bank_detail() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        //check authenticate user...
        $this->user_auth($user_id);

        $bankdtl = $this->common->select_data_by_condition('bank_detail', array('user_id' => $user_id), '*', '', '', '', '', array());
        if (!empty($bankdtl)) {

            echo json_encode(array('status' => '200', 'message' => 'Record Found', 'user_bank_detail' => $bankdtl));
            die();
        } else {
            echo json_encode(array('status' => '402', 'message' => 'No Records Found !'));
            die();
        }
    }

    public function submit_bank_detail() {

        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        $user_id = $jsonobj['user_id'];
        //check authenticate user...
        $this->user_auth($user_id);

        if (empty($jsonobj['user_id']) || empty($jsonobj['bank_name']) || empty($jsonobj['account_holder_name']) || empty($jsonobj['account_no']) || empty($jsonobj['ifsc_no'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        } else {
            $data_exist = $this->common->select_data_by_id('bank_detail', 'user_id', $user_id, 'id', array());
            if (!empty($data_exist)) {
                echo json_encode(array('status' => '402', 'message' => 'Bank Details already submitted.'));
                die();
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'bank_name' => $jsonobj['bank_name'],
                    'account_name' => $jsonobj['account_holder_name'],
                    'account_no' => $jsonobj['account_no'],
                    'ifsc_code' => $jsonobj['ifsc_no'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_ip' => $this->input->ip_address(),
                    'modified_date' => date('Y-m-d H:i:s'),
                    'modified_ip' => $this->input->ip_address()
                );
                $result = $this->common->insert_data($data, 'bank_detail');
                if ($result) {
                    echo json_encode(array('status' => '200', 'message' => 'Your Bank Detail submitted successfully'));
                    die();
                } else {
                    echo json_encode(array('status' => '402', 'message' => 'Opps!! Something went wrong.'));
                    die();
                }
            }
        }
    }

    public function update_bank_detail() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['bank_name']) || empty($jsonobj['account_holder_name']) || empty($jsonobj['account_no']) || empty($jsonobj['ifsc_no'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }


        $user_id = $data['user_id'] = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $data['bank_name'] = $jsonobj['bank_name'];
        $data['account_name'] = $jsonobj['account_holder_name'];
        $data['account_no'] = $jsonobj['account_no'];
        $data['ifsc_code'] = $jsonobj['ifsc_no'];
        $data['modified_date'] = date('Y-m-d H:i:s');
        $data['modified_ip'] = $this->input->ip_address();

        $update_data = $this->common->update_data($data, 'bank_detail', 'user_id', $data['user_id']);
        if ($update_data) {
            echo json_encode(array('status' => '200', 'message' => 'Bank detail updated successfully', 'user_bank_detail' => $data));
            die();
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Something went wrong!'));
            die();
        }
    }

    public function wallet() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);
        if (empty($jsonobj['start_date']) && empty($jsonobj['end_date'])) {
            $start_date = "";
            $end_date = "";
        } else {
            $start_date = $jsonobj['start_date'];
            $end_date = $jsonobj['end_date'];
        }

        $condition = array();
        if (!empty($start_date) && !empty($end_date)) {
            $condition['DATE(created_datetime) >='] = $start_date;
            $condition['DATE(created_datetime) <='] = $end_date;
        }
        $wallet_balance = $this->common->select_data_by_id('user', 'id', $user_id, 'wallet_balance', array());
        $company_wallet_balance = $this->common->select_data_by_id('user', 'id', $user_id, 'company_wallet_balance', array());
        $wallet_transaction = $this->common->select_data_by_condition('wallet_transaction', $condition, '*', '', '', '', '', array());

        $wallet = array(
            'wallet_balance' => $wallet_balance,
            'company_balance' => $company_wallet_balance,
            'wallet_transaction' => $wallet_transaction
        );
        echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'Wallet_Information' => $wallet));
        die();
    }

    public function company_wallet() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);
        if (empty($jsonobj['start_date']) && empty($jsonobj['end_date'])) {
            $start_date = "";
            $end_date = "";
        } else {
            $start_date = $jsonobj['start_date'];
            $end_date = $jsonobj['end_date'];
        }

        $condition = array();
        if (!empty($start_date) && !empty($end_date)) {
            $condition['DATE(created_date) >='] = $start_date;
            $condition['DATE(created_date) <='] = $end_date;
        }

        $wallet_balance = $this->common->select_data_by_id('user', 'id', $user_id, 'wallet_balance', array());
        $company_wallet_balance = $this->common->select_data_by_id('user', 'id', $user_id, 'company_wallet_balance', array());
        $company_wallet_transaction = $this->common->select_data_by_condition('company_wallet', $condition, '*', '', '', '', '', array());

        $wallet = array(
            'wallet_balance' => $wallet_balance,
            'company_balance' => $company_wallet_balance,
            'company_wallet_transaction' => $company_wallet_transaction
        );
        echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'Wallet_Information' => $wallet));
        die();
    }

    public function registration_transaction() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $settings = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $dtl = $this->data['register_payment_detail'] = $this->common->select_data_by_id('register_payment', 'user_id', $user_id, '*', array());
        $detail = array(
            'Bank_Name' => $settings[6]['setting_value'],
            'IFSC_Code' => $settings[7]['setting_value'],
            'Account_Holder_Name' => $settings[8]['setting_value'],
            'Account_Number' => $settings[9]['setting_value'],
            'Amount' => $dtl[0]['amount'],
            'Status' => $dtl[0]['status'],
            'Transaction_Date' => $dtl[0]['created_datetime'],
            'Comment' => $dtl[0]['comment']
        );
        echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'registration_transaction' => $detail));
        die();
    }

    public function reward_transaction() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'join_type' => '',
        );

        $condition = array();

        $condition['user_id'] = $user_id;

        $get_data = $this->common->select_data_by_condition('user_reward', $condition, 'user_reward.id,user_reward.wallet_transaction_id,user_reward.amount,user_reward.created_datetime,user.email', '', '', '', '', $join_str);
//        print_r($get_data);exit;

        if (!empty($get_data)) {
            echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'Wallet_to_wallet_transaction' => $get_data));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'No Record Found!', 'Wallet_to_wallet_transaction' => $get_data));
            die();
        }
    }

    public function registration_fee_distribution() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user_reward.user_id',
            'from_table_id' => 'user.id',
            'join_type' => ''
        );
        $join_str[1] = array(
            'table' => 'level_reward',
            'join_table_id' => 'user_reward.level',
            'from_table_id' => 'level_reward.id',
            'join_type' => ''
        );

        $condition = array();

        $condition['from_user_id'] = $user_id;

        $result = $this->common->select_data_by_condition('user_reward', $condition, 'user_reward.id,user_reward.amount,level_reward.price,user.email,user_reward.created_datetime', '', '', '', '', $join_str);
        if (empty($result)) {
            echo json_encode(array('status' => '200', 'message' => 'No Record Found!', 'fee_distribution' => $result));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'Record Found!', 'fee_distribution' => $result));
            die();
        }
    }

    public function wallet_to_wallet_transaction() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['type'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $type = $jsonobj['type'];
        $this->user_auth($user_id);
        if (empty($jsonobj['start_date']) && empty($jsonobj['end_date'])) {
            $start_date = "";
            $end_date = "";
        } else {
            $start_date = $jsonobj['start_date'];
            $end_date = $jsonobj['end_date'];
        }

        $join_str[0] = array(
            'table' => 'user as u1',
            'join_table_id' => 'u1.id',
            'from_table_id' => 'wallet_to_wallet.to_userid',
            'type' => '',
        );
        $condition = array();
        if ($type == "debit") {
            $condition = array('from_userid' => $user_id);
        } else {
            $condition = array('to_userid' => $user_id);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $condition['DATE(' . $this->db->dbprefix . 'wallet_to_wallet.created_date) >='] = $start_date;
            $condition['DATE(' . $this->db->dbprefix . 'wallet_to_wallet.created_date) <='] = $end_date;
        }

        $transactions = $this->common->select_data_by_condition('wallet_to_wallet', $condition, 'wallet_to_wallet.id,u1.email as to_username,wallet_to_wallet.wallet_transaction_id,wallet_to_wallet.amount,wallet_to_wallet.created_date', '', '', '', '', $join_str);
        if (empty($transactions)) {
            echo json_encode(array('status' => '200', 'message' => 'No Record Found!', 'Wallet_to_wallet_transaction' => $transactions));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'Wallet_to_wallet_transaction' => $transactions));
            die();
        }
    }

    public function support_ticket() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $condition = array(
            'user_id' => $user_id
        );

        $support = $this->common->select_data_by_condition('support', $condition, '*', '', '', '', '', array());
        if (empty($support)) {
            echo json_encode(array('status' => '200', 'message' => 'No Records Found.', 'support_tickets' => $support));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'Record Found.', 'support_tickets' => $support));
            die();
        }
    }

    public function send_query() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }

        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['title']) || empty($jsonobj['message'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $dataexist = $this->common->select_data_by_id('support', 'user_id', $user_id, '*', array());
        if (!empty($dataexist)) {
            echo json_encode(array('status' => '200', 'message' => 'Your request alredy sent to support team'));
            die();
        }
        $title = $jsonobj['title'];
        $message = $jsonobj['message'];
        $support_arr = array(
            'title' => $title,
            'message' => $message,
            'created_date' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
        );
        $result = $this->common->insert_data($support_arr, 'support');
        if ($result) {
            $user = $this->common->select_data_by_id('user', 'id', $user_id, 'firstname,lastname,email', array());
            $name = $user[0]['firstname'] . $user[0]['lastname'];
            $email = $user[0]['email'];
            $sub = $title;
            $message = $message;
            $sitename = $this->data['site_name'];
            $site_logo = base_url('../') . 'images/logo.png';
            $year = date('Y');
            $link = '<a href="' . site_url('admincp/Support') . '">Please Click Here For More Details</a>';

            $mailData = $this->common->select_data_by_id('email_format', 'id', '30', '*', array());

            $mailformat = $mailData[0]['emailformat'];
            //print_r($mailformat);exit;
            $subject = str_replace('%site_name%', $sitename, $mailData[0]['subject']);
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%name%", $name, str_replace("%email%", $email, str_replace("%subject%", $sub, str_replace("%message%", nl2br($message), str_replace("%site_name%", $sitename, str_replace("%link%", $link, str_replace("%year%", $year, stripslashes($mailformat)))))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $sitename . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $sitename . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);

            $this->sendEmail($name, $email, $this->data['support_email'][0]['setting_value'], $subject, $mail_body);
            echo json_encode(array('status' => '200', 'message' => 'Your request sent successfully', 'support_ticket_request' => $support_arr));
            die();
        } else {
            echo json_encode(array('status' => '400', 'message' => 'Something went wrong!'));
            die();
        }
    }

    public function dashboard_before_payment() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }

        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        $general_settings = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $setting_data = array(
            'bank_name' => $general_settings[6]['setting_value'],
            'IFSC_code' => $general_settings[7]['setting_value'],
            'Account_holder_name' => $general_settings[8]['setting_value'],
            'Account_no' => $general_settings[9]['setting_value'],
            'registration_fee' => $this->data['registration_fee'][0]['registration_fee']
        );

        echo json_encode(array('status' => '200', 'message' => 'Records Found', 'site_information' => $setting_data));
        die();
    }

    public function Paynow() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['payment_info'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }


        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);
        $payment_info = $jsonobj['payment_info'];

        $dataexist = $this->common->select_data_by_id('register_payment', 'user_id', $user_id, 'id', array());
        if (!empty($dataexist)) {
            echo json_encode(array('status' => '200', 'message' => 'Your request already sent.'));
            die();
        }
        $dataimage = '';

        if (isset($jsonobj['payment_receipt']) && $jsonobj['payment_receipt'] != null) {

            /*             * * encoded image ***** */
            $img = str_replace('data:image/png;base64,', '', $jsonobj['payment_receipt']);
            //  $user_id=$this->session->userdata();
            $img . "<br>";
            //   $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $path = $this->config->item('upload_path_paymentinfo');
//            $path1 = $this->config->item('upload_path_profilepic_thumb');

            $filename = rand(10, 99) . time() . '.png';


            // $filename_array[] = $filename;
            $file = $path . $filename;
//            $file1 = $path1 . $filename;
            $success = file_put_contents($file, $data);
//            $success1 = file_put_contents($file1, $data);
            $dataimage = $filename;
        }
        $payment_data = array(
            "user_id" => $user_id,
            "created_datetime" => date('Y-m-d H:i:s'),
            "modified_date" => date('Y-m-d H:i:s'),
            "created_ip" => $this->input->ip_address(),
            "payment_information" => $payment_info,
            "document" => $dataimage,
            "amount" => $this->data['registration_fee'][0]['registration_fee'],
            "status" => 'Pending',
            "modified_ip" => $this->input->ip_address(),
        );

        $result = $this->common->insert_data_getid($payment_data, "register_payment");
        if ($result) {
            $user = $this->common->select_data_by_id('user', 'id', $user_id, 'firstname,lastname,email', array());
            /* ------------- sending request *********** */
            $email = $user[0]['email'];

            $site_logo = base_url('../') . 'images/logo.png';

            $year = date('Y');
            //$activation_link = '<a href="' . site_url('Register/verifyemail/' . $custData['activecode']) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
            $mailData = $this->common->select_data_by_id('email_format', 'id', 28, '*', array());
            $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
            $mailformat = $mailData[0]['emailformat'];
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%email%", $email, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);
            // print_r($subject);print_r($mail_body);exit;

            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);

            echo json_encode(array('status' => '200', 'message' => 'Payment Request sent successfully.', 'payment_information' => $payment_data));
            die();
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Something went wrong !'));
            die();
        }
    }

    public function network() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }
        $user_id = $jsonobj['user_id'];
        $this->user_auth($user_id);

        for ($i = 1; $i <= 11; $i++) {

            $condition_array = array(
                'user_id' => $user_id,
                'level' => $i
            );
            $this->data['dtluser'][$i] = $this->common->select_data_by_condition('user_reward', $condition_array, '*', '', '', '', '', array());
            $this->data['totaluser'][$i] = count($this->data['dtluser'][$i]);
//            echo $this->db->last_query();exit;
            $this->data['totalrewardamount'][$i] = $this->common->select_data_by_condition('user_reward', $condition_array, 'sum(amount) as totalamount', '', '', '', '', array());
            $rewardampount[$i] = $this->data['totalrewardamount'][$i][0]['totalamount'];

            if (empty($this->data['totalrewardamount'][$i][0]['totalamount'])) {

                $rewardampount[$i] = $this->data['totalrewardamount'][$i][0]['totalamount'] = 0.00;
            }
            $network_info[] = array(
                'level' => $i,
                'No_of_users' => $this->data['totaluser'][$i],
                'total_amount' => $rewardampount[$i]
            );
        }
        echo json_encode(array('status' => '200', 'message' => 'Records Found.', 'Network_information' => $network_info));
        die();
    }

    public function transaction_information() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        if (empty($jsonobj['user_id']) || empty($jsonobj['level'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }
        $user_id = $jsonobj['user_id'];

        $this->user_auth($user_id);
        $level = $jsonobj['level'];
        $join_str[0] = array(
            'table' => 'user',
            'join_table_id' => 'user.id',
            'from_table_id' => 'user_reward.from_user_id',
            'join_type' => '',
        );

        $condition = array(
            'user_reward.user_id' => $user_id,
            'user_reward.level' => $level
        );

        $result = $this->common->select_data_by_condition('user_reward', $condition, 'user_reward.id,user_reward.amount,user_reward.created_datetime,user.email,user.profilepic,user.firstname,user.lastname', '', '', '', '', $join_str);
        if (!empty($result)) {
            echo json_encode(array('status' => '200', 'message' => 'Records Found.', 'transaction_information' => $result));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'No Records Found.', 'transaction_information' => $result));
            die();
        }
    }

// business..
    public function business_type() {
        if ($this->input->method() != 'get') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $business_type = $this->common->select_data_by_condition('business_type', array('status' => 'Enable'), 'id,type_name,status', '', '', '', '', array());

        if (empty($business_type)) {
            echo json_encode(array('status' => '200', 'message' => 'No Records Found!', 'business_type' => $business_type));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'Records Found.', 'business_type' => $business_type));
            die();
        }
    }

    public function submit_business_details() {

        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        $user_id = $jsonobj['user_id'];

        $this->user_auth($user_id);

        if (empty($jsonobj['user_id']) || empty($jsonobj['businessname']) || empty($jsonobj['business_type']) || empty($jsonobj['ownername']) || empty($jsonobj['email']) || empty($jsonobj['phone']) || empty($jsonobj['geolocation']) || empty($jsonobj['addressline1']) || empty($jsonobj['city']) || empty($jsonobj['states']) || empty($jsonobj['zipcode'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        } else {

            if (isset($jsonobj['image']) && $jsonobj['image'] != null) {

                /*                 * * encoded image ***** */
                $img = str_replace('data:image/png;base64,', '', $jsonobj['image']);
                //  $user_id=$this->session->userdata();
                $img . "<br>";
                //   $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                $path = $this->config->item('upload_path_business');
                $path1 = $this->config->item('upload_path_business_thumb');

                $filename = rand(10, 99) . time() . '.png';
                // $filename_array[] = $filename;
                $file = $path . $filename;
                $file1 = $path1 . $filename;
                $success = file_put_contents($file, $data);
                $success1 = file_put_contents($file1, $data);

                $dataimage = $filename;

                $check_business = $this->common->select_data_by_id('business', 'user_id', $jsonobj['user_id'], '', array());
                $check_business_type = $this->common->select_data_by_id('business_type', 'id', $jsonobj['business_type'], '', array());
                if (empty($check_business_type)) {
                    echo json_encode(array('status' => '403', 'message' => 'There is no any business type you have entered ! Try Again'));
                    die();
                }
                $check_contry = $this->common->select_data_by_id('country', 'name', 'India', '*', array());
                $check_state = $this->common->select_data_by_id('states', 'id', $jsonobj['states'], '*', array());
                if (empty($check_state)) {
                    echo json_encode(array('status' => '403', 'message' => 'There is no any state you have entered ! Try Again'));
                    die();
                }
                if (empty($check_business)) {
                    $businessinfo = array(
                        'user_id' => $jsonobj['user_id'],
                        'businessname' => $jsonobj['businessname'],
                        'business_type' => $jsonobj['business_type'],
                        'email' => $jsonobj['email'],
                        'ownername' => $jsonobj['ownername'],
                        'phone' => $jsonobj['phone'],
                        'description' => $jsonobj['description'],
                        'image' => $dataimage,
                        'addressline1' => $jsonobj['addressline1'],
                        'city' => $jsonobj['city'],
                        'state' => $check_state[0]['id'],
                        'country' => $check_contry[0]['id'],
                        'zipcode' => $jsonobj['zipcode'],
                        'geolocation' => $jsonobj['geolocation'],
                        "created_datetime" => date('Y-m-d H:i:s'),
                        "created_ip" => $this->input->ip_address(),
                        "modified_datetime" => date('Y-m-d H:i:s'),
                        "modified_ip" => $this->input->ip_address(),
                    );
                    //print_r($businessinfo);exit;
                    if ($this->common->insert_data($businessinfo, 'business')) {
                        echo json_encode(array('status' => '200', 'message' => 'business account registered successfullly.'));
                        die();
                    } else {
                        echo json_encode(array('status' => '403', 'message' => 'Something went wrong in registering business! Try Again'));
                        die();
                    }
                } else {
                    echo json_encode(array('status' => '200', 'message' => 'You have already registered for one business!'));
                    die();
                }
            } else {
                echo json_encode(array('status' => '403', 'message' => 'Please upload business profile photo.'));
                die();
            }
        }
    }

    public function update_business() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        $user_id = $jsonobj['user_id'];

        $this->user_auth($user_id);

        if (empty($jsonobj['user_id']) || empty($jsonobj['businessname']) || empty($jsonobj['business_type']) || empty($jsonobj['ownername']) || empty($jsonobj['email']) || empty($jsonobj['phone']) || empty($jsonobj['geolocation']) || empty($jsonobj['addressline1']) || empty($jsonobj['city']) || empty($jsonobj['states']) || empty($jsonobj['zipcode'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        } else {
            $business_image = $this->common->select_data_by_id('business', 'user_id', $jsonobj['user_id'], 'image', array());
            if (isset($jsonobj['image']) && $jsonobj['image'] != null) {

                /*                 * * encoded image ***** */
                $img = str_replace('data:image/png;base64,', '', $jsonobj['image']);
                //  $user_id=$this->session->userdata();
                $img . "<br>";
                //   $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                $path = $this->config->item('upload_path_business');
                $path1 = $this->config->item('upload_path_business_thumb');

                $filename = rand(10, 99) . time() . '.png';
                // $filename_array[] = $filename;
                $file = $path . $filename;
                $file1 = $path1 . $filename;
                $success = file_put_contents($file, $data);
                $success1 = file_put_contents($file1, $data);
                $dataimage = $filename;

                $pic = $this->config->item('upload_path_business') . $business_image[0]['image'];
                $pic_thumb = $this->config->item('upload_path_business_thumb') . $business_image[0]['image'];
                if (file_exists($pic)) {
                    unlink($pic);
                }
                if (file_exists($pic_thumb)) {
                    unlink($pic_thumb);
                }
            } else {
                $dataimage = $business_image[0]['image'];
            }

            $check_business = $this->common->select_data_by_id('business', 'user_id', $jsonobj['user_id'], '*', array());
            $check_business_type = $this->common->select_data_by_id('business_type', 'id', $jsonobj['business_type'], 'id', array());
            if (empty($check_business_type)) {
                echo json_encode(array('status' => '403', 'message' => 'There is no any business type you have entered ! Try Again'));
                die();
            }
            $check_contry = $this->common->select_data_by_id('country', 'name', 'India', '*', array());
            $check_state = $this->common->select_data_by_id('states', 'id', $jsonobj['states'], '*', array());
            if (empty($check_state)) {
                echo json_encode(array('status' => '403', 'message' => 'There is no any state you have entered ! Try Again'));
                die();
            }
            if (!empty($check_business)) {
                $businessinfo = array(
                    'businessname' => $jsonobj['businessname'],
                    'business_type' => $jsonobj['business_type'],
                    'email' => $jsonobj['email'],
                    'ownername' => $jsonobj['ownername'],
                    'phone' => $jsonobj['phone'],
                    'description' => $jsonobj['description'],
                    'image' => $dataimage,
                    'addressline1' => $jsonobj['addressline1'],
                    'city' => $jsonobj['city'],
                    'state' => $check_state[0]['id'],
                    'country' => $check_contry[0]['id'],
                    'zipcode' => $jsonobj['zipcode'],
                    'geolocation' => $jsonobj['geolocation'],
                    "created_datetime" => date('Y-m-d H:i:s'),
                    "created_ip" => $this->input->ip_address(),
                    "modified_datetime" => date('Y-m-d H:i:s'),
                    "modified_ip" => $this->input->ip_address(),
                );
                //print_r($businessinfo);exit;
                if ($this->common->update_data($businessinfo, 'business', 'user_id', $jsonobj['user_id'])) {
                    echo json_encode(array('status' => '200', 'message' => 'Business Account Updated successfullly.'));
                    die();
                } else {
                    echo json_encode(array('status' => '403', 'message' => 'Something went wrong in Updating Business.Please Try again!'));
                    die();
                }
            }
        }
    }

    public function get_business_detail() {
        if ($this->input->method() != 'post') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $json = file_get_contents('php://input');
        $jsonobj = json_decode($json, true);

        $user_id = $jsonobj['user_id'];

        $this->user_auth($user_id);

        if (empty($jsonobj['user_id'])) {
            echo json_encode(array('status' => '402', 'message' => 'Invalid Data Format.'));
            die();
        }
        $business_detail = $this->common->select_data_by_condition('business', array('user_id' => $jsonobj['user_id']), '*', '', '', '', '', array(), '');
        if (!empty($business_detail)) {
            echo json_encode(array('status' => '200', 'message' => 'Record Found !', 'business_detail' => $business_detail));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'No Record Found!'));
            die();
        }
    }

    public function get_states() {
        if ($this->input->method() != 'get') {
            echo json_encode(array('status' => '403', 'message' => 'Request Not allowed.'));
            die();
        }
        $states = $this->common->select_data_by_condition('states', array(), 'id,name,country_id', '', '', '', '', array());

        if (empty($states)) {
            echo json_encode(array('status' => '402', 'message' => 'No Records Found!', 'business_type' => $states));
            die();
        } else {
            echo json_encode(array('status' => '200', 'message' => 'Records Found.', 'business_type' => $states));
            die();
        }
    }

    public function check_email_exist($email) {
        $check_data = $this->common->select_data_by_condition('user', array('email' => $email), 'id', '', '', '', '', array(), '');

        if (empty($check_data)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_pancard_exist($pancard) {
        $check_data = $this->common->select_data_by_condition('user', array('pan_no' => $pancard), 'id', '', '', '', '', array(), '');

        if (empty($check_data)) {
            return true;
        } else {
            return false;
        }
    }

    public function check_mobile_exist($mobile) {
        $check_data = $this->common->select_data_by_condition('user', array('mobile_no' => $mobile), 'id', '', '', '', '', array(), '');

        if (empty($check_data)) {
            return true;
        } else {
            return false;
        }
    }

    function sendEmail($app_name, $app_email, $to_email, $subject, $mail_body) {
//echo $to_email;exit;
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($app_email, $app_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
    }

    public function upload_adhar_photo($adharimg) {

        if (isset($adharimg) && $adharimg != null) {
            /*             * * encoded image ***** */
            $img = str_replace('data:image/png;base64,', '', $adharimg);
            //  $user_id=$this->session->userdata();
            $img . "<br>";
            //   $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $path = $this->config->item('upload_path_adharphoto');
            $path1 = $this->config->item('upload_path_adharphoto_thumb');

            $filename = rand(10, 99) . time() . '.png';


            // $filename_array[] = $filename;
            $file = $path . $filename;
            $file1 = $path1 . $filename;
            $success = file_put_contents($file, $data);
            $success1 = file_put_contents($file1, $data);
            return $filename;

            /* $this->load->library('upload');
              $config['upload_path'] = $this->config->item('upload_path_adharphoto');
              $config['encrypt_name'] = TRUE;
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->upload->initialize($config);
              if ($this->upload->do_upload('adharimage')) {

              $upload_data = $this->upload->data();
              $saveData['adhar_photo'] = $upload_data['file_name'];
              }
              $config_path = $this->config->item('upload_path_profilepic');
              $config['source_image'] = $config_path . $upload_data['file_name'];
              $config['new_image'] = $this->config->item('upload_path_adharphoto_thumb');
              $config['create_thumb'] = TRUE;
              //$config['maintain_ratio'] = TRUE;
              $config['thumb_marker'] = '';
              $config['width'] = $this->config->item('adharphoto_thumb_width');
              $config['height'] = $this->config->item('adharphoto_thumb_width');
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->load->library('image_lib');
              $this->image_lib->initialize($config);
              $this->image_lib->resize();

              return $saveData['adhar_photo']; */
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Something went wrong!'));
            die();
        }
    }

    public function upload_passbook_photo($passbookimg) {

        if (isset($passbookimg) && $passbookimg != null) {
            /*             * * encoded image ***** */
            $img = str_replace('data:image/png;base64,', '', $passbookimg);
            //  $user_id=$this->session->userdata();
            $img . "<br>";
            //   $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $path = $this->config->item('upload_path_passbookphoto');
            $path1 = $this->config->item('upload_path_passbookphoto_thumb');

            $filename = rand(10, 99) . time() . '.png';


            // $filename_array[] = $filename;
            $file = $path . $filename;
            $file1 = $path1 . $filename;
            $success = file_put_contents($file, $data);
            $success1 = file_put_contents($file1, $data);
            return $filename;

            /* $this->load->library('upload');
              $config['upload_path'] = $this->config->item('upload_path_passbookphoto');
              $config['encrypt_name'] = TRUE;
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->upload->initialize($config);
              if ($this->upload->do_upload('passbookimage')) {
              $upload_data = $this->upload->data();
              $saveData['passbook_photo'] = $upload_data['file_name'];
              }
              $config_path = $this->config->item('upload_path_passbookphoto');
              $config['source_image'] = $config_path . $upload_data['file_name'];
              $config['new_image'] = $this->config->item('upload_path_passbookphoto_thumb');
              $config['create_thumb'] = TRUE;
              //$config['maintain_ratio'] = TRUE;
              $config['thumb_marker'] = '';
              $config['width'] = $this->config->item('passbookphoto_thumb_width');
              $config['height'] = $this->config->item('passbookphoto_thumb_width');
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->load->library('image_lib');
              $this->image_lib->initialize($config);
              $this->image_lib->resize();

              return $saveData['passbook_photo']; */
        } else {

            echo json_encode(array('status' => '402', 'message' => 'Something went wrong!'));
            die();
        }
    }

    public function upload_pancard_photo($pancardimg) {
        if (isset($pancardimg) && $pancardimg != null) {
            /*             * * encoded image ***** */
            $img = str_replace('data:image/png;base64,', '', $pancardimg);
            //  $user_id=$this->session->userdata();
            $img . "<br>";
            //   $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);

            $path = $this->config->item('upload_path_pancardphoto');
            $path1 = $this->config->item('upload_path_pancardphoto_thumb');

            $filename = rand(10, 99) . time() . '.png';


            // $filename_array[] = $filename;
            $file = $path . $filename;
            $file1 = $path1 . $filename;
            $success = file_put_contents($file, $data);
            $success1 = file_put_contents($file1, $data);
            return $filename;

            /* $this->load->library('upload');
              $config['upload_path'] = $this->config->item('upload_path_pancardphoto');
              $config['encrypt_name'] = TRUE;
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->upload->initialize($config);
              if ($this->upload->do_upload('pancardimage')) {
              $upload_data = $this->upload->data();
              $saveData['pancard_photo'] = $upload_data['file_name'];
              }
              $config_path = $this->config->item('upload_path_pancardphoto');
              $config['source_image'] = $config_path . $upload_data['file_name'];
              $config['new_image'] = $this->config->item('upload_path_pancardphoto_thumb');
              $config['create_thumb'] = TRUE;
              //$config['maintain_ratio'] = TRUE;
              $config['thumb_marker'] = '';
              $config['width'] = $this->config->item('pancardphoto_thumb_width');
              $config['height'] = $this->config->item('pancardphoto_thumb_width');
              $config['allowed_types'] = 'jpg|jpeg|png';
              $this->load->library('image_lib');
              $this->image_lib->initialize($config);
              $this->image_lib->resize();

              return $saveData['pancard_photo']; */
        } else {
            echo json_encode(array('status' => '402', 'message' => 'Something went wrong!'));
            die();
        }
    }

}
