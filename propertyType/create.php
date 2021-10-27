<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
 
include_once '../config/Database.php';
include_once '../class/PropertyType.php';
 
$database = new Database();
$db = $database->getConnection();
$PropertyType = new PropertyType($db);
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->property_type_name))
{    
    $PropertyType->property_type_name = $data->property_type_name;
    $PropertyType->property_headtype = $data->property_type_name;
    $PropertyType->is_active = '1';
    $PropertyType->created_date = date('Y-m-d H:i:s');	
    $PropertyType->updated_date = date('Y-m-d H:i:s'); 
    
    if($PropertyType->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Property Type Created Successfully."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Create Property Type."));
    }
}else
{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Create Property Type. Data is Incomplete."));
}
?>