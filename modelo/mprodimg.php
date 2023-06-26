<?php
class mprodimg{
	#listar todos los registros
    public function selprod(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idprod, pname, price, trademark, model, category, discount, cdescription, cstatus FROM product";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	#insertar imagenes
	public function insprodimg($idimg, $pfilename, $idprod){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL insprodimg(:idimg,:pfilename,:idprod);";
		//echo "<br><br><br><br>".$sql."<br>'".$idprod."'-'".$cname."'-'".$cicon."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idimg',$idimg);
		$result->bindParam(':pfilename',$pfilename);
		$result->bindParam(':idprod',$idprod);

		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
	#verificacion
	public function insimg($idimg, $pfilename, $idprod){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL insprodimg(:idimg,:pfilename,:idprod);";
		#echo "<br><br><br><br>".$sql."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idimg',$idimg);
		$result->bindParam(':pfilename',$pfilename);
		$result->bindParam(':idprod',$idprod);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}


}
?>