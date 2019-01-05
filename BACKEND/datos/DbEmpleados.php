<?php
include_once 'DbConfig.php';

class DbEmpleados extends DbConfig
{
	public function __construct($basedatos,$servidor,$usuario,$paswd)
	{
		parent::__construct($basedatos,$servidor,$usuario,$paswd);
	}
	
	public function getData($query)
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		
		return $rows;
	}
		
	public function execute($query) 
	{
		$result = $this->connection->query($query);
		if (!$result) {
			//echo 'Error: cannot execute the command';
			return false;
		} else {
			return $this->connection->insert_id;
		}
	}
	
	public function delete($id, $table) 
	{ 
		$query = "DELETE FROM $table WHERE pk = $id";
		
		$result = $this->connection->query($query);
	
		if ($result == false) {
			echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
			return false;
		} else {
			return true;
		}
	}

	public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}

	public function lastid(){
		$ult_id=mysqli_insert_id($this->connection);
		return $ult_id;
	}
}
?>

