<?php
class mfavicon{
	#Metodo mostrar Todos los registros de la tabla category
	public function sfavicon(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT favicon FROM html_configuration";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
}
?>