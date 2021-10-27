<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
 
include_once '../config/Database.php';
include_once '../class/Employee.php';
$database = new Database();
$db = $database->getConnection();
$Employee = new Employee($db);
$data = json_decode(file_get_contents("php://input"));

    if(!empty($data->emp_name) && !empty($data->emp_email) && !empty($data->emp_mobile_no) && !empty($data->emp_pan_no) && !empty($data->emp_address) && !empty($data->emp_city_id) && !empty($data->emp_state_id) && !empty($data->pincode) && !empty($data->designation_id) && !empty($data->emp_password) && !empty($data->emp_reporting_to))
    {
        $Employee->emp_name = $data->emp_name;
        $Employee->emp_email = $data->emp_email;
        $Employee->emp_mobile_no = $data->emp_mobile_no;
        $Employee->emp_pan_no = $data->emp_pan_no;
        $Employee->emp_address = $data->emp_address;
        $Employee->emp_city_id = $data->emp_city_id;
        $Employee->emp_state_id = $data->emp_state_id;
        $Employee->pincode = $data->pincode;
        $Employee->designation_id = $data->designation_id;
        $Employee->emp_password = $data->emp_password;
        $Employee->emp_encrypted_password = md5($data->emp_password);
        $Employee->emp_reporting_to = $data->emp_reporting_to;
        //$Employee->emp_profile_pic = $data->emp_profile_pic;
        $Employee->is_active = '1';
        $Employee->created_date = date('Y-m-d H:i:s');  
        $Employee->updated_date = date('Y-m-d H:i:s'); 


        if($Employee->create())
        {         
            http_response_code(201);         
            echo json_encode(array("message" => "Employee was Created Successfully."));
        } 
        else
        {         
            http_response_code(503);        
            echo json_encode(array("message" => "Unable to create Employee."));
        }
    }
    else
    {    
        http_response_code(400);    
        echo json_encode(array("message" => "Unable to Create Employee. Data is Incomplete."));
    }
/*if(!empty($data->emp_name) && !empty($data->emp_email) && !empty($data->emp_mobile_no) && !empty($data->emp_pan_no) && !empty($data->emp_address) && !empty($data->emp_city_id) && !empty($data->emp_state_id) && !empty($data->pincode) && !empty($data->designation_id) && !empty($data->emp_password) && !empty($data->emp_reporting_to))
{    
    $Employee->emp_name = $data->emp_name;
    $Employee->emp_email = $data->emp_email;
    $Employee->emp_mobile_no = $data->emp_mobile_no;
    $Employee->emp_pan_no = $data->emp_pan_no;
    $Employee->emp_address = $data->emp_address;
    $Employee->emp_city_id = $data->emp_city_id;
    $Employee->emp_state_id = $data->emp_state_id;
    $Employee->pincode = $data->pincode;
    $Employee->designation_id = $data->designation_id;
    $Employee->emp_password = $data->emp_password;
    $Employee->emp_encrypted_password = md5($data->emp_password);
    $Employee->emp_reporting_to = $data->emp_reporting_to;
    $Employee->emp_profile_pic = $data->emp_profile_pic;
    $Employee->is_active = '1';
    $Employee->created_date = date('Y-m-d H:i:s');	
    $Employee->updated_date = date('Y-m-d H:i:s'); 
    
    if($Employee->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Employee was Created Successfully."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create Employee."));
    }
}else
{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Create Employee. Data is Incomplete."));
}*/
?>