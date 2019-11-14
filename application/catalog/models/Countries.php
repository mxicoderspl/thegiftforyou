<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function record_count() {
        return $this->db->count_all("thegiftsforyou_business");
    }

    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);
       

		$this->db->select('thegiftsforyou_business.*,thegiftsforyou_business_type.type_name,thegiftsforyou_states.name AS SN,thegiftsforyou_country.name AS CN');
    		$this->db->from('thegiftsforyou_business');
    		$this->db->join('thegiftsforyou_business_type', 'thegiftsforyou_business.business_type = thegiftsforyou_business_type.id');
   		$this->db->join('thegiftsforyou_states', 'thegiftsforyou_business.state = thegiftsforyou_states.id');
   		$this->db->join(' thegiftsforyou_country', 'thegiftsforyou_business.country =  thegiftsforyou_country.id');
		 $query=$this->db->get();

		/*select('thegiftsforyou_business.*')
			->select('thegiftsforyou_states.name AS SN')
			->select('thegiftsforyou_country.name AS CN') 
		->$this->db->join('thegiftsforyou_business_type', 'thegiftsforyou_business.business_type = thegiftsforyou_business_type.cid')
   		->$this->db->join('thegiftsforyou_states', 'thegiftsforyou_business.state = thegiftsforyou_states.id')
   		->$this->db->join(' thegiftsforyou_country', 'thegiftsforyou_business.country =  thegiftsforyou_country.id')*/
   		
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
}
?>
