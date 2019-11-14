<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallet extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Company Transaction : ' . $this->data['app_name'];

        //Load header and save in variable
        $this->data['header'] = $this->load->view('header', $this->data, true);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['footer'] = $this->load->view('footer', $this->data, true);
    }
	// trasaction page 
    public function index() {
        $this->data['user'] = $this->common->get_all_record('user', 'id,email', '', '');
        $this->load->view('wallet/index', $this->data);
    }

   
   
    //load user datatable data
   

    public function getgrdUserData() {

        $join_str[0] = array(
            'table' => 'user as u1',
            'join_table_id' => 'u1.id',
            'from_table_id' => 'wallet_to_wallet.to_userid',
            'type' => '',
        );
	$join_str[1] = array(
            'table' => 'user as u2',
            'join_table_id' => 'u2.id',
            'from_table_id' => 'wallet_to_wallet.from_userid',
            'type' => '',
        );

        $columns = array  ('u2.email','u2.email','wallet_to_wallet.amount','wallet_to_wallet.Total_tax','wallet_to_wallet.created_date');
        $request = $this->input->get();
        $condition = array();
       if (!empty($request['user_id'])) {
           
            $condition['from_userid'] = base64_decode($request['user_id']);
        }
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) >='] = $request['from_date'];
            $condition['DATE('.$this->db->dbprefix.'wallet_to_wallet.created_date) <='] = $request['to_date'];
        }
        $getfiled = "wallet_to_wallet.id,u1.email as to_username,u2.email as from_username,wallet_to_wallet.amount,wallet_to_wallet.Total_tax,wallet_to_wallet.created_date";
        echo $this->common->getDataTableSource('wallet_to_wallet', $columns, $condition, $getfiled, $request, $join_str);
       // print_r($this->db->last_query()); exit();
        die();
    }
function paymentsheet(){
       $json=array();
        $json['status']='fail';
        $json['msg']='';
       // $id=$this->input->post('id');
       // $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array('id' => $id), '*', '', '', '', '', array());
        
        /*if(!empty($payment_sheet)){
             */ $condition=array();
            //$condition['wallet_transaction.created_datetime >'] = $payment_sheet[0]['start_time'];
            //$condition['wallet_transaction.created_datetime <='] = $payment_sheet[0]['end_time'];
            //$condition['type']='credit';
            $condition['wallet_to_wallet.from_userid >']=0;
            $join_str[0] = array(
            'table' => 'user as u1',
            'join_table_id' => 'u1.id',
            'from_table_id' => 'wallet_to_wallet.to_userid',
            'type' => '',
        );
	$join_str[1] = array(
            'table' => 'user as u2',
            'join_table_id' => 'u2.id',
            'from_table_id' => 'wallet_to_wallet.from_userid',
            'type' => '',
        );
            
           
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_to_wallet', $condition, 'wallet_to_wallet.amount,u1.email as receiver,u2.email as sender,wallet_to_wallet.wallet_transaction_id,wallet_to_wallet.Total_tax,wallet_to_wallet.created_date', '', 'desc', '', '', $join_str,'');
           // print_r($wallet_transaction); exit();
            if(!empty($wallet_transaction)){
                
                /*$filename = str_replace(" ","_",$payment_sheet[0]['filename']); 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$filename"); 
                header("Content-Type: application/csv; ");
*/
                
                $filename = str_replace(" ","_",date('Y-m-d H:i:s').'.csv');
                header( "Content-Type: text/csv;charset=utf-8" );
                header( "Content-Disposition: attachment;filename=\"$filename\"" );
                header("Pragma: no-cache");
                header("Expires: 0");
                // file creation 
                $file = fopen('php://output', 'w');
                $header = array("ID","Amount","Sender User","Receiver User ","Total Tax","Date"); 
                fputcsv($file, $header);
                
                for($i=0;$i<count($wallet_transaction);$i++){ 
                 
                    fputcsv($file,array('id'=>($i+1),'amount'=>$wallet_transaction[$i]['amount'],'SenderUser'=>$wallet_transaction[$i]['sender'],'Receiver User '=>$wallet_transaction[$i]['receiver'],'totaltax'=>$wallet_transaction[$i]['Total_tax'],'Date'=>$wallet_transaction[$i]['created_date'])); 
                }
               
                fclose($file); 
                
                exit; 
            }
            else{
                 $json['msg']='Sorry! No information found!';
            }
        /*}
        else{
                $json['msg']='Sorry! No information found!';
        }*/
        //echo $json['msg'];die();
         $this->session->set_flashdata('error', $json['msg']);
         redirect('Payment', 'refresh');
    }
    
    
}


    
