<?php 
require_once 'modelo/conexion.php';
require_once 'modelo/mprin.php';
$pg = 199;
$arc = "index.php";
$mprin = new mprin();

function mosdatos(){
	$mprin = new mprin();
	$dtcate = $mprin->selconfig();
    $txt = "";
    foreach ($dtcate as $dt){
    $txt .= "<ul>";
        $txt .= "<li>".$dt['cname']."</li>";
    $txt .= "</ul>";

    }
    $txt .= "<a href='?pg=201' class='button'>Iniciar Sesion</a>";
    echo $txt;

}
?>
