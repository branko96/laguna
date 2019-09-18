<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbTareas.php';
	include_once dirname(__FILE__). '/../model/Tarea.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class TareasController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbTareas($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		public function DevolverTareas()
		{	
					$query = sprintf("SELECT * FROM tareas");
					$result = $this->db->getData($query);

			return $result;
		}
		
		public function VerTarea($tareapk){
			$query = sprintf("SELECT * FROM tareas WHERE id_tareas = %d",$tareapk);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la tarea'); 
				return $respuesta;
			}else{
					$tarea =  new Tarea($result[0]['id_tareas'],$result[0]['nombre'],$result[0]['descrip'],$result[0]['fecha'],$result[0]['id_establecimiento']);

					$respuesta =  new Respuesta(1,$tarea);

					return $respuesta;
			}	
			
		}

		public function AltaTarea($nombre,$descrip,$fecha,$id_establecimiento){			

			$query = sprintf("INSERT INTO tareas (nombre,descrip,fecha,id_establecimiento) VALUES ('%s','%s','%s',%d)", $nombre,$descrip,$fecha,$id_establecimiento);

			$result = $this->db->execute($query);
			//var_dump($result);
			$id_tareas = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, la tarea no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'tarea creada correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarTarea($id_tareas){
			$query = sprintf("DELETE from tareas WHERE id_tareas = %d", $id_tareas);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Tarea eliminada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar la tarea');
					return $respuesta;
			}	
		}

		function EditarTarea($id_tareas,$nombre,$descrip,$fecha,$id_establecimiento){
				$query = sprintf("UPDATE tareas SET nombre = '%s',descrip = '%s',fecha = '%s',id_establecimiento = %d WHERE id_tareas = %d ;",$nombre,$descrip,$fecha,$id_establecimiento);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Tarea actualizada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar la tarea');
					return $respuesta;
			}	
		}

		public function Traer_Tareas(){
			$query = sprintf("SELECT * FROM tareas");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$tareas = [];
				
				for($i=0; $i< count($result);$i++){		

					array_push($tareas, new Tarea($result[$i]['id_tareas'],$result[$i]['nombre'],$result[$i]['descrip'],$result[$i]['fecha'],$result[$i]['id_establecimiento']));
				}
					$respuesta =  new Respuesta(1,$tareas);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna tarea asociada.'); 
				return $respuesta;	
			}						

		}
		
	}


	?>