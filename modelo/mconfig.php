<?php
class mconfig{
//Motrar Configuracion Actual
	public function selconfig(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idconfig, idusu, tittle, header, footer, colorp, colors FROM configuration";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Actualizar o Insertar
	public function updateconfig($idconfig, $tittle, $mname, $mdescription, $header, $footer, $caddress, $facebook, $instagram, $logo, $favicon, $map, $about, $cservices, $phone, $colorpry, $colorsec, $font){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL updateconfig(:idconfig, :tittle, :mname, :mdescription, :header, :footer, :caddress, :facebook, :instagram, :logo, :favicon, :map, :about, :cservices, :phone, :colorpry, :colorsec, :font);";
		//echo "<br><br><br><br>".$sql."<br>'".$idconfig."'-'".$cname."'-'".$cicon."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idconfig',$idconfig);
		$result->bindParam(':tittle',$tittle);
		$result->bindParam(':mname',$mname);
		$result->bindParam(':mdescription',$mdescription);
		$result->bindParam(':header',$header);
		$result->bindParam(':footer',$footer);
		$result->bindParam(':caddress',$caddress);
		$result->bindParam(':facebook',$facebook);
		$result->bindParam(':instagram',$instagram);
		$result->bindParam(':logo',$logo);
		$result->bindParam(':favicon',$favicon);
		$result->bindParam(':map',$map);
		$result->bindParam(':about',$about);
		$result->bindParam(':cservices',$cservices);
		$result->bindParam(':phone',$phone);
		$result->bindParam(':colorpry',$colorpry);
		$result->bindParam(':colorsec',$colorsec);
		$result->bindParam(':font',$font);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}

	//Mostrar un registro
	public function selconfig1($idconfig){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idconfig, tittle, mname, mdescription, header, footer, caddress, facebook, instagram, logo, favicon, map, about, cservices, phone, colorpry, colorsec, font FROM html_configuration";
		$sql .= " WHERE idconfig=:idconfig";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idconfig',$idconfig);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
}