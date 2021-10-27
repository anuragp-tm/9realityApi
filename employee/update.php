<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Employee.php';
 
$database = new Database();
$db = $database->getConnection();
$Employee = new Employee($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->emp_id) && !empty($data->emp_name) && !empty($data->emp_email) && !empty($data->emp_mobile_no) && !empty($data->emp_pan_no) && !empty($data->emp_address) && !empty($data->emp_city_id) && !empty($data->emp_state_id) && !empty($data->pincode) && !empty($data->designation_id) && !empty($data->emp_reporting_to)){ 
	
	$Employee->emp_id = $data->emp_id; 
	$Employee->emp_name = $data->emp_name;
	$Employee->emp_email = $data->emp_email;
	$Employee->emp_mobile_no = $data->emp_mobile_no;
	$Employee->emp_pan_no = $data->emp_pan_no;
	$Employee->emp_address = $data->emp_address;
	$Employee->emp_city_id = $data->emp_city_id;
	$Employee->emp_state_id = $data->emp_state_id;
	$Employee->pincode = $data->pincode;
	$Employee->designation_id = $data->designation_id;
	$Employee->emp_reporting_to = $data->emp_reporting_to;
    $Employee->updated_date = date('Y-m-d H:i:s'); 
	
	if($Employee->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Employee was Updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to Update Employee."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to Update Employee. Data is Incomplete."));
}
?>