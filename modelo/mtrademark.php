<?php
class mtrademark{
	#Metodo mostrar Todos los registros de la tabla trademark
	public function seltrademark(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idtrademark, tname, timg FROM trademark";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Mostrar un registro
	public function seltrademark1($idtrademark){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idtrademark, tname, timg FROM trademark";
		$sql .= " WHERE idtrademark=:idtrademark";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idtrademark',$idtrademark);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Actualizar o Insertar
	public function instrademark($idtrademark, $tname, $timg){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL instrade(:idtrademark, :tname, :timg);";
		//echo "<br><br><br><br>".$sql."<br>'".$idtrademark."'-'".$tname."'-'".$timg."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idtrademark',$idtrademark);
		$result->bindParam(':tname',$tname);
		$result->bindParam(':timg',$timg);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
	//Eliminar
	public function deltrademark($idtrademark){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL deltrade(:idtrademark);";
		//echo "<br><br><br><br>".$sql."<br>".$idtrademark."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idtrademark',$idtrademark);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
}
?>