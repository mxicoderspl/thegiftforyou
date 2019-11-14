<?php

Class Cron_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

	/**********************/
	$user_id = $this->common->select_data_by_condition('cron_users_data', array(), 'user_id', 'id', 'Asc', '3', '', array());

	foreach ($user_id as $uid) {
            $get_ref_id = $this->common->select_data_by_condition('user', array('id' => $uid['user_id']), 'ref_by', 'id', 'ASC', '', '', array());
            do {

                $user_level = $this->check_level(array($uid['user_id']), 0, 3, 5);
                echo 'Level of this user is: ' . $user_level;

                if ($user_level != 0) {
                    for ($i = 1; $i <= $user_level; $i++) {
                        // check gift reward exist or not
                        $product_exist = $this->common->select_data_by_condition('business_plan', array('level' => $i), 'product_list,price', '', '', '', '', array());

                        $user_gift_reward = $this->common->select_data_by_condition('user_gift_reward', array('user_id' => $uid['user_id'], 'reward_level' => $i), 'id', '', '', '', '', array());
			//echo $product_exist[0]['product_list'];exit;
                        if ($product_exist[0]['product_list'] != 0 || $product_exist[0]['price'] != 0) {
                                                     
			    if($product_exist[0]['product_list'] != 0){ 
				 $products = explode(',', $product_exist[0]['product_list']);
				 $productnm = array();
                            	 for ($j=0; $j<count($products); $j++) {

		                        $prname[] = $this->common->select_data_by_id('product', 'id', $products[$j], 'title', array());

		                        $productnm[$j] = $prname[$j][0]['title'];
		                    }
				
			    }else{
				$productnm = array();				
				}
                                                      
                            if (empty($user_gift_reward)) {
                                $gift_data = array(
                                    'user_id' => $uid['user_id'],
                                    'reward_level' => $i,
                                    'product_id' => $product_exist[0]['product_list'],
                                    'product_name' => implode(',', $productnm),
                                    'price' => $product_exist[0]['price'],
                                    'status' => 'Pending',
                                    'created_datetime' => date('Y-m-d H:i:s')
                                );
                                $this->common->insert_data($gift_data, 'user_gift_reward');
                            }
                        }
                    }
                }
                $refer_by = $this->common->select_data_by_condition('user', array('id' => $get_ref_id[0]['ref_by']), 'ref_by', 'id', 'Asc', '', '', array());
                if (!empty($refer_by)) {
                    $get_ref_id[0]['ref_by'] = $refer_by[0]['ref_by'];
                } else {
                    $get_ref_id[0]['ref_by'] = 0;
                }
            } while ($get_ref_id[0]['ref_by'] != 0);
		$this->common->delete_data('cron_users_data', 'user_id', $uid['user_id']);
        }

    }

    function check_level($user_array,$user_level=0,$tree_size=3,$level=10){
	//print_r($user_array);exit;
       if(empty($user_array)){
           return $user_level;
       }
       if($user_level==$level){
           return $user_level;
       }
       
        $temp_user_array=array();
        $temp_each_level=0;
        foreach ($user_array as $u){
   
            $userinfo = $this->common->select_data_by_condition('user', array('id'=>$u,'payment_verified'=>'Yes'), 'id,firstname,ref_by','', '','','',array());
            if(!empty($userinfo)){
                echo $userinfo[0]['firstname']."<br>";
                $child = $this->common->select_data_by_condition('user', array('ref_by'=>$userinfo[0]['id'],'payment_verified'=>'Yes'), 'id,firstname,ref_by','', '','','',array());
               
                if(!empty($child)){
                    
                    if(count($child)>=$tree_size){
                        $temp_each_level++;
                        
                        foreach ($child as $c){
                         echo $c['id'].' '.$c['firstname']."<br>";
                         
                         
                            $childs = $this->common->select_data_by_condition('user', array('ref_by'=>$c['id'],'payment_verified'=>'Yes'), 'id','', '','','',array());
                         
                            if(!empty($childs) && count($childs)>=$tree_size){
                                $temp_user_array[]=$c['id'];
                            }
                            
                            
                        }

                    }
                 /*   else{
                        return $user_level;
                    }*/
                }
                else{
                    return $user_level;
                }
                
            }
          /*  else{
                return $user_level; 
            }*/
            
        }
        print_r($temp_user_array);
        echo 'count:  '.count($temp_user_array).' level:'.($user_level+1).'<br>';
        
        if(count($user_array)>=pow($tree_size,$user_level) ){
        	return $this->check_level($temp_user_array,($user_level+1),$tree_size,$level);
        }
        else{
            return $user_level;
        }
        

    }

}

