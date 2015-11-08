<?php
include "conexion.php";
$query = mysql_query("SELECT * FROM `rutas`");
$to_encode = array();
while ($fila = mysql_fetch_assoc($query)) {
    $to_encode[] = $fila;
}
echo json_encode($to_encode);
?>
