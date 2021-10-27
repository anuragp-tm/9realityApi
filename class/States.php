<?php
class States{   
    
    private $statesTable = "tbl_states";      
    public $id;
    public $name;
    public $country_id;
    private $conn;
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->statesTable." WHERE id = ?");
			$stmt->bind_param("i", $this->id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->statesTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
}
?>