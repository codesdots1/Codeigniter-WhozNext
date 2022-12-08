<?php

class DT_CI_Form_validation extends CI_Form_validation
{

    public function edit_unique($str, $field)
    {

        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);

        $variable_id = '';
        if ($field == "username") {
            $variable_id = 'business_id';
        }
        elseif ($field == "categories_name") {
            $variable_id = 'categories_id';
        }
        elseif ($field == "blood_group_name") {
            $variable_id = 'blood_group_id';
        }
        elseif ($field == "occupation_name") {
            $variable_id = 'occupation_id';
        }
        elseif ($field == "education_name") {
            $variable_id = 'education_id';
        }
        elseif ($field == "marital_status_name") {
            $variable_id = 'marital_status_id';
        }
        elseif ($field == "state_name") {
            $variable_id = 'state_id';
        }
        elseif ($field == "city_name") {
            $variable_id = 'city_id';
        }
        elseif ($field == "caste_name") {
            $variable_id = 'caste_id';
        }
        elseif ($field == "section_name") {
            $variable_id = 'section_id';
        }
        elseif ($field == "scheme_name") {
            $variable_id = 'scheme_id';
        }
        elseif ($field == "cost_center_name") {
            $variable_id = 'cost_center_id';
        }
        elseif ($field == "amsom_name") {
            $variable_id = 'amsom_id';
        }
        elseif ($field == "desom_name") {
            $variable_id = 'desom_id';
        }
        elseif ($field == "gender_name") {
            $variable_id = 'gender_id';
        }
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, $variable_id . ' !=' => $id))->num_rows() === 0)
            : FALSE;
    }


}
