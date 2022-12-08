<?php


class Mdl_booking extends DT_CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($bookingId)
	{

		//$staffId = explode(',',$staffId);
		$tables = array('tbl_booking','tbl_booking_file');
		$this->db->where_in('booking_id',$bookingId);
		$this->db->delete($tables);

		$ids = is_array($bookingId) ? implode(',',$bookingId) : $bookingId;
		$response = array();
		if ($this->db->affected_rows()) {
			$response['success'] = "true";
		}
		return $response;
    }

    public function getBookingData($bookingId)
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('client_image');
        $this->db->select("tb.booking_id,tbs.business_id,tbs.business_name,tb.client_name,tsf.service_id,tsf.service_name,ts.staff_id,CONCAT(ts.first_name,' ',ts.last_name) as staff_name,tb.status,
        date_format(tb.booking_date,'" . DATE_FORMATE_MYSQL . "') as booking_date");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tbf.filename),"") as client_image');
		$this->db->from('tbl_booking as tb');
		$this->db->join('tbl_booking_file as tbf','tbf.booking_id = tb.booking_id','left');
        $this->db->join('tbl_staff as ts','ts.staff_id = tb.staff_id','left');
		$this->db->join('tbl_service as tsf','tsf.service_id = tb.service_id','left');
		$this->db->join('tbl_business as tbs','tbs.business_id = tb.business_id','left');
		$this->db->where('tb.booking_id', $bookingId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
    }
    
    public function getImage($bookingId)
	{
		$this->db->select("booking_file_id,booking_id,filename");
		$this->db->from('tbl_booking_file');
		$this->db->where_in('booking_id', $bookingId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

    }
    
    public function deleteClientImageEntry($imageId)
	{
		$this->db->where('booking_file_id', $imageId);
		$this->db->delete('tbl_booking_file');

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

		$this->db->select("booking_file_id,booking_id,filename");
		$this->db->from('tbl_booking_file');
		$this->db->where('booking_id', $dataArray['booking_id']);
		$query = $this->db->get();
		$result = $query->row_array();

		$imageUrl    = $this->config->item('client_image').$result['filename'];

		if(! empty($result)){
			$this->db->where('booking_id', $dataArray['booking_id']);
			$staffData  =  $this->db->update('tbl_booking_file', $dataArray);
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

		}else{
			$this->db->insert('tbl_booking_file', $dataArray);
		}
	}

	public function getBookingListing($data = '')
	{
		$imagePath = IMAGE_DIR_URL . $this->config->item('client_image');
		$limit = DATA_LIMIT;
		$this->db->select("tb.booking_id,tbs.business_id,tb.client_name,ts.service_id,ts.service_name,tb.booking_date,tsf.staff_id,CONCAT(tsf.first_name,' ',tsf.last_name) as staff_name,
		ts.status");
		$this->db->select('COALESCE(CONCAT("' . $imagePath . '",tbf.filename),"") as client_image');
		$this->db->from('tbl_booking as tb');
		$this->db->join('tbl_booking_file as tbf','tbf.booking_id = tb.booking_id','left');
		$this->db->join('tbl_service as ts','ts.service_id = tb.service_id','left');
		$this->db->join('tbl_staff as tsf','tsf.staff_id = tb.staff_id','left');
		$this->db->join('tbl_business as tbs','tbs.business_id = tb.business_id','left');
		if (isset($data['business_id'])) {
			$this->db->where('tb.business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('booking_id','ASC');
        return $this->db->get()->result_array();
	}
}