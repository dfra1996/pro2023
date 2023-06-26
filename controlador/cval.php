<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mval.php';
require_once 'modelo/mpagina.php';

$pg = 307;
$arc = "home.php";
$mval = new mval();

$codval = isset($_POST['codval']) ? $_POST['codval']:NULL;
if(!$codval)
  $codval = isset($_GET['codval']) ? $_GET['codval']:NULL;
$iddom = isset($_POST['iddom']) ? $_POST['iddom']:NULL; 
$nomval = isset($_POST['nomval']) ? $_POST['nomval']:NULL;
$parval = isset($_POST['parval']) ? $_POST['parval']:NULL; 

$filtro = isset($_POST['filtro']) ? $_POST['filtro']:NULL; 
if(!$filtro)
  $filtro = isset($_GET['filtro']) ? $_GET['filtro']:NULL;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL; 
if(!$opera)
  $opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

//echo "<br><br>".$codval."-".$iddom."-".$nomval."-".$sigval."-".$parval."-".$filtro."<br><br>";
//Insertar o Actualizar
if ($opera=="InsAct"){
    if($iddom && $nomval){
      $mval->valiu($codval, $iddom, $nomval, $parval);
      echo "<script>alert('Datos insertados y/o Actualizados exitosamente');</script>";
      echo '<script>window.location="home.php?pg='.$pg.'";</script>';
    }else{
       echo "<script>alert('Falta llenar algunos campos');</script>";
    }
}
//Eliminar
if ($opera=="delete"){
	 if($codval){
    $mval->valdel($codval);
    echo "<script>alert('Datos Eliminados exitosamente');</script>";	
    }
}
function insdatos($codval,$pg,$arc){
    $mval = new mval();
    $datdom = $mval->seldom();
    if ($codval) $dtvl = $mval->selval1($codval);
    $txt = '';
    $txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="d-flex justify-content-center">';
			$txt .= vayuda("Como usar?", "Esperando mensaje...");
			$txt .= vpqr($pg);
			$txt .= '</div>';

			$txt .= '<div class="card-header py-3">';
			$txt .= '<h6 class="m-0 font-weight-bold text-info">Gestion de Valores</h6>';
			$txt .= '</div>';

			$txt .= '<form name= "frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				$txt .= '<label>Código</label>';
				$txt .= '<input type="number" name="codval" class="form-control"';
					if ($codval && $dtvl) $txt .= ' value="'.$dtvl[0]['codval'].'" readonly ';
				$txt .= '>';
				$txt .= '<label>Nombre</label>';
				$txt .= '<input type="text" name ="nomval" class="form-control"';
					if ($codval && $dtvl) $txt .= ' value="'.$dtvl[0]['nomval'].'" ';
				$txt .= '>';
				$txt .= '<label>Parámetro</label>';
				$txt .= '<input type="text" name ="parval" class="form-control"';
					if ($codval && $dtvl) $txt .= ' value="'.$dtvl[0]['parval'].'" ';
				$txt .= '>';          
				$txt .= '<label>Dominio</label>';
				if ($datdom){
					$txt .= '<select name ="iddom" class="form-control">';
					$txt .= '<option value="0">Seleccione</option>';
					foreach ($datdom as $ddv) {
						$txt .= '<option value="'.$ddv['iddom'].'"';
							if ($codval && $dtvl && $ddv['iddom']==$dtvl[0]['iddom']) $txt .= ' selected ';
						$txt .= '>'; 
							$txt .= $ddv['nomdom']; 
						$txt .= '</option>';
					}
					$txt .= '</select>';
				}
					$txt .= '<input type="hidden" name="opera" value="InsAct">';
					$txt .= '<input type="submit" class="btn btn-primary w-100 mt-3"';
					if ($codval && $dtvl)
						$txt .= ' value="Actualizar"';
					else
						$txt .= ' value="Nuevo"';
					$txt .= '>';
			$txt .= '</form>';
		$txt .= '</div>';
    $txt .= '</div>';
    echo $txt; 
}
function mosdatos($codval,$pg,$arc){
    $mval = new mval();
    $dtval = $mval->selval();
    $txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="card-header py-3">';
			$txt .= '<h6 class="m-0 font-weight-bold text-info">Listado de Dominios</h6>';
			$txt .= '</div>';
			if ($dtval){
				$txt .= '<div class="table-responsive">';
					$txt .= '<table id="example" class="table table-hover" style="width:100%">';
						$txt .= '<thead>';
							$txt .= '<tr>';
								$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Codigo de valor</th>';
								$txt .= '<th>Nombre del Dominio</th>';
							$txt .= '</tr>';
						$txt .= '</thead>';

						$txt .= '<tbody>';
						foreach($dtval AS $dt){
							$txt .= '<tr>';							
								$txt .= '<td>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&codval='.$dt['codval'].'" title="Editar">';
										$txt .= '<i class="fas fa-edit fa-2x"></i>';
									$txt .= '</a>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=delete&codval='.$dt['codval'].'" onclick="return eliminar();">';
										$txt .= '<i class="fas fa-trash-alt fa-2x"></i>';
									$txt .= '</a>';
								$txt .= '</td>';
								$txt .= '<td>'.$dt['codval'].'</td>';
								$txt .= '<td>'.$dt['nomval'].'</td>';
								$txt .= '<td>'.$dt['nomdom'].'</td>';
							}
							$txt .= '</tr>';
							$txt .= '</tbody>';							
							$txt .= '<tfoot>';
							$txt .= '<tr>';
								$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Codigo de valor</th>';
								$txt .= '<th>Nombre del Dominio</th>';
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