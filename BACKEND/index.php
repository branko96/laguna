<?php 

	include("controller/UsuariosController.php");
	$uc = new UsuariosController($basedatos,$servidor,$usuario,$paswd);
	//$rta=$uc->traer_cant_hijos(202);

	//$id_padre_actual=202;
	$id_usuario=122;

	$rta= $uc->VerUsuario($id_usuario);
	//var_dump();
	//if(count($rta)>0){
		var_dump($rta);
	


?>