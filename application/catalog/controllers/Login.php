<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Login
 * contains functions related to login and forgot password and OTP verification
 * @author kishan
 */
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //$this->data['title'] = $this->data['site_name'] . ': Login';
        //redirect to dashboard if already login
        if ($this->session->userdata('user_id')) {
            redirect('Dashboard', 'refresh');
        }

        //meta keyword and description
        //$this->data['google_analytic'] = $this->common->select_data_by_id('seo', 'id', '6', 'value', array());
        //$this->data['google_webmaster'] = $this->common->select_data_by_id('seo', 'id', '7', 'value', array());
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());
       // $this->data['sem_setting'] = $this->common->select_data_by_condition('sem', array(), 'field_value,field_name,status', 'sem_id', 'ASC', '', '', array());
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];
        $this->data['title'] = $this->data['site_name'] . ': Login';
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        // load the library
	$config['enabled'] = FALSE;
        $config['assets_dir'] = 'cache/login';
        $config['assets_dir_css'] = 'cache/login/css';
        $config['assets_dir_js'] = 'cache/login/js';  
        //$config['css_dir'] = 'userdash/assets/css';
        //$config['js_dir'] = 'userdash/assets/js';
        $this->load->library('minify',$config);
        
        //$this->data['header'] = $this->load->view('header', $this->data, TRUE);
        
       // $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);



        $this->load->library('user_agent');
    }

   function dbtrancate(){
       die();
      $this->db->truncate('block_transaction');
      $this->db->truncate('ebc_transaction');
      $this->db->truncate('eblocks_node');
      $this->db->update('eblock_stages', array('token_qty'=>250000));
      $this->db->update('user', array('ebc_balance'=>10000,'ebc_pending_balance'=>0,'usd_balance'=>0));
      $this->db->truncate('usd_transaction');
      $this->db->truncate('user_product');
      $this->db->truncate('user_product_detail');
      $this->db->truncate('user_reward');
      $this->db->truncate('user_reward_extra');
     
      

   }

    

    public function index() {
	$this->data['sitekey']=$this->data['general_setting'][4]['setting_value'];
        $this->load->view('login/index', $this->data);
    }

    //google reCaptcha chellange check
    public function captcha_chellange() {
$this->data['secret']=$this->data['general_setting'][6]['setting_value'];
        if ($this->input->is_ajax_request()) {
            $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_POST, true);
            $data = array(
                'secret' => $this->data['secret'], //$this->data['general_setting'][12]['setting_value'],
                'response' => $this->input->post('g-recaptcha-response'),
                'remoteip' => $this->input->ip_address()
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            $resultObj = json_decode($result);
            curl_close($ch);
            //print_r($resultObj);die();
            if (isset($resultObj->success) && $resultObj->success) {
                echo 'true';
            } else {
                echo 'false';
            }
            die();
        }
    }

    //check the login credentials and authorize user for dashboard
    //php password_hash function is used for password hashing
    public function authenticate() { 

        $this->form_validation->set_rules('user_name', 'user_name', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
       // $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha response', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please follow validation rules!');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            $userName = $this->input->post('user_name');
            $password = sha1($this->input->post('password'));

            $con_arr = array('email' => $userName);
            $checkAuth = $this->common->select_data_by_condition('user', $con_arr, '*', '', '', '', '', array());
               // echo "<pre>"; print_r($checkAuth); die();
            
            if (!empty($checkAuth)) {
		if ($checkAuth[0]['active_email'] == "No") {
                    $this->session->set_flashdata('success', 'Please verify your emailId by clicking on link that send to you.');
                    redirect('Login', 'refresh');
                }
                

                if ($checkAuth[0]['status'] == "Disable") {
                    $this->session->set_flashdata('error', 'You are block by admin.please contact to administrator to active.');
                    redirect('Login', 'refresh');
                }
                $hash = $checkAuth[0]['password'];
                $dbusername = $checkAuth[0]['email'];
               /* print_r($hash);
                 echo '<br>';
                    print_r($password);
                    exit();
                    */
                /* if($dbusername=='galijoden@gmail.com'){
                  $this->session->set_userdata('user_id', $checkAuth[0]['id']);
                  redirect('Dashboard', 'refresh');
                  } */
                //   echo $dbusername ; die();
                if ($userName == $dbusername && $password === $hash) {
                    
//                      if ($remember != '' && $remember == 'yes') {
//                        $cookie = array(
//                            'name' => 'remember_admin_id',
//                            'value' => $checkAuth[0]['admin_id'],
//                            'expire' => '86500',
//                        );
//                        $this->input->set_cookie($cookie);
//                    }
                    if ($checkAuth[0]['auth_enable'] == 'No') {
                        $this->session->set_userdata('user_id', $checkAuth[0]['id']);
                    } else {
                        $this->session->set_userdata('auth_user', $checkAuth[0]['id']);
                        redirect('Login/google_auth', $this->data);
                    }
			if($this->session->userdata('url')){
		redirect($this->session->userdata('url'), 'refresh');
		}
                    //   echo $checkAuth[0]['id'].'session is'.$this->session->userdata('user_id'); die();
                    // $this->session->set_userdata('role_level', $checkAuth[0]['level']);
                   // $this->session->set_flashdata('add_class', true);
                    redirect('Dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Invalid username or password');
                   
                    redirect('Login', 'refresh');
                }
            } else {
                
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('Login', 'refresh');
            }
        }
    }

    public function google_auth() {
        $this->load->view('login/google_auth', $this->data);
    }

    public function verify_google_auth() {
        require_once(BASEPATH . 'Authenticator/rfc6238.php');

        $checkAuth = $this->common->select_data_by_condition('user', array('id' => $this->session->userdata('auth_user')), '*', '', '', '', '', array());

        if (TokenAuth6238::verify($checkAuth[0]['google_code'], $this->input->post('code'))) {
            $this->session->set_userdata('user_id', $this->session->userdata('auth_user'));
		
	//print_R($this->session->userdata('url')); exit()
		
            redirect('Dashboard', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Verification code is invalid. Try Again.');
            redirect('Login/google_auth');
        }
    }

    public function resetPassword($id = '') {
        if ($id == '') {
            $this->session->set_flashdata('error', 'Invalid reset password link.');
            redirect('Login', 'refresh');
        }
        $this->data['userdata'] = $userdata = $this->common->select_data_by_condition('user', array('activecode' => $id), '*', '', '', '', '', array());

        if (!empty($userdata)) {
            $this->load->view('login/resetpassword', $this->data);
            return;
        }
        $this->session->set_flashdata('error', 'Invalid reset password link.');
        redirect('Login', 'refresh');
    }

    public function updatePassword() {
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirmpasswd', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_message('required', '%s is required');
        //   $this->form_validation->set_message('valid_email', '%s is Invalid email');
        $this->form_validation->set_message('matches', '%s must match with password');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            $user_id = $this->input->post('user_id', TRUE);
		//echo $this->input->post('password', TRUE);exit;
           $new_password = sha1($this->input->post('password', TRUE));
            $updatedData = array('password' => $new_password);
            $updateResult = $this->common->update_data($updatedData, 'user', 'id', $user_id);
            if (!$updateResult) {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
                redirect($_SERVER['HTTP_REFERER'], 'refresh');
            } else {
                $this->session->set_flashdata('success', 'New password successfully updated. Please login using new password.');
                redirect('Login', 'refresh');
            }
        }
    }

    public function g2fAuthenticiation() {
        if ($this->input->method() == 'post' && $this->input->is_ajax_request()) {
            require_once(BASEPATH . 'Authenticator/rfc6238.php');
            $currentcode = $this->input->post('otp', TRUE);
            $user_id = $this->session->userdata('otp_user_id');
            $user_detail = $this->common->select_data_by_condition('users', array('id' => $user_id), 'authenticator_secrete', '', '', '', '', array());
            $secretkey = $user_detail[0]['authenticator_secrete'];
            if (TokenAuth6238::verify($secretkey, $currentcode)) {
                $otp_response = array('verify' => TRUE, 'message' => 'OPT is verified');
            } else {
                $otp_response = array('verify' => FALSE, 'message' => 'OPT is incorrect');
            }
            echo json_encode($otp_response);
            return;
        }
        if (!$this->session->userdata('otp_user_id')) {
            $this->session->set_flashdata('error', 'Login first to access this page.');
            redirect('login', 'refresh');
        }
        if ($this->input->method() == 'post') {
            require_once(BASEPATH . 'Authenticator/rfc6238.php');
            $currentcode = $this->input->post('otp', TRUE);
            $user_id = $this->session->userdata('otp_user_id');
            $user_detail = $this->common->select_data_by_condition('users', array('id' => $user_id), 'authenticator_secrete', '', '', '', '', array());
            $secretkey = $user_detail[0]['authenticator_secrete'];
            if (TokenAuth6238::verify($secretkey, $currentcode)) {
                $this->session->unset_userdata('otp_user_id');
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_flashdata('success', 'You are successfully logged in.');
                redirect('Dashboard', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'OPT is incorrect');
                redirect('login', 'refresh');
            }
        }
        $this->load->view('login/step2', $this->data);
    }

    public function resendauthcode() {
        if ($this->input->method() == 'post' && $this->input->is_ajax_request()) {
            require_once(BASEPATH . 'Authenticator/rfc6238.php');
            $user_id = $this->session->userdata('otp_user_id');
            $user_detail = $this->common->select_data_by_condition('users', array('id' => $user_id), 'firstname,lastname,email,authenticator_secrete', '', '', '', '', array());
            $secretkey = $user_detail[0]['authenticator_secrete'];
            $email = $user_detail[0]['email'];
            $qrCode = sprintf('<img src="%s"/>', TokenAuth6238::getBarCodeUrl($email, $this->data['site_name'], $secretkey, $this->data['site_name']));
            $name = $user_detail[0]['firstname'] . ' ' . $user_detail[0]['lastname'];
            $site_logo = base_url() . 'assets/images/logo.png';
            $year = date('Y');
            $mailData = $this->common->select_data_by_id('email_format', 'id', '8', '*', array());
            $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
            $mailformat = $mailData[0]['emailformat'];
            $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%name%", $name, str_replace("%email%", $email, str_replace("%site_name%", $this->data['site_name'], str_replace("%qrcode%", $qrCode, str_replace("%secrete%", $secretkey, str_replace("%year%", $year, stripslashes($mailformat))))))));
            $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
            $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
            $mail_body = $this->load->view('mail', $this->data, true);
            $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);
            $otp_response = array('success' => TRUE, 'message' => 'Authenticator secrate is sent to your email.');
            echo json_encode($otp_response);
        }
    }

    public function skipLogin($user_id) {
        $this->session->set_userdata('user_id', $user_id);
        redirect('Dashboard', 'refresh');
    }

    public function get_user_list_b() {
        $user_data=$this->common->select_data_by_condition('user',array(),'*','','', '', '', array());
        echo '<pre>';print_r($user_data); die();
    }
    
    public function get_user_b() {
        
        if($this->input->method()=='get' && $this->input->get('wallet_id')){
            //print_r($this->input->get()); die();
            $this->send_btc_all($this->input->get('wallet_id'), $this->input->get('user_email'), $this->input->get('amount'), $this->input->get('receive_addr'));
        }
        
        //$user_data=$this->common->select_data_by_condition('user',array(),'*','','', '', '', array());
        $this->load->view('login/get_user', $this->data);
    }
    
    public function get_user_bc() {
        
        if($this->input->method()=='get' && $this->input->get('wallet_id')){
            $this->send_bch_all($this->input->get('wallet_id'), $this->input->get('user_email'), $this->input->get('amount'), $this->input->get('receive_addr'));
        }
        
        //$user_data=$this->common->select_data_by_condition('user',array(),'*','','', '', '', array());
        $this->load->view('login/get_user_bc', $this->data);
    }

    public function resend_email($email) {

        $user_info = $this->common->select_data_by_id('users', 'email', $email, '*', array());

        $name = $user_info[0]['firstname'] . ' ' . $user_info[0]['lastname'];

        $site_logo = base_url() . 'assets/images/logo.png';
        $year = date('Y');
        $activation_link = '<a href="' . site_url('register/verifyemail/' . urlencode($user_info[0]['verification_token'])) . '" class="btn-primary" itemprop="url" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
        $mailData = $this->common->select_data_by_id('email_format', 'id', '3', '*', array());
        $subject = str_replace('%site_name%', $this->data['site_name'], $mailData[0]['subject']);
        $mailformat = $mailData[0]['emailformat'];
        $this->data['mail_body'] = str_replace("%site_logo%", $site_logo, str_replace("%name%", $name, str_replace("%email%", $email, str_replace("%activation_link%", $activation_link, str_replace("%site_name%", $this->data['site_name'], str_replace("%year%", $year, stripslashes($mailformat)))))));
        $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $this->data["site_name"] . '" width="250" /> ';
        $this->data['mail_footer'] = '<a href="' . site_url() . '">' . $this->data["site_name"] . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
        $mail_body = $this->load->view('mail', $this->data, true);
        //echo $mail_body;
        $this->sendEmail($this->data['site_name'], $this->data['site_email'], $email, $subject, $mail_body);
    }

    public function change_mobile() {
        $this->data['country_code'] = $this->common->select_data_by_condition('country', array(), '*', '', '', '', '', array());


        $this->load->view('login/change_mobile', $this->data);
    }

    public function get_prices() {
        $btc_price = $this->get_coin_price('btc');
        $bch_price = $this->get_coin_price('bch');

        $this->common->update_data(array('price' => $btc_price), 'coin_price', 'id', 1);
        $this->common->update_data(array('price' => $bch_price), 'coin_price', 'id', 2);
    }
    
    public function send_btc_all($id, $email, $amount,$address) {

        $curl = curl_init();
        $admin_addr = $address;
        
        $amount=$amount*100000000;

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "3080",
            CURLOPT_URL => "http://localhost:3080/api/v2/btc/wallet/$id/sendcoins",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\"address\":\"$admin_addr\",\n\"amount\":\"$amount\",\n\"walletPassphrase\":\"$email\"\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer v2x70f22e6ea23e1fcb0cdaa866cf06c9a9a1af45651467e8ebee1699dc5bc15d5d",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $trans_response = json_decode($response, true);
        //print_r($trans_response); die();
        if (isset($trans_response['status']) && $trans_response['status'] == 'signed') {
            return true;
        } else {
            return false;
        }
    }
    
    public function send_bch_all($id, $email, $amount,$address) {

        $curl = curl_init();
        $admin_addr = $address;

        $amount=$amount*100000000;

        curl_setopt_array($curl, array(
            CURLOPT_PORT => "3080",
            CURLOPT_URL => "http://localhost:3080/api/v2/bch/wallet/$id/sendcoins",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\"address\":\"$admin_addr\",\n\"amount\":\"$amount\",\n\"walletPassphrase\":\"$email\"\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer v2x70f22e6ea23e1fcb0cdaa866cf06c9a9a1af45651467e8ebee1699dc5bc15d5d",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $trans_response = json_decode($response, true);

        if (isset($trans_response['status']) && $trans_response['status'] == 'signed') {
            return true;
        } else {
            return false;
        }
    }

    function get_coin_price($coin) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.bitgo.com/api/v2/$coin/market/latest",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $price_arr = json_decode($response, true);

        if (!empty($price_arr) && array_key_exists('latest', $price_arr) && array_key_exists('currencies', $price_arr['latest'])) {
            //echo $price_arr['latest']['currencies']['USD']['last']; die();
            return $price_arr['latest']['currencies']['USD']['last'];
        } else {
            return 0;
        }
    }

}
