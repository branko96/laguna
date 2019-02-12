<?php 
//FIJAS
require_once '../../datos/conexion.php';
require_once '../../controller/EmpleadosController.php';

header('Access-Control-Allow-Origin: *');

//defino controladora

$empleadosController= new EmpleadosController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	//var_dump($body);
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$empleadosController->EditarEmpleado($body['id'],$body['nombre'],$body['apellido'],$body['puesto'],$body['sueldo'],$body['email'], $body['cod_postal'], $body['fecha_fin']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

