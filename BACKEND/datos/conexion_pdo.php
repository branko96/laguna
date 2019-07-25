<?php
class Conexion{
    function get_conexion(){
        $link= 'mysql:host=localhost; dbname=c1520705_laguna';
        $usuario='c1520705_perros';
        $pass='Perros2019';
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