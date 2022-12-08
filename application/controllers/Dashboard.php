<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends DT_CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function index ()
    {
        $this->data['extra_js'] = array(
            "js/plugins/tables/datatables/datatables.min.js",
            "js/plugins/notifications/sweet_alert.min.js",
            "js/plugins/forms/selects/select2.min.js",
            "js/plugins/forms/styling/uniform.min.js",
            "js/pages/form_layouts.js",
            "js/plugins/forms/jquery.form.min.js",
        );

        $this->data['message'] = $this->session->flashdata('message');

        $this->dt_ci_template->load("default", "v_dashboard", $this->data);


    }



}

?>