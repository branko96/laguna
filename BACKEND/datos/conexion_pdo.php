<?php
class Conexion{
    function get_conexion(){
        $link= 'mysql:host=localhost; dbname=lagunacampo';
        $usuario='root';
        $pass='';
        try {
            $conexion= new PDO($link,$usuario,$pass);
            //echo('conectado');
        } catch (Exception $e) {
            print "Eror :" .$e-> getMessage() . "<br/>";
            die();
        }
        return $conexion;
    }
}
?>