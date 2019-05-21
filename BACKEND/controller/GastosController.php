<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbGastos.php';
	include_once dirname(__FILE__). '/../model/Gasto.php';
	include_once dirname(__FILE__). '/../model/Establecimiento.php';
	include_once dirname(__FILE__). '/../model/Categoria.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class GastosController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbGastos($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		public function DevolverGastos()
		{	
					$query = sprintf("SELECT * FROM gastos_reales");
					$result = $this->db->getData($query);

			return $result;
		}
		
		public function VerGasto($gastopk){
			$query = sprintf("SELECT * FROM gastos_reales WHERE id_gasto = %d",$gastopk);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el gasto'); 
				return $respuesta;
			}else{
					$gasto =  new Gasto($result[0]['id_gasto'],$result[0]['fecha'],$result[0]['id_categoria'],$result[0]['detalle'],$result[0]['valor'],$result[0]['id_establecimiento'],$result[0]['tipo_recibo']);

					$respuesta =  new Respuesta(1,$gasto);

					return $respuesta;
			}	
			
		}

		public function AltaGasto($fecha,$id_categoria,$detalle,$valor,$id_establecimiento,$tipo_recibo){		
			$query = sprintf("INSERT INTO gastos_reales (fecha,id_categoria,detalle,valor,id_establecimiento,tipo_recibo) VALUES ('%s',%d,'%s','%f',%d,'%s')", $fecha,$id_categoria,$detalle,$valor,$id_establecimiento,$tipo_recibo);

			$result = $this->db->execute($query);
			//var_dump($result);
			$id_gasto = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, el gasto no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'gasto creado correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarGasto($id_gasto){
			$query = sprintf("DELETE from gastos_reales WHERE id_gasto = %d", $id_gasto);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Gasto eliminado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar el gasto');
					return $respuesta;
			}	
		}

		function EditarGasto($id_gasto,$fecha,$id_categoria,$detalle,$valor,$id_establecimiento,$tipo_recibo){
				$query = sprintf("UPDATE gastos_reales SET fecha = '%s',id_categoria = %d,detalle = '%s',valor = '%f',id_establecimiento = %d,tipo_recibo = '%s' WHERE id_gasto = %d ;",$fecha,$id_categoria,$detalle,$valor,$id_establecimiento,$tipo_recibo,$id_gasto);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Gasto actualizado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar el gasto');
					return $respuesta;
			}	
		}

		public function Traer_gastos(){
			$query = sprintf("SELECT * FROM gastos_reales");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$gastos_reales = [];
				
				for($i=0; $i< count($result);$i++){		

					array_push($gastos_reales, new Gasto($result[$i]['id_gasto'],$result[$i]['fecha'],$result[$i]['id_categoria'],$result[$i]['detalle'],$result[$i]['valor'],$result[$i]['id_establecimiento'],$result[$i]['tipo_recibo']));
				}
					$respuesta =  new Respuesta(1,$gastos_reales);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun gasto asociado.'); 
				return $respuesta;	
			}						

		}

		public function Traer_establecimientos(){
			$query = sprintf("SELECT * FROM establecimientos");

			$result = $this->db->getData($query);
			//var_dump($result);
			if(count($result)>0) {
				$establecimientos = [];
				
				for($i=0; $i< count($result);$i++){		

					array_push($establecimientos, new Establecimiento($result[$i]['id_establecimiento'],$result[$i]['nombre']));
				}
					$respuesta =  new Respuesta(1,$establecimientos);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun establecimiento.'); 
				return $respuesta;	
			}						

		}

		public function Traer_categorias(){
			$query = sprintf("SELECT * FROM gastos_categorias");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$gastos_categorias = [];
				
				for($i=0; $i< count($result);$i++){		

					array_push($gastos_categorias, new Categoria($result[$i]['id_categoria'],$result[$i]['concepto']));
				}
					$respuesta =  new Respuesta(1,$gastos_categorias);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna categoria.'); 
				return $respuesta;	
			}						

		}
		
	}


	?>