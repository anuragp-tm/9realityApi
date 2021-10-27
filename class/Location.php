<?php
class Location{   
    
    private $locationTable = "tbl_location";      
    public $location_id;
    public $location_name;
    public $city;
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->location_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->locationTable." WHERE location_id = ?");
			$stmt->bind_param("i", $this->location_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->locationTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->locationTable."(`location_name`, `city`, `is_active`, `created_date`, `updated_date`)
			VALUES(?,?,?,?,?)");
		$this->location_name = htmlspecialchars(strip_tags($this->location_name));
		$this->city = htmlspecialchars(strip_tags($this->city));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));

		$stmt->bind_param("ssiis", $this->location_name, $this->city, $this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->locationTable." 
			SET location_name= ?, city = ?, is_active = ?, created_date = ?, updated_date = ?
			WHERE location_id = ?");
		$this->location_id = htmlspecialchars(strip_tags($this->location_id));
		$this->location_name = htmlspecialchars(strip_tags($this->location_name));
		$this->city = htmlspecialchars(strip_tags($this->city));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("ssiisi", $this->location_name, $this->city, $this->is_active, $this->updated_date, $this->location_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->locationTable." 
			WHERE location_id = ?");
		$this->location_id = htmlspecialchars(strip_tags($this->location_id));
		$stmt->bind_param("i", $this->location_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>