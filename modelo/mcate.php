<?php
class mcate{
	#Metodo mostrar Todos los registros de la tabla category
	public function selcate(){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idcate, cname, cicon FROM category";
		
		try {
			$result = $conexion->query($sql);
			$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		} catch (PDOException $e) {
			// Manejo de errores
			echo "Error al obtener los registros de la tabla category: " . $e->getMessage();
			return null;
		}
	}
	
	//Mostrar un registro
	public function selcate1($idcate){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "SELECT idcate, cname, cicon FROM category WHERE idcate = :idcate";
		
		try {
			$result = $conexion->prepare($sql);
			$result->bindParam(':idcate', $idcate);
			$result->execute();
			$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		} catch (PDOException $e) {
			// Manejo de errores
			echo "Error al obtener el registro de la tabla category: " . $e->getMessage();
			return null;
		}
	}
	
	//Actualizar o Insertar
	public function inscate($idcate, $cname, $cicon){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL inscate(:idcate, :cname, :cicon)";
	
		try {
			$result = $conexion->prepare($sql);
			$result->bindParam(':idcate', $idcate);
			$result->bindParam(':cname', $cname);
			$result->bindParam(':cicon', $cicon);
			$result->execute();
		} catch (PDOException $e) {
			// Manejo de errores
			echo "Error al registrar en la tabla category: " . $e->getMessage();
			return;
		}
	}	
	//Eliminar
	public function delcate($idcate){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "CALL delcate(:idcate)";
	
		try {
			$result = $conexion->prepare($sql);
			$result->bindParam(':idcate', $idcate);
			$result->execute();
		} catch (PDOException $e) {
			// Manejo de errores
			echo "Error al eliminar el registro de la tabla category: " . $e->getMessage();
			return;
		}
	}	
}
?>