<?php


class Mdl_gallery extends DT_CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
    }
    
    public function deleteRecord($galleryId)
	{
		$tables = array('tbl_gallery','tbl_gallery_file');
		$this->db->where_in('gallery_id',$galleryId);
		$this->db->delete($tables);

		$ids = is_array($galleryId) ? implode(',',$galleryId) : $galleryId;
		$response = array();
		if ($this->db->affected_rows()) {
			$response['success'] = "true";
		}
		return $response;
    }
    
    public function getGalleryData($galleryId)
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('gallery_path');
		$this->db->select("tg.gallery_id,tg.gallery_name,tg.product_name,tg.status,ts.staff_id,CONCAT(ts.first_name,' ',ts.last_name) as staff_name,
		tsf.service_id,tsf.service_name,tb.business_id,tb.business_name");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tgf.filename),"") as gallery_image');
		$this->db->from('tbl_gallery as tg');
		$this->db->join('tbl_gallery_file as tgf','tgf.gallery_id = tg.gallery_id','left');
		$this->db->join('tbl_service as tsf','tsf.service_id = tg.service_id','left');
		$this->db->join('tbl_staff as ts','ts.staff_id = tg.staff_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = tg.business_id','left');
		$this->db->where('tg.gallery_id', $galleryId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
    }
    
    public function getImage($galleryId)
	{
		$this->db->select("gallery_file_id,gallery_id,filename");
		$this->db->from('tbl_gallery_file');
		$this->db->where_in('gallery_id', $galleryId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

    }
    
    public function deleteStaffImageEntry($imageId)
	{
		$this->db->where('gallery_file_id', $imageId);
		$this->db->delete('tbl_gallery_file');

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

		$this->db->select("gallery_file_id,gallery_id,filename");
		$this->db->from('tbl_gallery_file');
		$this->db->where('gallery_id', $dataArray['gallery_id']);
		$query = $this->db->get();
		$result = $query->row_array();

		$imageUrl    = $this->config->item('gallery_path').$result['filename'];

		if(! empty($result)){
			$this->db->where('gallery_id', $dataArray['gallery_id']);
			$staffData  =  $this->db->update('tbl_gallery_file', $dataArray);
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

		}else{
			$this->db->insert('tbl_gallery_file', $dataArray);
		}
	}
	
	public function getGalleryListing($data = '')
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('gallery_path');
		$limit = DATA_LIMIT;
		$this->db->select("tg.gallery_id,tg.gallery_name,tg.product_name,ts.service_id,ts.service_name,tb.business_id,
		ts.service_name,tg.status,tsf.staff_id,CONCAT(tsf.first_name,' ',tsf.last_name) as staff_name");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tgf.filename),"") as gallery_image_path');
		$this->db->from('tbl_gallery as tg');
		$this->db->join('tbl_gallery_file as tgf','tgf.gallery_id = tg.gallery_id','left');
		$this->db->join('tbl_business as tb','tb.business_id = tg.business_id','left');
		$this->db->join('tbl_staff as tsf','tsf.staff_id = tg.staff_id','left');
		$this->db->join('tbl_service as ts','ts.service_id = tg.service_id','left');
		if (isset($data['business_id'])) {
			$this->db->where('tb.business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('staff_id','ASC');
        return $this->db->get()->result_array();
	}

}    
