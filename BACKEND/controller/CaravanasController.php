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
					$caravana =  new Caravana($result[0]['id_caravana'],$result[0]['codigo'],$result[0]['descripcion'],$result[0]['peso'],$result[0]['sexo'],$result[0]['categoria'],$result[0]['procedencia'],$result[0]['hectarea']);

					$respuesta =  new Respuesta(1,$caravana);

					return $respuesta;
			}	
			
		}

		public function AltaCaravana($codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea){			

			$query = sprintf("INSERT INTO caravanas (codigo,descripcion,peso,sexo,categoria,procedencia,hectarea) VALUES ('%s','%s','%s','%s','%s','%s','%s')", $codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea);

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

		function EditarCaravana($id_caravana,$codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea){
				$query = sprintf("UPDATE caravanas SET codigo = %d,descripcion = '%s',peso = '%s',sexo = '%s',categoria = '%s',procedencia = '%s',hectarea = '%s' WHERE id_caravana = %d ;",$codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$id_caravana);

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
					$caravana= new Caravana($result[$i]['id_caravana'],$result[$i]['codigo'],$result[$i]['descripcion'],$result[$i]['peso'],$result[$i]['sexo'],$result[$i]['categoria'],$result[$i]['procedencia'],$result[$i]['hectarea']);
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

		public function Traer_por_hectarea($procedencia,$hectarea){
		$query = sprintf("SELECT COUNT(*) FROM caravanas WHERE procedencia='%s' and hectarea='%s' and sexo='M'",$procedencia,$hectarea);
		$result = $this->db->getData($query);
		$query2 = sprintf("SELECT COUNT(*) FROM caravanas WHERE procedencia='%s' and hectarea='%s' and sexo='F'",$procedencia,$hectarea);
		$result2 = $this->db->getData($query2);

			if(count($result)>0) {
				$caravanas = [];
					//$respuesta =  new Respuesta(1,$caravanas);
					$respuesta["id_respuesta"]=1;
					$respuesta["mensaje"]["toros"]=$result;	
					$respuesta["mensaje"]["vacas"]=$result2;	
			}else{
				//$respuesta =  new Respuesta(0,'No se ha encontrado ninguna caravana asociada.'); 
				  $respuesta["id_respuesta"]=-1;
				  $respuesta["mensaje"]='No se ha encontrado ninguna caravana asociada.';	
			}	
			//var_dump($respuesta);
			return $respuesta;					

		}
		
	}


	?>