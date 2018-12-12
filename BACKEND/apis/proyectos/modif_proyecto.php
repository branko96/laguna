<?php 

//FIJAS
include("../../controller/ProyectController.php");
header('Access-Control-Allow-Origin: *');

//defino controladora

$proyectController= new ProyectController();

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	//var_dump($body);
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$proyectController->ActualizarProyect($body['id_proyect'],$body['nombre'],$body['pais'],$body['ciudad'],$body['descripcion'],$body['id_group'],$body['estado'], $_FILES['foto_proyecto']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

