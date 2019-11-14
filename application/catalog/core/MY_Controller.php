<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();


        if (!$this->session->userdata('user_id')) {
	    $this->session->set_userdata('url',current_url() );
            redirect('Login', 'refresh');
        } else {
            $user = $this->common->select_data_by_condition('user', array('id' => $this->session->userdata('user_id')), '*', '', '', '', '', array());
            $this->data['logged_use'] = $user[0];

        }



	$this->data['bank_detail'] = $this->common->select_data_by_id('bank_detail', 'user_id', $this->session->userdata('user_id'), '*', array());
	$this->data['registration_payment'] = $this->common->select_data_by_id('register_payment', 'user_id', $this->session->userdata('user_id'), '*', array());

	//print_r($this->data['registration_payment']);exit;
	if(($this->uri->segment(1) == 'ServiceFinder') || ($this->uri->segment(1) == 'BusinessAccount')){
		if(!empty($this->data['registration_payment'])){//echo "helo true";exit;
			if(empty($this->data['bank_detail'])){
				redirect('Dashboard', 'refresh');
			}
			//redirect('Dashboard', 'refresh');
		}else if(!empty($this->data['bank_detail'])){
			if(empty($this->data['registration_payment'])){
				redirect('Dashboard', 'refresh');
			}
			//redirect('Dashboard', 'refresh');
		}
	}
	
		//print_r( $this->data['logged_use']['wallet_balance']);exit();
	$this->data['ruid'] = $user[0]['id'].time(1,100); 
	$this->data['name'] = $user[0]['firstname']." ".$user[0]['lastname']; 
	$this->data['email'] = $user[0]['email']; 
	$this->data['firstname'] = $user[0]['firstname'];
	$this->data['lastname'] = $user[0]['lastname']; 
	$this->data['mobile_no'] = $user[0]['mobile_no']; 
$this->data['profilepic'] = $user[0]['profilepic'];
        $this->data['general_setting'] = $this->common->select_data_by_condition('settings', array(), 'setting_value', 'setting_id', 'ASC', '', '', array());

        $this->data['sem_setting'] = $this->common->select_data_by_condition('sem', array(), 'field_value,field_name,status', 'sem_id', 'ASC', '', '', array());
        $this->data['site_name'] = $this->data['general_setting'][0]['setting_value'];
        $this->data['site_email'] = $this->data['general_setting'][1]['setting_value'];
        
         $config['enabled'] = FALSE;
//echo current_url();exit;
	if(current_url() == base_url('ServiceFinder')|| $this->uri->segment(1)=='ServiceFinder'){
	
  		$config['assets_dir'] = 'cache/assetshome';
        	$config['assets_dir_css'] = 'cache/assetshome/css';
        	$config['assets_dir_js'] = 'cache/assetshome/js';  
        	$config['css_dir'] = 'assetshome/css';
        	$config['js_dir'] = 'assetshome/js';
	}else{
		//echo "helo";exit;
 		$config['assets_dir'] = 'cache/userdash';
        	$config['assets_dir_css'] = 'cache/userdash/css';
        	$config['assets_dir_js'] = 'cache/userdash/js';  
        	//$config['css_dir'] = 'userdash/assets/css';
        	//$config['js_dir'] = 'userdash/assets/js';
	}
         
        $this->load->library('minify',$config);
       
    }
   
    function dateDifference($date_1, $date_2, $differenceFormat = '%a') {
        $datetime1 = $date_1;
        $datetime2 = $date_2;
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }
    
    

    function pr($content) {
        echo "<pre>";
        print_r($content);
        echo "</pre>";
    }

    function datetime() {
        return date('Y-m-d H:i:s');
    }

    function last_query() {
        echo "<pre>";
        echo $this->db->last_query();
        echo "</pre>";
    }

    public function verify_google_auth($code) {
            require_once(BASEPATH . 'Authenticator/rfc6238.php');

            $checkAuth = $this->common->select_data_by_condition('user', array('id' => $this->session->userdata('user_id')), '*', '', '', '', '', array());

            if (TokenAuth6238::verify($checkAuth[0]['google_code'], $code)) {
                return true;
            } else {
               return false;
            }
        }
 

    function sendEmail($app_name, $app_email, $from_email, $subject, $mail_body) {
	
        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($from_email, $app_name);

        $this->email->to($app_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        return $this->email->send();
        
    }

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }

    public function displayFullDateFormat($field) {
        $dateformat = "d/m/Y";
        if (!empty($dateformat)) {
            $dateformat = $dateformat;
            $dateformat = str_replace("Y", "%Y", $dateformat);
            $dateformat = str_replace("m", "%m", $dateformat);
            $dateformat = str_replace("d", "%d", $dateformat);
            $dateformat = str_replace("M", "%b", $dateformat);
            $dateformat = str_replace("F", "%M", $dateformat);
            $dateformat = str_replace("l", "%W", $dateformat);
            $dateformat = str_replace("D", "%a", $dateformat);

            $timeformat = 'H:i';
            if (!empty($timeformat)) {

                if ($timeformat == 'h:i:s a') {
                    $timeformat = str_replace("h", "%h", $timeformat);
                    $timeformat = str_replace("i", "%i", $timeformat);
                    $timeformat = str_replace("s", "%s", $timeformat);
                    $timeformat = str_replace("a", "%p", $timeformat);
                }if ($timeformat == 'h:i:s A') {
                    $timeformat = "%r";
                } else {
                    $timeformat = str_replace("H", "%H", $timeformat);
                    $timeformat = str_replace("i", "%i", $timeformat);
                    $timeformat = str_replace("s", "%s", $timeformat);
                }
            }
            $dbformat = $dateformat . ' ' . $timeformat;
            return 'DATE_FORMAT(' . $field . ',"' . $dbformat . '")';
        }
    }

    function last_url() {
        return filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING);
    }
    
    function exp_to_dec($float_str) 
