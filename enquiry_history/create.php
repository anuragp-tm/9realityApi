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

if(!empty($data->enq_id) && !empty($data->enq_details_id) && !empty($data->emp_id) && !empty($data->enq_date) && !empty($data->last_call_date) && !empty($data->next_contact_date) && !empty($data->remarks) && !empty($data->is_close))
{    
    $EnquiryHistory->enq_id = $data->enq_id;
    $EnquiryHistory->enq_details_id = $data->enq_details_id;
    $EnquiryHistory->emp_id = $data->emp_id;
    $EnquiryHistory->enq_date = $data->enq_date;
    $EnquiryHistory->last_call_date = $data->last_call_date;
    $EnquiryHistory->next_contact_date = $data->next_contact_date;
    $EnquiryHistory->remarks = $data->remarks;
    $EnquiryHistory->is_close = $data->is_close;
    $EnquiryHistory->is_active = '1';
    $EnquiryHistory->created_date = date('Y-m-d H:i:s');	
    
    if($EnquiryHistory->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Enquiry Status Created Successfully."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to Create Enquiry Status."));
    }
}else
{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to Create Property Type. Data is Incomplete."));
}
?>