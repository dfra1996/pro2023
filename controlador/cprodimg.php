<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mprodimg.php';
require_once 'controlador/optimg.php';

$pg = 305;
$arc = "home.php";
$mprodimg = new mprodimg();

$idimg = isset($_POST['idimg']) ? $_POST['idimg']:NULL;
if(!$idimg)
	$idimg = isset($_GET['idimg']) ? $_GET['idimg']:NULL;

$idprod = isset($_POST['idprod']) ? $_POST['idprod']:NULL;
if(!$idprod)
$idprod = isset($_GET['idprod']) ? $_GET['idprod']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

$producto = $idprod;

$pfilename1 = isset($_POST['pfilename1']) ? $_POST['pfilename1']:NULL;
$arch1 = isset($_FILES['arch1']["name"]) ? $_FILES['arch1']["name"]:NULL;
if($arch1 and $producto){
	$pfilename1 = opti($_FILES['arch1'], "1".$producto, "img","img");
}
$pfilename2 = isset($_POST['pfilename2']) ? $_POST['pfilename2']:NULL;
$arch2 = isset($_FILES['arch2']["name"]) ? $_FILES['arch2']["name"]:NULL;
if($arch2 and $producto){
	$pfilename2 = opti($_FILES['arch2'], "2".$producto, "img","img");
}
$pfilename3 = isset($_POST['pfilename3']) ? $_POST['pfilename3']:NULL;
$arch3 = isset($_FILES['arch3']["name"]) ? $_FILES['arch3']["name"]:NULL;
if($arch3 and $producto){
	$pfilename3 = opti($_FILES['arch3'], "3".$producto, "img","img");
}
$pfilename4 = isset($_POST['pfilename4']) ? $_POST['pfilename4']:NULL;
$arch4 = isset($_FILES['arch4']["name"]) ? $_FILES['arch4']["name"]:NULL;
if($arch4 and $producto){
	$pfilename4 = opti($_FILES['arch4'], "4".$producto, "img","img");
}

echo "<br><br><br>".$idprod." ".$arch1." ".$pfilename1;
//Insertar
if($opera=="InsAct"){

	$mprodimg->insimg($idimg, $pfilename1, $producto);
	
	if($idprod & $pfilename1){
		$mprodimg->insprodimg($idimg, $pfilename1, $producto);
		$mprodimg->insprodimg($idimg, $pfilename2, $producto);
		$mprodimg->insprodimg($idimg, $pfilename3, $producto);
		$mprodimg->insprodimg($idimg, $pfilename4, $producto);
		echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
		echo '<script>window.location="home.php?pg=304";</script>';

	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
}

//Insertar datos
function insdatos($idimg,$idprod,$pg,$arc){
	$mprodimg = new mprodimg();
	$dtprod = NULL;
	
	$txt = '';
	$txt .= '<div class="container-fluid">';
	$txt .= '<div class="d-flex justify-content-center">';
	 	$txt .= vayuda("Nuevo Preoperacional", "Esperando mensaje...");
	 	$txt .= vpqr($pg);
	$txt .= '</div>';		$txt .= '<div class="card-header py-3">';
			$txt .= '<h6 class="m-0 font-weight-bold text-primary">Agregar imagenes del producto</h6>';
		$txt .= '</div>';

		$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST" enctype="multipart/form-data">';

			$txt .= '<label>ID PROD </label>';
			$txt .= '<input type="text" name="idprod" readonly value="'.$idprod.'" class="form-control" />';

			$txt .= '<label>IDIMG</label>';
			$txt .= '<input type="text" name="idimg" readonly value="'.$idimg.'"  class="form-control" />';
			

			$txt .= '<label>Imagen del Producto 1</label>';
			$txt .= '<input type="file" name="arch1" class="form-control" accept="image/jpeg, image/png, image/jpg">';
			$txt .= '<label>Imagen del Producto 2</label>';
			$txt .= '<input type="file" name="arch2" class="form-control" accept="image/jpeg, image/png, image/jpg">';
			$txt .= '<label>Imagen del Producto 3</label>';
			$txt .= '<input type="file" name="arch3" class="form-control" accept="image/jpeg, image/png, image/jpg">';
			$txt .= '<label>Imagen del Producto 4</label>';
			$txt .= '<input type="file" name="arch4" class="form-control" accept="image/jpeg, image/png, image/jpg">';



			$txt .= '<input type="hidden" name="opera" value="InsAct">';
			$txt .= '<div class="cen">';
				$txt .= '<input type="submit" class="btn btn-secondary" value="Registrar"';
				$txt .= '">';
			$txt .= '</div>';
		$txt .= '</form>';
	$txt .= '</div>';

	echo $txt;
}

?>
