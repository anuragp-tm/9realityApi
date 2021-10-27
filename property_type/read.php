<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/PropertyType.php';

$database = new Database();
$db = $database->getConnection();
 
$PropertyType = new PropertyType($db);

$PropertyType->property_id = (isset($_GET['property_id']) && $_GET['property_id']) ? $_GET['property_id'] : '0';

$result = $PropertyType->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["PropertyType"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "property_id" => $property_id,
            "property_type_name" => $property_type_name,
            "property_headtype" => $property_headtype,
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["PropertyType"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Property Type found.")
    );
} 