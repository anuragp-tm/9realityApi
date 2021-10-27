<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/PropertyType.php';
 
$database = new Database();
$db = $database->getConnection();
$PropertyType = new PropertyType($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->property_id) && !empty($data->property_type_name) && !empty($data->property_headtype)){ 
	
	$PropertyType->property_id = $data->property_id; 
	$PropertyType->property_type_name = $data->property_type_name;
    $PropertyType->property_headtype = $data->property_headtype;	
    $PropertyType->updated_date = date('Y-m-d H:i:s'); 
	
	if($PropertyType->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Property Type Updated Successfully."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to Update Property Type."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to Update Property Type. Data is incomplete."));
}
?>