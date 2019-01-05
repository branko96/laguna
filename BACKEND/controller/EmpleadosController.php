<?php
			
	include_once dirname(__FILE__). '/../datos/DbEmpleados.php';
	include_once dirname(__FILE__). '/../model/Empleado.php';

	class EmpleadosController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbEmpleados($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		public function DevolverEmpleados()
		{	
					$query = sprintf("SELECT * FROM empleados");
					$result = $this->db->getData($query);
					
			return $result;
		}


		
}


	?>