<?php
    class DB{
        public static function conectar(){
            // mysql('localhost',usuario,password, base_de_datos);
            $conexion = new mysqli("localhost", "root", "", "hervas.sl");
            $conexion->query("SET NAMES 'utf8'");

            return $conexion;
        }
    }
?>