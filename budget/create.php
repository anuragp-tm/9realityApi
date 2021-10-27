<?php
header("Access-Control-Allow-Origin: http://localhost:8100");
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

if(!empty($data->budget_amount) ){    

    $Budget->Budget_amount = $data->budget_amount;
  
    $Budget->is_active = '1';
    $Budget->created_date = date('Y-m-d H:i:s');	
    $Budget->updated_date = date('Y-m-d H:i:s'); 
    
    if($Budget->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Budget was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create Budget."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create Budget. Data is incomplete."));
}
?>