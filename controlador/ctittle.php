<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mtittle.php';

$mtittle = new mtittle();
$show = $mtittle->stittle();
echo $show[0]['tittle'];

?>