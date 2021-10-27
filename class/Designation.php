<?php
class Designation{   
    
    private $designationTable = "tbl_designation";      
    public $designation_id;
    public $designation_name;
    public $designation_higher_key;
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->designation_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->designationTable." WHERE designation_id = ?");
			$stmt->bind_param("i", $this->designation_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->designationTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->designationTable."(`designation_name`, `designation_higher_key`, `is_active`, `created_date`, `updated_date`)
			VALUES(?,?,?,?,?)");
		$this->designation_name = htmlspecialchars(strip_tags($this->designation_name));
		$this->designation_higher_key = htmlspecialchars(strip_tags($this->designation_higher_key));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("ssiis", $this->designation_name, $this->designation_higher_key, $this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->designationTable." 
			SET designation_name= ?, designation_higher_key = ?, is_active = ?, created_date = ?, updated_date = ?
			WHERE designation_id = ?");
		$this->designation_id = htmlspecialchars(strip_tags($this->designation_id));
		$this->designation_name = htmlspecialchars(strip_tags($this->designation_name));
		$this->designation_higher_key = htmlspecialchars(strip_tags($this->designation_higher_key));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("ssiisi", $this->designation_name, $this->designation_higher_key, $this->is_active, $this->updated_date, $this->designation_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->designationTable." 
			WHERE designation_id = ?");
		$this->designation_id = htmlspecialchars(strip_tags($this->designation_id));
		$stmt->bind_param("i", $this->designation_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>