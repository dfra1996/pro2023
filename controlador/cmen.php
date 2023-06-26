<?php
require_once('modelo/conexion.php');
require_once('modelo/mmen.php');

function mosmen($pagmen, $pefid){
	$mmen = new mmen();
	$result = $mmen->selmen($pagmen, $pefid);
	$pm = strtolower($pagmen);
	$idusu = isset($_SESSION["idusu"]) ? $_SESSION["idusu"]:NULL;
	$nom = isset($_SESSION["nomusu"]) ? $_SESSION["nomusu"]:NULL;
	$pg = isset($_POST['pg']) ? $_POST['pg']:NULL;
	if(!$pg)
	$pg = isset($_GET['pg']) ? $_GET['pg']:NULL;
	// Llamado Datos Usuario
	// Validar que trae la variable
	#var_dump ($dt[0]['imgus']);
	// Asignar 0 a valor Null para que no salgan errores
	//if($dt[0]['imgus']==NULL) $dt[0]['imgus'] = 0;
	$txt = '';
    $txt .= '<div class="container-fluid position-relative d-flex p-0">';
		#Sidebar Start
    	$txt .= '<div class="sidebar pe-4 pb-3">';
        	$txt .= '<nav class="navbar bg-secondary navbar-dark">';
        	$txt .= '<a href="home.php" class="navbar-brand mx-4 mb-3">';
        		$txt .= '<h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Siste DvN</h3>';
       		$txt .= '</a>';

        	$txt .= '<div class="d-flex align-items-center ms-4 mb-4">';
        		$txt .= '<div class="position-relative">';
        			$txt .= '<img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">';
        			$txt .= '<div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>';
        		$txt .= '</div>';

        		$txt .= '<div class="ms-3">';
        			$txt .= '<h6 class="mb-0">Admin: </h6>';
        			$txt .= '<span>'.$nom.'</span>';
        		$txt .= '</div>';
        	$txt .= '</div>';

			$txt .= '<div class="navbar-nav w-100">';			
				$txt .= '<a href="home.php" class="nav-item nav-link';
				if($pg == NULL){
					$txt .= ' active';
				}
				$txt .= '"><i class="fa fa-tachometer-alt me-2"></i>Resumen</a>';

				if($result){     
                    foreach($result as $dt){      
				        $txt .= '<a href="'.$pm.'.php?pg='.$dt['pagid'].'" class="nav-item nav-link';
						if ($dt['pagid'] == $pg) {
							$txt .= ' active';
						}				
						$txt .= '"><i class="'.$dt['icono'].'"></i>' .$dt['pagnom'].'</a>';
						$txt .= '<input type="hidden" name="pg" readonly value="'.$dt['pagid'].'"/>';
                    }
                }				
        	$txt .= '</nav>';
    	$txt .= '</div>';

		#Sidebar End
		#Content Start
		$txt .= '<div class="content">';
			#Navbar Start
			$txt .= '<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">';
				$txt .= '<a href="home.php" class="navbar-brand d-flex d-lg-none me-4">';
					$txt .= '<h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>';
				$txt .= '</a>';
				$txt .= '<a href="#" class="sidebar-toggler flex-shrink-0">';

				
					$txt .= '<i class="fa fa-bars"></i>';
				$txt .= '</a>';
		    $txt .= '</nav>';
			#Navbar End
			#Blank Start        
    echo $txt;
	
	function moscon($pefid,$pg){
		$mmen = new mmen();
		$datpgpf = $mmen->selpgpf($pefid);

		if($pefid)
			if(!$pg) $pg = $datpgpf[0]['pagprin'];
		else
			if(!$pg) $pg = 5555;

		$result = $mmen->selpgact($pg, $pefid);
		if($result){
			foreach ($result as $f) {
				require_once($f['pagarc']);
			}
		}else{
			$txt = "<div class='textinf'>";
				$txt .= "Usted no tiene permisos para ver esta página. Comuniquese con su administrador.";
			$txt .= "</div>";
			echo $txt;
		}
	}
}
?>