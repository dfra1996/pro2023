<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mconfig.php';


$pg=1009;
$arc="home.php";
$mconfig = new mconfig();

$idconfig = isset($_POST['idconfig']) ? $_POST['idconfig']:NULL;
if(!$idconfig)
	$idconfig = isset($_GET['idconfig']) ? $_GET['idconfig']:NULL;

$tittle = isset($_POST['tittle']) ? $_POST['tittle']:NULL;
$mname = isset($_POST['mname']) ? $_POST['mname']:NULL;
$mdescription = isset($_POST['mdescription']) ? $_POST['mdescription']:NULL;
$header = isset($_POST['header']) ? $_POST['header']:NULL;
$footer = isset($_POST['footer']) ? $_POST['footer']:NULL;
$caddress = isset($_POST['caddress']) ? $_POST['caddress']:NULL;
$facebook = isset($_POST['facebook']) ? $_POST['facebook']:NULL;
$instagram = isset($_POST['instagram']) ? $_POST['instagram']:NULL;
$logo = isset($_POST['logo']) ? $_POST['logo']:NULL;
$favicon = isset($_POST['favicon']) ? $_POST['favicon']:NULL;
$map = isset($_POST['map']) ? $_POST['map']:NULL;
$about = isset($_POST['about']) ? $_POST['about']:NULL;
$cservices = isset($_POST['cservices']) ? $_POST['cservices']:NULL;
$phone = isset($_POST['phone']) ? $_POST['phone']:NULL;
$colorpry = isset($_POST['colorpry']) ? $_POST['colorpry']:NULL;
$colorsec = isset($_POST['colorsec']) ? $_POST['colorsec']:NULL;
$font = isset($_POST['font']) ? $_POST['font']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

