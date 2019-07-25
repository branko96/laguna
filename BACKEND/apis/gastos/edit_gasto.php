<?php 
//FIJAS
require_once '../../datos/conexion.php';
require_once '../../controller/GastosController.php';

header('Access-Control-Allow-Origin: *');

//defino controladora

$GastosController= new GastosController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	//var_dump($body);
		$total=$_POST['cantidad']*$_POST['valor'];
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$GastosController->EditarGasto($body['id'],$body['fecha'],$body['id_categoria'],$body['detalle'],$body['valor'],$body['cantidad'],$body['id_establecimiento'],$body['tipo_recibo'],$total);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

