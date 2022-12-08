<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdl_terms_condition extends DT_CI_Model {
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

    }


    public function getTermsConditionData($termsConditionId = '')
    {
        $this->db->select("terms_condition_id,title,description,is_active");
        $this->db->from("tbl_terms_conditions as terms");
        $this->db->where('terms_condition_id', $termsConditionId);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function deleteRecord($termsConditionId)
    {
        $tables = array('tbl_terms_conditions');
        $this->db->where_in('terms_condition_id',$termsConditionId);
        $this->db->delete($tables);

        $ids = is_array($termsConditionId) ? implode(',',$termsConditionId) : $termsConditionId;

        if ($this->db->affected_rows()) {
            $response['success'] = true;

            logActivity('Terms And Conditions Deleted [TermsAndConditionsID: ' . $ids . ']',$this->data['userId'],'Term And Conditions');

            return $response;
        } else {
            $response['success'] = false;
            return $response;
        }

    }
}
?>