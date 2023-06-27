<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mtrademark.php';

$pg = 309;
$arc = "home.php";
$mtrademark = new mtrademark();

$idtrademark = isset($_POST['idtrademark']) ? $_POST['idtrademark']:NULL;
if(!$idtrademark)
	$idtrademark = isset($_GET['idtrademark']) ? $_GET['idtrademark']:NULL;
$tname = isset($_POST['tname']) ? $_POST['tname']:NULL;
$timg = isset($_POST['timg']) ? $_POST['timg']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

//echo "<br><br><br>".$idtrademark."-".$tname."-".$timg."-".$filtro."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($tname){
		$mtrademark->instrademark($idtrademark, $tname, $timg);
		echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
		echo '<script>window.location="home.php?pg='.$pg.'";</script>';
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$idtrademark = NULL;
}
//Eliminar
if($opera=="Eliminar"){
	if($idtrademark){
		$mtrademark->deltrademark($idtrademark);
		echo "<script>alert('Datos eliminados existosamente');</script>";
	}
	$idtrademark = NULL;
}
//Insertar datos
function insdatos($idtrademark,$pg,$arc){
	$mtrademark = new mtrademark();
	$dttrademark = NULL;
	if($idtrademark) $dttrademark = $mtrademark->seltrademark1($idtrademark);
	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
		$txt .= '<div class="d-flex justify-content-center">';
			$txt .= vayuda("Como usar?", "Esperando mensaje...");
			$txt .= vpqr($pg);
		$txt .= '</div>';

		$txt .= '<div class="card-header py-3">';
			$txt .= '<h4 class="m-0 font-weight-bold text-info">Gestion Marcas</h4>';
		$txt .= '</div>';

			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($idtrademark and $dttrademark){
					$txt .= '<h6 class="warning">ID Categoria</h6>';
					$txt .= '<input type="text" name="idtrademark" readonly value="'.$idtrademark.'" class="form-control" />';
				}
				$txt .= '<h6 class="warning">Nombre</h6>';
				$txt .= '<input type="text" name="tname" maxlength="70" class="form-control"';
					if($idtrademark and $dttrademark) $txt .= ' value="'.$dttrademark[0]['tname'].'"';
				$txt .= ' required />';
				$txt .= '<h6 class="warning">Icono</h6>';
				$txt .= '<input type="text" name="timg" maxlength="50" class="form-control"';
					if($idtrademark and $dttrademark) $txt .= ' value="'.$dttrademark[0]['timg'].'"';
				$txt .= ' />';
				$txt .= '<input type="hidden" name="opera" value="InsAct">';
				$txt .= '<input type="submit" class="btn btn-primary w-100 mt-3" value="';
				if($idtrademark and $dttrademark)
					$txt .= 'Actualizar';
				else
					$txt .= 'Registrar';
				$txt .= '">';
					#$txt .= '<button class="btn btn-warning w-100 mt-3" type="button">Limpiar campos</button>';
				
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}
//Mostrar datos
function mosdatos($pg,$arc){
	$mtrademark = new mtrademark();
	$dttrademark = $mtrademark->seltrademark();
	$txt = '';

	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
		$txt .= '<div class="card-header py-3">';
		$txt .= '<h6 class="m-0 font-weight-bold text-info">Listado de Marcas</h6>';
		$txt .= '</div>';
		
			if($dttrademark){
				$txt .= '<div class="table-responsive">';
					$txt .= '<table id="example" class="table table-hover" style="width:100%">';
						$txt .= '<thead>';
							$txt .= '<tr>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Nombre</th>';
								$txt .= '<th>Imagen</th>';
							$txt .= '</tr>';
						$txt .= '</thead>';
						$txt .= '<tbody>';
						foreach ($dttrademark as $dt) {
							$txt .= '<tr>';
								$txt .= '<td>'.$dt['idtrademark'].'</td>';
								$txt .= '<td>'.$dt['tname'].'</td>';
								$txt .= '<td>'.$dt['timg'].'</td>';
							}
							$txt .= '</tr>';					
						$txt .= '</tbody>';
						$txt .= '<tfoot>';
							$txt .= '<tr>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Nombre</th>';
								$txt .= '<th>Imagen</th>';
							$txt .= '</tr>';
						$txt .= '</tfoot>';
					$txt .= '</table>';
				$txt .= '</div>';
				

			}else{
				$txt .= '<h2 class="text-danger">No existen datos</h2>';
			}
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}
?>
