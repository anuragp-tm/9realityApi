<?php
class EnquiryHistory{   
    
    private $enquiryHistoryTable = "tbl_enquiry_history";      
    public $enq_history_id;
    public $enq_id;
    public $enq_details_id;
    public $emp_id;
    public $enq_date;
    public $last_call_date;
    public $next_contact_date;
    public $remarks;
    public $is_close;
    public $is_active;  
    public $created_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read()
	{	
		if($this->enq_history_id)
		{
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->enquiryHistoryTable." WHERE enq_history_id = ?");
			$stmt->bind_param("i", $this->enq_history_id);					
		} 
		else 
		{
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->enquiryHistoryTable);	
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->enquiryHistoryTable."(`enq_id`, `enq_details_id`, `emp_id`,`enq_date`,`last_call_date`,`next_contact_date`,`remarks`,`is_close`,`is_active`,`created_date`)
			VALUES(?,?,?,?,?,?,?,?,?,?)");
		$this->enq_id = htmlspecialchars(strip_tags($this->enq_id));
		$this->enq_details_id = htmlspecialchars(strip_tags($this->enq_details_id));
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$this->enq_date = htmlspecialchars(strip_tags($this->enq_date));
		$this->last_call_date = htmlspecialchars(strip_tags($this->last_call_date));
		$this->next_contact_date = htmlspecialchars(strip_tags($this->next_contact_date));
		$this->remarks = htmlspecialchars(strip_tags($this->remarks));
		$this->is_close = htmlspecialchars(strip_tags($this->is_close));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));


		$stmt->bind_param("ssiis", $this->enq_id, $this->enq_details_id,$this->emp_id,$this->enq_date,$this->last_call_date,$this->next_contact_date,$this->remarks,$this->is_close,$this->is_active, $this->created_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	/*function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->enquiryHistoryTable." 
			SET enq_id= ?, enq_details_id = ?, emp_id = ?, enq_date = ?,last_call_date = ?,next_contact_date = ?,remarks = ?,is_close = ?,is_active = ?, created_date = ?
			WHERE enq_history_id = ?");
		$this->enq_id = htmlspecialchars(strip_tags($this->enq_id));
		$this->enq_details_id = htmlspecialchars(strip_tags($this->enq_details_id));
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$this->enq_date = htmlspecialchars(strip_tags($this->enq_date));
		$this->last_call_date = htmlspecialchars(strip_tags($this->last_call_date));
		$this->next_contact_date = htmlspecialchars(strip_tags($this->next_contact_date));
		$this->remarks = htmlspecialchars(strip_tags($this->remarks));
		$this->is_close = htmlspecialchars(strip_tags($this->is_close));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$stmt->bind_param("ssiisi", $this->enq_id, $this->enq_details_id,$this->emp_id,$this->enq_date,$this->last_call_date,$this->next_contact_date,$this->remarks,$this->is_close,$this->is_active,$this->created_date,$this->emp_encrypted_password,$this->emp_reporting_to,$this->emp_profile_pic,$this->is_active,$this->updated_date, $this->emp_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}*/
	/*function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->employeeTable." 
			WHERE emp_id = ?");
		$this->emp_id = htmlspecialchars(strip_tags($this->emp_id));
		$stmt->bind_param("i", $this->emp_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}*/
}
?>