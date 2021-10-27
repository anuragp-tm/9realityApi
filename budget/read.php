<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Budget.php';

$database = new Database();
$db = $database->getConnection();
 
$Budget = new Budget($db);

$Budget->Budget_id = (isset($_GET['budget_id']) && $_GET['budget_id']) ? $_GET['budget_id'] : '0';

$result = $Budget->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Budgets"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "budget_id" => $budget_id,
            "budget_amount" => $budget_amount,
           
			"is_active" => $is_active,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["Budgets"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Budget found.")
    );
} 