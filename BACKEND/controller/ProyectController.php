<?php
	#include_once dirname(__FILE__).'/../datos/conexion.php';		
	include_once dirname(__FILE__). '/../datos/DbProyectos.php';
	include_once dirname(__FILE__). '/../model/Proyect.php';
	include_once dirname(__FILE__). '/../model/Grupo.php';
	include_once dirname(__FILE__). '/../model/Respuesta.php';
	include_once dirname(__FILE__). '/../model/Usuario.php';
	include_once dirname(__FILE__). '/../controller/UsuariosController.php';

	class ProyectController{
		private $db;	

		//Constructor//
		public function __construct()
		{	
			include_once dirname(__FILE__).'/../datos/conexion.php';
			$this->db = new DbProyectos();	
			$this->usuariosCont = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
		}
	
		//******************* Metodos *********************//
		
		//Funcion importante, es la funcion para el alta de un proyecto
		public function AltaProyecto($nombre,$pais,$ciudad,$fecha_creacion,$descripcion,$id_group,$id_creador,$estado,$foto_proyecto){			
			if ($foto_proyecto['size']>0){
				$foto='http://boxtracker.net/boxtracker1/admin/foto_proyecto/'.$this->subirFoto($foto_proyecto);
			}
			else{
				$foto="http://boxtracker.net/boxtracker1/admin/foto_proyecto/default_image/work.jpg";
			}

			$query = sprintf("INSERT INTO proyectos (nombre,pais,ciudad,fecha_creacion,descripcion,id_group,id_creador,estado,imagen) VALUES ('%s','%s','%s','%s','%s',%d,%d,%d,'%s')", $nombre,$pais,$ciudad,$fecha_creacion,$descripcion,$id_group,$id_creador,$estado,$foto);
			$result = $this->db->execute($query);
			$id_proyect = $this->db->lastid();

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'proyecto creado correctamente');

				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el proyecto no se ha podido grabar');
					return $respuesta;
			}
		}

		public function AltaGrupo($id_usuario,$nombre,$miembros){	
			$query = sprintf("INSERT INTO proyectos_grupos (id_usuario,nombre) VALUES (%d,'%s')", $id_usuario,$nombre);

			$result = $this->db->execute($query);
			$id_group = $this->db->lastid();

			$query2 = sprintf("INSERT INTO miembros_grupo (fk_grupo,fk_usuario) VALUES (%d,%d)", $id_group,$id_usuario);
					
					$result = $this->db->execute($query2);
			if (count($miembros)>0) {
				
				foreach ($miembros as $miembro) {
					$query3 = sprintf("INSERT INTO miembros_grupo (fk_grupo,fk_usuario) VALUES (%d,%d)", $id_group,$miembro);
					
					$result = $this->db->execute($query3);
				}
			}

			if($result != false){ //si la variable result es mayor a 0 significa que el proyecto fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Grupo creado correctamente');

				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'Error, el grupo no se ha podido grabar');
					return $respuesta;
			}
		}

		//funcion importante, da de baja un proyecto.
		public function FinalizarProyecto($id_proyect){
			$query = sprintf("UPDATE proyectos SET estado = 5 WHERE id_proyect = %d", $id_proyect);
			$result = $this->db->execute($query);	
			if(!$result) {
				$respuesta =  new Respuesta(1,'proyecto eliminado correctamente');
			}else{
				$respuesta =  new Respuesta(-1,'No se ha podido eliminar el proyecto');
			}	
			return $respuesta;

		}

		public function BajaGrupo($idproyectos_grupos){
			$query = sprintf("DELETE from proyectos_grupos WHERE idproyectos_grupos = %d", $idproyectos_grupos);
			$result = $this->db->execute($query);

			$query2 = sprintf("DELETE from boxtracker_01.miembros_grupo WHERE boxtracker_01.miembros_grupo.fk_grupo = %d", $idproyectos_grupos);
			$result2 = $this->db->execute($query2);	

			if(!$result) {
				$respuesta =  new Respuesta(1,'grupo eliminado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido eliminar el grupo');
					return $respuesta;
			}	

		}

		public function VerProyect($id_proyect){
		//En esta funcion se selecciona el proyecto segun lo que se reciba como parametro de id de proyecto	
			$query = sprintf("SELECT * FROM proyectos WHERE id_proyect = %d",$id_proyect);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto proyecto y así retornar a la función principal o quien la llame.
				
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado el proyecto'); 
				return $respuesta;
			}else{
					$proyecto =  new Proyect($result[0]['id_proyect'],$result[0]['nombre'],$result[0]['pais'],$result[0]['ciudad'],$result[0]['fecha_creacion'],$result[0]['descripcion'],$result[0]['id_group'],$result[0]['id_creador'],$result[0]['estado']);

					$respuesta =  new Respuesta(1,$proyecto);

					return $respuesta;
			}	
			
			}
			//Funcion interna - No se usa como API
			public function Miembros_grupo($id_grupo){
			$query = sprintf("SELECT * FROM miembros_grupo WHERE fk_grupo = %d",$id_grupo);
			$result = $this->db->getData($query);
				
			if(count($result)>0) {
				$usuarios=[];
				for($i=0; $i< count($result);$i++){  
					$miembros = $result[$i]['fk_usuario'];
					array_push($usuarios,$miembros);
				}
				return $usuarios;
				
			}else{
				$respuesta = [];
				return $respuesta;
			}	
			
		}

		public function VerMiembros_grupo($id_grupo){
			$query = sprintf("SELECT boxtracker_01.users.user_id,boxtracker_01.users.user_nombre,boxtracker_01.users.user_apellido FROM boxtracker_01.users INNER JOIN boxtracker_01.miembros_grupo on boxtracker_01.users.user_id = boxtracker_01.miembros_grupo.fk_usuario where boxtracker_01.miembros_grupo.fk_grupo = %d;",$id_grupo);
				//SELECT * FROM miembros_grupo WHERE fk_grupo = %d",$id_grupo);
			$result = $this->db->getData($query);
			

				if(count($result)>0){
					//var_dump($miembros);
					$miembros_grupo = [];
					for($i=0; $i< count($result);$i++){
						array_push($miembros_grupo, new Respuesta($result[$i]['user_id'],$result[$i]['user_nombre'].' '.$result[$i]['user_apellido'])); 
					}
					$respuesta =  new Respuesta(1,$miembros_grupo); 
				}else{
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun miembro asociado'); 
				}
				return $respuesta;
	}

			

			public function VerGrupo($id_grupo){
				$query = sprintf("SELECT * FROM proyectos_grupos WHERE idproyectos_grupos = %d",$id_grupo);
				$result = $this->db->getData($query);
	
				if(count($result)>0){
					$miembros=$this->Miembros_grupo($id_grupo);
		
					$grupo= new Grupo($result[0]['idproyectos_grupos'],$result[0]['nombre'],$miembros);
					$respuesta =  new Respuesta(1,$grupo); 
				}else{
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun grupo asociado'); 
				}
				return $respuesta;
			}

			public function Traergrupos_UserAsing($id_usuario,$fk_grupo){
				$query = sprintf("SELECT boxtracker_01.proyectos_grupos.* FROM boxtracker_01.proyectos_grupos inner join boxtracker_01.miembros_grupo ON boxtracker_01.miembros_grupo.fk_grupo = boxtracker_01.proyectos_grupos.idproyectos_grupos WHERE NOT boxtracker_01.miembros_grupo.fk_grupo = %d and boxtracker_01.miembros_grupo.fk_usuario = %d",$fk_grupo,$id_usuario);
				$result = $this->db->getData($query);
				
				$grupos = [];
				if(!$result) {
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun grupo asociado'); 
				}else{
					if(count($result)>0){
						$grupos=[];
						for($i=0; $i< count($result);$i++){ 
							$grupo= new Grupo($result[$i]['idproyectos_grupos'],$result[$i]['nombre']);
							array_push($grupos, $grupo);
						}	
					}	
					$respuesta =  new Respuesta(1,$grupos);
				}
				return $respuesta;
			}

			public function Traergrupos_User($id_usuario){
				$query = sprintf("SELECT boxtracker_01.proyectos_grupos.* FROM boxtracker_01.proyectos_grupos inner join boxtracker_01.miembros_grupo ON boxtracker_01.miembros_grupo.fk_grupo = boxtracker_01.proyectos_grupos.idproyectos_grupos WHERE boxtracker_01.miembros_grupo.fk_usuario = %d",$id_usuario);
				$result = $this->db->getData($query);
				
				$grupos = [];
				if(!$result) {
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun grupo asociado'); 
				}else{
					if(count($result)>0){
						$grupos=[];
						for($i=0; $i< count($result);$i++){ 
							$grupo= new Grupo($result[$i]['idproyectos_grupos'],$result[$i]['nombre']);
							array_push($grupos, $grupo);
						}	
					}	
					$respuesta =  new Respuesta(1,$grupos);
				}
				return $respuesta;
			}

			public function BuscarProyectos_group($id_group){
		//En esta funcion se selecciona el proyecto segun lo que se reciba como parametro de id de proyecto	
			$query = sprintf("SELECT * FROM proyectos WHERE id_group = %d",$id_group);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto proyecto y así retornar a la función principal o quien la llame.

			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto asociado'); 
				return $respuesta;
			}else{
					$proyectos = [];
					for($i=0; $i< count($result);$i++){  
						array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$result[$i]['id_group'],$result[$i]['id_creador'],$result[$i]['estado']));	
					}
					$respuesta =  new Respuesta(1,$proyectos);

					return $respuesta;
			}	
			
			}
		public function TraerEstados(){
			$query = sprintf("SELECT * from estados");
			$result = $this->db->getData($query);

			if(count($result)>0){

					$estados = [];
					for($i=0; $i< count($result);$i++){
						array_push($estados, new Respuesta($result[$i]['id_estado'],$result[$i]['nombre'])); 
					}
					$respuesta =  new Respuesta(1,$estados); 
				}else{
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun estado'); 
				}
				return $respuesta;
		}

			public function Proyectos_id_creador($id_creador){
		//En esta funcion se selecciona el proyecto segun lo que se reciba como parametro de id de creador	
			$query = sprintf("SELECT boxtracker_01.proyectos.* FROM boxtracker_01.proyectos INNER join boxtracker_01.miembros_grupo ON boxtracker_01.proyectos.id_group = boxtracker_01.miembros_grupo.fk_grupo WHERE boxtracker_01.proyectos.estado <> 5 and boxtracker_01.miembros_grupo.fk_usuario = %d ;",$id_creador);
			$result = $this->db->getData($query);
			//var_dump($result);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto proyecto y así retornar a la función principal o quien la llame.	
			if(!$result) {

				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun proyecto de ese usuario.'); 
				return $respuesta;
			}else{
					$proyectos = [];
				for($i=0; $i< count($result);$i++){
						$id_grupo=$result[$i]['id_group'];
						//var_dump($id_grupo);
						$nombre_grupo=$this->VerGrupo($id_grupo)->getMensaje()->getNombre();
						
						$estado=$result[$i]['estado'];
						if ($estado==1) {
							$nombre_estado='Preliminar';
						}elseif ($estado==2) {
							$nombre_estado='En curso';
						}elseif ($estado==3) {
							$nombre_estado='En pausa';
						}elseif ($estado==4) {
							$nombre_estado='Cancelado';
						}elseif ($estado==5) {
							$nombre_estado='Terminado';
						}
							
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$nombre_grupo,$result[$i]['id_creador'],$nombre_estado,$result[$i]['imagen']));	
				}	

					$respuesta =  new Respuesta(1,$proyectos);

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
						$id_grupo=$result[$i]['id_group'];
						//var_dump($id_grupo);
						$nombre_grupo=$this->VerGrupo($id_grupo)->getMensaje()->getNombre();
						
						$estado=$result[$i]['estado'];
						if ($estado==1) {
							$nombre_estado='Preliminar';
						}elseif ($estado==2) {
							$nombre_estado='En curso';
						}elseif ($estado==3) {
							$nombre_estado='En pausa';
						}elseif ($estado==4) {
							$nombre_estado='Cancelado';
						}elseif ($estado==5) {
							$nombre_estado='Terminado';
						}
							
					array_push($proyectos, new Proyect($result[$i]['id_proyect'],$result[$i]['nombre'],$result[$i]['pais'],$result[$i]['ciudad'],$result[$i]['fecha_creacion'],$result[$i]['descripcion'],$nombre_grupo,$result[$i]['id_creador'],$nombre_estado,$result[$i]['imagen']));	
				}	

					$respuesta =  new Respuesta(1,$proyectos);

					return $respuesta;
			}	
			
			}

			public function TraerPermisos($id_usuario,$id_modulo){
			$query = sprintf("SELECT boxtracker_01.users_permisos.* FROM boxtracker_01.users_permisos inner join boxtracker_01.permisos on boxtracker_01.permisos.pk_permiso = boxtracker_01.users_permisos.fk_permiso WHERE boxtracker_01.users_permisos.id_usuario = %d and boxtracker_01.permisos.modulo=%d;",$id_usuario,$id_modulo);
			$result = $this->db->getData($query);

			if(count($result)>0) {
				$respuesta =  new Respuesta(1,'El usuario tiene el modulo habilitado');
			}else{	
					$respuesta =  new Respuesta(-1,'No se ha encontrado ningun permiso para ese usuario.');		
			}	
				return $respuesta;
			}

		function ActualizarProyect($id_proyect,$nombre,$pais,$ciudad,$descripcion,$id_group,$estado,$foto_proyecto){
					if (isset($foto_proyecto)){
				$foto='http://boxtracker.net/boxtracker1/admin/foto_proyecto/'.$this->subirFoto($foto_proyecto);
				$query = sprintf("UPDATE proyectos SET nombre = '%s',pais = '%s',ciudad = '%s',descripcion = '%s',id_group = %d,estado = %d,imagen = '%s' WHERE id_proyect = %d ;",$nombre,$pais,$ciudad,$descripcion,$id_group,$estado,$foto,$id_proyect);
			}
			else{
				$query = sprintf("UPDATE proyectos SET nombre = '%s',pais = '%s',ciudad = '%s',descripcion = '%s',id_group = %d,estado = %d WHERE id_proyect = %d ;",$nombre,$pais,$ciudad,$descripcion,$id_group,$estado,$id_proyect);
			}

			$result = $this->db->execute($query);
			
			//$usuario=$this->VerProyect($id);
			
			if(!$result){
				$respuesta =  new Respuesta(1,'proyecto actualizado correctamente'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido modificar el proyecto');
					return $respuesta;
			}	
		}

		function Asignar_ProyectGrupo($id_grupoViejo,$id_grupoNuevo){
			 		$query = sprintf("UPDATE proyectos SET id_group = %d WHERE id_group = %d ;",$id_grupoNuevo,$id_grupoViejo);

			$result = $this->db->execute($query);
			
			//$usuario=$this->VerProyect($id);
			
			if(!$result){
				$respuesta =  new Respuesta(1,'Asignación realizada con exito'); 
				return $respuesta;
			}else{
					$respuesta =  new Respuesta(-1,'No se ha podido asignar el proyecto');
					return $respuesta;
			}	
		}

		function EditarGrupo($miembros,$nombre,$fk_grupo,$id_usuario){
			$query = sprintf("DELETE from boxtracker_01.miembros_grupo WHERE boxtracker_01.miembros_grupo.fk_grupo = %d", $fk_grupo);
			$result = $this->db->execute($query);

			$query0 = sprintf("UPDATE proyectos_grupos SET nombre = '%s' WHERE idproyectos_grupos = %d ;",$nombre,$fk_grupo);
			$result0 = $this->db->execute($query0);

			$query2 = sprintf("INSERT INTO miembros_grupo (fk_grupo,fk_usuario) VALUES (%d,%d)", $fk_grupo,$id_usuario);
					
			$result2 = $this->db->execute($query2);

			if (count($miembros)>0) {
				
				foreach ($miembros as $miembro) {
					$query3 = sprintf("INSERT INTO miembros_grupo (fk_grupo,fk_usuario) VALUES (%d,%d)", $fk_grupo,$miembro);
					
					$result3 = $this->db->execute($query3);
				}
			}	

			if(!$result){
				$respuesta =  new Respuesta(1,'grupo actualizado correctamente'); //momentaneo hasta solucionar los update

			}else{
					$respuesta =  new Respuesta(1,'grupo actualizado correctamente');
					
			}	
			return $respuesta;
		}

		function Traermiembros_User($id_padre){
			if ($this->usuariosCont->SaberPadre($id_padre)) 
			{
				
				//Traer hijos 
				$resp=[];
				$hijos=$this->usuariosCont->traer_hijos($id_padre);
				if (count($hijos)>0) {
					foreach ($hijos as $key => $hijo) {
						$id_hijo=$hijo["id_usuario"];
						$user=$this->usuariosCont->VerUsuario($id_hijo);
						array_push($resp, $user);
						$resp2=$this->Traermiembros_User($id_hijo);
						if ($resp2 != false) {
							if (count($resp2)>0) {
								foreach ($resp2 as $nieto) {
									//$user=$this->usuariosCont->VerUsuario($nieto);
									array_push($resp, $nieto);
								}
							}
							
						}
						
					}

				}
				return $resp;
				
			}
			else
			{
				return false;
			}
		}
		function TraerPosibles_miembros($id_padre){
			$result=$this->Traermiembros_User($id_padre);
			if(count($result)>0 && $result != false){
				$usuarios = [];
				/*for($i=0; $i< count($result);$i++){  
					array_push($usuarios, $result[$i]);	
				}*/
				$respuesta =  new Respuesta(1,$result);	
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun miembro asociado'); 
			}
			return $respuesta;
		}
		//funcion para poder actualizar la foto de un proyecto usando una imagen de la pc y subirla como foto perfil del sistema
		public function subirFoto($imagen)
		{
			//define ('SITE_ROOT', realpath(dirname(__FILE__)));
			$archivoExtension = substr($imagen['name'], -3); //Extension del archivo
			$MaximoImagen = 1000000; // En Bytes
			$archivoDestino = "";
			$mensaje = "";
			//Verifica tamaño de la imagen
			if ($imagen['size'] > $MaximoImagen)
			{
			$archivoDestino = "Error1";
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del proyecto (tamaño de la imagen incorrecto). Para hacerlo, edite el proyecto.";
			}
			else
			//Verifica el formato del archivo
			if ($archivoExtension != "png" && $archivoExtension != "jpg" && $archivoExtension != "PNG" && $archivoExtension != "JPG")
			{
			$archivoDestino = "Error2";
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del proyecto (solo archivos .jpg o .png). Para hacerlo, edite el proyecto.";
			}
			//Si no hubo problemas con el archivo a subir ni con las fechas
			if($archivoDestino=="")
			{
			$random="".rand();
			$archivoDestino = $random.".".$archivoExtension;
			//Agrega el archivo al servidor
			if (!move_uploaded_file($imagen["tmp_name"], '/srv/boxtracker/boxtracker1/admin/foto_proyecto/'.$archivoDestino))
			{
			$archivoDestino = "Error3"; //No se genero el alta
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del proyecto (Error al subir el archivo). Para hacerlo, edite el proyecto.";
			}
			}
			if ($archivoDestino!="Error1" && $archivoDestino!="Error2" && $archivoDestino!="Error3")
			//$this->base->agregarImagenAPremio($pkUser, $archivoDestino, $rutaImagen, 'premios');
				if ($mensaje == "") {
					return $archivoDestino;
				}else{
					return false;
				}
			
		}
		// 	NO SE USA
		/*public function TraerPosibles_miembros2($id_usuario,$id_padre){
					$query = sprintf("SELECT boxtracker_01.users.* FROM boxtracker_01.users INNER join boxtracker_01.herencia on boxtracker_01.users.user_id = boxtracker_01.herencia.id_usuario WHERE boxtracker_01.herencia.padre = %d ",$id_padre);
					$result = $this->db->getData($query);
					//var_dump($result);
			
			if(count($result)>0){
				$usuarios = [];
				for($i=0; $i< count($result);$i++){  
					array_push($usuarios, new Usuario($result[$i]['user_id'],$result[$i]['user_nombre'],$result[$i]['user_apellido'],$result[$i]['user_dni'],$result[$i]['user_tel'],$result[$i]['user_email'],$result[$i]['user_pass'],$result[$i]['foto']));	
				}
				$respuesta =  new Respuesta(1,$usuarios);	
			}else{
				$respuesta =  new Respuesta(-1,'No se ha encontrado ningun miembro asociado'); 
			}	
				return $respuesta;
		
			}*/
}


	?>