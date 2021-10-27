<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Designation.php';

$database = new Database();
$db = $database->getConnection();
 
$Designation = new Designation($db);

$Designation->designation_id = (isset($_GET['designation_id']) && $_GET['designation_id']) ? $_GET['designation_id'] : '0';

$result = $Designation->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Dasignations"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "designation_id" => $designation_id,
            "designation_name" => $designation_name,
            "designation_higher_key" => $designation_higher_key,
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["Dasignations"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Dasignations found.")
    );
} 