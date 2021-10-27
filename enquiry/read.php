<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Enquiry.php';

$database = new Database();
$db = $database->getConnection();
 
$Enquiry = new Enquiry($db);

$Enquiry->enquiry_id = (isset($_GET['enquiry_id']) && $_GET['enquiry_id']) ? $_GET['enquiry_id'] : '0';

$result = $Enquiry->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Enquiries"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "enquiry_id" => $enquiry_id,
            "customer_name" => $customer_name,
            "customer_mobile_no" => $customer_mobile_no,
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["Enquiries"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Enquiry found.")
    );
} 