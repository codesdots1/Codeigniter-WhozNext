<?php


class Mdl_employee extends DT_CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($employeeId = '')
	{
		$tables = array('tbl_business');
        $this->db->where_in('business_id',$employeeId);
        $this->db->delete($tables);

        $ids = is_array($employeeId) ? implode(',',$employeeId) : $employeeId;
		$response = array();
        if ($this->db->affected_rows()) {
            $response['success'] = "true";
        }
		return $response;

	}

	public function getEmployeeData($employeeId)
	{
		$this->db->select("tb.business_id,tb.business_name,tb.description,tb.address,tb.telephone,tb.mobile_no,tb.email,
		tb.password,tb.username,tb.website,
		tb.instagram_link,tb.facebook_link,tb.twitter_link,tb.days_name,
		tb.advance_booking,tb.bookingMonthId,tb.cancellationPolicyId,tb.booking_intervals,tb.booking_confirmation");
		$this->db->from('tbl_business as tb');
		$this->db->where('tb.business_id', $employeeId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
	}

    public function getBusinessListing($data = '')
	{
		$limit = DATA_LIMIT;
		$this->db->select("business_name,description,address,telephone,mobile_no,email,username,website,
		instagram_link,facebook_link,twitter_link,days_name,advance_booking,bookingMonthId,cancellationPolicyId,
		booking_intervals,booking_confirmation,auth_token,auth_token_validity");
		$this->db->from('tbl_business');
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('business_id','ASC');
        return $this->db->get()->result_array();
	}
	
	public function getBusinessInformation($data = '')
	{
		$limit = DATA_LIMIT;
		$this->db->select("business_id,business_name,description,address,telephone,mobile_no,email,username,website,
		instagram_link,facebook_link,twitter_link,days_name,advance_booking,bookingMonthId,cancellationPolicyId,
		date_format(booking_intervals,'%H:%i') as booking_intervals,booking_confirmation,auth_token,auth_token_validity");
		$this->db->from('tbl_business');
		if (isset($data['business_id'])) {
			$this->db->where('business_id',$data['business_id']);
		}
        return $this->db->get()->row_array();
	}
	
	
	public function getLoginData($data = '')
	{
		$this->db->select("tb.business_id");
		$this->db->from('tbl_business as tb');
		$this->db->where('tb.username',$data['username']);
		$this->db->where('tb.password',$data['password']);
        return $this->db->get()->row_array();
	}
	
	public function getBusiness($data = '')
	{
		$limit = DATA_LIMIT;
		$this->db->select("*");
		$this->db->from('tbl_business');
		if (isset($data['business_id'])) {
			$this->db->where('business_id',$data['business_id']);
		}
		if (isset($data['start']) && $data['start'] != '') {
			$this->db->limit($limit, $data['start'] * $limit);
		}
        $this->db->order_by('business_id','ASC');
        return $this->db->get()->result_array();
	}

	public function updateAuthToken($businessId, $authTokenData)
	{
		$this->db->where('business_id', $businessId);
		$query = $this->db->update('tbl_business', $authTokenData);
		if ($query == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getBusinessTokenData($businessId,$authToken)
    {
        $this->db->select('*');
        $this->db->from('tbl_business');
        $this->db->where('business_id', $businessId);
        $this->db->where('auth_token', $authToken);
		$result = $this->db->get()->row_array();
        return $result;
    }
    
    function getBusinessDD($data)
	{
		$this->db->select("tb.business_id as id,tb.business_name as text");
		$this->db->from('tbl_business as tb');
		if (isset($data['filter_param']) && $data['filter_param'] != '') {
			$this->db->like("tb.business_name", $data['filter_param'], 'both');
		}
		$query = $this->db->get();
		$result['result'] = $query->result_array();
		return json_encode($result);
	}
    
    
}


