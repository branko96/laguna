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
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el empleado'); 
				return $respuesta;
			}else{
					$empleado =  new Empleado($result[0]['id_empleado'],$result[0]['nombre'],$result[0]['apellido'],$result[0]['puesto'],$result[0]['fecha_inicio'],$result[0]['sueldo'],$result[0]['email'],$result[0]['dni'],$result[0]['cuil'],$result[0]['cod_postal'],$result[0]['fecha_fin']);

					$respuesta =  new Respuesta(1,$empleado);

					return $respuesta;
			}	
			
		}

		public function AltaEmpleado($nombre,$apellido,$puesto,$fecha_inicio,$sueldo,$email,$dni,$cuil,$cod_postal,$fecha_fin){			

			$query = sprintf("INSERT INTO empleados (nombre,apellido,puesto,fecha_inicio,sueldo,email,dni,cuil,cod_postal,fecha_fin) VALUES ('%s','%s','%s','%s','%f','%s','%s',%d,%d,'%s')", $nombre,$apellido,$puesto,$fecha_inicio,$sueldo,$email,$dni,$cuil,$cod_postal,$fecha_fin);

			$result = $this->db->execute($query);
			$id_empleado = $this->db->lastid();
			//var_dump($result);
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, el empleado no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'empleado creado correctamente');
					return $respuesta;
					
			}
		}


		public function EliminarEmpleado($id_empleado){
			$query = sprintf("DELETE from empleados WHERE id_empleado = %d", $id_empleado);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Empleado eliminado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar el empleado');
					return $respuesta;
			}	
		}

		function EditarEmpleado($id_empleado,$nombre,$apellido,$puesto,$sueldo,$email,$dni,$cuil,$cod_postal,$fecha_fin){
				$query = sprintf("UPDATE empleados SET nombre = '%s',apellido = '%s',puesto = '%s',sueldo = %f,email = '%s',dni = '%s',cuil = %d,cod_postal = %d,fecha_fin = '%s' WHERE id_empleado = %d ;",$nombre,$apellido,$puesto,$sueldo,$email,$dni,$cuil,$cod_postal,$fecha_fin,$id_empleado);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Empleado actualizado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar el empleado');
					return $respuesta;
			}	
		}

		public function Traer_Empleados(){
			$query = sprintf("SELECT * FROM empleados");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$empleados = [];
				for($i=0; $i< count($result);$i++){		

					array_push($empleados, new Empleado($result[$i]['id_empleado'],$result[$i]['nombre'],$result[$i]['apellido'],$result[$i]['puesto'],$result[$i]['fecha_inicio'],$result[$i]['sueldo'],$result[$i]['email'],$result[$i]['dni'],$result[$i]['cuil'],$result[$i]['cod_postal'],$result[$i]['fecha_fin']));
				}
					$respuesta =  new Respuesta(1,$empleados);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun empleado asociado.'); 
				return $respuesta;	
			}						

		}
		
	}


	?>