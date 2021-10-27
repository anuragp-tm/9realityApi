<?php
class Enquiry{   
    
    private $enquiryTable = "tbl_enquiry";      
    public $enquiry_id;
    public $customer_name;
    public $customer_mobile_no; 
    public $emp_id;
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->enquiry_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->enquiryTable." WHERE enquiry_id = ?");
			$stmt->bind_param("i", $this->enquiry_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->enquiryTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->enquiryTable."(`customer_name`,`customer_mobile_no`,`emp_id`, `is_active`, `created_date`, `updated_date`)
			VALUES(?,?,?,?,?,?)");
		$this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
		$this->customer_mobile_no = htmlspecialchars(strip_tags($this->customer_mobile_no));
        $this->emp_id=htmlspecialchars(strip_tags($this->emp_id));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("siiiss", $this->customer_name, $this->customer_mobile_no,$this->emp_id, $this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->enquiryTable." 
			SET customer_name= ?, customer_mobile_no = ?, emp_id=?, is_active = ?, created_date = ?, updated_date = ?
			WHERE enquiry_id = ?");
		$this->enquiry_id = htmlspecialchars(strip_tags($this->enquiry_id));
		$this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->customer_mobile_no = htmlspecialchars(strip_tags($this->customer_mobile_no));
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("siiisi", $this->customer_name,$this->customer_mobile_no, $this->emp_id , $this->is_active, $this->updated_date, $this->enquiry_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->enquiryTable." 
			WHERE enquiry_id = ?");
		$this->enquiry_id = htmlspecialchars(strip_tags($this->enquiry_id));
		$stmt->bind_param("i", $this->enquiry_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>