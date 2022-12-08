<?php


class Mdl_categories extends DT_CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code

	}

	public function deleteRecord($categoriesId)
	{

		//$categoriesId = explode(',',$categoriesId);
		$tables = array('tbl_categories');
		$this->db->where_in('categories_id',$categoriesId);
		$this->db->delete($tables);

		$ids = is_array($categoriesId) ? implode(',',$categoriesId) : $categoriesId;
		$response = array();
		if ($this->db->affected_rows()) {
			$response['success'] = "true";
		}
		return $response;
	}

	public function getCategoriesData($categoriesId)
	{
		$this->db->select("tc.categories_id,tc.categories_name,tb.business_id,tb.business_name,tc.is_active");
		$this->db->from('tbl_categories as tc');
		$this->db->join('tbl_business as tb','tb.business_id = tc.business_id','left');
		$this->db->where('tc.categories_id', $categoriesId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
	}
	
	public function getCategoriesListing($data = '')
	{
		$limit = DATA_LIMIT;
		$this->db->select("*");
		$this->db->from('tbl_categories');
		if (isset($data['business_id'])) {
			$this->db->where('business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('categories_id','ASC');
        return $this->db->get()->result_array();
	}
	
	function getCategoriesDD($data)
	{
		$this->db->select("ts.categories_id as id,ts.categories_name as text");
		$this->db->from('tbl_categories as ts');
		$this->db->where_in("business_id", $data['business_id']);
		if($data['business_id'] == ''){
			$result['result'] = array ( array ( 'id' => 0 , 'text' => 'First Select Business...' ));
		} else {
			if (isset($data['filter_param']) && $data['filter_param'] != '') {
				$this->db->like("ts.categories_name", $data['filter_param'], 'both');
			}
			$query = $this->db->get();
			$result['result'] = $query->result_array();
		}
		return json_encode($result);
	}

}
