<?php


class Mdl_service extends DT_CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($serviceId)
	{

		//$serviceId = explode(',',$serviceId);
		$tables = array('tbl_service','tbl_service_gallery_file');
		$this->db->where_in('service_id',$serviceId);
		$this->db->delete($tables);

		$ids = is_array($serviceId) ? implode(',',$serviceId) : $serviceId;
		$response = array();
		if ($this->db->affected_rows()) {
			$response['success'] = "true";
		}
		return $response;
    }

    public function getServiceData($serviceId)
	{
		$galleryPath = IMAGE_DIR_URL . $this->config->item('service_gallery');
        $this->db->select("ts.service_id,ts.service_name,tc.categories_id,tc.categories_name,tb.business_id,tb.business_name,
        tbs.staff_id,CONCAT(tbs.first_name,' ',tbs.last_name) as staff_name,ts.typeId,ts.description,ts.status,ts.service_price,ts.timeDuration");
		$this->db->select('COALESCE(CONCAT("' . $galleryPath . '",tsgf.filename),"") as service_gallery');
        $this->db->from('tbl_service as ts');
        $this->db->join('tbl_service_gallery_file as tsgf','tsgf.service_id = ts.service_id','left');
        $this->db->join('tbl_categories as tc','tc.categories_id = ts.categories_id','left');
		$this->db->join('tbl_staff as tbs','tbs.staff_id = ts.staff_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = ts.business_id','left');
		$this->db->where('ts.service_id', $serviceId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
    }
    
    public function getImage($serviceId)
	{
		$this->db->select("service_gallery_file_id,service_id,filename");
		$this->db->from('tbl_service_gallery_file');
		$this->db->where_in('service_id', $serviceId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

    }
    
    public function deleteStaffImageEntry($imageId)
	{
		$this->db->where('service_gallery_file_id', $imageId);
		$this->db->delete('tbl_service_gallery_file');

		$ids = is_array($imageId) ? implode(',', $imageId) : $imageId;

		if ($this->db->affected_rows()) {
			$response['success'] = true;
			return $response;
		} else {
			$response['success'] = false;
			return $response;
		}
    }
    
    public function insertUpdateStaffImageEntry($dataArray)
	{

		$this->db->select("service_gallery_file_id,service_id,filename");
		$this->db->from('tbl_service_gallery_file');
		$this->db->where('service_id', $dataArray['service_id']);
		$query = $this->db->get();
		$result = $query->row_array();

		$imageUrl    = $this->config->item('service_gallery').$result['filename'];

		if(! empty($result)){
			$this->db->where('service_id', $dataArray['service_id']);
			$staffData  =  $this->db->update('tbl_service_gallery_file', $dataArray);
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

		}else{
			$this->db->insert('tbl_service_gallery_file', $dataArray);
		}
	}

	function getServiceDD($data)
	{
		$this->db->select("ts.service_id as id,ts.service_name as text");
		$this->db->from('tbl_service as ts');
		$this->db->where_in("business_id", $data['business_id']);
		if($data['business_id'] == ''){
			$result['result'] = array ( array ( 'id' => 0 , 'text' => 'First Select Business...' ));
		} else {
			if (isset($data['filter_param']) && $data['filter_param'] != '') {
				$this->db->like("ts.service_name", $data['filter_param'], 'both');
			}
			$query = $this->db->get();
			$result['result'] = $query->result_array();
		}
		return json_encode($result);
	}

	public function getServiceListing($data = '')
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('staff_gallery');
		$limit = DATA_LIMIT;
		$this->db->select("ts.service_id,tb.business_id,tc.categories_id,tc.categories_name,tsf.staff_id,CONCAT(tsf.first_name,' ',tsf.last_name) as staff_name,
		ts.service_name,ts.typeId,ts.description,ts.timeDuration,ts.service_price,ts.status");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tsgf.filename),"") as staff_gallery');
		$this->db->from('tbl_service as ts');
		$this->db->join('tbl_service_gallery_file as tsgf','tsgf.service_id = ts.service_id','left');
		$this->db->join('tbl_categories as tc','tc.categories_id = ts.categories_id','left');
		$this->db->join('tbl_staff as tsf','tsf.staff_id = ts.staff_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = ts.business_id','left');
		if (isset($data['business_id'])) {
			$this->db->where('ts.business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('service_id','ASC');
        return $this->db->get()->result_array();
	}
}