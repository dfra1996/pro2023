<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mfooter.php';

$mfooter = new mfooter();
$footer = $mfooter->sfooter();
$txt = '<div class="container">';
    $txt .= 'Desarrollado por Duvan Robayo SisteDvN 3118256111';
$txt .= '</div>';    
$txt .= '<div class="container">';
    $txt .= $footer[0]['footer'];
$txt .= '</div>';
echo $txt;    

?>