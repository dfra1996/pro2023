<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mpef.php';
require_once 'modelo/mpagina.php';

$pg = 302;
$arc = "home.php";
$mpef = new mpef();

$pefid = isset($_POST['pefid']) ? $_POST['pefid']:NULL;
if(!$pefid)
	$pefid = isset($_GET['pefid']) ? $_GET['pefid']:NULL;
$pefnom = isset($_POST['pefnom']) ? $_POST['pefnom']:NULL;
$pagprin = isset($_POST['pagprin']) ? $_POST['pagprin']:NULL;
$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL;
if(!$filtro)
	$filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;
$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

$pagi[] = isset($_POST['pagi']) ? $_POST['pagi']:NULL;

//echo "<br><br><br>".$pefid."-".$pefnom."-".$pagprin."-".$filtro."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($pefnom && $pagprin){
		$mpef->updpef($pefid, $pefnom, $pagprin);
		echo "<script>alert('Datos insertados exitosamente');</script>";
		echo '<script>window.location="home.php?pg='.$pg.'";</script>';
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$pefid = "";
}

//Insertar PxP
if($opera=="Inspxp"){
	if($pefid){
		$mpef->delpxp($pefid);
		if($pagi and $pagi[0]){
			for ($i=0;$i<count($pagi[0]);$i++) {			
				$mpef->inspxp($pagi[0][$i], $pefid);
			}
		}
	}
	$pefid = "";
}

