<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Location.php';
 
$database = new Database();
$db = $database->getConnection();
$Location = new Location($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->location_id)) {
	$Location->location_id = $data->location_id;
	if($Location->delete()){    
		http_response_code(200); 
		echo json_encode(array("message" => "Location was deleted."));
	} else {    
		http_response_code(503);   
		echo json_encode(array("message" => "Unable to delete Location."));
	}
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to delete Location. Data is incomplete."));
}
?>