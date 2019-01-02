<?php
			
	include_once dirname(__FILE__). '/../datos/DbUsuarios.php';
	include_once dirname(__FILE__). '/../model/Usuario.php';

	class EmpleadosController
	{
		
		private $db;	
		//Constructor//
		public function __construct($basedatos,$servidor,$usuario,$paswd)
		{
			$this->db = new DbUsuarios($basedatos,$servidor,$usuario,$paswd);	
		}
	
		//Metodos//
		public function VerUsuario($usuariopk){
		//En esta funcion se selecciona el usuario segun lo que se reciba como parametro de id de usuario	
			$query = sprintf("SELECT * FROM users WHERE user_id = %d",$usuariopk);
			$result = $this->db->getData($query);
		//El resultado se guarda en una variable y luego se hace una verificación. Si el resultado es mayor a 0 se crea un nuevo objeto usuario y así retornar a la función principal o quien la llame.
			if(count($result)>0){
				$usuario =  new Usuario($result[0]['user_id'],$result[0]['user_nombre'],$result[0]['user_apellido'],$result[0]['user_dni'],$result[0]['user_tel'],$result[0]['user_email'],$result[0]['user_pass'],$result[0]['foto']);
			}else{
				$usuario=false;
			}
			
			return $usuario;
			
			}

		public function DevolverEmpleados()
		{	
				//esta funcion recibe un id de padre para no solo devolver un usuario sino tambien saber si este es padre y si el id de usuario que esta asociado a un id de herencia se corresponden
					//$id_usuario = $hijos[$i]['id_usuario'];
					$query = sprintf("SELECT * FROM empleados");
					$result = $this->db->getData($query);
					//si la funcion arroja valores significa que la consulta encontro al menos 1 registro, luego creamos un vector en donde hacemos la instancia de la clase usuarios y recorremos el vector con su correspondiente campo de la tabla sql
			/*if(count($result)>0){
				$empleados = [];
				for($i=0; $i< count($result);$i++){  
					array_push($empleados, new Usuario($result[$i]['user_id'],$result[$i]['user_nombre'],$result[$i]['user_apellido'],$result[$i]['user_dni'],$result[$i]['user_tel'],$result[$i]['user_email'],$result[$i]['user_pass'],$result[$i]['foto']));	
				}	
			}//como resultado retornamos las coincidencias que existieron entre el usuario y la consulta	
			return $empleados;*/
			return $result;
		}

		public function SaberPadre($id_padre){
			//como lo dice el nombre de la funcion, en algun momento necesitamos saber si un usuario es padre.
			//para saber si es padre  basta con una consulta que seleccione desde la tabla herencia la equivalencia del codigo padre que recibe la funcion.
			//query sin sprintf
			$query = "SELECT * FROM herencia WHERE padre = ".$id_padre;
			$result = $this->db->getData($query);
			//var_dump($query);
			// en caso de que la consulta arroje un valor mayor a 0 devolverá un true para dar como respuesta que es padre
			if (count($result)>0) {
				return true;
			}else{
				return false;
			}
		}
		//la siguieante funcion como dice su nombre nos trae los hijos de un usuario a partir del id_padre generado en la base de datos. Por ejemplo. Si un usuario padre tiene como codigo 1.2
		//los hijos van a llevar como prefijo ese codigo más una nueva nomenclatura. (ej. 1.2.1)
		public function traer_hijos($id_padre){

			$query = "SELECT * FROM herencia WHERE padre = ".$id_padre;
			$result = $this->db->getData($query);

			if (count($result)>0) {
				return $result;
			}else{
				return false;
			}
		}
		//En esta funcion seleccionamos de la tabla herencia el campo padre donde sabremos quien es el padre de un usuario n
		// por eso mismo esta funcion recibe el id del usuario
		//el resultado devuelve un array con el codigo del padre en caso que lo encuentre, sino devuelve false
		public function traer_padre_id($id_usuario){
			$query = sprintf("SELECT herencia.padre FROM herencia WHERE herencia.id_usuario = %d",$id_usuario);
			$result = $this->db->getData($query);
			//var_dump($result);
			if (count($result)>0) {
				return $result[0]['padre'];
			}else{
				return false;
			}
		}

		//Aca claramente como lo dice la funcion el objetivo es traer todos los hijos de un mismo padre exceptuando el usuario
		//por el cual hacemos la consulta, es decir, necesitamos traer solamente los hermanos de un usuario especifico		
		public function traer_hermanos($id_padre,$id_usuario){
			 $query = sprintf("SELECT users.* FROM users INNER join herencia on users.user_id = herencia.id_usuario WHERE herencia.padre = %d and herencia.id_usuario NOT IN (%d) ;",$id_padre,$id_usuario);
			 $result = $this->db->getData($query);

			 if(count($result)>0){
				$usuarios = [];
				for($i=0; $i< count($result);$i++){  
					array_push($usuarios, new Usuario($result[$i]['user_id'],$result[$i]['user_nombre'],$result[$i]['user_apellido'],$result[$i]['user_dni'],$result[$i]['user_tel'],$result[$i]['user_email'],$result[$i]['user_pass'],$result[$i]['foto']));	
				}	
			}//como resultado retornamos las coincidencias que existieron entre el usuario y la consulta	
			return $usuarios;

		}	
		//**OJO** una de las funciones más importantes de la controladora usuario
		//como lo dice el nombre de la funcion, se crea la herencia en el mismo momento que se crea un usuario, cada usuario está
		//ligado a otro.
		public function crear_herencia($id_usuario,$id_padre){
			$cod_padre=$this->traer_codigo_padre($id_padre);

			$res=$this->SaberPadre($id_padre);
			if($this->SaberPadre($id_padre)){
					// TIENE HIJOS
					// se busca el nivel del ultimo hijo
					$nivel_max=$this->traer_cant_hijos($id_padre);
					// se suma + 1 al nivel 
					$nivel=intval($nivel_max)+1;
					//se inserta al codigo
					$codigo_hijo=$cod_padre.'.'.strval($nivel);

			}else{
				// NO TIENE HIJOS
				$nivel=2;
				$codigo_hijo=$cod_padre.'.1';
			}
			
			$query = sprintf("INSERT INTO herencia (id_usuario,codigo,nivel,padre) VALUES (%d,'%s',%d,%d)", $id_usuario,$codigo_hijo,$nivel,$id_padre);
			$result = $this->db->execute($query);
			
			return $result;
		}
		//**OJO** VER ESTA FUNCION CREO QUE NO SE USA, YA NO ES NECESARIO
		//caso contrario lo que se hace es traer el codigo de un usuario padre en formato varchar
		public function traer_codigo_padre($id_padre){
			$query = sprintf("SELECT codigo FROM herencia WHERE id_usuario = %d ",$id_padre);
			$result = $this->db->getData($query);

			if(count($result)>0){
				return $result[0]["codigo"];
			}else{
				return false;
			}			
		}
		//lo unico que hace esta funcion es contar la cantidad de hijos que tiene un padre si y solo si este tiene hijos, sino
		//devuelve falso
		public function traer_cant_hijos($id_padre){
			$query = "SELECT count(*) as cantidad FROM herencia WHERE padre = ".$id_padre;
			$result = $this->db->getData($query);
			if(count($result)>0){
				return $result[0]["cantidad"];
			}else{
				return false;
			}	
		}
		//esta funcion se crea con el proposito de saber si un usuario ha sido dado de alta de forma completa
		//un usuario puede estar creado pero hasta que no se crea la contraseña el usuario permanecera inactivo
		//si el usuario crea una contraseña por medio de un link al mail, pasara a ser activo
		public function usuario_activo($id_usuario){
			$query = "SELECT * FROM users where user_id = ".$id_usuario;
			$result = $this->db->getData($query);
			//var_dump($result);
			if(count($result)>0){
				$pass=$result[0]["user_pass"];
				//var_dump($pass);
				if (!empty($pass)) {
					return true;
				}else{
					return false;
				}	
			}
		}
		//la siguiente funcion hace una verificacion, para saber si un mail existe o no dentro de la base de datos
		public function ValidarMail($mail){
			$query = sprintf("SELECT * FROM users WHERE user_email = '%s'",$mail);
			$result = $this->db->getData($query);

			if(count($result)>0){
				$rta = new Usuario($result[0]['user_id'],$result[0]['user_nombre'],$result[0]['user_apellido'],$result[0]['user_dni'],$result[0]['user_tel'],$result[0]['user_email'],$result[0]['user_pass'],$result[0]['foto']);
				}		

 				else {
         				$rta=false;
         			 }		
				return  $rta;
		}

		//una funcion clasica para loguearse en el sistema, compara un usuario con su respectiva contraseña.
		public function login($usuario,$pass){

			$query = sprintf("SELECT * FROM users WHERE user_email = '%s' AND user_pass = '%s'",$usuario,$pass);
			$result = $this->db->getData($query);
			if(count($result)>0){
				$rta =  new Usuario($result[0]['user_id'],$result[0]['user_nombre'],$result[0]['user_apellido'],$result[0]['user_dni'],$result[0]['user_tel'],$result[0]['user_email'],$result[0]['user_pass'],$result[0]['foto']);

											}else{
												$rta =false;
												 }
											return $rta;	
											}
	
		//Funcion importante, es la funcion para el alta de un usuario
		public function NuevoUsuario($nombre,$apellido,$dni,$telefono,$mail,$usuarios_permisos,$id_padre,$foto){
			$foto="/boxtracker1/admin/foto_user/user.png";
			
			if ($this -> ValidarMail($mail) == false) { //si recibo un false de la funcion llamada quiere decir que se puede crear el usuario, ya que no existe ningun registro igual.
			$query = sprintf("INSERT INTO users (user_nombre,user_apellido,user_dni,user_tel,user_email,foto) VALUES ('%s','%s','%s','%s','%s','%s')", $nombre,$apellido,$dni,$telefono,$mail,$foto);
			
			$result = $this->db->execute($query);
			$id_usuario = $this->db->lastid();

			if(count($result)>0){ //si la variable result es mayor a 0 significa que el usuario fue creado y se da un aviso.
				$respuesta =  new Respuesta(1,'Usuario creado correctamente');

				$this->guardar_permisos_usuario($usuarios_permisos,$id_usuario);
				$this->crear_herencia($id_usuario,$id_padre);
				$this->EnviarCorreo($mail,$id_usuario,$nombre);

				return $respuesta;

								}
							}
			else
				{
					$respuesta =  new Respuesta(-1,'El E-mail ya existe');
					return $respuesta;
				}
		}
			//Cuando un usuario es creado, automaticamente se envia un mail a la casilla de correo asociada a ese id
			//luego el usuario debera chequear la casilla de correo para activar su cuenta
			//la funcion es larga ya que primero se configura la entrada y salida del servidor(gmail)
			// luego se arma el body del correo enviado
			//dato importante, esta funcion llama a un archivo dentro del backend llamado PHPMAILER
			function EnviarCorreo ($mail,$id_usuario, $nombre){
			include dirname(__FILE__). "/../PHPMailer/PHPMailer/PHPMailer.php";
			include dirname(__FILE__). "/../PHPMailer/PHPMailer/SMTP.php";
			$email_user = "operacionesboxtracker@gmail.com";
			$email_password = "myboxtracker15";
			$the_subject = "Activacion de cuenta BoxTracker";
			$address_to = $mail;
			$from_name = "BoxTracker";
			$phpmailer = new PHPMailer \ PHPMailer \ PHPMailer ();
			// ---------- datos de la cuenta de Gmail -------------------------------
			$phpmailer->Username = $email_user;
			$phpmailer->Password = $email_password; 
			//-----------------------------------------------------------------------
			// $phpmailer->SMTPDebug = 1;
			$phpmailer->SMTPSecure = 'ssl';
			$phpmailer->Host = "smtp.gmail.com"; // GMail
			$phpmailer->Port = 465;
			$phpmailer->IsSMTP(); // use SMTP
			$phpmailer->SMTPAuth = true;
			$phpmailer->setFrom($phpmailer->Username,$from_name);
			$phpmailer->AddAddress($address_to); // recipients email
			$phpmailer->Subject = $the_subject;
			$link='http://boxtracker.net/boxtracker1/activar_usuario.php?token='.$id_usuario;
			$body='<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Active su Cuenta</title>
			</head>
			<body style="margin: 0.2em; color: #000000;">
			<div style="padding:32px; margin:0px; color:#333; background-color:#EEEEEE">
				<div style="background-color:#FFFFFF; width:600px; margin-left:auto; margin-right:auto">
				<table align="center" style="background-color:#FFFFFF; width:600px; text-align:center">
				</table>
				<table style="width:100%">
				<tbody>
				<tr>
				<td align="left" style="padding:0px; padding-top:32px; padding-left:16px; padding-bottom:20px; margin-bottom:0px">
				<img data-imagetype="External" style="width: 130px;" src="http://boxtracker.net/boxtracker1/admin/images/logogris_fblanco.png" alt="Boxtracker"></td>
				<td align="right" valign="bottom" style="color:#999; padding-bottom:20px; font-style:italic; padding-right:16px; font-size:10px">
				<p style="color:#999; font-style:italic; font-size:10px">Tu cuenta para gestionar Boxtracker.</p>
				</td>
				</tr>
				</tbody>
				</table>
				<hr style="color:grey">
				<table>
				<tbody>
				<tr>
				<td style="padding-top:24px; padding-left:16px; padding-bottom:10px">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tbody>
				<tr style="margin:24px; margin-left:0px">
				<td>
				<table border="0" cellspacing="0" cellpadding="0">
				<tbody>
				<tr>
				<td align="center">
				<p style="word-wrap:break-word; font-size:15px; margin:0px; padding:0px">Hola '.$nombre. ', </p>
				<p style="word-wrap:break-word; font-size:13px; margin-top:24px; padding:0px; line-height:19px">
				Por favor, activa tu cuenta (<b>'.$mail.'</b>) verificando tu email en el siguiente link:</p><br>
				<p>
				</p><table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top:30px; margin-bottom:30px; width:100%">
				<tbody>
				<tr>
				<td>
				<table align="left" style="text-align:center; vertical-align:center; color:#fff; display:block">
				<tbody>
				<tr>
				<td style="border-radius:4px 4px 4px 4px"><center><a href="'.$link.'" target="_blank" rel="noopener noreferrer" style="color:#fff!important; padding-left:28px; padding-top:12px; padding-bottom:12px; padding-right:28px; height:40px; width:160px; background-color:#0696D7; font-size:16px; text-decoration:none; text-transform:uppercase; border-radius:4px 4px 4px 4px">VERIFICAR EMAIL </a></center></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<p></p>
				<p style="word-wrap:break-word; display:block; font-size:13px">Si tu link no funciona, copia y pega esta URL en tu navegador:<br>
				</p>
				<p style="word-wrap:break-word; display:block; font-size:12px; margin-top:15px"><a href="'.$link.'" target="_blank" rel="noopener noreferrer">'.$link.'</a> </p>
				</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<hr style="color:grey">
				<table style="padding-bottom:25px; text-align:left">
				<tbody>
				<tr>
				<td align="left" style="color:#999; font-size:10px; line-height:1.6; padding-left:20px">
				<p align="left" style="margin-top:0; margin-bottom:0; padding-top:15px; color:#999; line-height:1.6">
				© 2018 Boxtracker, Inc. Todos los derechos reservados.</p>
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				 </div>';
			
			//$body.= '<a href="'.$link.'" ><button type="button" class="btn btn-primary">Activar Cuenta</button></a>';
			$body.='</div></div></body></html>';
			$phpmailer->Body = utf8_decode($body);
			$phpmailer->IsHTML(true);
			$phpmailer->Send();

		}
		//la funcion se comporta muy parecido a la de activar usuario por medio de un link
		//esta funcion se hace presente si un usuario olvida su contraseña
		//se envia un mail a la casilla de correo para re activarla
		function Olvide_password ($mail,$id_usuario, $nombre){
			include dirname(__FILE__). "/../PHPMailer/PHPMailer/PHPMailer.php";
			include dirname(__FILE__). "/../PHPMailer/PHPMailer/SMTP.php";
			$email_user = "operacionesboxtracker@gmail.com";
			$email_password = "myboxtracker15";
			$the_subject = "Activacion de cuenta BoxTracker";
			$address_to = $mail;
			$from_name = "BoxTracker";
			$phpmailer = new PHPMailer \ PHPMailer \ PHPMailer ();
			// ---------- datos de la cuenta de Gmail -------------------------------
			$phpmailer->Username = $email_user;
			$phpmailer->Password = $email_password; 
			//-----------------------------------------------------------------------
			// $phpmailer->SMTPDebug = 1;
			$phpmailer->SMTPSecure = 'ssl';
			$phpmailer->Host = "smtp.gmail.com"; // GMail
			$phpmailer->Port = 465;
			$phpmailer->IsSMTP(); // use SMTP
			$phpmailer->SMTPAuth = true;
			$phpmailer->setFrom($phpmailer->Username,$from_name);
			$phpmailer->AddAddress($address_to); // recipients email
			$phpmailer->Subject = $the_subject;
			$link='http://boxtracker.net/boxtracker1/change_password.php?token='.$id_usuario;
			$body='<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<title>Generar nueva contraseña</title>
			</head>
			<body style="margin: 0.2em; color: #000000;">
			<div style="padding:32px; margin:0px; color:#333; background-color:#EEEEEE">
				<div style="background-color:#FFFFFF; width:600px; margin-left:auto; margin-right:auto">
				<table align="center" style="background-color:#FFFFFF; width:600px; text-align:center">
				</table>
				<table style="width:100%">
				<tbody>
				<tr>
				<td align="left" style="padding:0px; padding-top:32px; padding-left:16px; padding-bottom:20px; margin-bottom:0px">
				<img data-imagetype="External" style="width: 130px;" src="http://boxtracker.net/boxtracker1/admin/images/logogris_fblanco.png" alt="Boxtracker"></td>
				<td align="right" valign="bottom" style="color:#999; padding-bottom:20px; font-style:italic; padding-right:16px; font-size:10px">
				<p style="color:#999; font-style:italic; font-size:10px">Tu cuenta para gestionar Boxtracker.</p>
				</td>
				</tr>
				</tbody>
				</table>
				<hr style="color:grey">
				<table>
				<tbody>
				<tr>
				<td style="padding-top:24px; padding-left:16px; padding-bottom:10px">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tbody>
				<tr style="margin:24px; margin-left:0px">
				<td>
				<table border="0" cellspacing="0" cellpadding="0">
				<tbody>
				<tr>
				<td align="center">
				<p style="word-wrap:break-word; font-size:15px; margin:0px; padding:0px">Hola '.$nombre. ', </p>
				<p style="word-wrap:break-word; font-size:13px; margin-top:24px; padding:0px; line-height:19px">
				Por favor, activa tu cuenta (<b>'.$mail.'</b>) verificando tu email en el siguiente link:</p><br>
				<p>
				</p><table border="0" cellspacing="0" cellpadding="0" width="100%" style="margin-top:30px; margin-bottom:30px; width:100%">
				<tbody>
				<tr>
				<td>
				<table align="left" style="text-align:center; vertical-align:center; color:#fff; display:block">
				<tbody>
				<tr>
				<td style="border-radius:4px 4px 4px 4px"><center><a href="'.$link.'" target="_blank" rel="noopener noreferrer" style="color:#fff!important; padding-left:28px; padding-top:12px; padding-bottom:12px; padding-right:28px; height:40px; width:160px; background-color:#0696D7; font-size:16px; text-decoration:none; text-transform:uppercase; border-radius:4px 4px 4px 4px">VERIFICAR EMAIL </a><center></td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<p></p>
				<p style="word-wrap:break-word; display:block; font-size:13px">Si tu link no funciona, copia y pega esta URL en tu navegador:<br>
				</p>
				<p style="word-wrap:break-word; display:block; font-size:12px; margin-top:15px"><a href="'.$link.'" target="_blank" rel="noopener noreferrer">'.$link.'</a> </p>
				</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				<hr style="color:grey">
				<table style="padding-bottom:25px; text-align:left">
				<tbody>
				<tr>
				<td align="left" style="color:#999; font-size:10px; line-height:1.6; padding-left:20px">
				<p align="left" style="margin-top:0; margin-bottom:0; padding-top:15px; color:#999; line-height:1.6">
				© 2018 Boxtracker, Inc. Todos los derechos reservados.</p>
				</td>
				</tr>
				</tbody>
				</table>
				</div>
				 </div>';
			
			//$body.= '<a href="'.$link.'" ><button type="button" class="btn btn-primary">Activar Cuenta</button></a>';
			$body.='</div></div></body></html>';
			$phpmailer->Body = utf8_decode($body);
			$phpmailer->IsHTML(true);
			$phpmailer->Send();

		}

		//la siguiente funcion solo hace un update de la contraseña creada. Dentro se llama a la funcion usuario_activo
		//para mandar un mail al usuario y crear el password
		 public function Crear_password($id_usuario,$pass){
		 	$activo=$this->usuario_activo($id_usuario);
		 	if (!$activo) {
				$query = sprintf("UPDATE users SET user_pass = '%s' WHERE user_id = %d ;",$pass,$id_usuario);
				$result = $this->db->execute($query);
				
				$usuario=$this->VerUsuario($id_usuario);
				
				return $usuario;
			}else {
				return false;
			}
		}

		//esta funcion hace un update de la contraseña en caso de que el usuario se la haya olvidado
		 public function Cambiar_password($id_usuario,$pass){
		
				$query = sprintf("UPDATE users SET user_pass = '%s' WHERE user_id = %d ;",$pass,$id_usuario);
				$result = $this->db->execute($query);
				
				$usuario=$this->VerUsuario($id_usuario);
			if(count($result)>0){	
				return $usuario;
			}else{
				return false;
			}
		}

			//esta funcion se hace presente en varios casos. Si un usuario padre decide modificar los permisos del otro hijo puede ser un ejemplo.
		//otro caso puede ser que se elimine un usuario que tenia hijos y esos hijos queden ligados a otro usuario, entonces
		//esos usuarios van a pasar a tener los permisos del nuevo padre. Es medio rebuscado pero es la manera más practica de explicarlo
			function guardar_permisos_usuario($usuarios_permisos,$id_usuario)
		{
			foreach ($usuarios_permisos as $key => $usuario_permiso) {
				$id_permiso=$usuario_permiso;
				if (isset($usuario_permiso)) {
					$valor=1;
				}else{
					$valor=0;
				}
				$query = sprintf("INSERT INTO users_permisos (id_usuario,fk_permiso,valor) VALUES (%d,%d,%d)", $id_usuario,$id_permiso,$valor);
				$result = $this->db->execute($query);
			}
		}
			//edita los permisos. Lo primero que hace antes de efectuar los cambios es llamar a la funcion comparar permisos.
			//el comparar permisos sirve para aplicar los cambios a los hijos y nietos.
			 function editar_permisos($usuarios_permisos,$id_usuario)
		{
				$permisos_editados=$this->comparar_permisos($id_usuario,$usuarios_permisos);
				//var_dump($permisos_editados);
				//Si es mayor a 0 se llama la funcion recursiva y verifica si se edito al menos 1 permiso.
				if (count($permisos_editados)>0) {
					$this->recursiva($id_usuario,$permisos_editados);
				}
				$query = sprintf("DELETE from users_permisos WHERE id_usuario = %d", $id_usuario);
				$result = $this->db->execute($query);

				$this->guardar_permisos_usuario($usuarios_permisos,$id_usuario);


			
				return $result;
		}
			//Se hace la comparacion de los permisos de usuario por id para saber que permisos faltan eliminar.
			function comparar_permisos($id_usuario,$permisos_nuevos){
				$permisos_viejos = $this->DevolverPermisos_usuario($id_usuario);
				//var_dump($permisos_viejos);
				$permisos_delete=[];
				if(count($permisos_viejos)>0){

					foreach ($permisos_viejos as $key => $permisoViejo_individual) {
							$id_permiso=$permisoViejo_individual -> getPermiso();
							$encontrado=false;
							foreach ($permisos_nuevos as $key => $permisoNuevo_individual) {
								//var_dump($permisoNuevo_individual);
								if ($id_permiso == $permisoNuevo_individual) {
									$encontrado=true;
								}
							}
							if ($encontrado != true) {
								array_push($permisos_delete, $id_permiso);
							}
					}
				}
				return $permisos_delete;
			}
			//esta funcion se haya en la seccion PERFIL donde se puede modificar los datos personales del usuario como tambien la foto
			 function EditarPerfil($id,$nombre,$apellido,$dni,$telefono,$foto){
			 	if ($foto["size"] != 0) {
			 		$nombre_imagen=$this->subirImagen($foto, $id);
			 		$ruta_imagen="/boxtracker1/admin/foto_user/".$nombre_imagen;
			 		$query = sprintf("UPDATE  users SET user_nombre = '%s',user_apellido = '%s',user_dni = '%s',user_tel = '%s',foto = '%s' WHERE user_id = %d ;",$nombre,$apellido,$dni,$telefono,$ruta_imagen,$id);
			 	}else{
			 		$query = sprintf("UPDATE  users SET user_nombre = '%s',user_apellido = '%s',user_dni = '%s',user_tel = '%s' WHERE user_id = %d ;",$nombre,$apellido,$dni,$telefono,$id);
			 	}
			$result = $this->db->execute($query);
			
			$usuario=$this->VerUsuario($id);
			

			return $usuario;
		}
			//esta funcion devuelve en formato de array aquellos permisos de un usuario que se encuentran activos para luego hacer la comparacion con los permisos de otro usuario
			function DevolverPermisos_activos($usuariopk)
		{	
			$query = sprintf("SELECT * FROM users_permisos where valor =1 and id_usuario = %d",$usuariopk);
			$result = $this->db->getData($query);
			$permisos = [];

			if(count($result)>0){
				for($i=0; $i< count($result);$i++){  
					array_push($permisos, new Permiso($result[$i]['id_permiso'],$result[$i]['id_usuario'],$result[$i]['fk_permiso'],$result[$i]['valor']));
					}			
			}else{
				$permisos=false;
			}
			return $permisos;
		}

		 function DevolverPermisos_usuario($usuariopk)
		{	
			$query = sprintf("SELECT * FROM users_permisos where id_usuario = %d",$usuariopk);
			$result = $this->db->getData($query);
			$permisos = [];

			if(count($result)>0){
				for($i=0; $i< count($result);$i++){  
					array_push($permisos, new Permiso($result[$i]['id_permiso'],$result[$i]['id_usuario'],$result[$i]['fk_permiso'],$result[$i]['valor']));
					}			
			}else{
				$permisos=false;
			}
			return $permisos;
		}
		function DevolverPermisos_usuario_array($usuariopk)
		{	
			$query = sprintf("SELECT fk_permiso as permiso FROM users_permisos where id_usuario = %d",$usuariopk);
			$result = $this->db->getData($query);
			$permisos = [];

			if(count($result)>0){
				for($i=0; $i< count($result);$i++){  
					array_push($permisos, $result[$i]['permiso']);
					}			
			}else{
				$permisos=false;
			}
			return $permisos;
		}

		function traer_menu_modulo($id_modulo)
		{	
			$query = sprintf("SELECT boxtracker_01.menu_modulos.* FROM boxtracker_01.menu_modulos inner join boxtracker_01.permisos on boxtracker_01.menu_modulos.id_permiso = boxtracker_01.permisos.pk_permiso where boxtracker_01.permisos.modulo = ".$id_modulo);
			//var_dump($query);
			$result = $this->db->getData($query);
			$menus = [];

			if(count($result)>0){
				for($i=0; $i< count($result);$i++){  
					array_push($menus, new Menu($result[$i]['idmenu_modulos'],$result[$i]['id_permiso'],$result[$i]['nombre'],$result[$i]['ruta'],$result[$i]['icono']));
					}			
			}else{
				$menus=false;
			}
			return $menus;
		}
		//No estoy seguro de la utilidad de esta funcion, solo selecciona la tabla permisos.
		 function DevolverPermisos_vigentes()
		{	
			$query = sprintf("SELECT * FROM permisos");
			$result = $this->db->getData($query);
			//$permisos = [];

			return $result;
		}
		//funcion que devuelve los modulos que existen en el sistema
		public function DevolverModulos()
		{	
			$query = sprintf("SELECT * FROM modulos");
			$result = $this->db->getData($query);
			//$permisos = [];
			if (count($result)>0) {
				return $result;
			}else{
				return false;
			}

		}
		//se comenta la funcion porque la llamada no hace referencia a nada
		/*public function Eliminar_permisos_super($id_usuario){
			$cod_padre=$this->filtrar_hijos($id_padre);

			if (count($result)>0){
				return $result;
			}else{
				return false;
			}
		}	*/	
		//funcion que elimina los permisos de un usuario que se recibe por parametro
		public function Eliminar_permisos($id_usuario){
			$query = sprintf("DELETE from users_permisos WHERE id_usuario = %d", $id_usuario);
			$result = $this->db->execute($query);	

			if (count($result)>0){
				return $result;
			}else{
				return false;
			}
		}
		//No recuerdo porque hice dos funciones igual con diferente nombre, lo chequeare y si no sirve la borro
		public function Eliminar_permisos2($id_usuario){
			$query = sprintf("DELETE from users_permisos WHERE id_usuario = %d", $id_usuario);
			$result = $this->db->execute($query);	

			return $result;
		}

		//funcion recursiva para poder eliminar los hijos de los hijos en caso que se decida eliminar un usuario que posea hijos y elijamos eliminar tambien los hijos que tenga ese usuario
		public function Eliminar_hijos_recursiva($id_usuario){
					if ($this->SaberPadre($id_usuario)){
						$hijos=$this->traer_hijos($id_usuario);
						if (count($hijos)>0) {
							foreach ($hijos as $key => $hijo) {
							$id_hijo=$hijo["id_usuario"];			
							
							$resp=$this->Eliminar_hijos_recursiva($id_hijo);
							$this->EliminarUsuario($id_hijo);
							}
						}
					}
					else
					{
						return false;
					}	
		}
		//si eliminamos un usuario y este tiene hijos el sistema preguntara si queremos eliminar los hijos tambien. En caso que no los queramos eliminar debemos ligarlos a otro usuario que sea el nuevo padre. Esta funcion hace el enganche
		public function enganchar_user_padre($id_padre_enganche,$id_padreActual){
			$query = "UPDATE herencia SET padre = ".$id_padre_enganche." WHERE padre = ".$id_padreActual."";
			
			//fijarse aca porque la consulta update arroja 0. entonces el result siempre va a ser
			// 0 y no va a llamar a las otras funciones hasta que sea mayor a 0
			
			//$query = "SELECT * FROM herencia where padre = ".$id_padreActual."";
			//var_dump($query);echo "<br>";
			$result = $this->db->execute($query);
			/*if (count($result)>0){
				return $result;
			}else{
				return false;
			}*/
			$usuarios_permisos=$this->DevolverPermisos_usuario_array($id_padre_enganche);
			//var_dump($usuarios_permisos);
			$this->recursiva_guardar_permisos_hijos($id_padre_enganche,$usuarios_permisos);
			$this->EliminarUsuario($id_padreActual);
			return true;
			
		}
		//si decidimos eliminar los hijos de los hijos de un usuario tambien debe eliminarse de la base de datos los permisos a los que hacia referencia ese id a eliminar
		public function Eliminar_permiso_recursivo($id_usuario,$array_permisos){
			if (count($array_permisos)>0) {
				foreach ($array_permisos as $key => $permiso) {
					$query = sprintf("DELETE from users_permisos WHERE id_usuario = %d AND fk_permiso= %d", $id_usuario,$permiso);
					$result = $this->db->execute($query);	
				}
			}
			if (count($result)>0){
						return $result;
					}else{
						return false;
					}
		}
		// quizas no la use porque en eliminar_hijos ya lo hace, pero en teoria lo que hace es eliminar la herencia a la que esta ligado un usuario que se va a eliminar.
		public function Eliminar_herencia_hijos($id_usuario,$array_herencia){
			if (count($array_herencia)>0) {
				foreach ($array_herencia as $key => $herencia) {
					$query = sprintf("DELETE from herencia WHERE id_usuario = %d", $id_usuario);
					$result = $this->db->execute($query);	
				}
			}
			if (count($result)>0){
						return $result;
					}else{
						return false;
					}
		}

		//funcion que elimina la herencia de un usuario, con el ultimo release del sistema puede que esta funcion quede obsoleta ya que existe una funcion recursiva que hace el trabajo más eficiente.
		public function Eliminar_Herencia($id_usuario){
			$query = sprintf("DELETE from herencia WHERE id_usuario = %d", $id_usuario);
			$result = $this->db->execute($query);	

			if (count($result)>0){
				return $result;
			}else{
				return false;
			}
		}

		//funcion clasica, da de baja un usuario, tambien elimina la herencia y los permisos.
		public function EliminarUsuario($id_usuario){
			$query = sprintf("DELETE from users WHERE user_id = %d", $id_usuario);
			$result = $this->db->execute($query);	
			//llamar a eliminar_herencia($id_usuario);		
			$this->Eliminar_Herencia($id_usuario);
			$this->Eliminar_permisos($id_usuario);	
		}

		//funcion para poder actualizar la foto de un usuario usando una imagen de la pc y subirla como foto perfil del sistema
		public function subirImagen($imagen, $pkUser)
		{
			$archivoExtension = substr($imagen['name'], -3); //Extension del archivo
			$MaximoImagen = 1000000; // En Bytes
			$archivoDestino = "";
			$mensaje = "";
			//Verifica tamaño de la imagen
			if ($imagen['size'] > $MaximoImagen)
			{
			$archivoDestino = "Error1";
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del premio (tamaño de la imagen incorrecto). Para hacerlo, edite el premio.";
			}
			else
			//Verifica el formato del archivo
			if ($archivoExtension != "png" && $archivoExtension != "jpg" && $archivoExtension != "PNG" && $archivoExtension != "JPG")
			{
			$archivoDestino = "Error2";
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del premio (solo archivos .jpg o .png). Para hacerlo, edite el premio.";
			}
			//Si no hubo problemas con el archivo a subir ni con las fechas
			if($archivoDestino=="")
			{
			$random="".rand();
			$archivoDestino = $pkUser."_".$random.".".$archivoExtension;
			//Agrega el archivo al servidor
			if (!move_uploaded_file($imagen["tmp_name"], '../../foto_user/'.$archivoDestino))
			{
			$archivoDestino = "Error3"; //No se genero el alta
			$mensaje = " Sin embargo no se pudo agregar la imagen principal del usuario (Error al subir el archivo). Para hacerlo, edite el usuario.";
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
		//FUNCION RECURSIVA, OJO! 
		function recursiva($id_padre,$array_permisos){
			if ($this->SaberPadre($id_padre)) 
			{
				//Traer hijos y eliminar sus permisos
				$hijos=$this->traer_hijos($id_padre);
				if (count($hijos)>0) {
					foreach ($hijos as $key => $hijo) {
						$id_hijo=$hijo["id_usuario"];
						//echo $id_hijo." <br>";
						//por cada hijo tiene que eliminar los permisos que vengan del array.
						$rt=$this->Eliminar_permiso_recursivo($id_hijo,$array_permisos);
						
						$resp=$this->recursiva($id_hijo,$array_permisos);

					}
				}
			}
			else
			{

				return false;
			}
		}
		//guarda los nuevos permisos del usuario hijo ya que su padre fue eliminado o cambiado y de esa manera se aplica el cambio a los hijos de los hijos.
		function recursiva_guardar_permisos_hijos($id_padre,$array_permisos){
			if ($this->SaberPadre($id_padre)) 
			{
				//Traer hijos y eliminar sus permisos
				$hijos=$this->traer_hijos($id_padre);
				if (count($hijos)>0) {
					foreach ($hijos as $key => $hijo) {
						$id_hijo=$hijo["id_usuario"];
						//echo $id_hijo." <br>";
						//por cada hijo tiene que eliminar los permisos que vengan del array.
						
						$rt=$this->Eliminar_permisos($id_hijo);

						$rt1=$this->guardar_permisos_usuario($array_permisos,$id_hijo);
						
						$resp=$this->recursiva_guardar_permisos_hijos($id_hijo,$array_permisos);

					}
				}
			}
			else
			{

				return false;
			}
		}
		
}


	?>