//Eliminar
if($opera=="Eliminar"){
	if($pefid){
		$mpef->delpef($pefid);
		echo "<script>alert('Datos eliminados exitosamente');</script>";
	}
	$pefid = "";
}
//Insertar datos
function insdatos($pefid,$pg,$arc){
	$mpef = new mpef();
	$dtpef = NULL;
	$dtpg = $mpef->selpg();
	if($pefid) $dtpef = $mpef->selpef1($pefid);
	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="d-flex justify-content-center">';
				$txt .= vayuda("Como usar?", "Esperando mensaje...");
				$txt .= vpqr($pg);
			$txt .= '</div>';

			$txt .= '<div class="card-header py-3">';
				$txt .= '<h6 class="m-0 font-weight-bold text-info">Gestion de perfiles</h6>';
			$txt .= '</div>';

			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($pefid AND $dtpef){
					$txt .= '<label>Id</label>';
					$txt .= '<input type="text" name="pefid" readonly value="'.$pefid.'" class="form-control" />';
				}
				$txt .= '<label>Perfil</label>';
				$txt .= '<input type="text" name="pefnom" maxlength="50" class="form-control"';
					if($pefid AND $dtpef) $txt .= ' value="'.$dtpef[0]['pefnom'].'"';
				$txt .= ' required />';
				$txt .= '<label>Pagina Inicial</label>';
				if ($dtpg){
					$txt .= '<select name ="pagprin" class="form-control">';
					foreach ($dtpg as $dpg) {
						$txt .= '<option value="'.$dpg['pagid'].'"';
							if ($pefid AND $dtpef AND $dtpef[0]['pagprin']==$dpg['pagid']) $txt .= " selected ";
						$txt .= '>'; 
							$txt .= $dpg['pagnom']; 
						$txt .= '</option>';
					}
					$txt .= '</select>';
				}
				$txt .= '<input type="hidden" name="opera" value="InsAct">';
					$txt .= '<input type="submit" class="btn btn-primary w-100 mt-3" value="';
					if($pefid AND $dtpef)
						$txt .= 'Actualizar';
					else
						$txt .= 'Registrar';
					$txt .= '">';
			$txt .= '</form>';
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

//Mostrar datos
function mosdatos($pg,$arc){
	$mpef = new mpef();
	$result = $mpef->selpef();

	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="card-header py-3">';
				$txt .= '<h6 class="m-0 font-weight-bold text-info">Listado de Dominios</h6>';
			$txt .= '</div>';
				if ($result){
			$txt .= '<div class="table-responsive">';

					$txt .= '<table id="example" class="table table-hover" style="width:100%">';
					$txt .= '<thead>';
						$txt .= '<tr>';
							$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
							$txt .= '<th>ID</th>';
							$txt .= '<th>NOMBRE</th>';
							$txt .= '<th>PAGINA INICIO</th>';
						$txt .= '</tr>';
					$txt .= '</thead>';
					$txt .= '<tbody>';
					foreach ($result as $dt) {
					$txt .= '<tr>';
					$txt .= '<td>';
						$txt .= '<button data-bs-toggle="modal" data-bs-target="#myModal'.$dt['pefid'].'" title="Mostrar Páginas">';
							$txt .= '<i class="fas fa-eye fa-2x ic2"></i>';
						$txt .= '</button> ';
						$txt .= modal($dt['pefid'], $dt['pefnom'], $pg);
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&pefid='.$dt['pefid'].'" onclick="return eliminar();">';
						$txt .= '<i class="fas fa-trash-alt fa-2x ic2"></i>';
						$txt .= '</a>';
						$txt .= ' ';
						$txt .= '<a href="'.$arc.'?pg='.$pg.'&pefid='.$dt['pefid'].'">';
							$txt .= '<i class="fas fa-edit fa-2x ic2"></i>';
						$txt .= '</a>';
					$txt .= '</td>';


					$txt .= '<td>'.$dt['pefid'].'</td>';	
					$txt .= '<td>'.$dt['pefnom'].'</td>';	
					$txt .= '<td>'.$dt['pagnom'].'</td>';	
			

					$txt .= '</tr>';
				}
					$txt .= '</tbody>';


					$txt .= '<tfoot>';
						$txt .= '<tr>';
							$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
							$txt .= '<th>ID</th>';
							$txt .= '<th>NOMBRE</th>';
							$txt .= '<th>PAGINA INICIO</th>';
						$txt .= '</tr>';
					$txt .= '</tfoot>';
				
				$txt .= '</table>';
				$txt .= '</div>';

				}else{
					$txt .= '<h4>No existen datos para mostrar</h4>';
				}
		$txt .= '</div>';
	$txt .= '</div>';
	echo $txt;
}

function modal($pefid, $pefnom, $pg){
	$txt = '';
	$mpef = new mpef();
	$dtpg = $mpef->selpg();
	$txt .= '<div class="modal fade bd-example-modal-lg show" id="myModal'.$pefid.'" tabindex="-1" role="dialog">';
		$txt .= '<div class="modal-dialog">';
			$txt .= '<div class="modal-content bg-secondary">';
				$txt .= '<div class="modal-header">';
					$txt .= '<h3 class="modal-title">Páginas</h3>';
					$txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
				$txt .= '</div>';
				$txt .= '<form name="frmpxp" action="home.php?pg='.$pg.'" method="POST">';
					$txt .= '<div class="modal-body">';
						$txt .= '<h5>Perfil: '.$pefnom.'</h5>';
						if($dtpg){
							foreach ($dtpg as $dpg) {
								$dtpxp = $mpef->selpxp($pefid,$dpg['pagid']);
								$txt .= '<div class="dpag';
								if($dpg['pagarc']=="#Espacio") $txt .= " dti";
								$txt .= '">';
									$txt .= '<input type="checkbox" name="pagi[]" value="'.$dpg['pagid'].'" ';
									if($dtpxp) $txt .= ' checked ';
									$txt .= '>';
									$txt .= "&nbsp;&nbsp;&nbsp;".$dpg['pagnom'];
								$txt .= '</div>';
							}
						}
						$txt .= '<input type="hidden" name="opera" value="Inspxp">';
						$txt .= '<input type="hidden" name="pefid" value="'.$pefid.'">';
					$txt .= '</div>';

					$txt .= '<div class="modal-footer">';
						$txt .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
	        			$txt .= '<input type="submit" class="btn btn-primary" value="Guardar">';
					$txt .= '</div>';
				$txt .= '</form>';
			$txt .= '</div>';
		$txt .= '</div>';
	$txt .= '</div>';
	return $txt;
}
?>