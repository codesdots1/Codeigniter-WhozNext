<?php
class EmployeeAttendance extends DT_CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_employee_attendance"));
		$this->lang->load('customer');
    }
    
    public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "employeeAttandance/v_employee_attendance", $data);
    }
    
    public function getEmployeeAttendanceListing()
	{
		$this->load->library('datatables');
        $this->datatables->select("tsa.student_attendance_id,CONCAT(ts.first_name,'',ts.last_name)emp_name,
        date_format(tsa.login_time,'".PHP_TIME_MYSQL_FORMAT."') as login_time,
        date_format(tsa.logout_time,'".PHP_TIME_MYSQL_FORMAT."') as logout_time,
        date_format(tsa.attendance_date,'".DATE_FORMATE_MYSQL."') as attendance_date");
        $this->datatables->from("tbl_student_attendance as tsa");
		$this->datatables->join("tbl_student as ts","ts.student_id = ts.student_id","left");
		echo $this->datatables->generate();
    }
    
    public function manage($employeeAttandanceId = '')
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/selects/select2.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/pages/form_layouts.js",
			"js/plugins/forms/jquery.form.min.js",
			"js/plugins/ui/moment/moment.min.js",
			"js/plugins/pickers/anytime.min.js",
			"js/core/libraries/jquery_ui/widgets.min.js",
			"js/plugins/media/fancybox.min.js",
			"js/pages/gallery.js",
			"js/additional-methods.min.js",
		);

		$select2 = array(
			'student' 			 =>true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if($employeeAttandanceId != '') {
			$data['getEmployeeData']    = $this->Mdl_employee_attendance->getEmployeeData($employeeAttandanceId);
		}
		$this->dt_ci_template->load("default", "employeeAttandance/v_employee_attendance_manage",$data);
    }

    public function delete()
    {
		$employeeId     = $this->input->post('deleteId',TRUE);
        $employeeData   = $this->Mdl_employee_attendance->deleteRecord($employeeId);
        
		if ($employeeData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),EMPLOYEE);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'),EMPLOYEE);
		}
		echo json_encode($response);
	}

    public function save()
	{
        $employeeAttendanceId 	= $this->input->post('student_attendance_id', TRUE);
        $employeeId 			= $this->input->post('student_id', TRUE);
        $loginTime   			  = $this->input->post('login_time', TRUE);
		$logoutTime     	   	  = $this->input->post('logout_time', TRUE);
		$attendanceDate  		  = $this->input->post('attendance_date', TRUE);
		

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('numeric', '%s Please Enter Only Number');
		$this->form_validation->set_message('is_unique', 'This %s Already Exists');
        $this->form_validation->set_message('edit_unique', 'This %s Already Exists');
        
		$this->form_validation->set_rules('student_id', $this->lang->line('student'), 'required');
		$this->form_validation->set_rules('login_time', $this->lang->line('login'), 'required');
		$this->form_validation->set_rules('logout_time', $this->lang->line('logout'), 'required');
		$this->form_validation->set_rules('attendance_date', $this->lang->line('date'), 'required');
		
        
        if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
			//if (isset($employeeId) && $employeeId == '') {
                $employeeArray = array(
                    'student_attendance_id' => $employeeAttendanceId,
					'student_id' =>$employeeId,
					'login_time' =>$loginTime,
                    'logout_time' => $logoutTime,
                    'attendance_date' =>DMYToYMD($attendanceDate),
                );
            //}
        
			$employeeData = $this->Mdl_employee_attendance->insertUpdateRecord($employeeArray, 'student_attendance_id', 'tbl_student_attendance', 1);
			
            if (isset($employeeAttandanceId) && $employeeAttandanceId != '') {
				if ($employeeData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), EMPLOYEE);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), EMPLOYEE);
				}
			} else {
				if ($employeeData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), EMPLOYEE);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), EMPLOYEE);
				}
			}
			echo json_encode($response);
		}
	}
}