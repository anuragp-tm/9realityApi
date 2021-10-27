<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/States.php';

$database = new Database();
$db = $database->getConnection();
 
$States = new States($db);

$States->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $States->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["States"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "name" => $name,
            "country_id" => $country_id	
        ); 
       array_push($itemRecords["States"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No States found.")
    );
} 