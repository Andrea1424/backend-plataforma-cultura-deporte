<?php
header('Content-Type: text/html'); // Tipo de archivo que recibe
header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
header('Access-Control-Allow-Credentials: true'); // Es para controlar quien tiene acceso
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); // Es para recibir el tipo de dato

$json = file_get_contents('php://input'); // Tipo JSON para peticiones http
$params = json_decode($json); // Se guarda en la variable $params

require "../../config/conexion.php"; // Trae la conexión de la base de datos

class Result {} // Creacion de la clase
$response = new Result(); // Instancia para la respuesta de la API

// Consulta SQL que se debe aplicar para el registro
$resultado = mysqli_query($conexion,"INSERT INTO `horarios` (`idHorario`,	`idActividad`,	`dia`,	`hora_inicio`,	`hora_fin`)
VALUES (NULL, '".$params->idActividad."', '".$params->dia."', '".$params->hora_inicio."', '".$params->hora_fin."');");

if($resultado){ // Si la consulta SQL no dió error entrará en el if
  $response->resultado = true; // Mensaje de éxito porque ya se registró
  $response->mensaje = 'Datos guardados'; // Respuesta que se le dará al frontend
} else { // Si la consulta SQL dió error entrará en el else
  $response->resultado = true; // Mensaje de error porque hubo algún error
  $response->mensaje = 'No se pudo registrar'; // Respuesta que se le dará al frontend
}

echo json_encode($response); // Respuesta de la API
?>