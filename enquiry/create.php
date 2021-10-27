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

if(!empty($data->customer_name) && !empty($data->customer_mobile_no) && !empty($data->emp_id)){    

    $Enquiry->customer_name = $data->customer_name;
    $Enquiry->customer_mobile_no = $data->customer_mobile_no;
    $Enquiry->emp_id=$data->emp_id;
    $Enquiry->is_active = '1';
    $Enquiry->created_date = date('Y-m-d H:i:s');	
    $Enquiry->updated_date = date('Y-m-d H:i:s'); 
    
    if($Enquiry->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Enquiry was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create Enquiry."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create Enquiry. Data is incomplete."));
}
?>