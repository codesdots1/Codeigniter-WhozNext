<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends DT_CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("Mdl_categories"));
        $this->lang->load('categories');
    }

    //Index page
    public function index()
	{
		$data['extra_js'] = array(
			"js/plugins/tables/datatables/datatables.min.js",
			"js/plugins/notifications/sweet_alert.min.js",
			"js/plugins/forms/styling/uniform.min.js",
			"js/plugins/forms/jquery.form.min.js"

		);

		$this->dt_ci_template->load("default", "categories/v_categories", $data);
    }

    // ajax call to the data listing
	public function getCategoriesListing()
	{
		$this->load->library('datatables');
		$this->datatables->select("tc.categories_id,tc.categories_name,tb.business_id,tb.business_name,tc.is_active");
		$this->datatables->from("tbl_categories as tc");
		$this->datatables->join("tbl_business as tb","tb.business_id = tc.business_id","left");
		echo $this->datatables->generate();
	}

	public function manage($categoriesId = '')
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
			'business'   => true,
		);
		$data['select2'] = $this->load->view("commonMaster/v_select2",$select2,true);
		if ($categoriesId != '') {
			$data['getCategoriesData'] = $this->Mdl_categories->getCategoriesData($categoriesId);
		}
		$this->dt_ci_template->load("default", "categories/v_categories_manage", $data);
    }

    //change status
    public function changeStatus()
	{
		$categoriesId  =  $this->input->post('categoriesId', TRUE);
		$status        =  $this->input->post('status', TRUE);

		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$return = $this->Mdl_categories->statusChange($categoriesId,$status,'categories_id','tbl_categories');

		if ($return == 1) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('status_change'),CATEGORY);
		} else {
			$response['success'] = false;
			$response['msg']     = sprintf($this->lang->line('status_change_error'),CATEGORY);
		}
		echo json_encode($response);
	}



    ///insert and update state
    public function save()
	{
		$categoriesId   = $this->input->post('categories_id');
		$businessId     = $this->input->post('business_id');
		$categoriesName = $this->input->post('categories_name');
		$isActive    	= $this->input->post('is_active', true)? '1' : '0';

		$this->form_validation->set_message('required', '%s is required');
		$this->form_validation->set_message('is_unique', 'This %s already exists');
		$this->form_validation->set_message('edit_unique', 'This %s already exists');

        $this->form_validation->set_rules('categories_name', $this->lang->line('categories_name'), 'required');
		$this->form_validation->set_rules('business_id', $this->lang->line('business_name'), 'required');
        
		if ($this->form_validation->run() == false) {
			$response['success'] = false;
			$response['msg']     = strip_tags(validation_errors(""));
			echo json_encode($response);
            exit;
		} else {
			$categoriesArray =	array(
				'categories_id'	 	 => $categoriesId,
				'business_id'	 	 => $businessId,
				'categories_name' 	 => $categoriesName,
				'is_active' 	 	 => $isActive
			);
			$categoriesData = $this->Mdl_categories->insertUpdateRecord($categoriesArray, 'categories_id', 'tbl_categories', 1);

			if (isset($categoriesId) && $categoriesId != '') {
				if ($categoriesData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), CATEGORY);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), CATEGORY);
				}
			} else {
				if ($categoriesData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), CATEGORY);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), CATEGORY);
				}
			}
			echo json_encode($response);
		}
	}


    public function delete()
    {
        $categoriesId = $this->input->post('deleteId',TRUE);
        $ids = is_array($stateId) ? implode(',',$categoriesId) : $categoriesId;

        if(is_reference_in_table('categories_id', 'tbl_categories', $categoriesId)){
            $response['success'] = false;

            logActivity('Tried to delete Categories [categoriesID: ' . $ids . ']',$this->data['userId'],'State');

            $response['msg'] = $this->lang->line('delete_record_dependency');
            echo json_encode($response);
            exit;
        }

        //delete  state
        $categoriesData = $this->Mdl_categories->deleteRecord($categoriesId);
        if ($categoriesData) {
            $response['success'] = true;
            $response['msg']     = sprintf($this->lang->line('delete_record'),CATEGORY);
        } else {
            $response['success'] = false;
            $response['msg'] =  sprintf($this->lang->line('error_delete_record'),CATEGORY);
        }

        echo json_encode($response);
    }


    public function getCategoriesDD()
	{
		$categoriesId    = $this->input->post("categories_id");
		$businessId 		 = $this->input->post('business_id');
		$searchTerm      = $this->input->post("filter_param");

		$data = array(
			"categories_id"  => $categoriesId,
			"business_id"    => $businessId,
			"filter_param"   => $searchTerm
		);
		echo $this->Mdl_categories->getCategoriesDD($data);
	}
}
?>
