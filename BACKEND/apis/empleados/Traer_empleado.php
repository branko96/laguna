<?php 
header('Access-Control-Allow-Origin: *');
require_once '../../datos/conexion.php';
require_once '../../controller/EmpleadosController.php';

//defino controladora

$EmpleadosController= new EmpleadosController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//OBTENGO DATOS ENVIADOS
	  	//Solamente cuando es json

		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros

		$body=$_GET; 

	//LLAMO A LA FUNCION CON LOS PARAMETROS

	$rta=$EmpleadosController->Traer_Empleados($body['id_empleado']);

	//IMPRIMO RESPUESTA

	print(json_encode($rta->getJson()));

}

?>



