<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/EnquiryHistory.php';

$database = new Database();
$db = $database->getConnection();
 
$EnquiryHistory = new EnquiryHistory($db);

$EnquiryHistory->enq_history_id = (isset($_GET['enq_history_id']) && $_GET['enq_history_id']) ? $_GET['enq_history_id'] : '0';

$result = $EnquiryHistory->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["EnquiryHistory"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "enq_history_id" => $enq_history_id,
            "enq_id" => $enq_id,
            "enq_details_id" => $enq_details_id,
            "emp_id" => $emp_id,
            "enq_date" => $enq_date,
            "last_call_date" => $last_call_date,
            "next_contact_date" => $next_contact_date,
            "remarks" => $remarks,
            "is_close" => $is_close,
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["EnquiryHistory"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Property Type found.")
    );
} 