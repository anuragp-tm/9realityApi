<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Designation.php';
 
$database = new Database();
$db = $database->getConnection();
$Designation = new Designation($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->designation_id)) {
	$Designation->designation_id = $data->designation_id;
	if($Designation->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Designation was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Designation."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to delete Designation. Data is incomplete."));
}
?>