<?php
class Employee{   
    
    private $employeeTable = "tbl_employee";      
    public $emp_id;
    public $emp_name;
    public $emp_email;
    public $emp_mobile_no;
    public $emp_pan_no;
    public $emp_address;
    public $emp_city_id;
    public $emp_state_id;
    public $pincode;
    public $designation_id;
    public $emp_password;
    public $emp_encrypted_password;
    public $emp_reporting_to;
    //public $emp_profile_pic;
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->emp_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->employeeTable." WHERE emp_id = ?");
			$stmt->bind_param("i", $this->emp_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->employeeTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->employeeTable." (emp_name, emp_email, emp_mobile_no,emp_pan_no,emp_address,emp_city_id,emp_state_id,pincode,designation_id,emp_password,emp_encrypted_password,emp_reporting_to,is_active,created_date,updated_date)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$this->emp_name = htmlspecialchars(strip_tags($this->emp_name));
		$this->emp_email = htmlspecialchars(strip_tags($this->emp_email));
		$this->emp_mobile_no = htmlspecialchars(strip_tags($this->emp_mobile_no));
		$this->emp_pan_no = htmlspecialchars(strip_tags($this->emp_pan_no));
		$this->emp_address = htmlspecialchars(strip_tags($this->emp_address));
		$this->emp_city_id = htmlspecialchars(strip_tags($this->emp_city_id));
		$this->emp_state_id = htmlspecialchars(strip_tags($this->emp_state_id));
		$this->pincode = htmlspecialchars(strip_tags($this->pincode));
		$this->designation_id = htmlspecialchars(strip_tags($this->designation_id));
		$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));
		$this->emp_encrypted_password = htmlspecialchars(strip_tags($this->emp_encrypted_password));
		$this->emp_reporting_to = htmlspecialchars(strip_tags($this->emp_reporting_to));
		//$this->emp_profile_pic = htmlspecialchars(strip_tags($this->emp_profile_pic));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));

		$stmt->bind_param("sssssiisissiiss", $this->emp_name, $this->emp_email,$this->emp_mobile_no,$this->emp_pan_no,$this->emp_address,$this->emp_city_id,$this->emp_state_id,$this->pincode,$this->designation_id,$this->emp_password,$this->emp_encrypted_password,$this->emp_reporting_to,$this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->employeeTable." 
			SET emp_name= ?, emp_email = ?, emp_mobile_no = ?, emp_pan_no = ?,emp_address = ?,emp_city_id = ?,emp_state_id = ?,pincode = ?,designation_id = ?,emp_password = ?,emp_encrypted_password = ?,emp_reporting_to = ?,emp_profile_pic = ?, is_active = ?, created_date = ?, updated_date = ?
			WHERE emp_id = ?");
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$this->emp_name = htmlspecialchars(strip_tags($this->emp_name));
		$this->emp_email = htmlspecialchars(strip_tags($this->emp_email));
		$this->emp_mobile_no = htmlspecialchars(strip_tags($this->emp_mobile_no));
		$this->emp_pan_no = htmlspecialchars(strip_tags($this->emp_pan_no));
		$this->emp_address = htmlspecialchars(strip_tags($this->emp_address));
		$this->emp_city_id = htmlspecialchars(strip_tags($this->emp_city_id));
		$this->emp_state_id = htmlspecialchars(strip_tags($this->emp_state_id));
		$this->pincode = htmlspecialchars(strip_tags($this->pincode));
		$this->designation_id = htmlspecialchars(strip_tags($this->designation_id));
		$this->emp_password = htmlspecialchars(strip_tags($this->emp_password));
		$this->emp_encrypted_password = htmlspecialchars(strip_tags($this->emp_encrypted_password));
		$this->emp_reporting_to = htmlspecialchars(strip_tags($this->emp_reporting_to));
		$this->emp_profile_pic = htmlspecialchars(strip_tags($this->emp_profile_pic));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("ssiisi", $this->emp_name, $this->emp_email,$this->emp_mobile_no,$this->emp_pan_no,$this->emp_address,$this->emp_city_id,$this->emp_state_id,$this->pincode,$this->designation_id,$this->emp_password,$this->emp_encrypted_password,$this->emp_reporting_to,$this->emp_profile_pic,$this->is_active,$this->updated_date, $this->emp_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->employeeTable." 
			WHERE emp_id = ?");
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$stmt->bind_param("i", $this->emp_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>