<?php
header('Content-Type: application/json, text/plain, */*'); // Tipo de archivo que recibe
header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Es para recibir el tipo de dato

class Result{} // Creacion de la clase
$response = new Result(); // Instancia para la respuesta de la API

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    $response->resultado = false;
    $response->mensaje   = "Metodo incorrecto";
      
    echo json_encode($response); // Respuesta de la API
    exit();
} else {
    require "../../config/conexion.php"; // Trae la conexión de la base de datos
}

$matricula = mysqli_real_escape_string($conexion,$_GET['matricula']);


// Consulta SQL que se debe aplicar para traer los registros
$registros=mysqli_query($conexion,"SELECT * FROM tutorias.usuarios u inner join actividades_usuarios au on au.idUsuario = u.idUsuario inner join actividades a on a.idActividad = au.idActividad where u.matricula like '%".$matricula."%' and idInstructor = '".$_GET['idInstructor']."'");

$vec=[]; // Array donde se guardaran los registros

// Ciclo while para recuperar fila por fila de la base de datos
while ($reg=mysqli_fetch_array($registros)){
    $vec[]=$reg; // Asignamos al array los registros
}

$cad=json_encode($vec); // Codificamos en formato JSON la varible que contienen los registros
echo $cad; // Respuesta de la API

?>