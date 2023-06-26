<?php
class conexion{
	public function get_conexion(){
		include ("configuration.php");
		$conexion=new PDO("mysql:host=$host;dbname=$db;", $user, $pass);		
		return $conexion;
	}
}
?>