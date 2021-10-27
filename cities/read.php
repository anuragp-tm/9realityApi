<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Cities.php';

$database = new Database();
$db = $database->getConnection();
 
$Cities = new Cities($db);

$Cities->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';
$Cities->state_id = (isset($_GET['state_id']) && $_GET['state_id']) ? $_GET['state_id'] : '0';

$result = $Cities->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Cities"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "city" => $city,
            "state_id" => $state_id		
        ); 
       array_push($itemRecords["Cities"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Cities found.")
    );
} 