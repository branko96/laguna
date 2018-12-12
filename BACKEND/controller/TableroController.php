<?php
	include_once dirname(__FILE__). '/../datos/DbTableros.php';
	include_once dirname(__FILE__). '/../model/Proyect.php';
	include_once dirname(__FILE__). '/../model/Tablero.php';
	include_once dirname(__FILE__). '/../model/Grupo.php';
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../model/Usuario.php';
	include_once dirname(__FILE__). '/../controller/UsuariosController.php';

	class TableroController{
		private $db;	

		//Constructor//

		public function __construct()
		{	
			include_once dirname(__FILE__).'/../datos/conexion.php';
			$this->db = new DbTableros();	
			$this->usuariosCont = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
		}

		//******************* Metodos *********************//

		public function Traer_allProyects($id_creador){
		//En esta funcion se selecciona el proyecto segun lo que se reciba como parametro de id de creador	
			$query = sprintf("SELECT boxtracker_01.proyectos.* FROM boxtracker_01.proyectos INNER join boxtracker_01.miembros_grupo ON boxtracker_01.proyectos.id_group = boxtracker_01.miembros_grupo.fk_grupo WHERE boxtracker_01.proyectos.estado <> 5 and boxtracker_01.miembros_grupo.fk_usuario = %d ;",$id_creador);

			$result = $this->db->getData($query);

		   //El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto proyecto y así retornar a la función principal o quien la llame.	

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$proyectos = [];
				for($i=0; $i< count($result);$i++){						
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$result[$i]['id_group'],$result[$i]['id_creador'],$result[$i]['estado'],$result[$i]['imagen']));	
				}	
					$respuesta =  new Respuesta(1,$proyectos);
					return $respuesta;
			}				

		}

			public function Traer_tablero_proyectos($id_proyecto){
			$query = sprintf("SELECT boxtracker_01.tablero_proyectos.* FROM boxtracker_01.tablero_proyectos WHERE boxtracker_01.tablero_proyectos.id_proyecto= %d ;",$id_proyecto);

			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun tablero asociado.'); 
				return $respuesta;
			}else{
					$tableros = [];
				for($i=0; $i< count($result);$i++){						
					array_push($tableros, new Tablero($result[$i]['id_tablero'],$result[$i]['id_proyecto'],$result[$i]['idusuario_creador'],$result[$i]['nombre_tablero'],$result[$i]['fecha_creacion'],$result[$i]['tipo_periodo'],$result[$i]['cant_periodos'],$result[$i]['estado'],$result[$i]['visible']));	
				}	
					$respuesta =  new Respuesta(1,$tableros);
					return $respuesta;
			}				

			}
			public function AltaTablero($id_proyecto,$idusuario_creador,$nombre_tablero,$fecha_creacion,$tipo_periodo,$cant_periodos,$estado,$visible){	

			$query = sprintf("INSERT INTO tablero_proyectos (id_proyecto,idusuario_creador,nombre_tablero,fecha_creacion,tipo_periodo,cant_periodos,estado,visible) VALUES (%d,%d,'%s','%s','%s',%d,'%s',%d)", $id_proyecto,$idusuario_creador,$nombre_tablero,$fecha_creacion,$tipo_periodo,$cant_periodos,$estado,$visible);

			$result = $this->db->execute($query);
			$id_tablero = $this->db->lastid();

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta($id_tablero,'tablero creado correctamente');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el tablero no se ha podido grabar');
					return $respuesta;
			}
		}	

		public function EditarTablero($id_tablero,$nombre_tablero,$tipo_periodo,$cant_periodos,$estado,$visible){	
			$query = sprintf("UPDATE tablero_proyectos SET nombre_tablero = '%s',tipo_periodo = '%s',cant_periodos = %d,estado = %d,visible = %d WHERE id_tablero = %d ;", $nombre_tablero,$tipo_periodo,$cant_periodos,$estado,$visible,$id_tablero);

			$result = $this->db->execute($query);

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'tablero editado con exito!');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el tablero no se ha podido grabar');
					return $respuesta;
			}
		}	

		public function VerTablero($id_tablero){
			$query = sprintf("SELECT * FROM tablero_proyectos WHERE id_tablero = %d",$id_tablero);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto tablero y así retornar a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el tablero'); 
				return $respuesta;
			}else{
					$tablero =  new Tablero($result[0]['id_tablero'],$result[0]['id_proyecto'],$result[0]['idusuario_creador'],$result[0]['nombre_tablero'],$result[0]['fecha_creacion'],$result[0]['tipo_periodo'],$result[0]['cant_periodos'],$result[0]['estado'],$result[0]['visible']);

					$respuesta =  new Respuesta(1,$tablero);

					return $respuesta;
			}	
			
			}

			public function ProyectosFinalizados($id_creador){
			$query = sprintf("SELECT boxtracker_01.proyectos.* FROM boxtracker_01.proyectos INNER join boxtracker_01.miembros_grupo ON boxtracker_01.proyectos.id_group = boxtracker_01.miembros_grupo.fk_grupo WHERE boxtracker_01.proyectos.estado = 5 and boxtracker_01.miembros_grupo.fk_usuario = %d ;",$id_creador);
			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$proyectos = [];
				for($i=0; $i< count($result);$i++){						
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$result[$i]['id_group'],$result[$i]['id_creador'],$result[$i]['estado'],$result[$i]['imagen']));	
				}	
					$respuesta =  new Respuesta(1,$proyectos);
					return $respuesta;
			}	
			
			}

			public function VerConfig($id_tablero){
			$query = sprintf("SELECT * FROM boxtracker_01.ajustes_tablero where id_tablero = %d",$id_tablero);
			$result = $this->db->getData($query);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$tableros = [];
				for($i=0; $i< count($result);$i++){						
					$tableros['id_tablero']=$result[$i]['id_tablero'];
					$tableros['idajustes']=$result[$i]['idajustes'];
					$tableros['paleta_color']=$result[$i]['paleta_color'];
					$tableros['id_herramienta']=$result[$i]['id_herramienta'];
					$tableros['coor_x']=$result[$i]['coor_x'];
					$tableros['coor_y']=$result[$i]['coor_y'];
					$tableros['escritorio']=$result[$i]['escritorio'];
				}	
					$respuesta =  new Respuesta(1,$tableros);
					return $respuesta;
			}	
			
			}


				public function AltaConfig($id_tablero,$paleta_color,$id_herramienta,$coor_x,$coor_y,$escritorio){	
			$query = sprintf("INSERT INTO ajustes_tablero (id_tablero,paleta_color,id_herramienta,coor_x,coor_y,escritorio) VALUES (%d,'%s',%d,%d,%d,%d)", $id_tablero,$paleta_color,$id_herramienta,$coor_x,$coor_y,$escritorio);

			$result = $this->db->execute($query);
			$id_tablero = $this->db->lastid();

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Configuracion guardada');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, Los ajustes no se han podido grabar');
					return $respuesta;
			}
		}

			public function EditarConfig($id_tablero,$paleta_color,$coor_x,$coor_y,$escritorio){	
			$query = sprintf("UPDATE ajustes_tablero SET paleta_color = '%s',coor_x = %d,coor_y = %d WHERE id_tablero = %d ;", $paleta_color,$coor_x,$coor_y,$id_tablero);

			$result = $this->db->execute($query);

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Configuracion actualizada con exito!');
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, los ajustes no se han podido grabar');
					return $respuesta;
			}
		}	

		public function TraerHerramientas(){
			$query = sprintf("SELECT * FROM boxtracker_01.herramientas_tablero");
			$result = $this->db->getData($query);

			var_dump($result);

			if(!$result) {
				$respuesta =  new Respuesta(-1,'No se ha encontrado ninguna herramienta.'); 
				return $respuesta;

			}else{
					$herramientas = [];
				for($i=0; $i< count($result);$i++){						
					$herramientas['idherramientas_tablero']=$result[$i]['idherramientas_tablero'];
					$herramientas['nombre']=$result[$i]['nombre'];
				}	
					$respuesta =  new Respuesta(1,$herramientas);
					return $respuesta;
			}

		}

}
	?>