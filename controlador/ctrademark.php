<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mtrademark.php';
require_once 'controlador/optimg.php';

$pg = 309;
$arc = "home.php";
$mtrademark = new mtrademark();

$idtrademark = isset($_POST['idtrademark']) ? $_POST['idtrademark']:NULL;
if(!$idtrademark)
	$idtrademark = isset($_GET['idtrademark']) ? $_GET['idtrademark']:NULL;
$tname = isset($_POST['tname']) ? $_POST['tname']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

$arch = isset($_FILES['arch']["name"]) ? $_FILES['arch']["name"]:NULL;
$timg = isset($_POST['timg']) ? $_POST['timg']:NULL;

if($arch && $tname){
	$timg = opti($_FILES['arch'], $tname, "img/marcas","img");
}
#echo "test<br><br><br>".$idtrademark."-".$tname."-".$timg."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($tname){
		$dttrademark = NULL;
		if($idtrademark) $dttrademark = $mtrademark->seltrademark1($idtrademark);
		$rutaImagenAnterior = $dttrademark[0]['timg'];
		// Verifica si se ha seleccionado un nuevo archivo de imagen
		if ($_FILES['arch']['tmp_name']) {
			// Elimina la imagen anterior
			if (file_exists($rutaImagenAnterior)) {
				unlink($rutaImagenAnterior);
			}
		}
		$mtrademark->instrademark($idtrademark, $tname, $timg);
		#echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
		#echo '<script>window.location="home.php?pg='.$pg.'";</script>';
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$idtrademark = NULL;
}
//Eliminar
if ($opera == "Eliminar") {
    if ($idtrademark) {
		
		$dttrademark = NULL;
		if($idtrademark) $dttrademark = $mtrademark->seltrademark1($idtrademark);
        $rutaImagen = $dttrademark[0]['timg']; // Obtén la ruta de la imagen desde la base de datos o donde la tengas almacenada
        $mtrademark->deltrademark($idtrademark);
        echo "<script>alert('Datos eliminados exitosamente');</script>";

        // Elimina la imagen del archivo en la carpeta
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
			echo '<script>window.location="home.php?pg='.$pg.'";</script>';
        }
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
			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST" enctype="multipart/form-data">';
				if($idtrademark and $dttrademark){
					$txt .= '<h6 class="warning">ID Categoria</h6>';
					$txt .= '<input type="text" name="idtrademark" readonly value="'.$idtrademark.'" class="form-control" />';
				}
				$txt .= '<h6 class="warning">Nombre</h6>';
				$txt .= '<input type="text" name="tname" maxlength="70" class="form-control"';
					if($idtrademark and $dttrademark) $txt .= ' value="'.$dttrademark[0]['tname'].'"';
				$txt .= ' required />';
				$txt .= '<h6 class="warning">Icono</h6>';

				if($idtrademark and $dttrademark){
					$txt .= '<div class="container">';
						$txt .= '<div class="row justify-content-center">';
							$txt .= '<div class="col-6 d-flex align-items-center">';
								$txt .= '<img  class="img-fluid" src="'.$dttrademark[0]['timg'].'">';	
							$txt .= '</div>';
						$txt .= '</div>';
					$txt .= '</div>';
			
				}
				if($idtrademark and $dttrademark) {$txt .= '<input type="hidden" name="timg" value="'.$dttrademark[0]['timg'].'">';}

				$txt .= '<input type="file" name="arch" class="form-control"accept="image/jpeg, image/png, image/jpg"';
				$txt .='>';
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
								$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Nombre</th>';
								$txt .= '<th>Imagen</th>';
							$txt .= '</tr>';
						$txt .= '</thead>';
						$txt .= '<tbody>';
						foreach ($dttrademark as $dt) {
							$txt .= '<tr>';
								$txt .= '<td>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&idtrademark='.$dt['idtrademark'].'" title="Editar">';
										$txt .= '<i class="fas fa-edit fa-2x"></i>';
									$txt .= '</a>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&idtrademark='.$dt['idtrademark'].'" onclick="return eliminar();">';
										$txt .= '<i class="fas fa-trash-alt fa-2x"></i>';
									$txt .= '</a>';
								$txt .= '</td>';
								$txt .= '<td>'.$dt['idtrademark'].'</td>';
								$txt .= '<td>'.$dt['tname'].'</td>';
								$txt .= '<td><img src="'.$dt['timg'].'" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px;" alt="'.$dt['tname'].'"></td>';
							}
							$txt .= '</tr>';					
						$txt .= '</tbody>';
						$txt .= '<tfoot>';
							$txt .= '<tr>';
								$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
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
