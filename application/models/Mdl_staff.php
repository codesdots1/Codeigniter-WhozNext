<?php


class Mdl_staff extends DT_CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($staffId)
	{

		//$staffId = explode(',',$staffId);
		$tables = array('tbl_staff','tbl_staff_file','tbl_staff_gallery_file');
		$this->db->where_in('staff_id',$staffId);
		$this->db->delete($tables);

		$ids = is_array($staffId) ? implode(',',$staffId) : $staffId;
		$response = array();
		if ($this->db->affected_rows()) {
			$response['success'] = "true";
		}
		return $response;
	}

	public function getStaffData($staffId)
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('staff_image');
		$galleryPath = IMAGE_DIR_URL . $this->config->item('staff_gallery');
		$this->db->select("ts.staff_id,ts.first_name,ts.last_name,ts.position,ts.contact_no,ts.biography,ts.status,ts.is_active,
		tb.business_id,tb.business_name");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tsf.filename),"") as staff_image');
		$this->db->select('COALESCE(CONCAT("' . $galleryPath . '",tsg.galleryname),"") as staff_gallery');
		$this->db->from('tbl_staff as ts');
		$this->db->join('tbl_staff_file as tsf','tsf.staff_id = ts.staff_id','left');
		$this->db->join('tbl_staff_gallery_file as tsg','tsg.staff_id = ts.staff_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = ts.business_id','left');
		$this->db->where('ts.staff_id', $staffId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
	}

	public function getImage($staffId)
	{
		$this->db->select("staff_file_id,staff_id,filename");
		$this->db->from('tbl_staff_file');
		$this->db->where_in('staff_id', $staffId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

	}

	public function getGallery($staffId)
	{
		$this->db->select("staff_gallery_file_id,staff_id,galleryname");
		$this->db->from('tbl_staff_gallery_file');
		$this->db->where_in('staff_id', $staffId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function deleteStaffImageEntry($imageId)
	{
		$this->db->where('staff_file_id', $imageId);
		$this->db->delete('tbl_staff_file');

		$ids = is_array($imageId) ? implode(',', $imageId) : $imageId;

		if ($this->db->affected_rows()) {
			$response['success'] = true;
			return $response;
		} else {
			$response['success'] = false;
			return $response;
		}
	}

	public function deleteStaffGalleryEntry($imageId)
	{
		$this->db->where('staff_gallery_file_id', $imageId);
		$this->db->delete('tbl_staff_gallery_file');

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

		$this->db->select("staff_file_id,staff_id,filename");
		$this->db->from('tbl_staff_file');
		$this->db->where('staff_id', $dataArray['staff_id']);
		$query = $this->db->get();
		$result = $query->row_array();

		$imageUrl    = $this->config->item('staff_image').$result['filename'];

		if(! empty($result)){
			$this->db->where('staff_id', $dataArray['staff_id']);
			$staffData  =  $this->db->update('tbl_staff_file', $dataArray);
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

		}else{
			$this->db->insert('tbl_staff_file', $dataArray);
		}
	}

	public function insertUpdateStaffGalleryEntry($dataArray)
	{

		$this->db->select("staff_gallery_file_id,staff_id,galleryname");
		$this->db->from('tbl_staff_gallery_file');
		$this->db->where('staff_id', $dataArray['staff_id']);
		$query = $this->db->get();
		$result = $query->row_array();

		$imageUrl    = $this->config->item('staff_gallery').$result['galleryname'];

		if(! empty($result)){
			$this->db->where('staff_id', $dataArray['staff_id']);
			$staffData  =  $this->db->update('tbl_staff_gallery_file', $dataArray);
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

		}else{
			$this->db->insert('tbl_staff_gallery_file', $dataArray);
		}
	}

	function getStaffDD($data)
	{
		$this->db->select("ts.staff_id as id,CONCAT(ts.first_name,' ',ts.last_name) as text");
		$this->db->from('tbl_staff as ts');
		$this->db->where('ts.is_active',1);
		$this->db->where_in("business_id", $data['business_id']);
		if($data['business_id'] == ''){
			$result['result'] = array ( array ( 'id' => 0 , 'text' => 'First Select Business...' ));
		} else {
			if (isset($data['filter_param']) && $data['filter_param'] != '') {
				$this->db->like("CONCAT(ts.first_name,' ',ts.last_name)", $data['filter_param'], 'both');
			}
			$query = $this->db->get();
			$result['result'] = $query->result_array();
		}
		return json_encode($result);
	}

	public function getStaffListing($data = '')
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('staff_image');
		//$galleryPath = IMAGE_DIR_URL . $this->config->item('staff_gallery');
		$limit = DATA_LIMIT;
		$this->db->select("ts.staff_id,tb.business_id,ts.first_name,ts.last_name,ts.position,ts.contact_no,ts.status,ts.is_active");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tsf.filename),"") as staff_image_path');
		//$this->db->select('COALESCE(CONCAT("' . $galleryPath . '",tsgf.galleryname),"") as staff_gallery_path');
		$this->db->from('tbl_staff as ts');
		$this->db->join('tbl_staff_file as tsf','tsf.staff_id = ts.staff_id','left');
		//$this->db->join('tbl_staff_gallery_file as tsgf','tsgf.staff_id = ts.staff_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = ts.business_id','left');
		if (isset($data['business_id'])) {
			$this->db->where('ts.business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('staff_id','ASC');
        return $this->db->get()->result_array();
	}

	public function getStaffGalleryById($staffId)
    {	$imagePath = IMAGE_DIR_URL . $this->config->item('staff_gallery');
        $this->db->select('staff_gallery_file_id as image_id,CONCAT("'.$imagePath.'",galleryname) as uri');
        $this->db->from('tbl_staff_gallery_file');
        $this->db->where_in('staff_id',$staffId);
        return $this->db->get()->result_array();
    }
}
