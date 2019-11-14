<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //web service auth header check
        $header = $this->input->request_headers();

       /* if (isset($header['Authorization'])) {
            if ($header['Authorization'] !== 'delta141forceSEAL8PARA9MARCOSBRAHMOS') {

                echo json_encode(array('status' => '400', 'message' => 'Access Denied.'));

                die();
            }
        } else {
            echo json_encode(array('status' => '400', 'message' => 'Access Denied.'));

            die();
        }*/
    }

    function sendPushNotificationToAPN($deviceId, $message, $alert) {
        //send apple Push notification
// this is the pass phrase you defined when creating the key
        $passphrase = '1';

        $body['aps'] = array(
            'alert' => $alert,
            'sound' => 'default',
            'body' => $message,
        );



// this is where you can customize your notification
        $payload = json_encode($body);

// start to create connection
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $_SERVER['DOCUMENT_ROOT'] . '/projects/goalkeeper/pushcert1.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);


        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        //$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        /* if (!$fp) {
          exit("Failed to connect: $err $errstr" . '<br />');
          } else {
          echo 'Apple service is online. ' . '<br />';
          } */

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceId) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));


        if ($fp) {
            fclose($fp);
            //echo 'The connection has been closed by the client' . '<br />';
        }
    }

    public function sendPushNotificationToGCMSever($token, $message, $notification) {


        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => $token,
            'notification' => $notification,
            'data' => array('message' => $message)
        );

        $headers = array(
            'Authorization:key=AIzaSyBedMgQ4_IlwhdeMRQ0Rll6C7Tr8pd1LhI',
            'Content-Type:application/json'
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    public function user_auth($user_id) {

        $header = $this->input->request_headers();
        // print_r($header);
        // die();
        if (isset($header['UserAuth'])) {

            $user_token = $header['UserAuth'];
        } elseif (isset($header['Userauth'])) {

            $user_token = $header['Userauth'];
        } else {

            echo json_encode(array('status' => '400', 'message' => 'Access Denied.'));
            die();
        }

        $token_data = $this->common->select_data_by_condition('users_token', array('user_id' => $user_id, 'api_token' => $user_token), '*', '', '', '', '', array(), '');
        
        if (empty($token_data)) {
            echo json_encode(array('status' => '400', 'message' => 'Access Denied.'));
            die();
        }
    }

    function last_url() {
        return filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING);
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

    function sendEmail($site_name, $site_email, $to_email, $subject, $mail_body) {

        $this->config->load('email', TRUE);
        $this->cnfemail = $this->config->item('email');

        //Loading E-mail Class
        $this->load->library('email');
        $this->email->initialize($this->cnfemail);

        $this->email->from($site_email, $site_name);

        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message("<table border='0' cellpadding='0' cellspacing='0'><tr><td></td></tr><tr><td>" . $mail_body . "</td></tr></table>");
        $this->email->send();
        return;
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

}
