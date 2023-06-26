<?php
class mprod{
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

	#Metodo mostrar Todos los registros de la tabla product
	public function selprod(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT p.idprod, p.pname, p.price, p.trademark, m.nomval, p.model, p.category, c.cname, p.discount, p.cdescription, p.cstatus FROM product AS p INNER JOIN valor AS m ON p.trademark=m.codval INNER JOIN category AS c ON p.category=c.idcate";
		//echo "<br><br><br><br>".$sql."<br><br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	#Metodo para llevar ID de un product a la pagina para insertar fotos
	public function selimgprod($pname, $price, $trademark, $model, $category, $discount, $cdescription, $cstatus){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idprod FROM product WHERE pname=:pname and price=:price and trademark=:trademark and model=:model and category=:category and discount=:discount and cdescription=:cdescription and cstatus=:cstatus";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':pname',$pname);
		$result->bindParam(':price',$price);
		$result->bindParam(':trademark',$trademark);
		$result->bindParam(':model',$model);
		$result->bindParam(':category',$category);
		$result->bindParam(':discount',$discount);
		$result->bindParam(':cdescription',$cdescription);
		$result->bindParam(':cstatus',$cstatus);
		
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	#Metodo mostrar Todos los registros de la tabla Valores para 
	public function seltrademark(){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT codval, iddom, nomval, parval FROM valor WHERE iddom=9";
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
	public function selprod1($idprod){
		$resultado=null;
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idprod, pname, price, trademark, model, category, discount, cdescription, cstatus FROM product ";
		$sql .= " WHERE idprod=:idprod";
		//echo "<br><br><br><br>".$sql."<br>".$filtro."<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idprod',$idprod);
		$result->execute();
		while($f=$result->fetch()){
			$resultado[]=$f;
		}
		return $resultado;
	}
	//Actualizar o Insertar
	public function insprod($idprod, $pname, $price, $trademark, $model, $category, $discount, $cdescription, $cstatus){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL insprod(:idprod, :pname, :price, :trademark, :model, :category, :discount, :cdescription, :cstatus);";
		//echo "<br><br><br><br>".$sql."<br>'".$idprod."'-'".$cname."'-'".$cicon."'<br>";
		$result = $conexion->prepare($sql);
		//echo $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result->bindParam(':idprod',$idprod);
		$result->bindParam(':pname',$pname);
		$result->bindParam(':price',$price);
		$result->bindParam(':trademark',$trademark);
		$result->bindParam(':model',$model);
		$result->bindParam(':category',$category);
		$result->bindParam(':discount',$discount);
		$result->bindParam(':cdescription',$cdescription);
		$result->bindParam(':cstatus',$cstatus);
		if(!$result)
			echo "<script>alert('ERROR AL REGISTRAR');</script>";
		else
			$result->execute();
	}
	//Eliminar
	public function delprod($idcate){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL delprod(:idcate);";
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