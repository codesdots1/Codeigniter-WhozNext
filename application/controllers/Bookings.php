<?php


class Bookings extends DT_CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_booking"));
		$this->lang->load('booking');
	}

	public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "booking/v_booking", $data);
    }

    public function getBookingListing()
	{
        $this->load->library('datatables');
        $imagePath = IMAGE_DIR_URL . $this->config->item('client_image');
        $this->datatables->select("tb.booking_id,tbs.business_id,tbs.business_name,tb.client_name,ts.service_id,ts.service_name,tsf.staff_id,CONCAT(tsf.first_name,' ',tsf.last_name) as staff_name");
        $this->datatables->select('COALESCE(CONCAT("' . $imagePath . '",tbf.filename),"") as client_image');
		$this->datatables->from("tbl_booking as tb");
        $this->datatables->join("tbl_booking_file as tbf","tbf.booking_id = tb.booking_id","left");
        $this->datatables->join("tbl_service as ts","ts.service_id = tb.service_id","left");
		$this->datatables->join("tbl_staff as tsf","tsf.staff_id = tb.staff_id","left");
		$this->datatables->join("tbl_business as tbs","tbs.business_id = tb.business_id","left");
		echo $this->datatables->generate();
    }

    public function manage($bookingId = '')
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
			'categories'   => true,
            'staff'        => true,
			'serviceStaff' => true,
			'business' => true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if ($bookingId != '') {
			$data['getBookingData'] = $this->Mdl_booking->getBookingData($bookingId);
		}
		$this->dt_ci_template->load("default", "booking/v_booking_manage", $data);
    }
    
    public function save()
	{
		$this->db->trans_begin();
		$bookingId			= $this->input->post('booking_id', TRUE);
		$businessId			= $this->input->post('business_id', TRUE);
		$clientName			= $this->input->post('client_name', TRUE);
		$serviceId 			= $this->input->post('service_id', TRUE);
		$bookingDate 		= $this->input->post('booking_date', TRUE);
		$staffId    		= $this->input->post('staff_id', TRUE);
		$status    			= $this->input->post('status', TRUE);

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('numeric', '%s Please Enter Only Number');
		$this->form_validation->set_message('is_unique', 'This %s Already Exists');
		$this->form_validation->set_message('edit_unique', 'This %s Already Exists');

		$this->form_validation->set_rules('client_name', $this->lang->line('client_name'), 'required');
		$this->form_validation->set_rules('service_id', $this->lang->line('service_info'), 'required');
		$this->form_validation->set_rules('booking_date', $this->lang->line('booking_date'), 'required');
		$this->form_validation->set_rules('staff_id', $this->lang->line('staff_info'), 'required');

		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
			$bookingArray = array(
				'booking_id'	 	=> $bookingId,
				'business_id'	 	=> $businessId,
				'client_name' 		=> $clientName,
				'service_id'	 	=> $serviceId,
				'booking_date' 		=> DMYToYMD($bookingDate),
				'staff_id' 			=> $staffId,
				'status' 			=> isset($status) ? 1 : 0,
			);

			$bookingData = $this->Mdl_booking->insertUpdateRecord($bookingArray, 'booking_id', 'tbl_booking', 1);

			$lastStaffId = $bookingData['lastInsertedId'];
			if (isset($lastStaffId) && $lastStaffId != '') {
				if ($bookingData['success']) {
					if (isset($_FILES['filename'])) {
						$memberImagePath = $this->config->item('client_image');
						$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
						if ($imageResult['success'] == false) {
							$response['success'] = false;
							$response['msg'] = strip_tags($imageResult['msg']);
							echo json_encode($response);
							die();
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

			if (isset($bookingId) && $bookingId != '') {
				if ($bookingData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), BOOKING);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), BOOKING);
				}
			} else {
				if ($bookingData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), BOOKING);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), BOOKING);
				}
			}
			echo json_encode($response);
		}
    }
    
    public function delete(){
		$bookingId     = $this->input->post('deleteId',TRUE);

		if($bookingId != ''){
			$imageArray   = $this->Mdl_booking->getImage($bookingId);
		}
		if(count($imageArray) > 0) {
			$getImage = array_column($imageArray,'filename');
			$this->Mdl_booking->unlinkFile('client_image', $getImage);
		}

		$bookingData   = $this->Mdl_booking->deleteRecord($bookingId);
		if ($bookingData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),BOOKING);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'),BOOKING);
		}
		echo json_encode($response);
		die();
    }
    
    public function imageDelete()
	{
		$imageUrl = $this->input->post('imageUrl');
		$imageId  = $this->input->post('imageId');

		$galleryImageData =  $this->Mdl_booking->deleteClientImageEntry($imageId);

		if ($galleryImageData['success']) {
			if (file_exists($imageUrl)) {
				unlink($imageUrl);
			}

			$response['success']  = true;
			$response['msg']      = $this->lang->line('gallery_image_delete');
		} else {
			$response['success']  = false;
			$response['msg']      = $this->lang->line('gallery_image_delete_error');
		}
		echo json_encode($response);
		die();
	}

	public function imageLoad()
	{
		$bookingId                    = $this->input->post('booking_id');
		$this->data['imageList']      = $this->Mdl_booking->getImage($bookingId);
		$result 					  = $this->load->view("booking/v_client_image_list", $this->data,true);
		echo json_encode($result);
	}
}