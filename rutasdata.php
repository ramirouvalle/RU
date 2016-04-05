<?php
include "conexion.php";
$destino_x = $_GET['destino_x'];
$destino_y = $_GET['destino_y'];

$query = mysql_query("SELECT * FROM `rutas` WHERE destino_x = $destino_x AND destino_y = $destino_y");
$to_encode = array();
while ($fila = mysql_fetch_assoc($query)) {
    $to_encode[] = $fila;
}
echo json_encode($to_encode);
?>
