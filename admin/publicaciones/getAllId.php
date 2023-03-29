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
// Consulta SQL que se debe aplicar para traer los registros
$registros=mysqli_query($conexion,"SELECT * FROM `publicaciones` p inner join instructores ins on ins.idInstructor = p.idInstructor WHERE p.idInstructor = '".$_GET['idInstructor']."'");

$vec=[]; // Array donde se guardaran los registros

// Ciclo while para recuperar fila por fila de la base de datos
while ($reg=mysqli_fetch_array($registros)){
    $registros2=mysqli_query($conexion,"SELECT count(*) as reaccion FROM reacciones where idPublicacion = '".$reg['idPublicacion']."'");
    while ($reg2=mysqli_fetch_array($registros2)){
        $reg['reacciones'] = $reg2['reaccion'];
    }

    $registros2=mysqli_query($conexion,"SELECT count(*) as comentario FROM comentarios where idPublicacion = '".$reg['idPublicacion']."'");
    while ($reg2=mysqli_fetch_array($registros2)){
        $reg['comentarios'] = $reg2['comentario'];
    }

    $vec[]=$reg; // Asignamos al array los registros
}

$cad=json_encode($vec); // Codificamos en formato JSON la varible que contienen los registros
echo $cad; // Respuesta de la API

?>