<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Security extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['app_name'] . ': Dashboard';
        if($this->router->fetch_method()=='index'){
            $this->data['title'] =$this->data['app_name'].': Security';
        }
        //redirect to dashboard if already login
        if (!$this->session->userdata('thegiftsforyou_admin')) {
            redirect('Login', 'refresh');
        }

        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
	$this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
    }
	// security page
    public function index() {
        require_once(BASEPATH . 'Authenticator/rfc6238.php');
        $user_id = $this->session->userdata('thegiftsforyou_admin');
        $this->data['user_detail']=$user_detail = $this->common->select_data_by_condition('admin', array('admin_id' => $user_id), 'firstname,lastname,email,google_code,auth_enable', '', '', '', '', array());
	       
	$secretkey = $user_detail[0]['google_code'];
        $email = $user_detail[0]['email'];
        $this->data['qrCode'] = sprintf('<img src="%s"/>', TokenAuth6238::getBarCodeUrl($email, str_replace(' ', '',$this->data['app_name']), $secretkey, str_replace(' ', '',$this->data['app_name'])));
        $this->load->view('security/index', $this->data);
    }
    // 2fa on/off
    public function update(){
        $json=array();
        $json['status']='fail';
        $json['msg']='';
        $enable_state= $this->input->post('auth_enable');
        $user = $this->common->select_data_by_condition('admin', array('admin_id' => $this->session->userdata('thegiftsforyou_admin')), 'auth_enable', '', '', '', '', array());
       
        if(empty($user)){
             $json['data']=$user[0]['auth_enable'];
            $json['msg']='Please login';
            echo json_encode($json);die();
        }
        
        
        if($user[0]['auth_enable']=='Yes'){
              if(!$this->verify_google_auth($this->input->post('authcode'))){
                  $json['data']=$user[0]['auth_enable'];
                  $json['msg']='Authetication code invalid!';
                  echo json_encode($json);die();
              }
         }
         
        
         
        $t=$this->common->update_data(array('auth_enable'=>$enable_state), 'admin', 'admin_id', $this->session->userdata('thegiftsforyou_admin'));
        
        $user = $this->common->select_data_by_condition('admin', array('admin_id' => $this->session->userdata('thegiftsforyou_admin')), 'auth_enable', '', '', '', '', array());
        if($t){
            $json['status']='success';
            $json['data']=$user[0]['auth_enable'];
            echo json_encode($json);die();
        }
        else{
            $json['status']='fail';
            $json['data']=$user[0]['auth_enable'];
            echo json_encode($json);die();
        }
    }
    // check auth 
    public function checkauth(){
        $json=array();
        $json['msg']='';
        $json['status']='fail';
        $user = $this->common->select_data_by_condition('admin', array('admin_id' => $this->session->userdata('thegiftsforyou_admin')), 'auth_enable', '', '', '', '', array());
        if(empty($user)){
            echo json_encode($json);die();
        }
        $json['status']='success';
        $json['data']=$user[0]['auth_enable'];
        echo json_encode($json);die();
        
    }
    

}
