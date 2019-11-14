<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->data['title'] = $this->data['site_name'];
        if($this->router->fetch_method()=='index'){
            $this->data['title'] =$this->data['site_name'].': Transactions';
        }
        //redirect to dashboard if already login
        if (!$this->session->userdata('user_id')) {
            redirect('Login', 'refresh');
        }

        //meta keyword and description
        $this->data['meta_keyword'] = $this->common->select_data_by_id('seo', 'id', '4', 'value', array());
        $this->data['meta_description'] = $this->common->select_data_by_id('seo', 'id', '5', 'value', array());

        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
    }

    public function index() {

        $join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.eblock_id',
                'from_table_id' => 'eblocks.id',
                'join_type' => 'left'
            );
        $this->data['eblocks']=$this->common->select_data_by_multiple_condition('eblocks', array('eblocks.block_type_id'=>1), 'eblocks.*', '', 'eblocks.id',  '', '', $join_str, 'eblocks.id', array(),array());
        
        
        
        
        /*$join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.eblock_id',
                'from_table_id' => 'e.id',
                'join_type' => 'left'
        );*/
        $join_str[0] = array('table' => 'eblocks as e',
                'join_table_id' => 'e.block_type_id',
                'from_table_id' => 'block_type.id',
                'join_type' => 'left'
        );
        $this->data['block_type']=$this->common->select_data_by_multiple_condition('block_type', array(), 'block_type.*', '', 'block_type.id',  '', '', $join_str, 'block_type.id', array(),array());
        
        
        //$this->data['ebloks']=$this->common->get_all_record('eblocks','*');
        $this->load->view('transaction/index', $this->data);
    }
    
        public function getTransaction(){
            
            $columns = array('block_transaction.id','eb.title', 'block_transaction.eblock_price', 'block_transaction.eblock_quantity','block_transaction.coin_price','block_transaction.payment_currency','block_transaction.payment_amount','block_transaction.amount_withdrawn','block_transaction.created_date');
            $request = $this->input->get();
            $condition = array();
            $condition['user_id'] = $this->data['logged_use']['id'];
            //$condition['status='] = 'Enable';
            if($request['eblock']!=0){
            $condition['block_transaction.eblock_id'] = $request['eblock'];
            }
            $condition['eb.block_type_id'] = $request['block_type_id'];
            if (!empty($request['from_date']) && !empty($request['to_date'])) {
                //   $request['search']['value']='';

                $condition['DATE('.$this->db->dbprefix.'block_transaction.created_date) >='] = $request['from_date'];
                $condition['DATE('.$this->db->dbprefix.'block_transaction.created_date) <='] = $request['to_date'];
            }
            
            $join_str[0] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'block_transaction.eblock_id',
                'join_type' => 'left'
            );
            $join_str[1] = array('table' => 'block_type',
                'join_table_id' => 'block_type.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
            
            

            $getfiled = "block_transaction.id,eb.title,block_type.title as title1,block_transaction.eblock_price,block_transaction.eblock_quantity,block_transaction.coin_price,block_transaction.payment_currency,block_transaction.payment_amount,block_transaction.amount_withdrawn,block_transaction.created_date";
            echo $this->common->getDataTableSource('block_transaction', $columns, $condition, $getfiled, $request,$join_str,array(),'t.created_date','DESC');
            die();
        }
        
        
        public function getRTransaction(){
            $columns = array('eblocks_node.id','eblocks_node.block_transaction_id','eblocks_node.bonus_eblocks_node_id','eblocks_node.created_date','eb.title','bt.eblock_price','bt.coin_price','bt.payment_currency');
            $request = $this->input->get();
            $condition = array();
            $condition['eblocks_node.user_id'] = $this->data['logged_use']['id'];
            //$condition['eblocks_node.eblock_id'] = 'bt.eblock_id' ;
            //$condition['bt.user_id'] = $this->data['logged_use']['id'];
            if($request['block_type_id']!=0){ 
            $condition['eb.block_type_id'] = $request['block_type_id'];
            }
         /*   $condition=array(
            'eblocks_node.user_id'=>$this->data['logged_use']['id']
                    );*/
            //$condition['status='] = 'Enable';
            // if (!empty($request['from_date']) && !empty($request['to_date'])) {
                //   $request['search']['value']='';


              //  $condition['DATE(u.created_datetime) >='] = $request['from_date'];
            //    $condition['DATE(u.created_datetime) <='] = $request['to_date'];
           // }
if(!empty($request['eblock_filter'])){
            $condition['eblocks_node.eblock_id']=$request['eblock_filter'];
            }
            else{
               
            }
            $join_str[0] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'eblocks_node.eblock_id',
                'join_type' => 'left'
            );
            $join_str[1] = array('table' => 'block_transaction as bt',
                'join_table_id' => 'bt.id',
                'from_table_id' => 'eblocks_node.block_transaction_id',
                'join_type' => 'left'
            );
            
            $join_str[2] = array('table' => 'block_type',
                'join_table_id' => 'block_type.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
            

            $getfiled = "eblocks_node.id,eblocks_node.block_transaction_id,eblocks_node.bonus_eblocks_node_id,eblocks_node.created_date,eb.title,block_type.title as title1,bt.eblock_price,(bt.total_ebc/bt.eblock_quantity) as ebc,bt.coin_price,bt.payment_currency";
            echo $this->common->getDataTableSource('eblocks_node', $columns, $condition, $getfiled, $request,$join_str,array(),'eblocks_node.id','DESC');
            die();
        }
        public function getRTransaction1(){
            $columns = array('user_reward.eblocks_node_id','user_reward.reward_amount','level','user_reward.created_date');
            $request = $this->input->get();
            $condition = array();
            $condition['user_reward.user_id'] = $this->data['logged_use']['id'];
            
           if($request['block_type_id']!=0){ 
                $condition['eb.block_type_id'] = $request['block_type_id'];
            }
            
            if($request['node_id']!=0){ 
                $condition['user_reward.eblocks_node_id'] = $request['node_id'];
            }
        
            if(!empty($request['eblock_filter'])){
            $condition['en.eblock_id']=$request['eblock_filter'];
             
            }
            else{
               
            }
            
           
            $join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.id',
                'from_table_id' => 'user_reward.eblocks_node_id',
                'join_type' => 'left'
            );
            
            $join_str[1] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'en.eblock_id',
                'join_type' => 'left'
            );
             $join_str[2] = array('table' => 'block_type as bt',
                'join_table_id' => 'bt.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
             
           
            
            
            
            

            $getfiled = "user_reward.eblocks_node_id,user_reward.reward_amount,CONCAT(".$this->db->dbprefix."user_reward.left_nodes,'/',".$this->db->dbprefix."user_reward.right_nodes) as level,user_reward.created_date";
            
            echo $this->common->getDataTableSource('user_reward',$columns, $condition, $getfiled, $request,$join_str,'user_reward.id') ;

            //echo $this->db->last_query();
            die();
        }
        
        public function refresh_eblock_dropdown(){
            $json=array();

            $json['eblocks']=array();
            $block_type_id=$this->input->post('block_type_id');
            $eblocks=$this->common->select_data_by_id('eblocks', 'block_type_id', $block_type_id, '*', array()); 


            foreach ($eblocks as $e){
                 $json['eblocks'][]=$e;
                }


            echo json_encode($json);die();
    }

    
    public function getRewardTable(){ 
        $json=array();
        $json['status']='fail';
        $json['msg']='';
        $html='';
        $id=$this->input->post('id');
        if($id!=''){
            $node=$this->common->select_data_by_multiple_condition('eblocks_node', array('id'=>$id), '*', '', 'id',  '', '', array(), 'id', array(),array());
            $left=$this->nodecounter($node,'left',1,0);
            $right=$this->nodecounter($node,'right',1,0);
            
            
            if(!empty($node)){
                
                
                $user_reward_extra=$this->common->select_data_by_condition('user_reward_extra', array('user_id'=>$node[0]['user_id'],'eblocks_node_id'=>$node[0]['id']), '*',  'id',  'ASC', '', '',  array()); 
                $reentryblocks='';
                $entryblocks='';
                if(!empty($user_reward_extra)){
                    $entry_block_id='';
                    $reentry_block_id='';
                    if($user_reward_extra[0]['reentry_block_id']!=0){
                        $join_str[0] = array('table' => 'eblocks as eb',
                            'join_table_id' => 'eb.id',
                            'from_table_id' => 'eblocks_node.eblock_id',
                            'join_type' => 'left'
                        );
                         $join_str[1] = array('table' => 'block_type as bt',
                            'join_table_id' => 'bt.id',
                            'from_table_id' => 'eb.block_type_id',
                            'join_type' => 'left'
                        );
                        $nnn=$this->common->select_data_by_multiple_condition('eblocks_node', array('auto_id'=>$user_reward_extra[0]['reentry_block_id']), 'eblocks_node.id,eb.title,bt.title as title1', '', 'id',  '', '', $join_str, 'id', array(),array());
                        if(!empty($nnn)){
                            $reentry_block_id=$nnn[0]['title'].'-'.$nnn[0]['title1'].': '.$nnn[0]['id'];
                        }
                        
                    }
                    if($user_reward_extra[0]['entry_block_id']!=0){
                        $join_str[0] = array('table' => 'eblocks as eb',
                            'join_table_id' => 'eb.id',
                            'from_table_id' => 'eblocks_node.eblock_id',
                            'join_type' => 'left'
                        );
                         $join_str[1] = array('table' => 'block_type as bt',
                            'join_table_id' => 'bt.id',
                            'from_table_id' => 'eb.block_type_id',
                            'join_type' => 'left'
                        );
                        $nnn=$this->common->select_data_by_multiple_condition('eblocks_node', array('auto_id'=>$user_reward_extra[0]['entry_block_id']), 'eblocks_node.id,eb.title,bt.title as title1', '', 'id',  '', '', $join_str, 'id', array(),array());
                        if(!empty($nnn)){
                        $entry_block_id=$nnn[0]['title'].'-'.$nnn[0]['title1'].': '.$nnn[0]['id'];
                        }
                    }
                    
                    $left='<i class="fa fa-check" style="color:green"></i>';
                    $right='<i class="fa fa-check" style="color:green"></i>';
                    $reentryblocks='Re-entry blocks <br>'.$reentry_block_id;
                    $entryblocks='Entry blocks<br>'.$entry_block_id;
                }
                
                $reward=$this->common->select_data_by_condition('reward', array('eblock_id'=>$node[0]['eblock_id']), '*',  'id',  'ASC', '', '',  array()); 
                
                $tableheader='';
                $tablebody='';
                $bonus='<td align="center">Bonus<br>(Re-entry Eblocks)</td>';
                foreach ($reward as $r){
                    $tableheader .='<th style="text-align: center; ">'.$r['left_nodes'].'/'.$r['right_nodes'].'</th>';
                    
                    $user_reward=$this->common->select_data_by_condition('user_reward', array('user_id'=>$node[0]['user_id'],'left_nodes'=>$r['left_nodes'],'right_nodes'=>$r['right_nodes'],'eblocks_node_id'=>$node[0]['id']), '*',  'id',  'ASC', '', '',  array()); 
                    
                    if(!empty($user_reward)){
                        $tablebody .='<td style="text-align: center; "><i class="fa fa-check" style="color:green"></i></td>';
                    
                        $join_str=array();
                        $join_str[0] = array('table' => 'block_type as bt',
                            'join_table_id' => 'bt.id',
                            'from_table_id' => 'eblocks.block_type_id',
                            'join_type' => 'left'
                         );
                    
                       $bonus_eblock_id=''; 
                       if(!empty($user_reward[0]['eblocks_auto_ids'])){
                            $block_array=  json_decode($user_reward[0]['eblocks_auto_ids']);
                            if(!empty($block_array)){
                               // print_r($block_array);die();
                                $bonusblock=$this->common->select_data_by_multiple_condition('eblocks_node', array('auto_id'=>$block_array[0]), '*', '', 'id',  '', '',array(), 'id', array(),array());
                                if(!empty($bonusblock)){
                                    $bonus_eblock_id=$bonusblock[0]['id'];
                                }
                            }
                            
                        }
                        $eb=$this->common->select_data_by_condition('eblocks', array('eblocks.id'=>$user_reward[0]['bonus_eblock_id']), 'eblocks.title,bt.title as title1',  'eblocks.id',  'ASC', '', '',  $join_str); 
                        if(!empty($eb)){
                            if($bonus_eblock_id==''){
                                $bonus .='<td style="text-align: center; ">'.$eb[0]['title'].'-'.$eb[0]['title1'].'</td>';
                            }
                            else{
                                $bonus .='<td style="text-align: center; ">'.$eb[0]['title'].'-'.$eb[0]['title1'].'<br>'.$bonus_eblock_id.'</td>';
                            }
                            
                            
                        }
                        else{
                            $bonus .='<td></td>';
                        }
                        
                    }
                    else{
                        $tablebody .='<td></td>';
                        $bonus .='<td></td>';
                    }
                    
                    
                    
                    
                }
                
                
                
                $html='
                        <table id="transaction" class="table table-hover m-b-0 table-bordered">
                                  <thead>
                                    <tr >
                                      <th style="text-align: center;">Block No.</th>
                                      
                                     '.$tableheader.'
                                      <th style="text-align: center; ">Left</th>
                                      <th style="text-align: center; ">Right</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td style="text-align: center; ">'.$node[0]['id'].'</td>
                                            '.$tablebody.'
                                          <td style="text-align: center; ">'.$left.'</td>
                                          <td style="text-align: center; ">'.$right.'</td>
                                      </tr>
                                      
                                    <tr>
                                   '.$bonus.'
                                    <td colspan="2">'.$reentryblocks.'<br>'.$entryblocks.'</td>
                                    </tr>
                                     
                                  </tbody>
                                </table>';
                
                $json['status']='success';
                $json['data']=$html;
            }
        }
        
        
        
       
        echo json_encode($json);die();
    }
    
    
    private function nodecounter($nodes,$position='left',$root=0,$totalnodes=0){
        
        if($root==1){
            if($position=='left'){
                $leftnodes=$this->common->select_data_by_condition('eblocks_node', array('parent_id'=>$nodes[0]['id'],'left'=>1), '*', 'id', 'ASC', '', '',array());
                if(empty($leftnodes)){
                    return $totalnodes;
                }
                else{
                    $totalnodes++;
                    return $this->nodecounter(array($leftnodes[0]),'left',0,$totalnodes);
                }
            }
            else{
                
                $rightnodes=$this->common->select_data_by_condition('eblocks_node', array('parent_id'=>$nodes[0]['id'],'right'=>1), '*', 'id', 'ASC', '', '',array());
                if(empty($rightnodes)){
                    return $totalnodes;
                }
                else{
                    $totalnodes++;
                    return $this->nodecounter(array($rightnodes[0]),'right',0,$totalnodes);
                }
            }
        }
        else{
            $childs=array();
            foreach ($nodes as $n){
                $nodechilds=$this->common->select_data_by_condition('eblocks_node', array('parent_id'=>$n['id']), '*', 'id', 'ASC', '', '',array());
                if(count($nodechilds)==1){
                    $totalnodes++;
                }
                if(count($nodechilds)==2){
                    $totalnodes=$totalnodes+2;
                }
                $childs=array_merge($nodechilds,$childs);
            }
            if(empty($childs)){
                return $totalnodes;
            }
            else{
                return $this->nodecounter($childs,$position,0,$totalnodes);
            }
        }
    }
    
    
    function node_refresh(){
         $json=array();

            $json['nodes']=array();
            $block_type_id=$this->input->post('block_type_id');
            $eblock_id=$this->input->post('eblock_id');
            $node_id=$this->input->post('node_id');
            $condition=array();
            $condition['en.user_id']=$this->data['logged_use']['id'];
            if(!empty($eblock_id) && $eblock_id!=0){
                $condition['en.eblock_id']=$eblock_id;
            }
            if(!empty($block_type_id) && $block_type_id!=0){
                $condition['eb.block_type_id']=$block_type_id;
            }
            if(!empty($node_id) && $node_id!=0){
                $condition['user_reward.eblocks_node_id']=$node_id;
            }
            
            
            
            $join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.id',
                'from_table_id' => 'user_reward.eblocks_node_id',
                'join_type' => 'left'
            );
            
            $join_str[1] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'en.eblock_id',
                'join_type' => 'left'
            );
             $join_str[2] = array('table' => 'block_type as bt',
                'join_table_id' => 'bt.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
             
           $groupby='user_reward.eblocks_node_id';
            $userreward=$this->select_data_by_condition('user_reward', $condition, 'user_reward.*', 'user_reward.eblocks_node_id', 'ASC', '', '',$join_str,$groupby);
            
            
            
            $json['nodes']=$userreward;

            echo json_encode($json);die();
    }
    
    function node_refresh_extra(){
         $json=array();

            $json['nodes']=array();
            $block_type_id=$this->input->post('block_type_id');
            $eblock_id=$this->input->post('eblock_id');
            $node_id=$this->input->post('node_id');
            $condition=array();
            $condition['en.user_id']=$this->data['logged_use']['id'];
            if(!empty($eblock_id) && $eblock_id!=0){
                $condition['en.eblock_id']=$eblock_id;
            }
            if(!empty($block_type_id) && $block_type_id!=0){
                $condition['eb.block_type_id']=$block_type_id;
            }
            if(!empty($node_id) && $node_id!=0){
                $condition['user_reward_extra.eblocks_node_id']=$node_id;
            }
            
            
            
            $join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.id',
                'from_table_id' => 'user_reward_extra.eblocks_node_id',
                'join_type' => 'left'
            );
            
            $join_str[1] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'en.eblock_id',
                'join_type' => 'left'
            );
             $join_str[2] = array('table' => 'block_type as bt',
                'join_table_id' => 'bt.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
             
           $groupby='user_reward_extra.eblocks_node_id';
            $userreward=$this->select_data_by_condition('user_reward_extra', $condition, 'user_reward_extra.*', 'user_reward_extra.eblocks_node_id', 'ASC', '', '',$join_str,$groupby);
            
            
            
            $json['nodes']=$userreward;

            echo json_encode($json);die();
    }
    public function usd(){
        $this->load->view('transaction/usd', $this->data);
    }
    public function ebc(){
        $this->load->view('transaction/ebc', $this->data);
    }
    public function get_usd_transaction(){
         $columns = array('usd_transaction.id','ur.eblocks_node_id','usd_transaction.amount','usd_transaction.type','usd_transaction.created_date');
            $request = $this->input->get();
            $condition = array();
            $condition['usd_transaction.status']='completed';
            $condition['usd_transaction.user_id'] = $this->data['logged_use']['id'];
             if (!empty($request['from_date']) && !empty($request['to_date'])) {
                $condition['DATE('.$this->db->dbprefix.'usd_transaction.created_date) >='] = $request['from_date'];
                $condition['DATE('.$this->db->dbprefix.'usd_transaction.created_date) <='] = $request['to_date'];
            }
            
            $join_str[0] = array('table' => 'user_reward as ur',
                'join_table_id' => 'ur.id',
                'from_table_id' => 'usd_transaction.user_reward_id',
                'join_type' => 'left'
            );
            
            $getfiled = "usd_transaction.id,ur.eblocks_node_id,usd_transaction.amount,usd_transaction.type,usd_transaction.created_date";
            echo $this->common->getDataTableSource('usd_transaction',$columns, $condition, $getfiled, $request,$join_str,'') ;

            die();
    }
    
    public function get_ebc_transaction(){
         $columns = array('ebc_transaction.id','ebc_transaction.ebc','ebc_transaction.type','ebc_transaction.created_date','ebc_transaction.comment');
            $request = $this->input->get();
            $condition = array();
            $condition['ebc_transaction.user_id'] = $this->data['logged_use']['id'];
             if (!empty($request['from_date']) && !empty($request['to_date'])) {
                $condition['DATE('.$this->db->dbprefix.'ebc_transaction.created_date) >='] = $request['from_date'];
                $condition['DATE('.$this->db->dbprefix.'ebc_transaction.created_date) <='] = $request['to_date'];
            }
            $getfiled = "ebc_transaction.id,ebc_transaction.ebc,ebc_transaction.type,ebc_transaction.created_date,ebc_transaction.comment";
            echo $this->common->getDataTableSource('ebc_transaction',$columns, $condition, $getfiled, $request,array(),'') ;

            die();
    }
    
    public function giftcard(){
        $this->load->view('transaction/giftcard', $this->data);
    }
    
     public function get_product_transaction(){
         $columns = array('user_product.id','user_product.product_name','user_product.usd_amount','user_product.ebc','user_product.qty','user_product.payable_ebc','user_product.btc_rate','user_product.payable_btc','user_product.created_date','user_product.status');
            $request = $this->input->get();
            $condition = array();
            $condition['user_product.user_id'] = $this->data['logged_use']['id'];
             if (!empty($request['from_date']) && !empty($request['to_date'])) {
                $condition['DATE('.$this->db->dbprefix.'user_product.created_date) >='] = $request['from_date'];
                $condition['DATE('.$this->db->dbprefix.'user_product.created_date) <='] = $request['to_date'];
            }
            $getfiled = "user_product.id,user_product.product_name,user_product.usd_amount,user_product.ebc,user_product.qty,user_product.payable_ebc,user_product.btc_rate,user_product.payable_btc,user_product.created_date,user_product.status";
            echo $this->common->getDataTableSource('user_product',$columns, $condition, $getfiled, $request,array(),'') ;

            die();
    }
    
    
    
    
    
    function select_data_by_condition($tablename, $condition_array = array(), $data='', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(),$groupby='') {
       //$this->db->distinct();
        $this->db->select($data);
        //if join_str array is not empty then implement the join query
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }

        //condition array pass to where condition
        $this->db->where($condition_array);
        if ($groupby != '') {
            
            $this->db->group_by($groupby);
        }
 
        //Setting Limit for Paging
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        //order by query
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }

        $query = $this->db->get($tablename);
        
        
        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
         
        //if limit is not empty then return result array
        return $query->result_array();
    }
    
    
    function google_auth(){
        $json=array();
        $json['status']='fail';
        $json['msg']='Please Enable 2FA authenticator to access this information!';
        $user=$this->common->select_data_by_id('user', 'id', $this->data['logged_use']['id'], '*', array());
        if(!empty($user)){
            if($user[0]['auth_enable']=='Yes'){
                $json['status']='success';
                $json['msg']='';
            }
        }
        echo json_encode($json);die();
    }
    function view_codes(){
        $json=array();
        $json['status']='fail';
        $json['msg']='No information found!';
        $user_product_id=$this->input->post('user_product_id');
        $auth_code=$this->input->post('auth_code');
        $html='';
        if($user_product_id==''){
            echo json_encode($json);die();
        }
        
        if(!$this->verify_google_auth($auth_code)){
                $json['msg']='Authetication code invalid!';
                echo json_encode($json);die();
        }
        else{
            
            $user_product=$this->common->select_data_by_id('user_product', 'id', $user_product_id, '*', array());
            if(!empty($user_product)){
                if($user_product[0]['user_id']==$this->data['logged_use']['id']){
                    $user_product_detail=$this->common->select_data_by_id('user_product_detail', 'user_product_id', $user_product[0]['id'], '*', array());
                    if(!empty($user_product_detail)){
                        $html='
                            <div class="col-md-4">
                                <label>Product Name:</label> '.$user_product[0]['product_name'].'
                            </div>
                            <div class="col-md-8">
                                <label>Status:</label> '.$user_product[0]['status'].'
                            </div>
                            <div class="col-md-12">
                                <label>BTC Transaction ID:</label> '.$user_product[0]['tid'].'
                            </div>
                            <div class="col-md-12">
                                <label>Email:</label> '.$user_product[0]['email'].'
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="table-responsive">
                                        <table id="producttransaction" class="table table-hover m-b-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Secret code</th>
                                                    <th>Expiry Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           
                                            ';
                        
                        $i=0;
                        foreach($user_product_detail as $ud){
                            $i++;
                            $html .='<tr>';
                            $html .='<td>'.$i.'</td>';
                            $html .='<td>'.$ud['secret_code'].'</td>';
                            $html .='<td>'.$ud['expiry_date'].'</td>';
                            $html .='</tr>';
                        }
                        
                        $html .='</tbody>
                                        </table>
                             </div>';
                        $json['status']='success';
                        $json['data']=$html;
                    }
                }
            }
        }
        
        
        echo json_encode($json);die();
    }
    
    
    function extrapayout(){
        $columns = array('user_reward_extra.eblocks_node_id','user_reward_extra.reward_amount','level','user_reward_extra.created_date');
            $request = $this->input->get();
            $condition = array();
            $condition['user_reward_extra.user_id'] = $this->data['logged_use']['id'];
            
           if($request['block_type_id']!=0){ 
                $condition['eb.block_type_id'] = $request['block_type_id'];
            }
            
            if($request['node_id']!=0){ 
                $condition['user_reward_extra.eblocks_node_id'] = $request['node_id'];
            }
        
            if(!empty($request['eblock_filter'])){
            $condition['en.eblock_id']=$request['eblock_filter'];
             
            }
            else{
               
            }
            
           
            $join_str[0] = array('table' => 'eblocks_node as en',
                'join_table_id' => 'en.id',
                'from_table_id' => 'user_reward_extra.eblocks_node_id',
                'join_type' => 'left'
            );
            
            $join_str[1] = array('table' => 'eblocks as eb',
                'join_table_id' => 'eb.id',
                'from_table_id' => 'en.eblock_id',
                'join_type' => 'left'
            );
             $join_str[2] = array('table' => 'block_type as bt',
                'join_table_id' => 'bt.id',
                'from_table_id' => 'eb.block_type_id',
                'join_type' => 'left'
            );
             
           
            
            
            
            

            $getfiled = "user_reward_extra.eblocks_node_id,user_reward_extra.reward_amount,CONCAT(".$this->db->dbprefix."user_reward_extra.left_nodes,'/',".$this->db->dbprefix."user_reward_extra.right_nodes) as level,user_reward_extra.created_date";
            
            echo $this->common->getDataTableSource('user_reward_extra',$columns, $condition, $getfiled, $request,$join_str,'user_reward_extra.id') ;

            //echo $this->db->last_query();
            die();
    }
}
