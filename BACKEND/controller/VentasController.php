<?php
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../datos/DbVentas.php';
	include_once dirname(__FILE__). '/../model/Venta.php';
	//include_once dirname(__FILE__). '/../datos/conexion.php';

	class VentasController
	{
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbVentas($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//

		public function DevolverVentas()
		{	
					$query = sprintf("SELECT * FROM ventas");
					$result = $this->db->getData($query);

			return $result;
		}
		
		public function VerVenta($ventapk){
			$query = sprintf("SELECT * FROM ventas WHERE id_ventas = %d",$ventapk);
			$result = $this->db->getData($query);
			//var_dump($result);
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado la venta'); 
				return $respuesta;
			}else{
					$venta =  new Venta($result[0]['id_ventas'],$result[0]['fecha'],$result[0]['num_fact'],$result[0]['num_fact'],$result[0]['cabezas'],$result[0]['kg'],$result[0]['peso_x_kg'],$result[0]['bruto'],$result[0]['iva'],$result[0]['neto'],$result[0]['retencion']);

					$respuesta =  new Respuesta(1,$venta);

					return $respuesta;
			}	
			
		}

		public function AltaVenta($fecha,$num_fact,$cabezas,$kg,$peso_x_kg){			

			$query = sprintf("INSERT INTO ventas (fecha,num_fact,cabezas,kg,peso_x_kg) VALUES ('%s','%s',%d,'%f','%f')", $fecha,$num_fact,$cabezas,$kg,$peso_x_kg);

			$result = $this->db->execute($query);
			//var_dump($result);
			$id_ventas = $this->db->lastid();
			
			if(!$result){ 
				$respuesta =  new Respuesta(-1,'Error, la venta no se ha podido grabar');
				return $respuesta;
				
				
			}else{
					$respuesta =  new Respuesta(1,'venta creado correctamente');
					return $respuesta;
					
			}
		}

		public function EliminarVenta($id_ventas){
			$query = sprintf("DELETE from ventas WHERE id_ventas = %d", $id_ventas);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'Venta eliminada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar la venta');
					return $respuesta;
			}	
		}

		function EditarVenta($id_ventas,$fecha,$num_fact,$cabezas,$kg,$peso_x_kg,$bruto,$iva,$neto,$retencion){
				$query = sprintf("UPDATE ventas SET fecha = '%s',num_fact = '%s',cabezas = %d,kg = '%f',peso_x_kg = '%f',bruto = '%f',iva = '%f',neto = '%f',retencion = '%f' WHERE id_ventas = %d ;",$fecha,$num_fact,$cabezas,$kg,$peso_x_kg,$bruto,$iva,$neto,$retencion,$id_ventas);

			$result = $this->db->execute($query);
			
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Venta actualizada correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar la venta');
					return $respuesta;
			}	
		}

		public function Traer_Ventas(){
			$query = sprintf("SELECT * FROM ventas");

			$result = $this->db->getData($query);

			if(count($result)>0) {
				$ventas = [];
				for($i=0; $i< count($result);$i++){		

					array_push($ventas, new Venta($result[$i]['id_ventas'],$result[$i]['fecha'],$result[$i]['num_fact'],$result[$i]['cabezas'],$result[$i]['kg'],$result[$i]['peso_x_kg'],$result[$i]['bruto'],$result[$i]['iva'],$result[$i]['neto'],$result[$i]['retencion']));
				}
					$respuesta =  new Respuesta(1,$ventas);
					return $respuesta;	
				
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna venta asociada.'); 
				return $respuesta;	
			}						

		}
		
	}


	?>