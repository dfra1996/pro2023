<?php
require_once 'modelo/conexion.php';
require_once 'modelo/mdescription.php';

$mdescription = new mdescription();
$footer = $mdescription->sdescription();
echo $footer[0]['mdescription'];

?>