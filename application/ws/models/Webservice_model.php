<?php

/**
 * Description of Holidays_model
 * contains all the functions related to holidays table
 * @author KT
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservice_model extends CI_Model {

    public function delete_user_token($user_id, $api_token) {

        $this->db->where(array('users_token.user_id' => $user_id, 'users_token.api_token' => $api_token));
        return $this->db->delete('users_token');
    }

    public function get_past_game($manager_id) {
        $this->db->select('player_request.*,player_request.arena_lat as address_lat,player_request.arena_long as address_long,concat(gkeep_users.first_name, ,gkeep_users.last_name) as Team_manager,player_response.player_id as p_id,player_response.request_id,player_response.applicant_status,player_response.requestor_status');
        $this->db->from('player_request');
        $this->db->join('player_response', 'player_response.request_id=player_request.id');
        $this->db->join('users', 'users.id=player_request.manager_id');
        $this->db->where('player_request.manager_id', $manager_id);
        //$this->db->where('player_response.requestor_status','Approve');
        $this->db->group_start();
        $this->db->where('player_request.game_date < ', date('Y-m-d'));
        $this->db->or_group_start();

        $this->db->where(array('player_request.game_date' => date('Y-m-d'), "ADDTIME(gkeep_player_request.`game_start_time`,SEC_TO_TIME(gkeep_player_request.duration*100)) < " => date('H:i:s')));
        $this->db->group_end();
        $this->db->group_end();
        $this->db->order_by('player_request.id', 'DESC');
        $this->db->group_by('player_response.request_id');
        return $this->db->get()->result_array();
        //echo $this->db->last_query(); die();
    }

    function update_data_by_conditions($data, $tablename, $conditions, $like_clo = '', $like = array()) {
        if (!empty($like)) {
            $this->db->where_in($like_clo, $like);
            if ($this->db->update($tablename, $data, $conditions)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($this->db->update($tablename, $data, $conditions)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function select_data_by_multiple_condition($tablename, $condition_array = array(), $data = '*', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '', $condition_or_arr = array(), $like_clo = '', $like = array()) {
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

    // select data using multiple conditions
    function select_data_by_condition($tablename, $condition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $group_by = '', $like_clo = '', $like = array()) {
        $this->db->distinct();
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

        if (!empty($like)) {
            $this->db->where_in($like_clo, $like);
        } else {
            $this->db->where_in($like_clo);
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
        $this->db->group_by($group_by);
        $query = $this->db->get();

        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
        //if limit is not empty then return result array
        return $query->result_array();
    }

    public function pagging_data($page_id, $user_id, $to_id) {
        $setLimit = 10;

        //    $pageLimit = ($page_id * $setLimit) - $setLimit;

        $pageLimit = ($page_id - 1) * $setLimit;
        $this->db->select('id,message,created_date');
        $this->db->from('message');
        $this->db->where(array('message.from_id' => $user_id, 'message.to_id' => $to_id));

        if ($setLimit != '' && $pageLimit == 0) {
            $this->db->limit($setLimit);
        } else if ($setLimit != '' && $pageLimit != 0) {
            $this->db->limit($setLimit, $pageLimit);
        }
        return $this->db->get()->result_array();
    }

    // select data using multiple conditions
    function select_data_by_rating($tablename, $condition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $group_by = '', $uid = '') {

        $this->db->select($data);
        $this->db->from($tablename);

        // $this->db->join('gkeep_player_request', 'gkeep_player_request.id = gkeep_player_performance.request_id and gkeep_player_request.manager_id='.$uid, 'right');
        // $this->db->join('gkeep_users', 'gkeep_users.id = gkeep_player_request.manager_id', 'right');
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

        //order by query
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }
        $this->db->group_by($group_by);
        $query = $this->db->get();

        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
        //if limit is not empty then return result array
        return $query->result_array();
    }

    function getDataTableSource($tablename, $datatable_fields = array(), $conditions_array = array(), $data = '*', $request, $search, $join_str = array()) {
        $output = array();
        //Fields tobe display in datatable
        $this->db->select($data);
        $this->db->from($tablename);
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }

        //Conditions for Query  that is defaultly available to Datatable data source.
        if (!empty($conditions_array)) {
            $this->db->where($conditions_array);
        }


        //Total record in query tobe return
        $output['recordsTotal'] = $this->db->count_all_results(NULL, FALSE);

        //Filtering based on the datatable_fileds
        if ($search != '') {
            $this->db->group_start();
            for ($i = 0; $i < count($datatable_fields); $i++) {
                //if ($request['columns'][$i]['searchable'] == true) {
                $this->db->or_like($datatable_fields[$i], $search);
                //}
            }
            $this->db->group_end();
        }

        //Total number of records return after filtering not no of record display on page.
        //It must be counted before limiting the resultset.
        // $output['recordsFiltered'] = $this->db->count_all_results(NULL, FALSE);


        $query = $this->db->get();
        //$output['draw'] = $request['draw'];
        //$output['data'] = $query->result_array();
        //return json_encode($output);
        return $query->result_array();
    }

    function select_data_by_like_condition($tablename, $condition_array = array(), $like_clo = '', $like = '', $like_clo1 = '', $like1 = array(), $like_clo2 = '', $like2 = '', $like_clo3 = '', $like3 = '', $like_clo4 = '', $like4 = '', $like_clo5 = '', $like5 = '', $like6 = '', $like7 = '', $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '', $having = '') {
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

        if ($like != '') {
            $this->db->like($like_clo, $like);
        }
        if ($like2 != '') {
            $this->db->like($like_clo2, $like2);
        }
        if ($like3 != '') {
            $this->db->like($like_clo3, $like3);
        }
        if ($like4 != '') {
            $this->db->like($like_clo4, $like4);
        }
        if ($like5 != '') {
            $this->db->like($like_clo5, $like5);
        }
        if (!empty($like1)) {
            $this->db->where_in($like_clo1, $like1);
        } else {
            $this->db->where_in($like_clo1);
        }
        if ($like6 != '' && $like7 != '') {
            $this->db->where('start_time <=', $like6);
            $this->db->where('end_time >=', $like7);
        }


//        if (!empty($like2)) {
//            $this->db->where_in($like_clo2, $like2);
//        } else {
//            $this->db->where_in($like_clo2);
//        }
//        
//        if (!empty($like3)) {
//            $this->db->where_in($like_clo3, $like3);
//        } else {
//            $this->db->where_in($like_clo3);
//        }
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
        if ($having != '') {
            $this->db->having($having);
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
