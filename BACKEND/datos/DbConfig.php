<?php

class DbConfig 
{	
	protected $connection;
	
	public function __construct()
	{	
		 $basedatos='lagunacampo';
	     $servidor='localhost';
	     $usuario='root';
	      $paswd='';

		$this->dbName = $basedatos;

		$this->dbHost = $servidor;
		$this->dbUsername = $usuario;
		$this->dbUserPassword = $paswd;

		if (!isset($this->connection)) {
			
			$this->connection = new mysqli($this->dbHost, $this->dbUsername, $this->dbUserPassword, $this->dbName);
			
			if (!$this->connection) {
				echo 'No se ha podido conectar a la base de datos';
				exit;
			}			
		}	
		
		return $this->connection;
	}

	// cerrar conexion
	public function disconnect(){
	    	
	    	if($this->connection){
	    	
	    		if(mysqli_close($this->connection)){
	    	
	    			$this->connection = false;
			
					return true;
				}else{
			
					return false;
				}
			}
	    }
}
?>