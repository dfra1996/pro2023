<?php
require_once 'modelo/mveh.php';
date_default_timezone_set('America/Bogota');
#Funcion mensajes de error
function errormsn($msn, $msn2){
    $txt = '';
    $txt = '<div class="col-xl-3 col-md-6 mb-4">';
        $txt = '<div class="card border-left-danger shadow h-100 py-2">';
        $txt .= '<div class="card-body">';
            $txt .= '<div class="row no-gutters align-items-center">';
                $txt .= '<div class="col mr-2">';
                    $txt .= '<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">';
                        $txt .= ''.$msn.'</div>';
                    $txt .= '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$msn2.'</div>';
                $txt .= '</div>';
                $txt .= '<div class="col-auto">';
                    $txt .= '<i class="fas fa-exclamation-triangle"></i>';
                $txt .= '</div>';
            $txt .= '</div>';
        $txt .= '</div>';
    $txt .= '</div>';       
    echo $txt;
}
function subir(){
    $txt = '';
    $txt .= '<a class="scroll-to-top rounded" href="#page-top">';
        $txt .= '<i class="fas fa-angle-up"></i>';
    $txt .= '</a>';
    return $txt;
}
function vayuda($nom, $msn){
    $txt = '';
    $txt .= '<a data-bs-toggle="modal" href="" data-bs-target="#myModalvr" title="Ayuda">';
        $txt .= '<i class="far fa-question-circle fa-2x crd"></i>';
    $txt .= '</a> ';
    $txt .= '<div class="modal fade bd-example-modal-lg" id="myModalvr" tabindex="-1" role="dialog">';
        $txt .= '<div class="modal-dialog modal-lg">';
            $txt .= '<div class="modal-content bg-secondary">';
                $txt .= '<div class="modal-header">';
                    $txt .= '<h5 class="m-0 font-weight-bold text-primary">Ventana de ayuda pagina: '.$nom.'</h5>';
                    $txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        $txt .= '</div>';
                    $txt .= '<div class="modal-body">';
                          $txt .= '<img src="img/a1.png" class="img-fluid">';
                    $txt .= '</div>';
                    $txt .= '<div class="modal-footer">';
                        $txt .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                $txt .= '</div>';
            $txt .= '</div>';
        $txt .= '</div>';
    $txt .= '</div>';
    return $txt;
}
function vpqr($pg){
    $mveh = new mveh();
    $opera = isset($_POST['opera']) ? $_POST['opera']:NULL;
    if(!$opera){
        $opera = isset($_GET['opera']) ? $_GET['opera']:NULL;
    }
    $idpqr = isset($_POST['idpqr']) ? $_POST['idpqr']:NULL;
    if(!$idpqr){
        $idpqr = isset($_GET['idpqr']) ? $_GET['idpqr']:NULL;
    }
    $msn = isset($_POST['msn']) ? $_POST['msn']:NULL;
    if($opera=="npqr"){
        $idusu = $_SESSION["idusu"];
        if($msn && $idusu && $pg){
            $mveh->inspqr($idpqr,$pg,$idusu,$msn);
            #echo "<script>alert('PQR insertada');</script>";
            echo '<script>window.location="home.php?pg='.$pg.'";</script>';
        }
    }
    $txt = '';
    $txt .= '<a data-bs-toggle="modal" href="" data-bs-target="#myModalpqr" title="Ayuda">';
        $txt .= '<i class="fas fa-marker fa-2x"></i>';
    $txt .= '</a> ';    
    $txt .= '<div class="modal fade bd-example-modal-lg" id="myModalpqr" tabindex="-1" role="dialog">';
        $txt .= '<div class="modal-dialog modal-lg">';
            $txt .= '<div class="modal-content bg-secondary">';
                $txt .= '<div class="modal-header">';
                    $txt .= '<h5 class="m-0 font-weight-bold text-info">Peticiones, quejas, reclamos, felicitaciones.</h5>';
                    $txt .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                        $txt .= '</div>';
                    $txt .= '<div class="modal-body">';
                        $txt .= '<form method="POST">';
                            $txt .= '<input type="hidden" name="idp" value="'.$pg.'" >';
                            #$txt .= '<label>Espacio escribir</label>';

                            $txt .= '<textarea class="form-control" name="msn" maxlength="200" required >';
                            $txt .= '</textarea>';

                            $txt .= '<input type="hidden" name="opera" value="npqr">';
                            $txt .= '<div class="col text-center">';
                                $txt .= '<input type="submit" class="btn btn-primary w-100 mt-3" value="Enviar">';
                            $txt .= '</div>';

                        $txt .= '</form>';                  
                    $txt .= '</div>';
                    $txt .= '<div class="modal-footer">';
                        $txt .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                $txt .= '</div>';
            $txt .= '</div>';
        $txt .= '</div>';
    $txt .= '</div>';
    return $txt;
}
?>