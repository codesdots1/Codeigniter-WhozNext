<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_city extends DT_CI_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

    }


    public function deleteRecord($cityId)
    {
        $tables = array('tbl_city');
        $this->db->where_in('city_id',$cityId);
        $this->db->delete($tables);

        $ids = is_array($cityId) ? implode(',',$cityId) : $cityId;

        if ($this->db->affected_rows()) {
            logActivity('City Deleted [CityID: ' . $ids . ']',$this->data['userId'],'City');
            return true;
        }
        return false;
    }

    public function getData($cityId = '')
    {
        $this->db->where('city_id', $cityId);
        $data = $this->db->get("tbl_city");
        $query = $data->result_array();
        return $query;
    }


    function getCityDD($filterParameter = '',$page ,$cityIdActive,$start = 0, $limit = 10)
    {
        if($page != 1){
            $start = ($page * $limit) - $limit;
        }
//        $this->db->start_cache();
        $this->db->select('city_id as id,city_name as text');
        $this->db->from('tbl_city');
        if ($filterParameter != '') {
            $this->db->like('city_name', $filterParameter, 'both');
        }
        $this->db->where('is_active',1);
        $query = $this->db->get();
        $result['result'] = $query->result_array();
        return json_encode($result);
    }
	public function getCityListing($data = ''){
		$limit = DATA_LIMIT;
		$this->db->select("c.city_id,c.city_name");
		$this->db->from("tbl_city as c");
		if (isset($data['search']) && $data['search'] != '') {
			$this->db->like('c.city_name', $data['search'],'both');
		}
		if (isset($data['start'])) {
			$this->db->limit($limit, $data['start'] * $limit);
		}
		$query = $this->db->get()->result_array();
		return $query;
	}

    public function checkExistCity($cityId = '', $cityName = ''){
        $this->db->select('count(tc.city_name) as city');
        $this->db->from('tbl_city as tc');
        if($cityId != ''){
            $this->db->where('tc.city_id != ',$cityId);
        }
        $this->db->where('tc.city_name',$cityName);
        $city = $this->db->get()->row_array();
        return isset($city['city']) ? $city['city'] : 0;
    }

}
?>
