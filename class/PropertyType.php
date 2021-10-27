<?php
class PropertyType{   
    
    private $propertyTypeTable = "tbl_property_type";      
    public $property_type_id;
    public $property_type_name;
    public $property_headtype;
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->property_type_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->propertyTypeTable." WHERE property_id = ?");
			$stmt->bind_param("i", $this->property_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->propertyTypeTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->propertyTypeTable."(`property_type_name`, `property_headtype`,`is_active`, `created_date`, `updated_date`)
			VALUES(?,?,?,?,?)");
		$this->property_type_name = htmlspecialchars(strip_tags($this->property_type_name));
		$this->property_headtype = htmlspecialchars(strip_tags($this->property_headtype));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));

		$stmt->bind_param("ssiss", $this->property_type_name, $this->property_headtype, $this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->propertyTypeTable." 
			SET property_type_name= ?, property_headtype = ?, is_active = ?, created_date = ?, updated_date = ?
			WHERE property_id = ?");
		$this->property_id = htmlspecialchars(strip_tags($this->property_id));
		$this->property_type_name = htmlspecialchars(strip_tags($this->property_type_name));
		$this->property_headtype = htmlspecialchars(strip_tags($this->property_headtype));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("ssiisi", $this->property_type_name, $this->property_headtype, $this->is_active, $this->updated_date, $this->property_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->propertyTypeTable." 
			WHERE property_id = ?");
		$this->property_id = htmlspecialchars(strip_tags($this->property_id));
		$stmt->bind_param("i", $this->property_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>