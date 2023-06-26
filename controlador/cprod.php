<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mprod.php';

$pg = 304;
$arc = "home.php";
$mprod = new mprod();

$idprod = isset($_POST['idprod']) ? $_POST['idprod']:NULL;
if(!$idprod)
	$idprod = isset($_GET['idprod']) ? $_GET['idprod']:NULL;
$pname = isset($_POST['pname']) ? $_POST['pname']:NULL;
$price = isset($_POST['price']) ? $_POST['price']:NULL;
$trademark = isset($_POST['trademark']) ? $_POST['trademark']:NULL;
$model = isset($_POST['model']) ? $_POST['model']:NULL;
$category = isset($_POST['category']) ? $_POST['category']:NULL;
$discount = isset($_POST['discount']) ? $_POST['discount']:NULL;
$cdescription = isset($_POST['cdescription']) ? $_POST['cdescription']:NULL;
$cstatus = isset($_POST['cstatus']) ? $_POST['cstatus']:1;

$opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
if(!$opera)
	$opera = isset($_GET['opera']) ? $_GET['opera']:NULL;

//echo "<br><br><br>".$idprod."-".$pname."-".$price."-".$filtro."-".$opera."<br><br>";
//Insertar
if($opera=="InsAct"){
	if($pname && $price){
		$mprod->insprod($idprod, $pname, $price, $trademark, $model, $category, $discount, $cdescription, $cstatus);
		$request = $mprod->selimgprod($pname, $price, $trademark, $model, $category, $discount, $cdescription, $cstatus);
		echo '<script>window.location="home.php?pg=305&idprod='.$request[0]['idprod'].'";</script>';

		#echo "<script>alert('Datos insertados y/o actualizados existosamente');</script>";
		echo '<script>window.location="home.php?pg='.$pg.'";</script>';
	}else{
		echo "<script>alert('Falta llenar algunos campos');</script>";
	}
	$idprod = NULL;
}
//Eliminar
if($opera=="Eliminar"){
	if($idprod){
		$mprod->delprod($idprod);
		echo "<script>alert('Datos eliminados existosamente');</script>";
	}
	$idprod = NULL;
}
//Insertar datos
function insdatos($idprod,$pg,$arc){
	$mprod = new mprod();
	$dtprod = NULL;
    $dtprod = $mprod->selprod($idprod);
    $dtcate = $mprod->selcate();
    $dttrademark = $mprod->seltrademark();

	if($idprod) $dtprod = $mprod->selprod1($idprod);
	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="d-flex justify-content-center">';
				$txt .= vayuda("Como usar?", "Esperando mensaje...");
				$txt .= vpqr($pg);
			$txt .= '</div>';

			$txt .= '<div class="card-header py-3">';
				$txt .= '<h6 class="m-0 font-weight-bold text-info">Gestion Productos</h6>';
			$txt .= '</div>';	 

			$txt .= '<form name="frm1" action="'.$arc.'?pg='.$pg.'" method="POST">';
				if($idprod and $dtprod){
					$txt .= '<label>ID Categoria</label>';
					$txt .= '<input type="text" name="idprod" readonly value="'.$idprod.'" class="form-control" />';
				}
				$txt .= '<label>Nombre</label>';
				$txt .= '<input type="text" name="pname" maxlength="70" class="form-control"';
					if($idprod and $dtprod) $txt .= ' value="'.$dtprod[0]['pname'].'"';
				$txt .= ' required />';
				$txt .= '<label>Precio</label>';
				$txt .= '<input type="text" name="price" maxlength="50" class="form-control"';
					if($idprod and $dtprod) $txt .= ' value="'.$dtprod[0]['price'].'"';
				$txt .= ' />';
				$txt .= '<label>Marca</label>';
				if ($dttrademark){
				$txt .= '<select name ="trademark" class="form-control">';
				$txt .= '<option value="0">Seleccione</option>';
					foreach ($dttrademark as $dt) {
						$txt .= '<option value="'.$dt['codval'].'"';
						if ($idprod && $dttrademark && $dt['codval']==$dttrademark[0]['codval']) $txt .= ' selected ';
						$txt .= '>'; 
							$txt .= $dt['nomval']; 
						$txt .= '</option>';
					}
				$txt .= '</select>';
				}
				$txt .= '<label>Modelo</label>';
				$txt .= '<input type="text" name="model" maxlength="50" class="form-control"';
					if($idprod and $dtprod) $txt .= ' value="'.$dtprod[0]['model'].'"';
				$txt .= ' />';

				$txt .= '<label>Categoria</label>';
				if ($dtcate){
				$txt .= '<select name ="category" class="form-control">';
				$txt .= '<option value="0">Seleccione</option>';
					foreach ($dtcate as $dt) {
						$txt .= '<option value="'.$dt['idcate'].'"';
						if ($idprod && $dtcate && $dt['idcate']==$dtcate[0]['idcate']) $txt .= ' selected ';
						$txt .= '>'; 
							$txt .= $dt['cname']; 
						$txt .= '</option>';
					}
				$txt .= '</select>';
				}
				$txt .= '<label>Descuento</label>';
				$txt .= '<input type="text" name="discount" maxlength="50" class="form-control"';
					if($idprod and $dtprod) $txt .= ' value="'.$dtprod[0]['discount'].'"';
				$txt .= ' />';
				$txt .= '<label>Descripcion</label>';
				$txt .= '<input type="text" name="cdescription" maxlength="50" class="form-control"';
					if($idprod and $dtprod) $txt .= ' value="'.$dtprod[0]['cdescription'].'"';
				$txt .= ' />';
				
				$txt .= '<input type="hidden" name="opera" value="InsAct">';
					$txt .= '<input type="submit" class="btn btn-primary w-100 mt-3" value="';
					if($idprod and $dtprod)
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
	$mprod = new mprod();
	$dtprod = $mprod->selprod();
	$txt = '';
	$txt .= '<div class= "container-fluid pt-4 px-4">';
		$txt .= '<div class="bg-secondary rounded-top p-4">';
			$txt .= '<div class="card-header py-3">';
				$txt .= '<h6 class="m-0 font-weight-bold text-info">Listado de productos</h6>';
			$txt .= '</div>';
			if ($dtprod){
				$txt .= '<div class="table-responsive">';
					$txt .= '<table id="example" class="table table-hover" style="width:100%">';
						$txt .= '<thead>';
							$txt .= '<tr>';
								$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Nombre</th>';
								$txt .= '<th>Precio</th>';
								$txt .= '<th>Marca</th>';
								$txt .= '<th>Modelo</th>';
								$txt .= '<th>Categoria</th>';
								$txt .= '<th>Descuento</th>';
								$txt .= '<th>Descripcion</th>';
								$txt .= '<th>Estado</th>';
							$txt .= '</tr>';
						$txt .= '</thead>';
						$txt .= '<tbody>';
						foreach($dtprod AS $dt){
							$txt .= '<tr>';								
								$txt .= '<td>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&idprod='.$dt['idprod'].'" title="Editar">';
										$txt .= '<i class="fas fa-edit fa-2x"></i>';
									$txt .= '</a>';
									$txt .= '<a href="'.$arc.'?pg='.$pg.'&opera=Eliminar&idprod='.$dt['idprod'].'" onclick="return eliminar();">';
										$txt .= '<i class="fas fa-trash-alt fa-2x"></i>';
									$txt .= '</a>';
								$txt .= '</td>';
								$txt .= '<td>'.$dt['idprod'].'</td>';
								$txt .= '<td>'.$dt['pname'].'</td>';
								$txt .= '<td>'.$dt['price'].'</td>';
								$txt .= '<td>'.$dt['nomval'].'</td>';
								$txt .= '<td>'.$dt['model'].'</td>';
								$txt .= '<td>'.$dt['cname'].'</td>';
								$txt .= '<td>'.$dt['discount'].'</td>';
								$txt .= '<td>'.$dt['cdescription'].'</td>';
								if($dt['cstatus']==1)
									$txt .= '<td>Activo</td>';
								else
									$txt .= '<td>Pausado</td>';
						}
							$txt .= '</tr>';
						$txt .= '</tbody>';				
						$txt .= '<tfoot>';
						$txt .= '<th><i class="fas fa-cog fa-2x"></i></th>';
							$txt .= '<tr>';
								$txt .= '<th>ID</th>';
								$txt .= '<th>Nombre</th>';
								$txt .= '<th>Precio</th>';
								$txt .= '<th>Marca</th>';
								$txt .= '<th>Modelo</th>';
								$txt .= '<th>Categoria</th>';
								$txt .= '<th>Descuento</th>';
								$txt .= '<th>Descripcion</th>';
								$txt .= '<th>Estado</th>';
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
