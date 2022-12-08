<?php

class Gallery extends DT_CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model(array("Mdl_gallery"));
		$this->lang->load('gallery');
    }
    
    public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "commonMaster/v_gallery", $data);
    }
    
    public function getGalleryListing()
	{
		$this->load->library('datatables');
		$this->datatables->select("tg.gallery_id,tg.gallery_name,ts.service_id,ts.service_name,tg.product_name,tb.business_id,tb.business_name");
		$this->datatables->from("tbl_gallery as tg");
		$this->datatables->join("tbl_service as ts","ts.service_id = tg.service_id","left");
		$this->datatables->join("tbl_business as tb","tb.business_id = tg.business_id","left");
		echo $this->datatables->generate();
    }
    
    public function manage($galleryId = '')
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
            'staff'        => true,
			'serviceStaff' => true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);

		if ($galleryId != '') {
			$data['getGalleryData'] = $this->Mdl_gallery->getGalleryData($galleryId);
		}
		$this->dt_ci_template->load("default", "commonMaster/v_gallery_manage", $data);
    }
    
    public function save()
	{
		$this->db->trans_begin();
		$galleryId		    = $this->input->post('gallery_id', TRUE);
		$businessId		    = $this->input->post('business_id', TRUE);
		$galleryName 		= $this->input->post('gallery_name', TRUE);
		$staffId		    = $this->input->post('staff_id', TRUE);
		$serviceId		    = $this->input->post('service_id', TRUE);
		$productName		= $this->input->post('product_name', TRUE);
		$status    			= $this->input->post('status', TRUE);

		$this->form_validation->set_message('required', '%s is required');
	
		$this->form_validation->set_rules('gallery_name', $this->lang->line('gallery_name'), 'required');
		$this->form_validation->set_rules('staff_id', $this->lang->line('staff_data'), 'required');
		$this->form_validation->set_rules('business_id', $this->lang->line('business_name'), 'required');
		$this->form_validation->set_rules('service_id', $this->lang->line('service_data'), 'required');
		$this->form_validation->set_rules('product_name', $this->lang->line('product_name'), 'required');
        
		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg'] = strip_tags(validation_errors(""));
			echo json_encode($response);
			exit;
		} else {
			$galleryArray = array(
				'gallery_id'	 => $galleryId,
				'business_id'	 => $businessId,
				'gallery_name' 	 => $galleryName,
				'staff_id'	 	 => $staffId,
				'service_id'	 => $serviceId,
				'product_name' 	 => $productName,
				'status'	 	=> isset($status) ? 1 : 0,
			);

			$galleryData = $this->Mdl_gallery->insertUpdateRecord($galleryArray, 'gallery_id', 'tbl_gallery', 1);

			$lastGalleryId = $galleryData['lastInsertedId'];
			if (isset($lastGalleryId) && $lastGalleryId != '') {
				if ($galleryData['success']) {
					if (isset($_FILES['filename'])) {
						$memberImagePath = $this->config->item('gallery_path');
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
									$batchGalleryArray[] = array(
										'gallery_id' 		=> $lastGalleryId,
										'filename'   => $data['file_name'],
									);		
								}
							}
							$this->Mdl_gallery->batchInsert($batchGalleryArray, 'tbl_gallery_file');	
						}
					}
				}
			}

			if (isset($galleryId) && $galleryId != '') {
				if ($galleryData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), GALLERY);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), GALLERY);
				}
			} else {
				if ($galleryData['success']) {
					$this->db->trans_commit();
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), GALLERY);
				} else {
					$this->db->trans_rollback();
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), GALLERY);
				}
			}
			echo json_encode($response);
		}
    }
    
    public function delete(){
		$galleryId     = $this->input->post('deleteId',TRUE);

		if($staffId != ''){
			$imageArray   = $this->Mdl_gallery->getImage($galleryId);
		}
		if(count($imageArray) > 0) {
			$getImage = array_column($imageArray,'filename');
			$this->Mdl_gallery->unlinkFile('gallery_images', $getImage);
		}

        $galleryData   = $this->Mdl_gallery->deleteRecord($galleryId);
        
		if ($galleryData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),GALLERY);
		} else {
			$response['success'] = false;
			$response['msg'] = sprintf($this->lang->line('error_delete_record'),GALLERY);
		}
		echo json_encode($response);
		die();
    }
    
    public function imageDelete()
	{
		$imageUrl = $this->input->post('imageUrl');
		$imageId  = $this->input->post('imageId');

		$galleryData =  $this->Mdl_gallery->deleteStaffImageEntry($imageId);

		if ($galleryData['success']) {
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
		$galleryId                    = $this->input->post('gallery_id');
		$this->data['imageList']    = $this->Mdl_gallery->getImage($galleryId);
		$result 					= $this->load->view("commonMaster/v_gallery_image_list", $this->data,true);
		echo json_encode($result);
	}
}