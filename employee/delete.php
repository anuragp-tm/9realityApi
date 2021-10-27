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

if(!empty($data->emp_id)) {
	$Employee->emp_id = $data->emp_id;
	if($Employee->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Employee was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Employee."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to delete Employee. Data is incomplete."));
}
?>