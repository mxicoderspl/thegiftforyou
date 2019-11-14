<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * News.php file contains functions for show admin dashboard, logout, admin account, change password etc.
 * 
 *  
 */

class Payment extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->data['title'] = 'Payment : ' . $this->data['app_name'];
        //Load header and save in variable
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, true);
        $this->data['header'] = $this->load->view('header', $this->data, true);

        $this->data['footer'] = $this->load->view('footer', $this->data, true);
        $this->data['redirect_url'] = $this->last_url();
    }
		//enable user
    public function index() {
        
        $this->load->view('payment/index', $this->data);
    }
    function transaction(){
     
        $columns = array ('id','filename','start_time','end_time','created_date','status');
        $request = $this->input->get();
        $condition = array();
      
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE(created_date) >='] = $request['from_date'];
            $condition['DATE(created_date) <='] = $request['to_date'];
        }
        $getfiled = "id,filename,start_time,end_time,created_date,status";
        echo $this->common->getDataTableSource('payment_sheet', $columns, $condition, $getfiled, $request, array());

        die();
    }
    
    function paymentsheet(){
        $json=array();
        $json['status']='fail';
        $json['msg']='';
        
        $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array(), '*', 'id', 'desc', '1', '', array());
        if(!empty($payment_sheet)){
            
            
            $condition=array();
            $condition['wallet_transaction.created_datetime >'] = $payment_sheet[0]['end_time'];
            $condition['wallet_transaction.created_datetime <='] = date('Y-m-d H:i:s');
            $condition['type']='credit';
            $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            $join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_transaction', $condition, 'sum('.$this->db->dbprefix.'wallet_transaction.amount) as totalamount,u.email,b.bank_name,b.ifsc_code,b.account_name,b.account_no', 'wallet_transaction.id', 'desc', '', '', $join_str,'wallet_transaction.user_id');
            
            if(!empty($wallet_transaction)){
                $payment_sheet=array(
                    'filename'=>date('Y-m-d H:i:s').'.csv',
                    'start_time'=>$payment_sheet[0]['end_time'],
                    'end_time'=> date('Y-m-d H:i:s'),
                    'status'=>'Pending',
                    'created_date'=>date('Y-m-d H:i:s'),
                    'created_ip'=>$this->input->ip_address(),
                );
                            
               $this->common->insert_data_getid($payment_sheet, 'payment_sheet');
               $json['status']='success';
               $json['msg']='New payment sheet has been created';
                            
            }
            else{
                $json['msg']='Sorry! No information found!';
            }
            
        }
        else{
            $condition=array();
           // $condition['DATE('.$this->db->dbprefix.'wallet_transaction.created_datetime) >'] = $payment_sheet[0]['end_time'];
            $condition['wallet_transaction.created_datetime <='] = date('Y-m-d H:i:s');
            $condition['type']='credit';
            $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            $join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_transaction', $condition, 'sum('.$this->db->dbprefix.'wallet_transaction.amount) as totalamount,u.email,b.bank_name,b.ifsc_code,b.account_name,b.account_no', 'wallet_transaction.id', 'desc', '', '', $join_str,'wallet_transaction.user_id');
            
            if(!empty($wallet_transaction)){
                 $payment_sheet=array(
                    'filename'=>date('Y-m-d H:i:s').'.csv',
                    'start_time'=>'0000-00-00 00:00:00',
                    'end_time'=> date('Y-m-d H:i:s'),
                    'status'=>'Pending',
                    'created_date'=>date('Y-m-d H:i:s'),
                    'created_ip'=>$this->input->ip_address(),
                );
                            
               $this->common->insert_data_getid($payment_sheet, 'payment_sheet');
               $json['status']='success';
               $json['msg']='New payment sheet has been created';
            }
            else{
                $json['msg']='Sorry! No information found!';
            }
        }
        
        
        echo json_encode($json);die();
    }
    
    function exportsheet1(){
        $json=array();
        $json['status']='fail';
        $json['msg']='';
        $id=$this->input->post('id');
        $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array('id' => $id), '*', '', '', '', '', array());
        
        if(!empty($payment_sheet)){
             $condition=array();
            $condition['DATE('.$this->db->dbprefix.'wallet_transaction.created_datetime) >'] = $payment_sheet[0]['start_time'];
            $condition['DATE('.$this->db->dbprefix.'wallet_transaction.created_datetime) <='] = $payment_sheet[0]['end_time'];
            $condition['type']='credit';
            $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            $join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_transaction', $condition, 'sum('.$this->db->dbprefix.'wallet_transaction.amount) as totalamount,u.email,b.bank_name,b.ifsc_code,b.account_name,b.account_no', 'wallet_transaction.id', 'desc', '', '', $join_str,'wallet_transaction.user_id');
            
            if(!empty($wallet_transaction)){
                $filename = $payment_sheet[0]['filename']; 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$filename"); 
                header("Content-Type: application/csv; ");

                // file creation 
                $file = fopen('php://output', 'w');
                $header = array('ID','Amount','Email','BankName','BankIFSC','AccountName','AccountNo'); 
                fputcsv($file, $header);
                
                for($i=1;$i<=count($wallet_transaction);$i++){
                    fputcsv($file,array($i,$wallet_transaction[$i]['totalamount'],$wallet_transaction[$i]['email'],$wallet_transaction[$i]['bank_name'],$wallet_transaction[$i]['ifsc_code'],$wallet_transaction[$i]['account_name'],$wallet_transaction[$i]['account_no'])); 
                }
               
                fclose($file); 
                echo $file;
                exit; 
            }
            else{
                 $json['msg']='Sorry! No information found!';
            }
        }
        else{
                $json['msg']='Sorry! No information found!';
        }
        echo json_encode($json);die();
    }
    
    function exportsheet($id){
        $json=array();
        $json['status']='fail';
        $json['msg']='';
       // $id=$this->input->post('id');
        $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array('id' => $id), '*', '', '', '', '', array());
        
        if(!empty($payment_sheet)){
             $condition=array();
            $condition['wallet_transaction.created_datetime >'] = $payment_sheet[0]['start_time'];
            $condition['wallet_transaction.created_datetime <='] = $payment_sheet[0]['end_time'];
            $condition['type']='credit';
            $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            $join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_transaction', $condition, 'sum('.$this->db->dbprefix.'wallet_transaction.amount) as totalamount,u.email,b.bank_name,b.ifsc_code,b.account_name,b.account_no', 'wallet_transaction.id', 'desc', '', '', $join_str,'wallet_transaction.user_id');
            
            if(!empty($wallet_transaction)){
                
                /*$filename = str_replace(" ","_",$payment_sheet[0]['filename']); 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$filename"); 
                header("Content-Type: application/csv; ");
*/
                
                $filename = str_replace(" ","_",$payment_sheet[0]['filename']);
                header( "Content-Type: text/csv;charset=utf-8" );
                header( "Content-Disposition: attachment;filename=\"$filename\"" );
                header("Pragma: no-cache");
                header("Expires: 0");
                // file creation 
                $file = fopen('php://output', 'w');
                $header = array("ID","Amount","Email","BankName","BankIFSC","AccountName","AccountNo"); 
                fputcsv($file, $header);
                
                for($i=0;$i<count($wallet_transaction);$i++){ 
                 
                    fputcsv($file,array('id'=>($i+1),'amount'=>$wallet_transaction[$i]['totalamount'],'email'=>$wallet_transaction[$i]['email'],'bank_name'=>$wallet_transaction[$i]['bank_name'],'ifsc_code'=>$wallet_transaction[$i]['ifsc_code'],'account_name'=>$wallet_transaction[$i]['account_name'],'account_no'=>$wallet_transaction[$i]['account_no'])); 
                }
               
                fclose($file); 
                
                exit; 
            }
            else{
                 $json['msg']='Sorry! No information found!';
            }
        }
        else{
                $json['msg']='Sorry! No information found!';
        }
        //echo $json['msg'];die();
         $this->session->set_flashdata('error', $json['msg']);
         redirect('Payment', 'refresh');
    }
    
    function confirm_sheet(){
        $json=array();
        $json['status']='fail';
        $json['msg']='';
        $id=$this->input->post('id');
        $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array('id' => $id), '*', '', '', '', '', array());
        
        if(!empty($payment_sheet)){
             $condition=array();
            $condition['wallet_transaction.created_datetime >'] = $payment_sheet[0]['start_time'];
            $condition['wallet_transaction.created_datetime <='] = $payment_sheet[0]['end_time'];
            $condition['type']='credit';
            $condition['wallet_transaction.user_id >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            $join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );
            
            $wallet_transaction=$this->common->select_data_by_allcondition('wallet_transaction', $condition, 'sum('.$this->db->dbprefix.'wallet_transaction.amount) as totalamount,u.email,b.bank_name,b.ifsc_code,b.account_name,b.account_no,wallet_transaction.user_id', 'wallet_transaction.id', 'desc', '', '', $join_str,'wallet_transaction.user_id');
            
            if(!empty($wallet_transaction)){
               $flag=0;
                for($i=0;$i<count($wallet_transaction);$i++){
                
                    $debit_info=array(
                    'user_id'=>$wallet_transaction[$i]['user_id'],
                    'type'=>'debit',
                    'amount'=>$wallet_transaction[$i]['totalamount'],
                    'comment'=>'Deposited to bank account',
                    'created_datetime'=>date('Y-m-d H:i:s'),
                    'created_ip'=>$this->input->ip_address(),
                    );

                    $wallet_transaction_id=$this->common->insert_data_getid($debit_info, 'wallet_transaction');
                  
                    //user notify by email
                    
                     $this->debitUserPaymentEmail($wallet_transaction[$i]['user_id'],$wallet_transaction[$i]['totalamount']);
                    $flag=1;
                    if($wallet_transaction_id>0){
                        $user_info=$this->common->select_data_by_condition('user', array('id' => $wallet_transaction[$i]['user_id']), '*', '', '', '', '', array());
                        if(!empty($user_info)){
                            $this->common->update_data(array('wallet_balance'=>($user_info[0]['wallet_balance'] - $wallet_transaction[$i]['totalamount'])), 'user', 'id',$user_info[0]['id']);
                        }
                    }
                    
                }
                
                if($flag==1){
                    $this->common->update_data(array('status'=>'Confirmed'), 'payment_sheet', 'id',$id);
                    $json['status']='success'; 
                    $json['msg']='Sorry! No information found!';
                }
                else{
                    $json['msg']='Sorry! No information found!';
                }
                
            }
            else{
                 $json['msg']='Sorry! No information found!';
            }
        }
        else{
                $json['msg']='Sorry! No information found!';
        }
         echo json_encode($json);die();
    }


	function debitUserPaymentEmail($main_userid,$price){
		
		$mainuserdata = $this->common->select_data_by_condition('user', array('id' => $main_userid), '*', '', '', '', '', array());	

		$mailData = $this->common->selectRecordById('email_format', '27', 'id');
		    $amount=$price;
		  // $formemail=$mainuserdata[0]['email'];
			
		    $subject = $mailData['subject'];
		    $mailformat = $mailData['emailformat'];
		    $app_name = $this->common->selectRecordById('settings', '2', 'setting_id');
		    $site_name = $this->common->selectRecordById('settings', '1', 'setting_id');
			
		    $app_email = $app_name['setting_value'];
		    $site_name=$site_name['setting_value'];
			
		    $email=$mainuserdata[0]['email'];
		   $this->data['mail_body'] = str_replace("%email%", $email,str_replace("%totalamount%", $amount, str_replace("%site_name%", $site_name,  stripslashes($mailformat))));
            	    // print_r($mail_body);die();
		    $forgotEmail=$mainuserdata[0]['email'];
		    $year= date('Y');
		    $site_logo =  base_url('../images/logo.png'); 
		   $this->data['mail_header'] = '<img id="headerImage campaign-icon" src="' . $site_logo . '" title="' . $site_name. '" width="250" /> ';	
		    //$this->data['mail_header'] = '<a href="" class="logo logo-admin"><span>The</span>giftsforyou</a> ';
                    $this->data['mail_footer'] = '<a href="">' . $site_name . '</a> | Copyright &copy;' . $year . ' | All rights reserved</p>';
		     $mail_body = $this->load->view('mail', $this->data, true);
		    $this->sendEmail($this->data['app_name'], $app_email, $forgotEmail, $subject, $mail_body);
	}

}
