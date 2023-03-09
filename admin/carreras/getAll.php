<?php
header('Content-Type: application/json, text/plain, */*'); // Tipo de archivo que recibe
header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Es para recibir el tipo de dato

require "../../config/conexion.php"; // Trae la conexión de la base de datos

// Consulta SQL que se debe aplicar para traer los registros
$registros=mysqli_query($conexion,"SELECT * FROM `carreras`");

$vec=[]; // Array donde se guardaran los registros

// Ciclo while para recuperar fila por fila de la base de datos
while ($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg; // Asignamos al array los registros
}

$cad=json_encode($vec); // Codificamos en formato JSON la varible que contienen los registros
echo $cad; // Respuesta de la API

?>