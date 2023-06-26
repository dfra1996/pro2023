<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mhead.php';

$mhead = new mhead();
$footer = $mhead->shead();
echo $footer[0]['header'];

?>