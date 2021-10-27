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

if(!empty($data->designation_name) && !empty($data->designation_higher_key)){    

    $Designation->designation_name = $data->designation_name;
    $Designation->designation_higher_key = $data->designation_higher_key;
    $Designation->is_active = '1';
    $Designation->created_date = date('Y-m-d H:i:s');	
    $Designation->updated_date = date('Y-m-d H:i:s'); 
    
    if($Designation->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Designation was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create Designation."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create Designation. Data is incomplete."));
}
?>