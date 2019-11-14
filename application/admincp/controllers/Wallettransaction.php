<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wallettransaction extends MY_Controller {

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
        $this->load->view('wallettansaction/index', $this->data);
    }

   
   
    //load user datatable data
   

    public function getgrdUserData() {

        $join_str[0] = array(
            'table' => 'user as u',
            'join_table_id' => 'u.id',
            'from_table_id' => 'company_wallet.from_userid',
            'type' => '',
        );
	

        $columns = array  ('u.email','company_wallet.type','company_wallet.amount','company_wallet.comment','company_wallet.created_date');
        $request = $this->input->get();
        $condition = array();
       if (!empty($request['user_id'])) {
           
            $condition['from_userid'] = base64_decode($request['user_id']);
        }
       if (!empty($request['from_date']) && !empty($request['to_date'])) {

            $condition['DATE('.$this->db->dbprefix.'company_wallet.created_date) >='] = $request['from_date'];
            $condition['DATE('.$this->db->dbprefix.'company_wallet.created_date) <='] = $request['to_date'];
        }
        $getfiled = "company_wallet.id,u.email,company_wallet.type,company_wallet.amount,company_wallet.comment,company_wallet.Total_tax,company_wallet.created_date";
        echo $this->common->getDataTableSource('company_wallet', $columns, $condition, $getfiled, $request, $join_str);

        die();
    }

    

   function paymentsheet(){
       $json=array();
        $json['status']='fail';
        $json['msg']='';
        $id=$this->input->post('user_id');
        print_r($id);        exit();
       // $payment_sheet=$this->common->select_data_by_condition('payment_sheet', array('id' => $id), '*', '', '', '', '', array());
        
        /*if(!empty($payment_sheet)){
             */ $condition=array();
            //$condition['wallet_transaction.created_datetime >'] = $payment_sheet[0]['start_time'];
            //$condition['wallet_transaction.created_datetime <='] = $payment_sheet[0]['end_time'];
            //$condition['type']='credit';
            $condition['company_wallet.from_userid >']=0;
            $join_str[0] = array(
                'table' => 'user as u',
                'join_table_id' => 'u.id',
                'from_table_id' => 'company_wallet.from_userid',
                'join_type' => 'left',
            );
            /*$join_str[1] = array(
                'table' => 'bank_detail as b',
                'join_table_id' => 'b.user_id',
                'from_table_id' => 'wallet_transaction.user_id',
                'join_type' => 'left',
            );*/
           
            $wallet_transaction=$this->common->select_data_by_allcondition('company_wallet', $condition, 'company_wallet.amount,u.email,company_wallet.type,company_wallet.Total_tax,company_wallet.comment', '', 'desc', '', '', $join_str,'');
            //print_R($wallet_transaction);exit();
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
                $header = array("ID","Amount","Email","Type","Total Tax","comment"); 
                fputcsv($file, $header);
                
                for($i=0;$i<count($wallet_transaction);$i++){ 
                 
                    fputcsv($file,array('id'=>($i+1),'amount'=>$wallet_transaction[$i]['amount'],'email'=>$wallet_transaction[$i]['email'],'type'=>$wallet_transaction[$i]['type'],'totaltax'=>$wallet_transaction[$i]['Total_tax'],'comment'=>$wallet_transaction[$i]['comment'])); 
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


    
