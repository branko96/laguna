<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__) . '/../datos/DbHectarea.php';
	include_once dirname(__FILE__) . '/../model/Hectarea.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class HectareaController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbHectaria($basedatos,$servidor,$usuario,$paswd);
		}
	
		//Metodos//

		/*public function DevolverCaravanas()
		{	
					$query = sprintf("SELECT * FROM hectareas");
					$result = $this->db->getData($query);

			return $result;
		}*/
		
		public function VerHectarea($id_establecimiento){
			$query = sprintf("SELECT * FROM hectareas WHERE id_establecimiento = %d",$id_establecimiento);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la Hectarea');
				return $respuesta;
			}else{
					$caravana =  new Hectarea($result[0]['id'],$result[0]['id_establecimiento'],$result[0]['numero'],
                                              $result[0]['total_toros'],$result[0]['total_vacas'],$result[0]['total_terneros'],
                                              $result[0]['total_terneras'],$result[0]['total_novillos'],$result[0]['total_vaca_vieja'],
                                              $result[0]['total_vaquillona'],$result[0]['total_toros']);

					$respuesta =  new Respuesta(1,$caravana);

					return $respuesta;
			}	
			
		}

		public function AltaHectarea($numero,$total_toros,$total_vacas,$total_terneros,$total_terneras,
                                     $total_novillos,$total_vaca_vieja,$total_vaquillona,$total_caballos){

			$query = sprintf("INSERT INTO hectareas (numero,total_toros,total_vacas,total_terneros,total_terneras,
                                                           total_novillos,total_vaca_vieja,total_vaquillona,total_caballos)
                                          VALUES ('%s','%s','%s','%s','%s','%s','%s',%d)",
                                                           $numero,$total_toros,$total_vacas,$total_terneros,$total_terneras,
                                                           $total_novillos,$total_vaca_vieja,$total_vaquillona,$total_caballos);

			$result = $this->db->execute($query);
			
			$id = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, la Hectarea no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'Hectarea creado correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarHectarea($id){
			$query = sprintf("DELETE from hectareas WHERE id = %d", $id);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Hectarea eliminada correctamente');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar la hectarea');
					return $respuesta;
			}	
		}

		function EditarHectarea($id_establecimiento,$numero,$total_toros,$total_vacas,$total_terneros,$total_terneras,
                                $total_novillos,$total_vaca_vieja,$total_vaquillona,$total_caballos){
				$query = sprintf("UPDATE hectareas SET id_establecimiento = %d,numero = '%s',total_toros = '%s',total_vacas = '%s',
                                                             total_terneros = '%s',total_terneras = '%s',total_novillos = '%s',total_vaca_vieja = '%s',
                                                             total_vaquillona = '%s',total_caballos = '%s'
                                                       WHERE id = %d ;",$id_establecimiento,$numero,$total_toros,$total_vacas,$total_terneros,
                                                                        $total_terneras,$total_novillos,$total_vaca_vieja,$total_vaquillona,$total_caballos);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Hectarea actualizada correctamente');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar la hectarea');
					return $respuesta;
			}	
		}

		public function Traer_Caravanas(){
			$query = sprintf("SELECT * FROM hectareas");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$hectareas = [];
				//var_dump($result);
				for($i=0; $i< count($result);$i++){		
					$caravana= new Hectarea($result[$i]['id_caravana'],$result[$i]['codigo'],$result[$i]['descripcion'],$result[$i]['peso'],$result[$i]['sexo'],$result[$i]['categoria'],$result[$i]['procedencia'],$result[$i]['hectarea'],$result[$i]['cantidad']);
					array_push($hectareas,$caravana->getJson());
				}
					//$respuesta =  new Respuesta(1,$hectareas);
					$respuesta["id_respuesta"]=1;
					$respuesta["mensaje"]=$hectareas;
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
			$total_terneros=0;
			$total_terneras=0;
			$total_novillos=0;
			$total_vaquillona=0;
			$total_vaca_vieja=0;
			$total_caballos=0;
			
			//var_dump($hectarea);
		if (isset($hectarea) && $hectarea!="") {
			$query = sprintf("SELECT SUM(total_toros) AS cantidad FROM hectareas WHERE id_establecimiento=%d and numero='%s'",$id_establecimiento,$hectarea);
			$result = $this->db->getData($query);
			$query2 = sprintf("SELECT SUM(total_vacas) AS cantidad FROM hectareas WHERE id_establecimiento=%d   and numero='%s'",$id_establecimiento,$hectarea);
			$result2 = $this->db->getData($query2);
			$queryTerneros = sprintf("SELECT SUM(total_terneros) AS cantidad FROM hectareas WHERE id_establecimiento=%d and numero='%s'",$id_establecimiento,$hectarea);
			$resultTerneros = $this->db->getData($queryTerneros);
			$queryTerneras = sprintf("SELECT SUM(total_terneras) AS cantidad FROM hectareas WHERE id_establecimiento=%d   and numero='%s'",$id_establecimiento,$hectarea);
			$resultTerneras = $this->db->getData($queryTerneras);
			$queryNovillos = sprintf("SELECT SUM(total_novillos) AS cantidad FROM hectareas WHERE id_establecimiento=%d and numero='%s'",$id_establecimiento,$hectarea);
			$resultNovillos = $this->db->getData($queryNovillos);
			$queryVaquillona = sprintf("SELECT SUM(total_vaquillona) AS cantidad FROM hectareas WHERE id_establecimiento=%d   and numero='%s'",$id_establecimiento,$hectarea);
			$resultVaquillona = $this->db->getData($queryVaquillona);
			$queryVacaVieja = sprintf("SELECT SUM(total_vaca_vieja) AS cantidad FROM hectareas WHERE id_establecimiento=%d and numero='%s'",$id_establecimiento,$hectarea);
			$resultVacaVieja = $this->db->getData($queryVacaVieja);
			$queryCaballos = sprintf("SELECT SUM(total_caballos) AS cantidad FROM hectareas WHERE id_establecimiento=%d   and numero='%s'",$id_establecimiento,$hectarea);
			$resultCaballos = $this->db->getData($queryCaballos);

			if ($result[0]['cantidad']!=NULL) {
					$total_toros = $result[0]['cantidad'];
				}
			if ($result2[0]['cantidad']!=NULL) {
					$total_vacas= $result2[0]['cantidad'];
				}
			if ($resultTerneros[0]['cantidad']!=NULL) {
					$total_terneros = $resultTerneros[0]['cantidad'];
				}
			if ($resultTerneras[0]['cantidad']!=NULL) {
					$total_terneras= $resultTerneras[0]['cantidad'];
				}
			if ($resultNovillos[0]['cantidad']!=NULL) {
					$total_novillos = $resultNovillos[0]['cantidad'];
				}
			if ($resultVaquillona[0]['cantidad']!=NULL) {
					$total_vaquillona= $resultVaquillona[0]['cantidad'];
				}
			if ($resultVacaVieja[0]['cantidad']!=NULL) {
					$total_vaca_vieja = $resultVacaVieja[0]['cantidad'];
				}
			if ($resultCaballos[0]['cantidad']!=NULL) {
					$total_caballos= $resultCaballos[0]['cantidad'];
				}
		}else{
			$query3 = sprintf("SELECT SUM(total_toros) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result3 = $this->db->getData($query3);
			$query4 = sprintf("SELECT SUM(total_vacas) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result4 = $this->db->getData($query4);

			$query5 = sprintf("SELECT SUM(total_terneros) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result5 = $this->db->getData($query5);
			$query6 = sprintf("SELECT SUM(total_terneras) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result6 = $this->db->getData($query6);

			$query7 = sprintf("SELECT SUM(total_novillos) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result7 = $this->db->getData($query7);
			$query8 = sprintf("SELECT SUM(total_vaquillona) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result8 = $this->db->getData($query8);

			$query9 = sprintf("SELECT SUM(total_vaca_vieja) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result9 = $this->db->getData($query9);
			$query0 = sprintf("SELECT SUM(total_caballos) AS cantidad FROM hectareas WHERE id_establecimiento=%d ",$id_establecimiento);
			$result0 = $this->db->getData($query0);

			if ($result3[0]['cantidad']!=NULL) {
					$total_toros = $result3[0]['cantidad'];
				}
			if ($result4[0]['cantidad']!=NULL) {
					$total_vacas= $result4[0]['cantidad'];
				}
			if ($result5[0]['cantidad']!=NULL) {
					$total_terneros = $result5[0]['cantidad'];
				}
			if ($result6[0]['cantidad']!=NULL) {
					$total_terneras= $result6[0]['cantidad'];
				}
			if ($result7[0]['cantidad']!=NULL) {
					$total_novillos = $result7[0]['cantidad'];
				}
			if ($result8[0]['cantidad']!=NULL) {
					$total_vaquillona= $result8[0]['cantidad'];
				}
			if ($result9[0]['cantidad']!=NULL) {
					$total_vaca_vieja = $result9[0]['cantidad'];
				}
			if ($result0[0]['cantidad']!=NULL) {
					$total_caballos= $result0[0]['cantidad'];
				}
		}
					$respuesta["id_respuesta"]=1;
					$respuesta["mensaje"]["toros"]=$total_toros;	
					$respuesta["mensaje"]["vacas"]=$total_vacas;
					$respuesta["mensaje"]["terneros"]=$total_terneros;	
					$respuesta["mensaje"]["terneras"]=$total_terneras;
					$respuesta["mensaje"]["novillos"]=$total_novillos;	
					$respuesta["mensaje"]["vaca_vieja"]=$total_vaca_vieja;
					$respuesta["mensaje"]["vaquillona"]=$total_vaquillona;	
					$respuesta["mensaje"]["caballos"]=$total_caballos;	
	
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
                 $hectarea->total_toros =$result[$i]['total_toros'];
                 $hectarea->total_vacas= $result[$i]['total_vacas'];
                 $hectarea->total_terneros= $result[$i]['total_terneros'];
                 $hectarea->total_terneras= $result[$i]['total_terneras'];
                 $hectarea->total_novillos= $result[$i]['total_novillos'];
                 $hectarea->total_vaca_vieja= $result[$i]['total_vaca_vieja'];
                 $hectarea->total_vaquillona= $result[$i]['total_vaquillona'];
                 $hectarea->total_caballos= $result[$i]['total_caballos'];




                 array_push($hectareas, $hectarea);
                 $respuesta["id_respuesta"] = 1;
                 $respuesta["mensaje"]["hectareas"] = $hectareas;


             	}
                 
				 return $respuesta;

			}
		
		}
		
	}


	?>