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

if (!isset($_GET['idComentario'])) {
    $response->resultado = false;
    $response->mensaje   = "Datos incompletos";
      
    echo json_encode($response); // Respuesta de la API
    exit();
  }else{
    $idComentario = mysqli_real_escape_string($conexion,$_GET['idComentario']);
  }
  
// Consulta SQL que se debe aplicar para traer los registros
$registros=mysqli_query($conexion,"SELECT * FROM `comentarios` WHERE `idComentario` = '".$idComentario."'");

if(!$registros->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
    $response->resultado = false; // Mensaje de error porque ya existe un registro
    $response->mensaje = 'Ese comentario no existe'; // Respuesta que se le dará al frontend

    echo json_encode($response); // Respuesta de la API
    exit();
}else{

$vec; // Variable donde se guardara el registro obtenido

// Ciclo while para recuperar fila por fila de la base de datos
while ($reg=mysqli_fetch_array($registros)){
    $vec=$reg; // Asignamos a la variable el registro
}

$cad=json_encode($vec); // Codificamos en formato JSON la varible que contienen los registros
}
echo $cad; // Respuesta de la API

?>