<?php


class Staff extends DT_CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_staff"));
		$this->lang->load('staff');
	}

	public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "staff/v_staff", $data);
	}

	public function getStaffListing()
	{
		$this->load->library('datatables');
		$imagePath = IMAGE_DIR_URL . $this->config->item('staff_image');
		$this->datatables->select("ts.staff_id,CONCAT(ts.first_name,' ' ,ts.last_name) as staff_name,ts.position,ts.contact_no,ts.is_active,
		tb.business_id,tb.business_name");
		$this->datatables->select('COALESCE(CONCAT("' . $imagePath . '",tsf.filename),"") as staff_image');
		$this->datatables->from("tbl_staff as ts");
		$this->datatables->join("tbl_staff_file as tsf","tsf.staff_id = ts.staff_id","left");
		$this->datatables->join("tbl_business as tb","tb.business_id = ts.business_id","left");
		echo $this->datatables->generate();
	}

	public function manage($staffId = '')
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
			'business'   => true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if ($staffId != '') {
			$data['getStaffData'] = $this->Mdl_staff->getStaffData($staffId);
		}
		$this->dt_ci_template->load("default", "staff/v_staff_manage", $data);
	}

	public function save()
	{
		$this->db->trans_begin();
		$staffId				= $this->input->post('staff_id', TRUE);
		$businessId				= $this->input->post('business_id', TRUE);
		$firstName 				= $this->input->post('first_name', TRUE);
		$surName 				= $this->input->post('last_name', TRUE);
		$position 				= $this->input->post('position', TRUE);
		$contactNo 				= $this->input->post('contact_no', TRUE);
		$biography 				= $this->input->post('biography', TRUE);
		$isBooking    		    = $this->input->post('status', TRUE);
		$isActive    			= $this->input->post('is_active', TRUE);

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('numeric', '%s Please Enter Only Number');
		$this->form_validation->set_message('is_unique', 'This %s Already Exists');
		$this->form_validation->set_message('edit_unique', 'This %s Already Exists');

		$this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
		$this->form_validation->set_rules('position', $this->lang->line('position'), 'required');
		$this->form_validation->set_rules('contact_no', $this->lang->line('contact_no'), 'required');

		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
			$staffArray = array(
				'staff_id'	 	=> $staffId,
				'business_id'	=> $businessId,
				'first_name' 	=> $firstName,
				'last_name'	 	=> $surName,
				'position' 		=> $position,
				'contact_no' 	=> $contactNo,
				'biography' 	=> $biography,
				'status' 		=> isset($isBooking) ? 1 : 0,
				'is_active' 	=> isset($isActive) ? 1 : 0,
			);

			$staffData = $this->Mdl_staff->insertUpdateRecord($staffArray, 'staff_id', 'tbl_staff', 1);

			$lastStaffId = $staffData['lastInsertedId'];
			if (isset($lastStaffId) && $lastStaffId != '') {
				if ($staffData['success']) {
					if (isset($_FILES['filename'])) {
						$memberImagePath = $this->config->item('staff_image');
						$imageResult = $this->dt_ci_file_upload->UploadFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
						if ($imageResult['success'] == false) {
							$response['success'] = false;
							$response['msg'] = strip_tags($imageResult['msg']);
							echo json_encode($response);
							die();
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
							$response['success'] = false;
							$response['msg'] = strip_tags($imageResult['msg']);
							echo json_encode($response);
							die();
						} else {
							unset($imageResult['success']);
							foreach ($imageResult as $key => $data) {
								if(trim($data['file_name']) != ''){
									$batchGalleryArray[] = array(
										'staff_id' 		=> $lastStaffId,
										'galleryname'   => $data['file_name'],
									);		
								}
							}
							$this->Mdl_staff->batchInsert($batchGalleryArray, 'tbl_staff_gallery_file');
						}
					}
				}
			}

			if (isset($staffId) && $staffId != '') {
				if ($staffData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), STAFF);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), STAFF);
				}
			} else {
				if ($staffData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), STAFF);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), STAFF);
				}
			}
			echo json_encode($response);
		}
	}

	public function delete(){
		$staffId     = $this->input->post('deleteId',TRUE);

		if($staffId != ''){
			$imageArray   = $this->Mdl_staff->getImage($staffId);
			$galleryArray = $this->Mdl_staff->getGallery($staffId);
		}
		if(count($imageArray) > 0) {
			$getImage = array_column($imageArray,'filename');
			$this->Mdl_staff->unlinkFile('staff_image', $getImage);
		}
		if(count($galleryArray) > 0) {
			$getGallery = array_column($galleryArray,'filename');
			$this->Mdl_staff->unlinkFile('staff_gallery', $getGallery);
		}

		$staffData   = $this->Mdl_staff->deleteRecord($staffId);
		if ($staffData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),STAFF);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'),STAFF);
		}
		echo json_encode($response);
		die();
	}

	public function changeStatus()
	{
		$staffId  =  $this->input->post('staffId', TRUE);
		$status   =  $this->input->post('status', TRUE);

		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$return = $this->Mdl_staff->statusChange($staffId,$status,'staff_id','tbl_staff');

		if ($return == 1) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('status_change'),STAFF);
		} else {
			$response['success'] = false;
			$response['msg']     = sprintf($this->lang->line('status_change_error'),STAFF);
		}
		echo json_encode($response);
	}

	public function imageDelete()
	{
		$imageUrl = $this->input->post('imageUrl');
		$imageId  = $this->input->post('imageId');

		$galleryImageData =  $this->Mdl_staff->deleteStaffImageEntry($imageId);

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

	public function galleryDelete()
	{
		$imageUrl = $this->input->post('imageUrl');
		$imageId  = $this->input->post('imageId');

		$galleryImageData =  $this->Mdl_staff->deleteStaffGalleryEntry($imageId);

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
		$staffId                    = $this->input->post('staff_id');
		$this->data['imageList']    = $this->Mdl_staff->getImage($staffId);
		$result 					= $this->load->view("staff/v_staff_image_list", $this->data,true);
		echo json_encode($result);
	}

	public function galleryLoad()
	{
		$staffId                    = $this->input->post('staff_id');
		$this->data['galleryList']  = $this->Mdl_staff->getGallery($staffId);
		$result 					= $this->load->view("staff/v_staff_gallery_list", $this->data,true);
		echo json_encode($result);
	}

	public function getStaffDD()
	{
		$staffId    = $this->input->post("staff_id");
		$businessId 		 = $this->input->post('business_id');
		$searchTerm      = $this->input->post("filter_param");

		$data = array(
			"staff_id"  => $staffId,
			"business_id"    => $businessId,
			"filter_param"   => $searchTerm
		);
		echo $this->Mdl_staff->getStaffDD($data);
	}
}
