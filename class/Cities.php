<?php
class Cities{   
    
    private $citiesTable = "tbl_cities";      
    public $id;
    public $city;
    public $state_id;
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->citiesTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		}	
		elseif($this->state_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->citiesTable." WHERE state_id = ?");
			$stmt->bind_param("i", $this->state_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->citiesTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
}
?>