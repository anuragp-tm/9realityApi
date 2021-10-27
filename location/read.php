<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Location.php';

$database = new Database();
$db = $database->getConnection();
 
$Location = new Location($db);

$Location->location_id = (isset($_GET['location_id']) && $_GET['location_id']) ? $_GET['location_id'] : '0';

$result = $Location->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Locations"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "location_id" => $location_id,
            "location_name" => $location_name,
            "city" => $city,
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["Locations"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Location found.")
    );
} 