// formats a floating point number string in decimal notation, supports signed floats, also supports non-standard formatting e.g. 0.2e+2 for 20
// e.g. '1.6E+6' to '1600000', '-4.566e-12' to '-0.000000000004566', '+34e+10' to '340000000000'
// Author: Bob
{
    // make sure its a standard php float string (i.e. change 0.2e+2 to 20)
    // php will automatically format floats decimally if they are within a certain range
    $float_str = (string)((float)($float_str));

    // if there is an E in the float string
    if(($pos = strpos(strtolower($float_str), 'e')) !== false)
    {
        // get either side of the E, e.g. 1.6E+6 => exp E+6, num 1.6
        $exp = substr($float_str, $pos+1);
        $num = substr($float_str, 0, $pos);
       
        // strip off num sign, if there is one, and leave it off if its + (not required)
        if((($num_sign = $num[0]) === '+') || ($num_sign === '-')) $num = substr($num, 1);
        else $num_sign = '';
        if($num_sign === '+') $num_sign = '';
       
        // strip off exponential sign ('+' or '-' as in 'E+6') if there is one, otherwise throw error, e.g. E+6 => '+'
        if((($exp_sign = $exp[0]) === '+') || ($exp_sign === '-')) $exp = substr($exp, 1);
        else trigger_error("Could not convert exponential notation to decimal notation: invalid float string '$float_str'", E_USER_ERROR);
       
        // get the number of decimal places to the right of the decimal point (or 0 if there is no dec point), e.g., 1.6 => 1
        $right_dec_places = (($dec_pos = strpos($num, '.')) === false) ? 0 : strlen(substr($num, $dec_pos+1));
        // get the number of decimal places to the left of the decimal point (or the length of the entire num if there is no dec point), e.g. 1.6 => 1
        $left_dec_places = ($dec_pos === false) ? strlen($num) : strlen(substr($num, 0, $dec_pos));
       
        // work out number of zeros from exp, exp sign and dec places, e.g. exp 6, exp sign +, dec places 1 => num zeros 5
        if($exp_sign === '+') $num_zeros = $exp - $right_dec_places;
        else $num_zeros = $exp - $left_dec_places;
       
        // build a string with $num_zeros zeros, e.g. '0' 5 times => '00000'
        $zeros = str_pad('', $num_zeros, '0');
       
        // strip decimal from num, e.g. 1.6 => 16
        if($dec_pos !== false) $num = str_replace('.', '', $num);
       
        // if positive exponent, return like 1600000
        if($exp_sign === '+') return $num_sign.$num.$zeros;
        // if negative exponent, return like 0.0000016
        else return $num_sign.'0.'.$zeros.$num;
    }
    // otherwise, assume already in decimal notation and return
    else return $float_str;
}

}
