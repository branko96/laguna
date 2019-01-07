<?php
	include_once dirname(__FILE__). 'C:\wamp\www\laguna\BACKEND\model\Respuesta.php';
	include_once dirname(__FILE__). 'C:\wamp\www\laguna\BACKEND\datos\DbEmpleados.php';
	include_once dirname(__FILE__). 'C:\wamp\www\laguna\BACKEND\model\Empleado.php';
	//set_include_path('//model/Respuesta.php');
	//set_include_path('//model/Empleado.php');
	//set_include_path('//datos/DbEmpleados.php');

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
		
		public function VerEmpleado($empleadopk){
			$query = sprintf("SELECT * FROM empleados WHERE id_empleado = %d",$empleadopk);
			$result = $this->db->getData($query);
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el empleado'); 
				return $respuesta;
			}else{
					$empleado =  new Empleado($result[0]['id_empleado'],$result[0]['nombre'],$result[0]['apellido'],$result[0]['puesto'],$result[0]['fecha_inicio'],$result[0]['sueldo'],$result[0]['dni'],$result[0]['cuil'],$result[0]['cod_postal'],$result[0]['fecha_fin']);

					$respuesta =  new Respuesta(1,$empleado);

					return $respuesta;
			}	
			
			}


		
}


	?>