if($opera=="InsAct"){
	if($tittle){
		$mconfig->updateconfig($idconfig, $tittle, $mname, $mdescription, $header, $footer, $caddress, $facebook, $instagram, $logo, $favicon, $map, $about, $cservices, $phone, $colorpry, $colorsec, $font);
		echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
		echo '<script>window.location="home.php?pg='.$pg.'";</script>';
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$idconfig = NULL;
}

//Insertar datos
function insdatos($idconfig,$pg,$arc){
	$mconfig = new mconfig();
	$dtconfig = NULL;
	if($idconfig) $dtconfig = $mconfig->selconfig1($idconfig);
	$txt = '';
	$txt .= '<div class="container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="d-flex justify-content-center">';
				$txt .= vayuda("Nuevo Preoperacional", "Esperando mensaje...");
				$txt .= vpqr($pg);
			$txt .= '</div>';		$txt .= '<div class="card-header py-3">';
					$txt .= '<h6 class="m-0 font-weight-bold text-primary">Categorias</h6>';
				$txt .= '</div>';

				$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
					if($idconfig and $dtconfig){
						$txt .= '<label>ID Configuracion</label>';
						$txt .= '<input type="text" name="idconfig" readonly value="'.$idconfig.'" class="form-control" />';
					}
					$txt .= '<label>Titulo de la pagina publico</label>';
					$txt .= '<input type="text" name="tittle" maxlength="70" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['tittle'].'"';
					$txt .= ' required />';
					$txt .= '<label>Titulo de la pagina interno</label>';
					$txt .= '<input type="text" name="mname" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['mname'].'"';
					$txt .= ' />';

					$txt .= '<label>Descripcion de la pagina</label>';
					$txt .= '<input type="text" name="mdescription" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['mdescription'].'"';
					$txt .= ' />';
					
					$txt .= '<label>Texto cabecera</label>';
					$txt .= '<input type="text" name="header" maxlength="100" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['header'].'"';
					$txt .= ' />';
					
					$txt .= '<label>Texto pie de pagina</label>';
					$txt .= '<input type="text" name="footer" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['footer'].'"';
					$txt .= ' />';
					
					$txt .= '<label>Enlace a facebook</label>';
					$txt .= '<input type="text" name="facebook" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['facebook'].'"';
					$txt .= ' />';

					$txt .= '<label>Enlace a instagram</label>';
					$txt .= '<input type="text" name="instagram" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['instagram'].'"';
					$txt .= ' />';

					$txt .= '<label>Logo de la pagina</label>';
					$txt .= '<input type="text" name="logo" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['logo'].'"';
					$txt .= ' />';

					$txt .= '<label>Favicon de la pagina</label>';
					$txt .= '<input type="text" name="favicon" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['favicon'].'"';
					$txt .= ' />';

					$txt .= '<label>Enlace del mapa</label>';
					$txt .= '<input type="text" name="map" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['map'].'"';
					$txt .= ' />';

					$txt .= '<label>Descripcion "Sobre nosotros"</label>';
					$txt .= '<input type="text" name="about" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['about'].'"';
					$txt .= ' />';

					$txt .= '<label>Descripcion "Servicios"</label>';
					$txt .= '<input type="text" name="cservices" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['cservices'].'"';
					$txt .= ' />';

					$txt .= '<label>Telefono contacto i/o Whatsapp</label>';
					$txt .= '<input type="text" name="phone" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['phone'].'"';
					$txt .= ' />';

					$txt .= '<label>Color de la pagina primario</label>';
					$txt .= '<input type="color" name="colorpry" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['colorpry'].'"';
					$txt .= ' />';

					$txt .= '<label>Color de la pagina Secundario</label>';
					$txt .= '<input type="color" name="colorsec" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['colorsec'].'"';
					$txt .= ' />';

					$txt .= '<label>Fuente principal</label>';
					$txt .= '<input type="text" name="font" maxlength="50" class="form-control"';
						if($idconfig and $dtconfig) $txt .= ' value="'.$dtconfig[0]['font'].'"';
					$txt .= ' />';		
					

					$txt .= '<input type="hidden" name="opera" value="InsAct">';
					$txt .= '<div class="cen">';
						$txt .= '<input type="submit" class="btn btn-secondary" value="';
						if($idconfig and $dtconfig)
							$txt .= 'Actualizar';
						else
							$txt .= 'Registrar';
						$txt .= '">';
					$txt .= '</div>';
				$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';

	echo $txt;
}

function mosdatos(){
	$mconfig = new mconfig();
	$dtusu = $mconfig->selconfig();
	$txt = '';
	$txt .= '<div class="container-fluid">';
		$txt .= '<div class="card shadow mb-4">';
    		$txt .= '<div class="card-header py-3">';
    			$txt .= '<h6 class="m-0 font-weight-bold text-danger">Configuracion</h6>';
    		$txt .= '</div>';
    	$txt .= '<div class="card-body">';
        $txt .= '<div class="table-responsive">';
	if ($dtusu){
			$txt .= '<table id="datatablesSimple">';
			$txt .= '<thead>';
				$txt .= '<tr>';
					$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
					$txt .= '<th>ID</th>';
					$txt .= '<th>Titulo</th>';
					$txt .= '<th>Header</th>';
					$txt .= '<th>fotter</th>';
					$txt .= '<th>Color Primario</th>';
					$txt .= '<th>Color Secundario</th>';

				$txt .= '</tr>';
			$txt .= '</thead>';
			$txt .= '<tfoot>';
				$txt .= '<tr>';
                    $txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
                    $txt .= '<th>ID</th>';
                    $txt .= '<th>Titulo</th>';
                    $txt .= '<th>Header</th>';
                    $txt .= '<th>fotter</th>';
                    $txt .= '<th>Color Primario</th>';
                    $txt .= '<th>Color Secundario</th>';			
				$txt .= '</tr>';
			$txt .= '</tfoot>';
			$txt .= '<tbody>';
			foreach ($dtusu as $dt){
				$txt .= '<tr>';
                    
					#$txt .= '<td><i class="fa-solid fa-code"></i></td>';
					$txt .= '<td><input type="color"></td>';
					$txt .= '<td>'.$dt['idconfig'].'</td>';
					$txt .= '<td>'.$dt['tittle'].'</td>';
					$txt .= '<td>'.$dt['header'].'</td>';
					$txt .= '<td>'.$dt['footer'].'</td>';
					$txt .= '<td>'.$dt['colorp'].'</td>';
					$txt .= '<td>'.$dt['colors'].'</td>';
                    


				$txt .= '</tr>';
			}	
			$txt .= '</tbody>';
		$txt .= '</table>';
		$txt .= '</div>';
	$txt .= '</div>';

	$txt .= '</div>';
	}else{
		echo "<h2>Sin Registros<h2>";
	}
	echo $txt;
}
?>