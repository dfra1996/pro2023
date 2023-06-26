<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mcate.php';

$pg = 303;
$arc = "home.php";
$mcate = new mcate();

$idcate = isset($_POST['idcate']) ? $_POST['idcate']:NULL;
if(!$idcate)
	$idcate = isset($_GET['idcate']) ? $_GET['idcate']:NULL;
$cname = isset($_POST['cname']) ? $_POST['cname']:NULL;
$cicon = isset($_POST['cicon']) ? $_POST['cicon']:NULL;
$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;


if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

//echo "<br><br><br>".$idcate."-".$cname."-".$cicon."-".$filtro."-".$opera."<br><br>";
//Insertar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($opera == "InsAct" && !empty($cname)) {
        $mcate->inscate($idcate, $cname, $cicon);
		$_SESSION['success_message'] = 'Datos insertados y/o actualizados exitosamente';
		


        #echo "<script>alert('Datos insertados y/o actualizados exitosamente');</script>";
        echo '<script>window.location="home.php?pg=' . $pg . '";</script>';
        exit;
        $idcate = NULL; // Movido aquí para mantener el valor en caso de éxito
    } else {
        echo "<script>alert('Falta llenar algunos campos');</script>";
    }
}

//Eliminar
if ($opera == "Eliminar") {
    if (!empty($idcate)) {
        $mcate->delcate($idcate);
        $mensaje = "Datos eliminados exitosamente.";
    }
}

//Insertar datos/*
function insdatos($idcate,$pg,$arc){
	$mcate = new mcate();
	$dtcate = NULL;
	if($idcate) $dtcate = $mcate->selcate1($idcate);
	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="d-flex justify-content-center">';
				$txt .= vayuda("Nuevo Preoperacional", "Esperando mensaje...");
				$txt .= vpqr($pg);

			$txt .= '</div>';		
			$txt .= '<div class="card-header py-3">';
				$txt .= '<h6 class="m-0 font-weight-bold text-primary">Categorias</h6>';
			$txt .= '</div>';

			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($idcate and $dtcate){
					$txt .= '<label>ID Categoria</label>';
					$txt .= '<input type="text" name="idcate" readonly value="'.$idcate.'" class="form-control" />';
				}
				$txt .= '<label>Nombre</label>';
				$txt .= '<input type="text" name="cname" maxlength="70" class="form-control"';
					if($idcate and $dtcate) $txt .= ' value="'.$dtcate[0]['cname'].'"';
				$txt .= ' required />';
				$txt .= '<label>Icono</label>';
				$txt .= '<input type="text" name="cicon" maxlength="50" class="form-control"';
					if($idcate and $dtcate) $txt .= ' value="'.$dtcate[0]['cicon'].'"';
				$txt .= ' />';
				$txt .= '<input type="hidden" name="opera" value="InsAct">';
					$txt .= '<input type="submit" class="btn btn-primary w-100 mt-3" value="';
					if($idcate and $dtcate)
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
	$mcate = new mcate();
	$dtcate = $mcate->selcate();
	$txt = '';

	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
		$txt .= '<div class="card-header py-3">';
		$txt .= '<h6 class="m-0 font-weight-bold text-info">Listado de Categorias</h6>';
		$txt .= '</div>';
		
		if($dtcate){
			$txt .= '<div class="table-responsive">';
				$txt .= '<table id="example" class="table table-hover" style="width:100%">';
					$txt .= '<thead>';
						$txt .= '<tr>';
							$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
							$txt .= '<th>ID</th>';
							$txt .= '<th>Nombre</th>';
							$txt .= '<th>Icono</th>';
						$txt .= '</tr>';
					$txt .= '</thead>';
					$txt .= '<tbody>';
					foreach ($dtcate as $dt) {
						$txt .= '<tr>';
							$txt .= '<td>';
								$txt .= '<a href="'.$arc.'?pg='.$pg.'&idcate='.$dt['idcate'].'" title="Editar">';
									$txt .= '<i class="fas fa-edit fa-2x"></i>';
								$txt .= '</a>';
								$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&idcate='.$dt['idcate'].'" onclick="return eliminar();">';
									$txt .= '<i class="fas fa-trash-alt fa-2x"></i>';
								$txt .= '</a>';
							$txt .= '</td>';
							$txt .= '<td>'.$dt['idcate'].'</td>';
							$txt .= '<td>'.$dt['cname'].'</td>';
							$txt .= '<td>'.$dt['cicon'].'</td>';
					}	
						$txt .= '</tr>';
					$txt .= '</tbody>';
					$txt .= '<tfoot>';
						$txt .= '<tr>';
							$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
							$txt .= '<th>ID</th>';
							$txt .= '<th>Nombre</th>';
							$txt .= '<th>Icono</th>';
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