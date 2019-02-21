<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbMovimientos.php';
	include_once dirname(__FILE__). '/../model/Movimiento.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class MovimientosController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbMovimientos($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		public function DevolverMovimientos()
		{	
					$query = sprintf("SELECT * FROM movimientos");
					$result = $this->db->getData($query);

			return $result;
		}
		
		public function VerMovimiento($movimientopk){
			$query = sprintf("SELECT * FROM movimientos WHERE id_mov = %d",$movimientopk);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el movimiento'); 
				return $respuesta;
			}else{
					$movimiento =  new Movimiento($result[0]['id_mov'],$result[0]['id_caravana'],$result[0]['fecha_mov'],$result[0]['cantidad'],$result[0]['tipo_mov']);

					$respuesta =  new Respuesta(1,$movimiento);

					return $respuesta;
			}	
			
		}

		public function AltaMovimiento($id_caravana,$fecha_mov,$cantidad,$tipo_mov){			

			$query = sprintf("INSERT INTO movimientos (id_caravana,fecha_mov,cantidad,tipo_mov) VALUES (%d,'%s',%d,'%s')", $id_caravana,$fecha_mov,$cantidad,$tipo_mov);

			$result = $this->db->execute($query);
			//var_dump($result);
			$id_mov = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, el movimiento no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'movimiento creado correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarMovimiento($id_mov){
			$query = sprintf("DELETE from movimientos WHERE id_mov = %d", $id_mov);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Movimiento eliminado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar el movimiento');
					return $respuesta;
			}	
		}

		function EditarMovimiento($id_mov,$id_caravana,$fecha_mov,$cantidad,$tipo_mov){
				$query = sprintf("UPDATE movimientos SET id_caravana = %d,fecha_mov = '%s',cantidad = %d,tipo_mov = '%s' WHERE id_mov = %d ;",$id_caravana,$fecha_mov,$cantidad,$tipo_mov,$id_mov);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Movimiento actualizada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar el movimiento');
					return $respuesta;
			}	
		}

		public function Traer_Movimientos(){
			$query = sprintf("SELECT * FROM movimientos");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$movimientos = [];
				for($i=0; $i< count($result);$i++){		

					array_push($movimientos, new Movimiento($result[$i]['id_mov'],$result[$i]['id_caravana'],$result[$i]['fecha_mov'],$result[$i]['cantidad'],$result[$i]['tipo_mov']));
				}
					$respuesta =  new Respuesta(1,$movimientos);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun movimiento asociado.'); 
				return $respuesta;	
			}						

		}
		
	}


	?>