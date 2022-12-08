<?php


class Services extends DT_CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_service"));
		$this->lang->load('service');
	}

	public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "service/v_service", $data);
    }

    public function getServiceListing()
	{
		$this->load->library('datatables');
		$this->datatables->select("ts.service_id,tb.business_id,tb.business_name,tc.categories_id,tc.categories_name,ts.service_name,ts.timeDuration,ts.service_price");
		$this->datatables->from("tbl_service as ts");
		$this->datatables->join("tbl_categories as tc","tc.categories_id = ts.categories_id","left");
		$this->datatables->join("tbl_business as tb","tb.business_id = ts.business_id","left");
		echo $this->datatables->generate();
    }
    
    public function manage($serviceId = '')
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
			'business'        => true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if ($serviceId != '') {
			$data['getServiceData'] = $this->Mdl_service->getServiceData($serviceId);
		}
		$this->dt_ci_template->load("default", "service/v_service_manage", $data);
	}

	public function save()
	{
		$this->db->trans_begin();
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

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('numeric', '%s Please Enter Only Number');
		$this->form_validation->set_message('is_unique', 'This %s Already Exists');
		$this->form_validation->set_message('edit_unique', 'This %s Already Exists');

		$this->form_validation->set_rules('service_name', $this->lang->line('service_name'), 'required');
		$this->form_validation->set_rules('business_id', $this->lang->line('business_name'), 'required');
		$this->form_validation->set_rules('categories_id', $this->lang->line('categories'), 'required');
		$this->form_validation->set_rules('service_price', $this->lang->line('service_price'), 'required');
		$this->form_validation->set_rules('staff_id', $this->lang->line('staff'), 'required');

		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
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

			$serviceData = $this->Mdl_service->insertUpdateRecord($serviceArray, 'service_id', 'tbl_service', 1);

			$lastServiceId = $serviceData['lastInsertedId'];
			if (isset($lastServiceId) && $lastServiceId != '') {
				if ($serviceData['success']) {
					if (isset($_FILES['filename'])) {
						$memberImagePath = $this->config->item('service_gallery');
						$imageResult = $this->dt_ci_file_upload->UploadMultipleFile('filename', MAX_IMAGE_SIZE_LIMIT, $memberImagePath, true, true, array('jpeg', 'png', 'jpg', 'JPG'));
						if ($imageResult['success'] == false) {
							$response['success'] = false;
							$response['msg'] = strip_tags($imageResult['msg']);
							echo json_encode($response);
							die();
						} else {

							unset($imageResult['success']);
							foreach ($imageResult as $key => $data) {
								if(trim($data['file_name']) != ''){
									$batchServiceGalleryArray[] = array(
										'service_id'  => $lastServiceId,
										'filename'   => $data['file_name'],
									);		
								}
							}
							$this->Mdl_service->batchInsert($batchServiceGalleryArray, 'tbl_service_gallery_file');
						}
					}
				}
			}

			if (isset($serviceId) && $serviceId != '') {
				if ($serviceData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), SERVICE);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), SERVICE);
				}
			} else {
				if ($serviceData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), SERVICE);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), SERVICE);
				}
			}
			echo json_encode($response);
		}
	}

	public function delete(){
		$serviceId     = $this->input->post('deleteId',TRUE);

		if($serviceId != ''){
			$imageArray   = $this->Mdl_service->getImage($serviceId);
		}
		if(count($imageArray) > 0) {
			$getImage = array_column($imageArray,'filename');
			$this->Mdl_service->unlinkFile('service_gallery', $getImage);
		}

		$serviceData   = $this->Mdl_service->deleteRecord($serviceId);
		if ($serviceData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),SERVICE);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'),SERVICE);
		}
		echo json_encode($response);
		die();
	}

	public function imageDelete()
	{
		$imageUrl = $this->input->post('imageUrl');
		$imageId  = $this->input->post('imageId');

		$galleryImageData =  $this->Mdl_service->deleteStaffImageEntry($imageId);

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
		$serviceId                    = $this->input->post('service_id');
		$this->data['imageList']      = $this->Mdl_service->getImage($serviceId);
		$result 					  = $this->load->view("service/v_service_image_list", $this->data,true);
		echo json_encode($result);
	}

	public function getServiceDD()
	{
		$serviceId    = $this->input->post("service_id");
		$businessId 		 = $this->input->post('business_id');
		$searchTerm      = $this->input->post("filter_param");

		$data = array(
			"service_id"  	 => $serviceId,
			"business_id"    => $businessId,
			"filter_param"   => $searchTerm
		);
		echo $this->Mdl_service->getServiceDD($data);
	}

}