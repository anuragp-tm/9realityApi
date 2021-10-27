<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/EnquiryHistory.php';
 
$database = new Database();
$db = $database->getConnection();
$EnquiryHistory = new EnquiryHistory($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->enq_history_id)) {
	$EnquiryHistory->enq_history_id = $data->enq_history_id;
	if($EnquiryHistory->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Enquiry History Deleted Successfully."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to Delete Enquiry History."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to Delete Enquiry History. Data is Incomplete."));
}
?>