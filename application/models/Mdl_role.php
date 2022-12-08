<?php


class Mdl_role extends DT_CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($roleId = '')
	{
		$roleId = explode(',',$roleId);
		$tables = array('tbl_role');
        $this->db->where_in('role_id',$roleId);
        $this->db->delete($tables);

        $ids = is_array($roleId) ? implode(',',$roleId) : $roleId;
		$response = array();
        if ($this->db->affected_rows()) {
            $response['success'] = "true";
        }
		return $response;

	}

	public function getRoleData($roleId)
	{
		$this->db->select('tr.role_id,tr.title,tr.role,tr.description');
		$this->db->from('tbl_role as tr');
		$this->db->where('tr.role_id', $roleId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
	}


	function getRoleDD($data){
		$this->db->select('tr.role_id as id,tr.role as text');
		$this->db->from('tbl_role as tr');
		if (isset($data['filter_param']) && $data['filter_param'] != '') {
			$this->db->like("tr.role", $data['filter_param'], 'both');
		}
		$query = $this->db->get();
		$result['result'] = $query->result_array();
		return json_encode($result);
	}

	public function getExistingRole($excludeId = '')
	{
		$this->db->select('role');
		$this->db->from('tbl_role');
		if($excludeId != ''){
			$this->db->where('role_id != ',$excludeId);
		}
		$query = $this->db->get();
		$queryData = $query->result_array();
		return $queryData;
	}

	
}


