<?php
include "conexion.php";


$id = $_GET['id'];

$query = mysql_query("SELECT * FROM `rutas` where id_ruta=".$id);
$to_encode = array();
while ($fila = mysql_fetch_assoc($query)) {
    $to_encode[] = $fila;
}
echo json_encode($to_encode);
?>
