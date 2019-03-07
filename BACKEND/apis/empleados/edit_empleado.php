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
	$fecha_fin= date('Y-m-d H:i:s');
	$rta=$empleadosController->EditarEmpleado($body['id_empleado'],$body['nombre'],$body['apellido'],$body['puesto'],$body['sueldo'],$body['email'],$body['dni'],$body['cuil'], $body['cod_postal'], $fecha_fin);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

