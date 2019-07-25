<?php

class DbConfig 
{	
	protected $connection;
	
	public function __construct()
	{	
		 $basedatos='c1520705_laguna';
	 $servidor='localhost';
	 $usuario='c1520705_perros';
	 $paswd='Perros2019';

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