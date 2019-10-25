<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbCaravanas.php';
	include_once dirname(__FILE__). '/../model/Caravana.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class CaravanasController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbCaravanas($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		/*public function DevolverCaravanas()
		{	
					$query = sprintf("SELECT * FROM caravanas");
					$result = $this->db->getData($query);

			return $result;
		}*/
		
		public function VerCaravana($caravanapk){
			$query = sprintf("SELECT * FROM caravanas WHERE id_caravana = %d",$caravanapk);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la caravana'); 
				return $respuesta;
			}else{
					$caravana =  new Caravana($result[0]['id_caravana'],$result[0]['codigo'],$result[0]['descripcion'],$result[0]['peso'],$result[0]['sexo'],$result[0]['categoria'],$result[0]['procedencia'],$result[0]['hectarea'],$result[0]['cantidad']);

					$respuesta =  new Respuesta(1,$caravana);

					return $respuesta;
			}	
			
		}

		public function AltaCaravana($codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$cantidad){			

			$query = sprintf("INSERT INTO caravanas (codigo,descripcion,peso,sexo,categoria,procedencia,hectarea,cantidad) VALUES ('%s','%s','%s','%s','%s','%s','%s',%d)", $codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$cantidad);

			$result = $this->db->execute($query);
			
			$id_caravana = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, la caravana no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'caravana creado correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarCaravana($id_caravana){
			$query = sprintf("DELETE from caravanas WHERE id_caravana = %d", $id_caravana);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Caravana eliminada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar la caravana');
					return $respuesta;
			}	
		}

		function EditarCaravana($id_caravana,$codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$cantidad){
				$query = sprintf("UPDATE caravanas SET codigo = %d,descripcion = '%s',peso = '%s',sexo = '%s',categoria = '%s',procedencia = '%s',hectarea = '%s' WHERE id_caravana = %d ;",$codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$cantidad,$id_caravana);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Caravana actualizada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar la caravana');
					return $respuesta;
			}	
		}

		public function Traer_Caravanas(){
			$query = sprintf("SELECT * FROM caravanas");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$caravanas = [];
				//var_dump($result);
				for($i=0; $i< count($result);$i++){		
					$caravana= new Caravana($result[$i]['id_caravana'],$result[$i]['codigo'],$result[$i]['descripcion'],$result[$i]['peso'],$result[$i]['sexo'],$result[$i]['categoria'],$result[$i]['procedencia'],$result[$i]['hectarea'],$result[$i]['cantidad']);
					array_push($caravanas,$caravana->getJson());
				}
					//$respuesta =  new Respuesta(1,$caravanas);
					$respuesta["id_respuesta"]=1;
					$respuesta["mensaje"]=$caravanas;	
			}else{
				//$respuesta =  new Respuesta(0,'No se ha encontrado ninguna caravana asociada.'); 
				  $respuesta["id_respuesta"]=-1;
				  $respuesta["mensaje"]='No se ha encontrado ninguna caravana asociada.';	
			}	
			//var_dump($respuesta);
			return $respuesta;					

		}

		public function Traer_por_hectarea($id_establecimiento,$hectarea){
			$total_toros=0;
			$total_vacas=0;
			//var_dump($hectarea);
		if (isset($hectarea) && $hectarea!="") {
			$query = sprintf("SELECT SUM(total_toros) AS cantidad FROM hectareas WHERE id_establecimiento=%d and numero='%s'",$id_establecimiento,$hectarea);
			$result = $this->db->getData($query);
			$query2 = sprintf("SELECT SUM(total_vacas) AS cantidad FROM hectareas WHERE id_establecimiento=%d   and numero='%s'",$id_establecimiento,$hectarea);
			$result2 = $this->db->getData($query2);

			if ($result[0]['cantidad']!=NULL) {
					$total_toros = $result[0]['cantidad'];
				}
			if ($result2[0]['cantidad']!=NULL) {
					$total_vacas= $result2[0]['cantidad'];
				}
		}else{
			$query3 = sprintf("SELECT SUM(total_toros) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result3 = $this->db->getData($query3);
			$query4 = sprintf("SELECT SUM(total_vacas) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result4 = $this->db->getData($query4);

			if ($result3[0]['cantidad']!=NULL) {
					$total_toros = $result3[0]['cantidad'];
				}
			if ($result4[0]['cantidad']!=NULL) {
					$total_vacas= $result4[0]['cantidad'];
				}
		}
					$respuesta["id_respuesta"]=1;
					$respuesta["mensaje"]["toros"]=$total_toros;	
					$respuesta["mensaje"]["vacas"]=$total_vacas;	
	
			return $respuesta;					
			
		}

		public function Traer_hectarea_id($id_establecimiento){
			$query = sprintf("SELECT * FROM hectareas WHERE id_establecimiento = %d",$id_establecimiento);
			$result = $this->db->getData($query);

			//var_dump($result);
			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado la hectarea'); 
				return $respuesta;
			}else{
				$hectareas = [];
             for($i=0; $i< count($result);$i++){
                 $hectarea = new stdClass();
                 $hectarea->id = $result[$i]['id'];
                 $hectarea->id_establecimiento= $result[$i]['id_establecimiento'];
                 $hectarea->numero= $result[$i]['numero'];

                 array_push($hectareas, $hectarea);
                 $respuesta["id_respuesta"] = 1;
				 $respuesta["mensaje"]["hectareas"] = $hectareas;
             	}
                 
				 return $respuesta;

			}
		
		}
		
	}


	?>