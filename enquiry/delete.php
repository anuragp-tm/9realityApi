<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Enquiry.php';
 
$database = new Database();
$db = $database->getConnection();
$Enquiry = new Enquiry($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->enquiry_id)) {
	$Enquiry->enquiry_id = $data->enquiry_id;
	if($Enquiry->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Enquiry was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Enquiry."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to delete Enquiry. Data is incomplete."));
}
?>