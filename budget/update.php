<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Budget.php';
 
$database = new Database();
$db = $database->getConnection();
$Budget = new Budget($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->budget_id) && !empty($data->budget_amount) ){ 
	
	$Budget->budget_id = $data->budget_id; 
	$Budget->budget_amount = $data->budget_amount;
    
    $Budget->updated_date = date('Y-m-d H:i:s'); 
	
	if($Budget->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Budget was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update Budget."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update Budget. Data is incomplete."));
}
?>