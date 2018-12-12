<?php
//77include ("../conexion.php");
class DbConfig 
{	
	/*private  $dbName  = 'boxtracker_01';
	private  $dbHost = 'localhost';
	private  $dbUsername= 'admin';
	private  $dbUserPassword = 'boxtracker1234';*/

	


	protected $connection;
	
	public function __construct()
	{	
		 $basedatos='boxtracker_01';
	 $servidor='localhost';
	 $usuario='admin';
	 $paswd='boxtracker1234';

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