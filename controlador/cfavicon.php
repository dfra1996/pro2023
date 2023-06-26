<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mfavicon.php';

$mfavicon = new mfavicon();
$footer = $mfavicon->sfavicon();
echo $footer[0]['favicon'];

?>