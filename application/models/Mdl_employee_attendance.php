<?php


class Mdl_employee_attendance extends DT_CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function deleteRecord($employeeId = '')
	{
		$tables = array('tbl_student_attendance');
        $this->db->where_in('student_attendance_id',$employeeId);
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
        $this->db->select("tsa.student_attendance_id,ts.student_id,CONCAT(ts.first_name,'',ts.last_name) as emp_name,
        tsa.logout_time,
		tsa.login_time,
		tsa.logout_time,
		date_format(tsa.attendance_date,'" . DATE_FORMATE_MYSQL . "') as attendance_date");
        $this->db->from('tbl_student_attendance as tsa');
        $this->db->join('tbl_student as ts','tsa.student_id = ts.student_id','left');
		$this->db->where('tsa.student_attendance_id', $employeeId);
		$query = $this->db->get();
		$queryData = $query->row_array();
		return $queryData;
	}
}


