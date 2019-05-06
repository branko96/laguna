<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
session_start();

    $datos=json_decode(file_get_contents("php://input"),true);

    $titulo = $datos["mensaje"];
    $_SESSION['objetoCliente']=$titulo;
    //var_dump($_SESSION['objetoCliente']);
    echo "1";
?>
