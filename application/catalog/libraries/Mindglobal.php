<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mindglobal {

    private $username;
    private $password;
    private $response;
    private $error;
    private $api="https://staging.identitymind.com";
    private $curlObj;

    public function __construct($config) {
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    public function createConsumer($man, $bfn, $bln, $bco, $doType, $docCountry, $scanData) {
        $data = [
            'man' => $man,
            'bfn' => $bfn,
            'bln' => $bln,
            'bco' => $bco,
            'docType' => $doType,
            'docCountry' => $docCountry,
            'scanData' => $scanData
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->api/im/account/consumer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_SSL_VERIFYPEER=>0,
            CURLOPT_SSL_VERIFYHOST=>0,
            CURLOPT_USERNAME=> $this->username,
            CURLOPT_PASSWORD=> $this->password,
            CURLOPT_HTTPAUTH=> CURLAUTH_BASIC,
            CURLINFO_HEADER_OUT=>true,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data)
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $this->curlObj= curl_getinfo($curl);
        curl_close($curl);
        if ($err) {
            $this->error = $err;
            return FALSE;
        } else {
            return $this->response = json_decode($response, TRUE);
        }
    }

    public function addDocument($mtid) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->api/im/account/consumer/$mtid/addDocument",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERNAME=> $this->username,
            CURLOPT_PASSWORD=> $this->password,
            CURLOPT_HTTPAUTH=> CURLAUTH_BASIC,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $this->curlObj= curl_getinfo($curl);
        curl_close($curl);

        if ($err) {
            $this->error = $err;
            return FALSE;
        } else {
            return $this->response = json_decode($response, TRUE);
        }
    }

    public function check_status($mtid) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->api/im/account/consumer/$mtid",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERNAME=> $this->username,
            CURLOPT_PASSWORD=> $this->password,
            CURLOPT_HTTPAUTH=> CURLAUTH_BASIC,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $this->curlObj= curl_getinfo($curl);
        curl_close($curl);
        if ($err) {
           $this->error = $err;
           return FALSE;
        } else {
            return $this->response = json_decode($response, TRUE);
        }
    }

    public function get_response() {
        return $this->response;
    }

    public function get_error() {
        return $this->error;
    }
    public function get_info(){
        return $this->curlObj;
    }
    public function get_credential(){
        return $this->username.':'.$this->password;
    }
}
