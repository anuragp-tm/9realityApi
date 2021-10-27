<?php
class Budget{   
    
    private $BudgetTable = "tbl_budget";      
    public $Budget_id;
    public $Budget_amount;
    
    public $is_active;  
    public $created_date; 
	public $updated_date; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	function read(){	
		if($this->Budget_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->BudgetTable." WHERE budget_id = ?");
			$stmt->bind_param("i", $this->Budget_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->BudgetTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	function create(){
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->BudgetTable."(`budget_amount`, `is_active`, `created_date`, `updated_date`)
			VALUES(?,?,?,?)");
		$this->Budget_amount = htmlspecialchars(strip_tags($this->Budget_amount));
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->created_date = htmlspecialchars(strip_tags($this->created_date));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("siss", $this->Budget_amount, $this->is_active, $this->created_date, $this->updated_date);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
	function update(){
		$stmt = $this->conn->prepare("
			UPDATE ".$this->BudgetTable." 
			SET budget_amount= ?, is_active = ?, created_date = ?, updated_date = ?
			WHERE budget_id = ?");
		$this->Budget_id = htmlspecialchars(strip_tags($this->Budget_id));
		$this->Budget_amount = htmlspecialchars(strip_tags($this->Budget_amount));
		
		$this->is_active = htmlspecialchars(strip_tags($this->is_active));
		$this->updated_date = htmlspecialchars(strip_tags($this->updated_date));
		$stmt->bind_param("sisi", $this->Budget_amount,  $this->is_active, $this->updated_date, $this->Budget_id);
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	function delete(){
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->BudgetTable." 
			WHERE budget_id = ?");
		$this->Budget_id = htmlspecialchars(strip_tags($this->Budget_id));
		$stmt->bind_param("i", $this->Budget_id);
		if($stmt->execute()){
			return true;
		}
		return false;		 
	}
}
?>