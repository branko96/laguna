<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbEmpleados.php';
	include_once dirname(__FILE__). '/../model/Empleado.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

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
			var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el empleado'); 
				return $respuesta;
			}else{
					$empleado =  new Empleado($result[0]['id_empleado'],$result[0]['nombre'],$result[0]['apellido'],$result[0]['puesto'],$result[0]['fecha_inicio'],$result[0]['sueldo'],$result[0]['dni'],$result[0]['cuil'],$result[0]['cod_postal'],$result[0]['fecha_fin']);

					$respuesta =  new Respuesta(1,$empleado);

					return $respuesta;
			}	
			
		}

		public function AltaEmpleado($nombre,$apellido,$puesto,$fecha_inicio,$sueldo,$dni,$cuil,$cod_postal,$fecha_fin){			

			$query = sprintf("INSERT INTO empleados (nombre,apellido,puesto,fecha_inicio,sueldo,dni,cuil,cod_postal,fecha_fin) VALUES ('%s','%s','%s','%s','%f',%d,%d,%d,'%s')", $nombre,$apellido,$puesto,$fecha_inicio,$sueldo,$dni,$cuil,$cod_postal,$fecha_fin);

			$result = $this->db->execute($query);
			$id_empleado = $this->db->lastid();

			var_dump($result);
			if(count($result)>0){ 
				$empleado =  new Empleado($result[0]['id_empleado'],$result[0]['nombre'],$result[0]['apellido'],$result[0]['puesto'],$result[0]['fecha_inicio'],$result[0]['dni'],$result[0]['cuil'],$result[0]['cod_postal'],$result[0]['fecha_fin']);
				
				$respuesta =  new Respuesta(1,'empleado creado correctamente');
				return $empleado;
				
			}else{
					$respuesta =  new Respuesta(-1,'Error, el empleado no se ha podido grabar');
					return $respuesta;
			}
		}


		
}


	?>