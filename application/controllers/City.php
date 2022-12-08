<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends DT_CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("Mdl_city"));
        $this->lang->load('city');
    }

    //Index page
    public function index()
    {
        $data['extra_js'] = array(
            "js/plugins/tables/datatables/datatables.min.js",
            "js/plugins/notifications/sweet_alert.min.js",
            "js/plugins/forms/styling/uniform.min.js",
            "js/plugins/forms/jquery.form.min.js",
            "js/plugins/forms/selects/select2.min.js"
        );

        $data['v_cityModal'] = $this->load->view('commonMaster/v_cityModal', $data, TRUE);
        $this->dt_ci_template->load("default", "commonMaster/v_city", $data);
    }

    // ajax call to the data listing
    public function getCityListing()
    {
        $this->load->library('datatables');
        $this->datatables->select("city_id,city_name,is_active");
        $this->datatables->from("tbl_city as city");
        echo $this->datatables->generate();
    }

    //change status
    public function changeStatus()
    {
        $cityId     =  $this->input->post('cityId', TRUE);
        $status     =  $this->input->post('status', TRUE);

        if ($status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        $return = $this->Mdl_city->statusChange($cityId,$status,'city_id','tbl_city');
        if ($return == 1) {
            $response['success'] = true;
            $response['msg']     = sprintf($this->lang->line('status_change'),CITY);
        } else {
            $response['success'] = false;
            $response['msg']     = sprintf($this->lang->line('status_change_error'),CITY);
        }
        echo json_encode($response);
    }



    ///insert and update city
    public function save()
    {
        $cityId   = $this->input->post('city_id');
        $cityName = $this->input->post('city_name');
		$isActive = $this->input->post('is_active', true);

        if (isset($cityId) && $cityId == '') {
            $this->form_validation->set_rules('city_name', $this->lang->line('city_name'), 'required');
        } else {
            $this->form_validation->set_rules('city_name', $this->lang->line('city_name'), 'required');
        }

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        $this->form_validation->set_message('edit_unique', 'This %s already exists');

        if ($this->form_validation->run() == false) {
            $response['success'] = false;
            $response['msg']     = strip_tags(validation_errors(""));
            echo json_encode($response);

        } else {
            $isExist = $this->Mdl_city->checkExistCity($cityId , $cityName);
            if($isExist == 1){
                $response['success'] = false;
                $response['msg']         = strip_tags('Duplicate City');
                echo json_encode($response);
                die();
            }

			$cityArray = array(
				'city_id'	 => $cityId,
				'city_name'  => $cityName,
				'is_active'  => isset($isActive) ? 1 : 0,
			);

			$cityData = $this->Mdl_city->insertUpdateRecord($cityArray, 'city_id', 'tbl_city', 1);

			if (isset($cityId) && $cityId != '') {
				if ($cityData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('update_record'), CITY);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('update_record_error'), CITY);
				}
			} else {
				if ($cityData['success']) {
					$response['success'] = true;
					$response['msg'] = sprintf($this->lang->line('create_record'), CITY);
				} else {
					$response['success'] = false;
					$response['msg'] = sprintf($this->lang->line('create_record_error'), CITY);
				}
			}
			echo json_encode($response);
        }
    }

	public function delete()
	{
		$cityId = $this->input->post('deleteId',TRUE);

		if( is_reference_in_table('city_id', 'tbl_employee', $cityId)) {
			$response['success'] = false;
			$response['msg'] = $this->lang->line('delete_record_dependency');
			echo json_encode($response);
			exit;
		}

		$cityData = $this->Mdl_city->deleteRecord($cityId);

		if ($cityData) {
			$response['success'] = true;
			$response['msg']     = sprintf($this->lang->line('delete_record'),CITY);
		} else {
			$response['success'] = false;
			$response['msg']     = sprintf($this->lang->line('error_delete_record'),CITY);
		}
		echo json_encode($response);
	}

    //edit time get the city data
    public function getData(){
        $cityId = $this->input->post('cityId');
        $data['get_data'] = $this->Mdl_city->getData($cityId);
        echo json_encode($data['get_data']);
    }


    public function getCityDD(){
        $filterParameter = $this->input->post('filter_param');
        $cityIdActive = $this->input->post('cityIdActive');
        $page = $this->input->post('page');

        echo $this->Mdl_city->getCityDD($filterParameter,$page,$cityIdActive);
    }


}

?>
