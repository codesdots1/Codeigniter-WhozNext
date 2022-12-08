<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dt_ci_acl
{

    private $CI;

    private $permitableMethodsArray = array(
        "Country" =>
            array(
                array("index" => "View Country"),
                array("save"  => "Modify Country"),
            ),
        "State" =>
            array(
                array("index" => "View State"),
            ),
        "City" =>
            array(
                array("index" => "View City"),
            ),
        "Category" =>
            array(
                array("index" => "View Category"),
                array("manage" => "Modify Category"),
                array("delete" => "Delete Category"),
            ),
        "Post" =>
            array(
                array("index" => "View Post"),
                array("manage" => "Modify Post"),
                array("delete" => "Delete Post"),
            ),
        "Poll" =>
            array(
                array("index" => "View Poll"),
                array("manage" => "Modify Poll"),
                array("delete" => "Delete Poll"),
            ),
        "Samaj" =>
            array(
                array("index" => "View Samaj"),
                array("manage" => "Modify Samaj"),
                array("delete" => "Delete Samaj"),
            ),
        "Surname" =>
            array(
                array("index" => "View Surname"),
                array("manage" => "Modify Surname"),
                array("delete" => "Delete Surname"),
            ),
        "Native" =>
            array(
                array("index" => "View Native Location"),
                array("manage" => "Modify Native Location"),
                array("delete" => "Delete Native Location"),
            ),
        "Page" =>
            array(
                array("index" => "View Page"),
                array("manage" => "Modify Page"),
                array("delete" => "Delete Page"),
            ),
        "Event" =>
            array(
                array("index" => "View Event"),
                array("manage" => "Modify Event"),
                array("delete" => "Delete Event"),
            ),
        "Member" =>
            array(
                array("index" => "View Member"),
                array("manage" => "Modify Member"),
                array("delete" => "Delete Member"),
            ),
        "BusinessType" =>
            array(
                array("index" => "View Business Type"),
                array("manage" => "Modify Business Type"),
                array("delete" => "Delete Business Type"),
            ),
        "Language" =>
            array(
                array("index" => "View Language"),
                array("save" => "Modify Language"),
                array("delete" => "Delete Language"),
                array("changeActive" => "Is Active Language"),
                array("changeDefault" => "Is Default Language")
            ),
        "Banner" =>
            array(
                array("index" => "View Banner"),
                array("manage" => "Modify Banner"),
                array("delete" => "Delete Banner"),
            ),
        "Monk" =>
            array(
                array("index" => "View Monk"),
                array("manage" => "Modify Monk"),
                array("delete" => "Delete Monk")
            ),
        "MonkLocation" =>
            array(
                array("index" => "View Monk Location"),
                array("manage" => "Modify Monk Location"),
                array("delete" => "Delete Monk Location")
            ),
//        "Auth" =>
//            array(
//                array("edit_group" => "Modify Groups"),
//                array("manage_groups" => "View Groups"),
//                array("index" => "View Users"),
//                array("edit_user" => "Modify Users"),
//            ),
    );

    private $friendlyControllerNames = array(
        "auth" => "User access"
    );

    // Construct
    function __construct()
    {
        // Get Codeigniter instance
        $this->CI = get_instance();

        // Get all controllers
//		$this->setControllers();
    }

    public function checkAdmin()
    {
        return $this->CI->ion_auth->is_admin();
    }

    public function checkAccess($requiredPermission)
    {


//		$trace = debug_backtrace();
//		$callingMethod  = $trace[1]['function'];
//		$callingClass  = $trace[1]['class'];
//
//		$requiredPermission = $callingClass."|".$callingMethod;


        if ($this->CI->ion_auth->is_admin()) {
            return true;
        }

        //echo "ok"; die();echo $requiredPermission; die();
        $requiredPermissionArr = explode("|", $requiredPermission);
        $requiredPClass = $requiredPermissionArr[0];
        $requiredPMethod = $requiredPermissionArr[1];


//        echo "<pre>"; print_r($requiredPermission);
        // echo "<br/>";
//       print_r($requiredPMethod);

        // die();
        if (isset($this->permitableMethodsArray[$requiredPClass]) && $this->checkArray($requiredPMethod, $this->permitableMethodsArray[$requiredPClass])) {
            $currentPermission = $this->CI->ion_auth->get_current_user_permission();


            if (in_array(strtolower($requiredPermission), ($currentPermission))) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }


    }

    private function checkArray($needle, $haystack)
    {
        foreach ($haystack as $item) {
            if ($item == $needle) {
                return true;
            } else if (is_array($item)) {
                reset($item);
                if (key($item) == $needle) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getPermissableMethods()
    {
        return $this->permitableMethodsArray;
    }

    public function getActiveMenu($path, $class = 'active')
    {

        if ($path == uri_string()) {
            return "class='$class'";
        }
    }


}
// EOF
