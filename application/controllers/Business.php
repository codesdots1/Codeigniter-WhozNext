<?php

class Business extends DT_CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_employee","Ion_auth_model"));
		$this->lang->load('customer_group');
	}

	public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "employee/v_employee", $data);
	}

	public function getEmployeeListing()
	{
		$this->load->library('datatables');
		$this->datatables->select("tb.business_id,tb.business_name,tb.description,tb.address");
		$this->datatables->from("tbl_business as tb");
		echo $this->datatables->generate();
	}

	public function manage($employeeId = '')
	{
		$data['extra_js'] = array(
			"../ckeditor/ckeditor.js",
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
			'bookingMonth' 		    => true,
			'cancellationPolicy'    => true,
			'bookingIntervals' 		=> true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if ($employeeId != '') {
			$data['getEmployeeData'] = $this->Mdl_employee->getEmployeeData($employeeId);
//			printArray($data['getEmployeeData'],1);
		}
		$this->dt_ci_template->load("default", "employee/v_employee_manage", $data);
	}

	public function delete()
	{
		$employeeId = $this->input->post('deleteId', TRUE);
		$employeeData = $this->Mdl_employee->deleteRecord($employeeId);

		if ($employeeData) {
			$response['success'] = true;
			$response['msg'] = sprintf($this->lang->line('delete_record'), BUSINESS);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'), BUSINESS);
		}
		echo json_encode($response);
	}

	public function save()
	{
		$employeeId 				= $this->input->post('business_id', TRUE);
		$businessName 				= $this->input->post('business_name', TRUE);
		$description 				= $this->input->post('description', TRUE);
		$address 					= $this->input->post('address', TRUE);
		$telephone 					= $this->input->post('telephone', TRUE);
		$mobileNo 					= $this->input->post('mobile_no', TRUE);
		$email 						= $this->input->post('email', TRUE);
		$userName 					= $this->input->post('username', TRUE);
		$password 					= $this->input->post('password', TRUE);
		$website 					= $this->input->post('website', TRUE);
		$instagramLink 				= $this->input->post('instagram_link', TRUE);
		$facebookLink 				= $this->input->post('facebook_link', TRUE);
		$twitterLink 				= $this->input->post('twitter_link', TRUE);
		$daysName					= $this->input->post('days_name', TRUE);
		$daysNameString 			= implode(',', $daysName);
		$advanceBooking 			= $this->input->post('advance_booking', TRUE);
		$bookingMonthId 			= $this->input->post('bookingMonthId', TRUE);
		$cancellationPolicyId 		= $this->input->post('cancellationPolicyId', TRUE);
		$bookingIntervals 		    = $this->input->post('booking_intervals', TRUE);
		$bookingConfirmation 		= $this->input->post('booking_confirmation', TRUE);
		
		if (isset($employeeId) && $employeeId == '') {
			$this->form_validation->set_rules('username', $this->lang->line('username'), 'required|[tbl_business.username]');
			$this->form_validation->set_rules('password', $this->lang->line('password'), 'required');
		} else {
			$this->form_validation->set_rules('username', $this->lang->line('username'), 'required|[tbl_business.username.' .$employeeId. ']');
		}
	

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('numeric', '%s Please Enter Only Number');
		$this->form_validation->set_message('is_unique', 'This %s Already Exists');
		$this->form_validation->set_message('edit_unique', 'This %s Already Exists');

		$this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
		$this->form_validation->set_rules('address', $this->lang->line('business_address'), 'required');
		$this->form_validation->set_rules('mobile_no', $this->lang->line('business_contact'), 'required');
		$this->form_validation->set_rules('telephone', $this->lang->line('business_contact'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
		$this->form_validation->set_rules('username', $this->lang->line('username'), 'required');

		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
		    //$password = $this->Ion_auth_model->hash_password($password);
		    if (isset($employeeId) && $employeeId == '') {
			    $businessArray = array(
    				'business_id' 				=> $employeeId,
    				'business_name' 			=> $businessName,
    				'description' 				=> $description,
    				'address' 					=> $address,
    				'telephone' 				=> $telephone,
    				'mobile_no' 				=> $mobileNo,
    				'email' 					=> $email,
    				'username' 					=> $userName,
    				'password' 					=> $password,
    				'website' 					=> $website,
    				'instagram_link' 			=> $instagramLink,
    				'facebook_link' 			=> $facebookLink,
    				'twitter_link' 				=> $twitterLink,
    				'days_name' 				=> $daysNameString,
    				'advance_booking' 			=> $advanceBooking,
    				'bookingMonthId' 		    => $bookingMonthId,
    				'cancellationPolicyId' 		=> $cancellationPolicyId,
    				'booking_intervals' 		=> $bookingIntervals,
    				'booking_confirmation' 		=> $bookingConfirmation,
			    );
		    } else {
		        $businessArray = array(
    				'business_id' 				=> $employeeId,
    				'business_name' 			=> $businessName,
    				'description' 				=> $description,
    				'address' 					=> $address,
    				'telephone' 				=> $telephone,
    				'mobile_no' 				=> $mobileNo,
    				'email' 					=> $email,
    				'username' 					=> $userName,
    				'website' 					=> $website,
    				'instagram_link' 			=> $instagramLink,
    				'facebook_link' 			=> $facebookLink,
    				'twitter_link' 				=> $twitterLink,
    				'days_name' 				=> $daysNameString,
    				'advance_booking' 			=> $advanceBooking,
    				'bookingMonthId' 		    => $bookingMonthId,
    				'cancellationPolicyId' 		=> $cancellationPolicyId,
    				'booking_intervals' 		=> $bookingIntervals,
    				'booking_confirmation' 		=> $bookingConfirmation,
			    );
		    }	    

			$employeeData = $this->Mdl_employee->insertUpdateRecord($businessArray, 'business_id', 'tbl_business', 1);

			if (isset($employeeId) && $employeeId != '') {
				if ($employeeData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), BUSINESS);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), BUSINESS);
				}
			} else {
				if ($employeeData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), BUSINESS);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), BUSINESS);
				}
			}
			echo json_encode($response);
		}
	}

	public function getBookingMonthsDD()
	{
		$bookingMonthId   = $this->input->post("bookingMonthId");
		$searchTerm  	  = $this->input->post("filter_param");

		$data = array('result' => array(
			
		array(
			"id"        => '1',
			"text"      => '1'),
		array(
			"id"        => '2',
			"text"      => '2'),
		array(
			"id"        => '3',
			"text"      => '3'),
		array(
			"id"        => '4',
			"text"      => '4'),
		array(
			"id"        => '5',
			"text"      => '5'),
		array(
			"id"        => '6',
			"text"      => '6'),
		array(
			"id"        => '7',
			"text"      => '7'),
		array(
			"id"        => '8',
			"text"      => '8'),
		array(
			"id"        => '9',
			"text"      => '9'),
		array(
			"id"        => '10',
			"text"      => '10'),
		array(
			"id"        => '11',
			"text"      => '11'),
		array(
			"id"        => '12',
			"text"      => '12'),	

		));

		echo json_encode($data); die;
	}

	public function getCancellationPolicyDD()
	{
		$cancellationPolicyId   = $this->input->post("cancellationPolicyId");
		$searchTerm  	  		= $this->input->post("filter_param");

		$data = array('result' => array(
			
		array(
			"id"        => '1',
			"text"      => '1'),
		array(
			"id"        => '2',
			"text"      => '2'),
		array(
			"id"        => '3',
			"text"      => '3'),
		array(
			"id"        => '4',
			"text"      => '4'),
		array(
			"id"        => '5',
			"text"      => '5'),
		array(
			"id"        => '6',
			"text"      => '6'),
		array(
			"id"        => '7',
			"text"      => '7'),
		array(
			"id"        => '8',
			"text"      => '8'),
		array(
			"id"        => '9',
			"text"      => '9'),
		array(
			"id"        => '10',
			"text"      => '10'),
		array(
			"id"        => '11',
			"text"      => '11'),
		array(
			"id"        => '12',
			"text"      => '12'),
		
		array(
			"id"        => '13',
			"text"      => '13'),
		array(
			"id"        => '14',
			"text"      => '14'),
		array(
			"id"        => '15',
			"text"      => '15'),
		array(
			"id"        => '16',
			"text"      => '16'),
		array(
			"id"        => '17',
			"text"      => '17'),
		array(
			"id"        => '18',
			"text"      => '18'),
		array(
			"id"        => '19',
			"text"      => '19'),
		array(
			"id"        => '20',
			"text"      => '20'),
		array(
			"id"        => '21',
			"text"      => '21'),
		array(
			"id"        => '22',
			"text"      => '22'),
		array(
			"id"        => '23',
			"text"      => '23'),
		array(
			"id"        => '24',
			"text"      => '24'),
		array(
			"id"        => '25',
			"text"      => '25'),
		array(
			"id"        => '26',
			"text"      => '26'),
		array(
			"id"        => '27',
			"text"      => '27'),
		array(
			"id"        => '28',
			"text"      => '28'),
		array(
			"id"        => '29',
			"text"      => '29'),
		array(
			"id"        => '30',
			"text"      => '30'),
		array(
			"id"        => '31',
			"text"      => '31')			
		));

		echo json_encode($data); die;
	}

	public function getbookingIntervalsDD()
	{
		$bookingIntervalsId   = $this->input->post("bookingIntervalsId");
		$searchTerm  	  		= $this->input->post("filter_param");

		$data = array('result' => array(
			
		array(
			"id"        => '1',
			"text"      => '1'),
		array(
			"id"        => '2',
			"text"      => '2'),
		array(
			"id"        => '3',
			"text"      => '3'),
		array(
			"id"        => '4',
			"text"      => '4'),
		array(
			"id"        => '5',
			"text"      => '5'),
		array(
			"id"        => '6',
			"text"      => '6'),
		array(
			"id"        => '7',
			"text"      => '7'),
		array(
			"id"        => '8',
			"text"      => '8'),
		array(
			"id"        => '9',
			"text"      => '9'),
		array(
			"id"        => '10',
			"text"      => '10'),
		array(
			"id"        => '11',
			"text"      => '11'),
		array(
			"id"        => '12',
			"text"      => '12'),
		
		array(
			"id"        => '13',
			"text"      => '13'),
		array(
			"id"        => '14',
			"text"      => '14'),
		array(
			"id"        => '15',
			"text"      => '15'),
		array(
			"id"        => '16',
			"text"      => '16'),
		array(
			"id"        => '17',
			"text"      => '17'),
		array(
			"id"        => '18',
			"text"      => '18'),
		array(
			"id"        => '19',
			"text"      => '19'),
		array(
			"id"        => '20',
			"text"      => '20'),
		array(
			"id"        => '21',
			"text"      => '21'),
		array(
			"id"        => '22',
			"text"      => '22'),
		array(
			"id"        => '23',
			"text"      => '23'),
		array(
			"id"        => '24',
			"text"      => '24'),
		array(
			"id"        => '25',
			"text"      => '25'),
		array(
			"id"        => '26',
			"text"      => '26'),
		array(
			"id"        => '27',
			"text"      => '27'),
		array(
			"id"        => '28',
			"text"      => '28'),
		array(
			"id"        => '29',
			"text"      => '29'),
		array(
			"id"        => '30',
			"text"      => '30'),
		array(
			"id"        => '31',
			"text"      => '31')			
		));

		echo json_encode($data); die;
	}
	
	public function getBusinessDD()
	{
		$businessId    = $this->input->post("business_id");
		$searchTerm      = $this->input->post("filter_param");

		$data = array(
			"business_id"  => $businessId,
			"filter_param"   => $searchTerm
		);
		echo $this->Mdl_employee->getBusinessDD($data);
	}
}
