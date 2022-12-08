<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class WhozNxtWebService extends REST_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            "Mdl_employee",
            "Mdl_whoz_nxt_webservice",
			"Mdl_categories",
			"Mdl_staff",
			"Mdl_service",
            "Mdl_booking",
            "Mdl_gallery",
        ));
    }

    public function addEditBusiness_post()
	{
		$this->db->trans_begin();
		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('telephone', 'Telephone', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'required');
        $this->form_validation->set_rules('website', 'Webiste', 'required');
        $this->form_validation->set_rules('instagram_link', 'Instagram Link', 'required');
        $this->form_validation->set_rules('facebook_link', 'Facebook Link', 'required');
        $this->form_validation->set_rules('twitter_link', 'Twitter Link', 'required');
        $this->form_validation->set_rules('days_name[]', 'Days Name', 'required');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$employeeId 				= $this->input->post('business_id', TRUE);
		$businessName 				= $this->input->post('business_name', TRUE);
		$description 				= $this->input->post('description', TRUE);
		$address 					= $this->input->post('address', TRUE);
		$telephone 					= $this->input->post('telephone', TRUE);
		$mobileNo 					= $this->input->post('mobile_no', TRUE);
		$email 						= $this->input->post('email', TRUE);
		$website 					= $this->input->post('website', TRUE);
		$instagramLink 				= $this->input->post('instagram_link', TRUE);
		$facebookLink 				= $this->input->post('facebook_link', TRUE);
		$twitterLink 				= $this->input->post('twitter_link', TRUE);
		$daysName					= $this->input->post('days_name', TRUE);

		$businessArray = array(
            'business_id' 				=> $employeeId,
            'business_name' 			=> $businessName,
            'description' 				=> $description,
            'address' 					=> $address,
            'telephone' 				=> $telephone,
            'mobile_no' 				=> $mobileNo,
			'email' 					=> $email,
            'website' 					=> $website,
            'instagram_link' 			=> $instagramLink,
            'facebook_link' 			=> $facebookLink,
            'twitter_link' 				=> $twitterLink,
            'days_name' 				=> $daysName,
        );
		if ((isset($employeeId) && $employeeId != '')) {
			$successMessage = 'Business updated successfully';
			$errorMessage = 'Need to Update Business';
		} else {
			unset($businessArray['business_id']);
			$successMessage = 'Business inserted successfully';
			$errorMessage = 'Business insert unsuccessful';
		}
		$businessData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($businessArray, 'business_id', 'tbl_business', 1);

		if ($businessData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
    
    public function addEditBookingPreferences_post()
	{
		$this->db->trans_begin();
		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
        $this->form_validation->set_rules('advance_booking', 'Advance Booking', 'required');
        $this->form_validation->set_rules('bookingMonthId', 'Booking Month ', 'required');
        $this->form_validation->set_rules('cancellationPolicyId', 'Cancellation Policy', 'required');
        $this->form_validation->set_rules('booking_intervals', 'Booking Intervals', 'required');
        $this->form_validation->set_rules('booking_confirmation', 'Booking Confrimation', 'required');

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$businessId 				= $this->input->post('business_id', TRUE);
		$advanceBooking 			= $this->input->post('advance_booking', TRUE);
		$bookingMonthId 			= $this->input->post('bookingMonthId', TRUE);
		$cancellationPolicyId 		= $this->input->post('cancellationPolicyId', TRUE);
		$bookingIntervals 		    = $this->input->post('booking_intervals', TRUE);
		$bookingConfirmation 		= $this->input->post('booking_confirmation', TRUE);
	
		$businessPreferencesArray = array(
            'business_id' 				=> $businessId,
            'advance_booking' 			=> $advanceBooking,
    		'bookingMonthId' 		    => $bookingMonthId,
    		'cancellationPolicyId' 		=> $cancellationPolicyId,
    		'booking_intervals' 		=> $bookingIntervals,
    		'booking_confirmation' 		=> $bookingConfirmation,

        );
		if ((isset($businessId) && $businessId != '')) {
			$successMessage = 'Booking Preferences updated successfully';
			$errorMessage = 'Need to Update Booking Preferences';
		} else {
			unset($businessPreferencesArray['business_id']);
			$successMessage = 'BookingPreferences inserted successfully';
			$errorMessage = 'BookingPreferences insert unsuccessful';
		}
		$businessPreferencesData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($businessPreferencesArray, 'business_id', 'tbl_business', 1);

		if ($businessPreferencesData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
    
    public function getBusinessInfo_post()
    {
        $businessId = $this->input->post('business_id');
        $businessDataArray = array(
            'business_id' => $businessId
        );
        $businessData = $this->Mdl_employee->getBusinessInformation($businessDataArray);
        if (!empty($businessData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Business Information successfully',
                'data'          => $businessData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
                "data"          => $businessData,
            ), REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function getBusinessList_post()
    {
        $start = $this->input->post('start');
        $start = ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
        $businessDataArray = array(
            'start' => $start
        );
        $businessData = $this->Mdl_employee->getBusinessListing($businessDataArray);
        if (!empty($businessData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Business Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $businessData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
                'limit'         => DATA_LIMIT,
                "data"          => $businessData,
            ), REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function deleteBusiness_post()
	{
		$employeeId = $this->input->post('business_id');
		
		$this->form_validation->set_rules('business_id', 'Business Id', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('integer', '%s should be integer');

		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status"        => FALSE,
				"message"       => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data"          => [],
				'responseCode'  => self::HTTP_OK,
			), REST_Controller::HTTP_OK);
		}
	   	
		$businessData = $this->Mdl_employee->deleteRecord($employeeId);
		

		if ($businessData['success'] == "true") {
			$this->response(array(
				'status'        => TRUE,
				'responseCode'  => self::HTTP_OK,
				"message"       => 'Business Deleted successfully',
				'limit'         => DATA_LIMIT,
				'data'          => $businessData,
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"status"        => FALSE,
				'responseCode'  => self::HTTP_OK,
				'message'       => "Business Failed to delete",
				'limit'         => DATA_LIMIT,
			), REST_Controller::HTTP_OK);
		}
	}
	
	public function addEditCategories_post()
	{
	    $this->db->trans_begin();
	    
		$this->form_validation->set_rules('categories_id ', 'Categories Id', 'integer');
		$this->form_validation->set_rules('business_id ', 'Business Id', 'integer');
        $this->form_validation->set_rules('categories_name', 'Categories Name', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'integer');
        
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
        if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$categoriesId 				= $this->input->post('categories_id', TRUE);
		$businessId 				= $this->input->post('business_id', TRUE);
		$categoriesName 			= $this->input->post('categories_name', TRUE);
		$isActive 			 	    = $this->input->post('is_active', TRUE);
		
		$categoriesArray = array(
			'categories_id' 	=> $categoriesId,
			'business_id' 		=> $businessId,
            'categories_name' 	=> $categoriesName,
            'is_active' 		=> $isActive,
        );
        if ((isset($categoriesId) && $categoriesId != '')) {
			$successMessage = 'Categories updated successfully';
			$errorMessage = 'No data found';
		} else {
			unset($categoriesArray['categories_id']);
			$successMessage = 'Categories inserted successfully';
			$errorMessage = 'Categories insert unsuccessful';
		}
		
		$categoriesData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($categoriesArray, 'categories_id', 'tbl_categories', 1);
		
		if ($categoriesData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	public function addEditCategoriesStatus_post()
	{
	    $this->db->trans_begin();
	    
		$this->form_validation->set_rules('categories_id ', 'Categories Id', 'integer');
		$this->form_validation->set_rules('business_id ', 'Business Id', 'integer');
        $this->form_validation->set_rules('is_active', 'Is Active', 'integer');
        
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
        if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$categoriesId 				= $this->input->post('categories_id', TRUE);
		$businessId 				= $this->input->post('business_id', TRUE);
		$isActive 			 	    = $this->input->post('is_active', TRUE);
		
		$categoriesStatusArray = array(
			'categories_id' 	=> $categoriesId,
			'business_id' 		=> $businessId,
            'is_active' 		=> $isActive,
        );
        if ((isset($categoriesId) && $categoriesId != '')) {
			$successMessage = 'Categories Status Updated successfully';
			$errorMessage = 'No data found';
		}
		
		$categoriesStatusData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($categoriesStatusArray, 'categories_id', 'tbl_categories', 1);
		
		if ($categoriesStatusData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	public function getCategoriesList_post()
    {
        $start = $this->input->post('start');
        $businessId = $this->input->post('business_id');
        $start = ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
       
        $categoriesDataArray = array(
            'start' => $start,
            'business_id' => $businessId
        );
        
        $categoriesData = $this->Mdl_categories->getCategoriesListing($categoriesDataArray);
        
        if (!empty($categoriesData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Categories Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $categoriesData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
            ), REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function deleteCategories_post()
	{
		$categoriesId = $this->input->post('categories_id');
		
		$this->form_validation->set_rules('categories_id', 'Categories Id', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('integer', '%s should be integer');

		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status"        => FALSE,
				"message"       => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data"          => [],
				'responseCode'  => self::HTTP_OK,
			), REST_Controller::HTTP_OK);
		}
	   	
		$categoriesData = $this->Mdl_categories->deleteRecord($categoriesId);
		//printArray($categoriesData,1);

		if ($categoriesData['success'] == "true") {
			$this->response(array(
				'status'        => TRUE,
				'responseCode'  => self::HTTP_OK,
				"message"       => 'Categories Deleted successfully',
				'data'          => $categoriesData,
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"status"        => FALSE,
				'responseCode'  => self::HTTP_OK,
				'message'       => "Categories Failed to delete",
			), REST_Controller::HTTP_OK);
		}
	}
	
	public function login_post()
    {
        $this->form_validation->set_rules('username ', 'Username', 'integer');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('device_token ', 'Device Token', 'required');
        $this->form_validation->set_rules('device_type', 'Device Type', 'required');
        
        $userName  = $this->input->post('username');
		$password 	= $this->input->post('password');
		$deviceToken  = $this->input->post('device_token');
		$deviceType   = $this->input->post('device_type');
		$businessId = $this->input->post('business_id');
		
		$getAuthToken       = GenRandomAlphaNumeric(20);
        $lastDay            = strtotime("+3 months", strtotime(date('Y-m-d')));
        $AuthTokenValidity  = date('Y-m-d', $lastDay);
        $updateAuthTokenArray = array(
            'auth_token'          => $getAuthToken,
            'auth_token_validity' => $AuthTokenValidity
        );
		
		$updatedAuthToken = $this->Mdl_employee->updateAuthToken($businessId, $updateAuthTokenArray);
		
		
		$loginArray = array(
			'username' => $userName,
			'password' => $password
		);

		$loginData = $this->Mdl_employee->getLoginData($loginArray);
		
		$deviceTokenArray = array(
			'business_id' 	=> $loginData['business_id'],
			'device_token' 	=> $deviceToken,
			'device_type' 	=> $deviceType
		);

		$deviceData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($deviceTokenArray, 'business_id', 'tbl_business', 1);
        
        if (!empty($loginData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
				"message"       => 'Login  Successfully',
				"data"			=> $loginData
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "Login  Unsuccessfully",
            ), REST_Controller::HTTP_NOT_FOUND);
        }
	}
	
	public function getStaffList_post()
    {
		$start 		= $this->input->post('start');
		$businessId = $this->input->post('business_id');
        $start 		= ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
       
        $staffDataArray = array(
			'start' 	  => $start,
			'business_id' => $businessId,
        );
        
		$staffData = $this->Mdl_staff->getStaffListing($staffDataArray);
		foreach($staffData as $key => $value){
			$staffGalleryData = $this->Mdl_staff->getStaffGalleryById($value['staff_id']);
			$gallery = array();
			foreach($staffGalleryData as $keyGallery => $valueGallery){
				array_push($gallery,$valueGallery);
			}
			$staffStatusData[$key]['staff_gallery_path'] = $gallery;
		}
        
        if (!empty($staffData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Staff Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $staffData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
            ), REST_Controller::HTTP_NOT_FOUND);
        }
	}
    
    public function deleteStaff_post()
	{
		$staffId = $this->input->post('staff_id');
		
		$this->form_validation->set_rules('staff_id', 'Staff Id', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('integer', '%s should be integer');

		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status"        => FALSE,
				"message"       => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data"          => [],
				'responseCode'  => self::HTTP_OK,
			), REST_Controller::HTTP_OK);
		}
	   	
		$staffData = $this->Mdl_staff->deleteRecord($staffId);
		

		if ($staffData['success'] == "true") {
			$this->response(array(
				'status'        => TRUE,
				'responseCode'  => self::HTTP_OK,
				"message"       => 'Staff Deleted successfully',
				'limit'         => DATA_LIMIT,
				'data'          => $staffData,
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"status"        => FALSE,
				'responseCode'  => self::HTTP_OK,
				'message'       => "Staff Failed to delete",
				'limit'         => DATA_LIMIT,
			), REST_Controller::HTTP_OK);
		}
	}
	
	public function addEditStaff_post()
	{
		$this->db->trans_begin();
// 		$this->form_validation->set_rules('staff_id', 'Staff Id', 'integer');
// 		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
//         $this->form_validation->set_rules('first_name', 'First Name', 'required');
//         $this->form_validation->set_rules('last_name', 'Last Name', 'required');
// 		$this->form_validation->set_rules('position', 'Position', 'required');
// 		$this->form_validation->set_rules('biography', 'Biography', 'required');
//         $this->form_validation->set_rules('contact_no', 'Business Name', 'integer');
//         $this->form_validation->set_rules('status', 'Business Name', 'integer');
//         $this->form_validation->set_rules('is_active', 'Active', 'required');
//         $this->form_validation->set_message('required', '%s is required');
//         $this->form_validation->set_message('integer', '%s should be numeric');
// 		if ($this->form_validation->run() === FALSE) {
// 			$strip_message = strip_tags(validation_errors(""));
// 			$this->response(array(
// 				"status" => FALSE,
// 				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
// 				"data" => null,
// 				'responseCode' => self::HTTP_BAD_REQUEST,
// 			), REST_Controller::HTTP_BAD_REQUEST);
// 		}
		
		
		$staffValueArray = array();
		foreach($_POST as $key => $staffValue){
            $staffValueArray[$key] = $staffValue;
		}
		//exit();
		
 		$staffId				= $this->input->post('staff_id', TRUE);
// 		$businessId				= $this->input->post('business_id', TRUE);
// 		$firstName 				= $this->input->post('first_name', TRUE);
// 		$surName 				= $this->input->post('last_name', TRUE);
// 		$position 				= $this->input->post('position', TRUE);
// 		$contactNo 				= $this->input->post('contact_no', TRUE);
// 		$biography 				= $this->input->post('biography', TRUE);
// 		$isBooking    		    = $this->input->post('status', TRUE);
// 		$isActive    			= $this->input->post('is_active', TRUE);

// 		$staffArray = array(
// 			'staff_id'	 	=> $staffId,
// 			'business_id'	=> $businessId,
// 			'first_name' 	=> $firstName,
// 			'last_name'	 	=> $surName,
// 			'position' 		=> $position,
// 			'contact_no' 	=> $contactNo,
// 			'biography' 	=> $biography,
// 			'status' 		=> isset($isBooking) ? 1 : 0,
// 			'is_active' 	=> isset($isActive) ? 1 : 0,
// 		);
		if ((isset($staffId) && $staffId != '')) {
			$successMessage = 'Staff updated successfully';
			$errorMessage = 'Need To Change Staff Details';
		} else {
			unset($staffValueArray['staff_id']);
			$successMessage = 'Staff inserted successfully';
			$errorMessage = 'Staff insert unsuccessful';
		}
		$staffData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($staffValueArray, 'staff_id', 'tbl_staff', 1);
		// printArray($staffData ,1);
		$lastStaffId = $staffData['lastInsertedId'];
		if (isset($lastStaffId) && $lastStaffId != '') {
			if ($staffData['success']) {
				if (isset($_FILES['filename'])) {
					$memberImagePath = $this->config->item('staff_image');
					$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
					if ($imageResult['success'] == false) {
						$this->response(array(
							'status'        => FALSE,
							'responseCode'  => self::HTTP_OK,
							'message'       => strip_tags($imageResult['msg']),
						), REST_Controller::HTTP_OK);
					} else {
						unset($imageResult['success']);
						$batchArray = array(
							'staff_id' 	=> $lastStaffId,
							'filename'  => $imageResult['file_name'],
						);
						$this->Mdl_staff->insertUpdateStaffImageEntry($batchArray);
					}
				}
			}
		}

		$lastStaffId = $staffData['lastInsertedId'];
		if (isset($lastStaffId) && $lastStaffId != '') {
			if ($staffData['success']) {
				if (isset($_FILES['galleryname'])) {
					$memberImagePath = $this->config->item('staff_gallery');
					$imageResult = $this->dt_ci_file_upload->UploadMultipleFile('galleryname', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
					if ($imageResult['success'] == false) {
						$this->response(array(
							'status'        => FALSE,
							'responseCode'  => self::HTTP_OK,
							'message'       => strip_tags($imageResult['msg']),
						), REST_Controller::HTTP_OK);
					} else {
						unset($imageResult['success']);
						$batchArray = array();
						foreach ($imageResult as $key => $data) {
							$batchArray[] = array(
								'staff_id' 		=> $lastStaffId,
								'galleryname'   => $data['file_name'],
							);
						}
						$this->db->insert_batch('tbl_staff_gallery_file',$batchArray);
					}
				} 
			}
		}

		if ($staffData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
    
    public function updateBookingStatus_post()
	{
	    $this->db->trans_begin();
	    
		$this->form_validation->set_rules('staff_id ', 'Staff Id', 'integer');
		$this->form_validation->set_rules('business_id ', 'Business Id', 'integer');
        $this->form_validation->set_rules('status', 'Booking Enable', 'integer');
        
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
        if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$staffId 				= $this->input->post('staff_id', TRUE);
		$businessId 				= $this->input->post('business_id', TRUE);
		$status 			 	    = $this->input->post('status', TRUE);
		
		$staffStatusArray = array(
			'staff_id' 			=> $staffId,
			'business_id' 		=> $businessId,
            'status' 		    => $status,
        );
        if ((isset($staffId) && $staffId != '')) {
			$successMessage = 'Staff Booking Status Updated successfully';
			$errorMessage = 'Need to Change Booking';
		}
		
		$staffStatusData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($staffStatusArray, 'staff_id', 'tbl_staff', 1);
		
		if ($staffStatusData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
	}
    
    public function addEditService_post()
	{
		$this->db->trans_begin();
		$this->form_validation->set_rules('service_id', 'Service Id', 'integer');
		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
        $this->form_validation->set_rules('service_name', 'Service Name', 'required');
        $this->form_validation->set_rules('categories_id', 'Categories Id', 'integer');
		$this->form_validation->set_rules('typeId', 'Type', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('timeDuration', 'Time Duration', 'required');
        $this->form_validation->set_rules('service_price', 'Service Price', 'integer');
		$this->form_validation->set_rules('staff_id', 'Staff Id', 'integer');
		$this->form_validation->set_rules('status', 'Status', 'integer');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$serviceId				= $this->input->post('service_id', TRUE);
		$businessId				= $this->input->post('business_id', TRUE);
		$serviceName			= $this->input->post('service_name', TRUE);
		$categoriesId 			= $this->input->post('categories_id', TRUE);
		$typeId 				= $this->input->post('typeId', TRUE);
		$description 			= $this->input->post('description', TRUE);
		$timeDuration 			= $this->input->post('timeDuration', TRUE);
		$servicePrice 			= $this->input->post('service_price', TRUE);
		$staffId    		    = $this->input->post('staff_id', TRUE);
		$status    			    = $this->input->post('status', TRUE);

		$serviceArray = array(
			'service_id'	 	=> $serviceId,
			'business_id'	 	=> $businessId,
			'service_name' 		=> $serviceName,
			'categories_id'	 	=> $categoriesId,
			'typeId' 			=> $typeId,
			'description' 		=> $description,
			'timeDuration' 		=> $timeDuration,
			'service_price' 	=> $servicePrice,
			'staff_id' 			=> $staffId,
			'status' 			=> isset($status) ? 1 : 0,
		);
		if ((isset($serviceId) && $serviceId != '')) {
			$successMessage = 'Service updated successfully';
			$errorMessage = 'No data found';
		} else {
			unset($serviceArray['service_id']);
			$successMessage = 'Service inserted successfully';
			$errorMessage = 'Service insert unsuccessful';
		}
		$serviceData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($serviceArray, 'service_id', 'tbl_service', 1);

		$lastStaffId = $serviceData['lastInsertedId'];
		if (isset($lastStaffId) && $lastStaffId != '') {
			if ($serviceData['success']) {
				if (isset($_FILES['filename'])) {
					$memberImagePath = $this->config->item('staff_gallery');
					$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
					if ($imageResult['success'] == false) {
						$this->response(array(
							'status'        => FALSE,
							'responseCode'  => self::HTTP_OK,
							'message'       => strip_tags($imageResult['msg']),
						), REST_Controller::HTTP_OK);
					} else {
						unset($imageResult['success']);
						$batchArray = array(
							'service_id' 		=> $lastStaffId,
							'filename'   => $imageResult['file_name'],
						);
						$this->Mdl_service->insertUpdateStaffImageEntry($batchArray);
					}
				}
			}
		}

		if ($serviceData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
	
	public function getServiceList_post()
    {
		$start 		= $this->input->post('start');
		$businessId = $this->input->post('business_id');
        $start 		= ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
       
        $serviceDataArray = array(
			'start' 	  => $start,
			'business_id' => $businessId
        );
        
		$serviceData = $this->Mdl_service->getServiceListing($serviceDataArray);
        
        if (!empty($serviceData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Service Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $serviceData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
                'limit'         => DATA_LIMIT,
                "data"          => $serviceData,
            ), REST_Controller::HTTP_NOT_FOUND);
        }
	}

    public function deleteService_post()
	{
		$serviceId = $this->input->post('service_id');
		
		$this->form_validation->set_rules('service_id', 'Service Id', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('integer', '%s should be integer');

		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status"        => FALSE,
				"message"       => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data"          => [],
				'responseCode'  => self::HTTP_OK,
			), REST_Controller::HTTP_OK);
		}
	   	
		$serviceData = $this->Mdl_service->deleteRecord($serviceId);
		

		if ($serviceData['success'] == "true") {
			$this->response(array(
				'status'        => TRUE,
				'responseCode'  => self::HTTP_OK,
				"message"       => 'Service Deleted successfully',
				'limit'         => DATA_LIMIT,
				'data'          => $serviceData,
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"status"        => FALSE,
				'responseCode'  => self::HTTP_OK,
				'message'       => "Service Failed to delete",
				'limit'         => DATA_LIMIT,
			), REST_Controller::HTTP_OK);
		}
	}
	
	public function addEditBooking_post()
	{
		$this->db->trans_begin();
		$this->form_validation->set_rules('booking_id', 'Booking Id', 'integer');
		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
        $this->form_validation->set_rules('client_name', 'Client Name', 'required');
        $this->form_validation->set_rules('service_id', 'Service Id', 'integer');
		$this->form_validation->set_rules('booking_date', 'Booking Date', 'required');
		$this->form_validation->set_rules('staff_id', 'Staff Id', 'integer');
		$this->form_validation->set_rules('status', 'Status', 'integer');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$bookingId			= $this->input->post('booking_id', TRUE);
		$businessId			= $this->input->post('business_id', TRUE);
		$clientName			= $this->input->post('client_name', TRUE);
		$serviceId 			= $this->input->post('service_id', TRUE);
		$bookingDate 		= $this->input->post('booking_date', TRUE);
		$staffId    		= $this->input->post('staff_id', TRUE);
		$status    			= $this->input->post('status', TRUE);

		$bookingArray = array(
			'booking_id'	 	=> $bookingId,
			'business_id'	 	=> $businessId,
			'client_name' 		=> $clientName,
			'service_id'	 	=> $serviceId,
			'booking_date' 		=> DMYToYMD($bookingDate),
			'staff_id' 			=> $staffId,
			'status' 			=> isset($status) ? 1 : 0,
		);

		if ((isset($bookingId) && $bookingId != '')) {
			$successMessage = 'Booking updated successfully';
			$errorMessage = 'No data found';
		} else {
			unset($bookingArray['booking_id']);
			$successMessage = 'Booking inserted successfully';
			$errorMessage = 'Booking insert unsuccessful';
		}
		$bookingData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($bookingArray, 'booking_id', 'tbl_booking', 1);

		$lastStaffId = $bookingData['lastInsertedId'];
		if (isset($lastStaffId) && $lastStaffId != '') {
			if ($bookingData['success']) {
				if (isset($_FILES['filename'])) {
					$memberImagePath = $this->config->item('client_image');
					$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
					if ($imageResult['success'] == false) {
						$this->response(array(
							'status'        => FALSE,
							'responseCode'  => self::HTTP_OK,
							'message'       => strip_tags($imageResult['msg']),
						), REST_Controller::HTTP_OK);
					} else {
						unset($imageResult['success']);
						$batchArray = array(
							'booking_id' 		=> $lastStaffId,
							'filename'   => $imageResult['file_name'],
						);
						$this->Mdl_booking->insertUpdateStaffImageEntry($batchArray);
					}
				}
			}
		}

		if ($bookingData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
    
    public function getBookingList_post()
    {
        $start      = $this->input->post('start');
        $businessId = $this->input->post('business_id');
        $start      = ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
       
        $bookingDataArray = array(
            'start'       => $start,
            'business_id' => $businessId
        );
        
		$bookingData = $this->Mdl_booking->getBookingListing($bookingDataArray);
        
        if (!empty($bookingData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Booking Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $bookingData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
                'limit'         => DATA_LIMIT,
                "data"          => $bookingData,
            ), REST_Controller::HTTP_NOT_FOUND);
        }
	}
    
    public function deleteBooking_post()
	{
		$bookingId = $this->input->post('booking_id');
		
		$this->form_validation->set_rules('booking_id', 'Booking Id', 'required');
		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('integer', '%s should be integer');

		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status"        => FALSE,
				"message"       => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data"          => [],
				'responseCode'  => self::HTTP_OK,
			), REST_Controller::HTTP_OK);
		}
	   	
		$bookingData = $this->Mdl_booking->deleteRecord($bookingId);
		

		if ($bookingData['success'] == "true") {
			$this->response(array(
				'status'        => TRUE,
				'responseCode'  => self::HTTP_OK,
				"message"       => 'Booking Deleted successfully',
				'limit'         => DATA_LIMIT,
				'data'          => $bookingData,
			), REST_Controller::HTTP_OK);
		} else {
			$this->response(array(
				"status"        => FALSE,
				'responseCode'  => self::HTTP_OK,
				'message'       => "Booking Failed to delete",
				'limit'         => DATA_LIMIT,
			), REST_Controller::HTTP_OK);
		}
	}
	
	public function addEditGallery_post()
	{
		$this->db->trans_begin();
		$this->form_validation->set_rules('gallery_id', 'Booking Id', 'integer');
		$this->form_validation->set_rules('business_id', 'Business Id', 'integer');
        $this->form_validation->set_rules('staff_id', 'Staff Id', 'integer');
        $this->form_validation->set_rules('service_id', 'Service Id', 'integer');
		$this->form_validation->set_rules('gallery_name', 'Image Caption', 'required');
		$this->form_validation->set_rules('product_name', 'Product', 'required');
		$this->form_validation->set_rules('status', 'Status', 'integer');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('integer', '%s should be numeric');
		if ($this->form_validation->run() === FALSE) {
			$strip_message = strip_tags(validation_errors(""));
			$this->response(array(
				"status" => FALSE,
				"message" => trim(preg_replace("/\r\n|\r|\n/", ',', $strip_message), ","),
				"data" => null,
				'responseCode' => self::HTTP_BAD_REQUEST,
			), REST_Controller::HTTP_BAD_REQUEST);
		}
		$galleryId			= $this->input->post('gallery_id', TRUE);
		$businessId			= $this->input->post('business_id', TRUE);
		$staffId			= $this->input->post('staff_id', TRUE);
		$serviceId 			= $this->input->post('service_id', TRUE);
		$galleryName 		= $this->input->post('gallery_name', TRUE);
		$productName        = $this->input->post('product_name', TRUE);
		$status    			= $this->input->post('status', TRUE);

		$galleryArray = array(
			'gallery_id'	 	=> $galleryId,
			'business_id'	 	=> $businessId,
			'staff_id' 			=> $staffId,
			'service_id'	 	=> $serviceId,
			'gallery_name' 		=> $galleryName,
			'product_name' 		=> $productName,
			'status' 			=> $status,
		);

		if ((isset($galleryId) && $galleryId != '')) {
			$successMessage = 'Gallery updated successfully';
			$errorMessage = 'Need to Change Gallery Data';
		} else {
			unset($galleryArray['gallery_id']);
			$successMessage = 'Gallery inserted successfully';
			$errorMessage = 'Gallery insert unsuccessful';
		}
		$galleryData = $this->Mdl_whoz_nxt_webservice->insertUpdateRecordApi($galleryArray, 'gallery_id', 'tbl_gallery', 1);

		$lastStaffId = $galleryData['lastInsertedId'];
		if (isset($lastStaffId) && $lastStaffId != '') {
			if ($galleryData['success']) {
				if (isset($_FILES['filename'])) {
					$memberImagePath = $this->config->item('gallery_path');
					$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
					if ($imageResult['success'] == false) {
						$this->response(array(
							'status'        => FALSE,
							'responseCode'  => self::HTTP_OK,
							'message'       => strip_tags($imageResult['msg']),
						), REST_Controller::HTTP_OK);
					} else {
						unset($imageResult['success']);
						$batchArray = array(
							'gallery_id' 		=> $lastStaffId,
							'filename'   => $imageResult['file_name'],
						);
						$this->Mdl_gallery->insertUpdateStaffImageEntry($batchArray);
					}
				}
			}
		}

		if ($galleryData['success']) {
			$this->db->trans_commit();
			$this->response(array(
				'status' => TRUE,
				'responseCode' => self::HTTP_OK,
				'message' => $successMessage,
			), REST_Controller::HTTP_OK);

		} else {
			$this->db->trans_rollback();
			$this->response(array(
				'status' => FALSE,
				'responseCode' => self::HTTP_NOT_FOUND,
				'message' => $errorMessage,
			), REST_Controller::HTTP_NOT_FOUND);
		}
    }
	
	public function getGalleryList_post()
    {
		$start 		= $this->input->post('start');
		$businessId = $this->input->post('business_id');
        $start 		= ($start <= 0) ? 1 : ($start == 1) ? 0 : $start - 1;
       
        $galleryDataArray = array(
			'start' 	  => $start,
			'business_id' => $businessId,
        );
        
		$galleryData = $this->Mdl_gallery->getGalleryListing($galleryDataArray);
        
        if (!empty($galleryData)) {
            $this->response(array(
                'status'        => TRUE,
                'responseCode'  => self::HTTP_OK,
                "message"       => 'Gallery Listing successfully',
                'limit'         => DATA_LIMIT,
                'data'          => $galleryData,
            ), REST_Controller::HTTP_OK);
        } else {
            $this->response(array(
                "status"        => FALSE,
                'responseCode'  => self::HTTP_NOT_FOUND,
                'message'       => "No Data Found",
            ), REST_Controller::HTTP_NOT_FOUND);
        }
	}
}   