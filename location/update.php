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

if(!empty($data->location_id) && !empty($data->location_name) && !empty($data->city)){ 
	
	$Location->location_id = $data->location_id; 
	$Location->location_name = $data->location_name;
    $Location->city = $data->city;	
    $Location->updated_date = date('Y-m-d H:i:s'); 
	
	if($Location->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Location was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update Location."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update Location. Data is incomplete."));
}
?>