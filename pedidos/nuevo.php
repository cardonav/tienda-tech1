<?php
include('config/conexion.php');
if($_POST){
$codigo='PED'.rand(1000,9999);
$conexion->query("INSERT INTO pedidos VALUES(NULL,'$codigo','$_POST[cliente]','PENDIENTE',CURDATE())");
echo 'Pedido creado';
}
?>
<form method='POST'>
<input name='cliente' placeholder='Cliente'>
<button>Crear pedido</button>
</form>