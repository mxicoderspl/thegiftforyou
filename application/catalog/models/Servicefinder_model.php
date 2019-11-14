<?php

class Servicefinder_model extends CI_Model {

      // select data using multiple conditions
    function select_data_by_condition($tablename, $condition_array = array(), $data='', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array()) {
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
            if(!empty($this->input->post('keyword'))){
             $this->db->like('businessname',$this->input->post('keyword'));
        }
        }

        //condition array pass to where condition
        $this->db->where($condition_array);


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
}
