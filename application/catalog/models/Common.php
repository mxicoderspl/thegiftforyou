<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends CI_Model {

    // insert data into database and returns true and false
    function insert_data($data, $tablename) {
        if ($this->db->insert($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }

    // insert data into database and returns last insert id or 0
    function insert_data_getid($data, $tablename) {
        if ($this->db->insert($tablename, $data)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    // update database and returns true and false
    function update_data($data, $tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->update($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }

    
     public function selectRecordById($table, $id, $filed) {

        $this->db->where($filed, $id);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    // select data using colum id
    function select_data_by_id($tablename, $columnname, $columnid, $data = '*', $join_str = array()) {
        $this->db->select($data);
        //if join_str array is not empty then implement the join query
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                //check for join type
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
        $this->db->where($columnname, $columnid);
        $query = $this->db->get($tablename);
        return $query->result_array();
    }

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
    public function select_data_by_multiple_condition($tablename, $condition_array = array(), $data = '*', $where_in_col = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '', $condition_or_arr = array(), $where_in_val = array()) {
        //select_data_by_multiple_condition('biometric_student_attendance', $condition_arr, $selected,$where_in,$orderby, '', '', $join_str,'','');
        $this->db->select($data);
        $this->db->from($tablename);

        //if join_str array is not empty then implement the join query
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }

        //condition array pass to where condition
        $this->db->where($condition_array);
        //$this->db->where('student_assignment_reply.student_id is null');
        if (!empty($where_in_val)) {
            $this->db->where_in($where_in_col, $where_in_val);
        } else {
            $this->db->where_in($where_in_col);
        }
        if (!empty($condition_or_arr)) {
            $this->db->group_start();
            $this->db->or_where($condition_or_arr);
            $this->db->group_end();
        }
        //Setting Limit for Paging
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }

        if ($groupby != '') {
            $this->db->group_by($groupby);
        }
        //order by query

        if ($orderby = '') {
            $this->db->order_by($orderby);
        }


        $query = $this->db->get();

        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
        //if limit is not empty then return result array
        return $query->result_array();
    }

    // select data using multiple conditions and search keyword
    function select_data_by_search($tablename, $search_condition, $condition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array()) {
         
        $this->db->select($data);
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
            }
        }
        $this->db->where($condition_array);
        $this->db->where($search_condition);

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

    //table records count
    function get_count_of_table($table) {
        $count = $this->db->get($table)->num_rows();
        return $count;
    }

    // delete data
    function delete_data($tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->delete($tablename)) {
            return true;
        } else {
            return false;
        }
    }

    // check unique avaliblity
    function check_unique_avalibility($tablename, $columname1, $columnid1_value, $columname2, $columnid2_value, $condition_array) {
        // if edit than $columnid2_value use
        if ($columnid2_value != '') {
            $this->db->where($columname2 . " != ", $columnid2_value);
        }

        if (!empty($condition_array)) {
            $this->db->where($condition_array);
        }

        $this->db->where($columname1, $columnid1_value);
        $query = $this->db->get($tablename);
        return $query->result();
    }

    /*
     * This function is to create the data source of the Jquery Datatable
     * 
     * @param $tablename Name of the Table in database
     * @param $datatable_fields Fields in datatable that avalable for filtering
     * @param $condition_array conditions for Query 
     * @param $data The field set tobe return to datatables
     * @param $request The Get or Post Request Sent from Datatable
     * @param $join_str Join array for Query
     * @return JSON data for datatable
     */
    
    function getDataTableSource($tablename, $datatable_fields = array(), $conditions_array = array(), $data = '*', $request, $join_str = array(),$group_by='') {
        $output = array();
        
        //Fields tobe display in datatable
        $this->db->distinct();
        $this->db->select($data,FALSE);
        //Making Join with tables if provided
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }
        //COnditions for Query
        if (!empty($conditions_array)) {
            $this->db->where($conditions_array);
        }
        if($group_by!=''){
             $this->db->group_by($group_by); 
        }
         
       
        //Total record in query tobe return
        $output['recordsTotal'] = $this->db->count_all_results($tablename, FALSE);
        //echo $this->db->last_query(); die();
        //Filtering based on the datatable_fileds
        if ($request['search']['value'] != '') {
            $this->db->group_start();
            for ($i = 0; $i < count($datatable_fields); $i++) {
                if ($request['columns'][$i]['searchable'] == 'true') {

                    $this->db->or_like($datatable_fields[$i], $request['search']['value']);
                }
            }
            $this->db->group_end();
        }

        //Total number of records return after filtering not no of record display on page.
        //It must be counted before limiting the resultset.
        $output['recordsFiltered'] = $this->db->count_all_results(NULL, FALSE);

        //Setting Limit for Paging
        $this->db->limit($request['length'], $request['start']);

        //ordering the query
        if (isset($request['order']) && count($request['order'])) {
            for ($i = 0; $i < count($request['order']); $i++) {
                if ($request['columns'][$request['order'][$i]['column']]['orderable'] == 'true') {
                    $this->db->order_by($datatable_fields[$request['order'][$i]['column']] . ' ' . $request['order'][$i]['dir']);
                }
            }
        }

        $query = $this->db->get();
        $output['draw'] = $request['draw'];
        $output['data'] = $query->result_array();

        return json_encode($output);
    }

    public function get_suggestion($table, $filed_name, $value) {

        $this->db->select('full_name as label,user_id as value');
        $this->db->like($filed_name,$value);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    public function selectMerchantRecords($table, $filed,$where) {
        $this->db->select($filed);
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->row_array();
    }
    
    
    function get_all_record($tablename, $data, $sortby='', $orderby='') {
        $this->db->select($data);
        $this->db->from($tablename);
        //$this->db->where('status', 'Enable');
        if ($sortby != '' && $orderby != "") {
            $this->db->order_by($sortby, $orderby);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
   function select_data_by_allcondition($tablename, $condition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '') {
        $this->db->select($data);
        $this->db->from($tablename);
        //if join_str array is not empty then implement the join query
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
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
        if ($groupby != '') {
            $this->db->group_by($groupby);
        }
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }

        $query = $this->db->get();
        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
        //if limit is not empty then return result array
        return $query->result_array();
    }
}
