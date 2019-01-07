<?php 

//FIJAS
include_once 'C:/wamp/www/laguna/BACKEND/controller/EmpleadosController.php'
//header('Access-Control-Allow-Origin: *');

//defino controladora

$EmpleadosController= new EmpleadosController();

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_GET; 
	
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$empleadosController->VerEmpleado($body['id_empleado']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

