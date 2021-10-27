<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Employee.php';

$database = new Database();
$db = $database->getConnection();
 
$Employee = new Employee($db);

$Employee->emp_id = (isset($_GET['emp_id']) && $_GET['emp_id']) ? $_GET['emp_id'] : '0';

$result = $Employee->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["Employee"]=array(); 
    $i = 1;
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        if($is_active == 1)
            $status = "Active";
        else
            $status = "Inactive";

        $itemDetails=array(
            "slno" => $i,
            "emp_id" => $emp_id,
            "name" => $emp_name,
            "email" => $emp_email,
            "mobile" => $emp_mobile_no,
            "pan_no" => $emp_pan_no,
            "address" => $emp_address,
            "emp_city_id" => $emp_city_id,
            "emp_state_id" => $emp_state_id,
            "pincode" => $pincode,
            "designation_id" => $designation_id,
            "reportingto" => $emp_reporting_to,
            "emp_profile_pic" => $emp_profile_pic,
			"status" => $status,          
			"created_date" => $created_date,
            "updated_date" => $updated_date			
        ); 
       array_push($itemRecords["Employee"], $itemDetails);
       $i++;
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No Employee found.")
    );
} 