<?php
class mcate{
	#Metodo mostrar Todos los registros de la tabla category
	public function selcate(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idcate, cname, cicon FROM category";
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
	public function selcate1($idcate){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idcate, cname, cicon FROM category";
		$sql .= " WHERE idcate=:idcate";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idcate',$idcate);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Actualizar o Insertar
	public function inscate($idcate, $cname, $cicon){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL inscate(:idcate, :cname, :cicon);";
		//echo "<br><br><br><br>".$sql."<br>'".$idcate."'-'".$cname."'-'".$cicon."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idcate',$idcate);
		$result->bindParam(':cname',$cname);
		$result->bindParam(':cicon',$cicon);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
	//Eliminar
	public function delcate($idcate){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL delcate(:idcate);";
		//echo "<br><br><br><br>".$sql."<br>".$idcate."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idcate',$idcate);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
}
?>