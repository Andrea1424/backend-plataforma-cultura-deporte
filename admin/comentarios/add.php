<?php
header('Content-Type: text/html'); // Tipo de archivo que recibe
header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
header('Access-Control-Allow-Credentials: true'); // Es para controlar quien tiene acceso
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method"); // Es para recibir el tipo de dato

class Result{} // Creacion de la clase
$response = new Result(); // Instancia para la respuesta de la API

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  $response->resultado = false;
  $response->mensaje   = "Metodo incorrecto";
    
  echo json_encode($response); // Respuesta de la API
  exit();
} else {
  $json   = file_get_contents('php://input'); // Tipo JSON para peticiones http
  $params = json_decode($json); // Se guarda en la variable $params
  require "../../config/conexion.php"; // Trae la conexión de la base de datos
}

if ($params == null) {
  $response->resultado = false;
  $response->mensaje   = "No hay datos para procesar";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}

if (!isset($params->idPublicacion) || !isset($params->idUsuario) || !isset($params->comentario)) {
  $response->resultado = false;
  $response->mensaje   = "Datos incompletos";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $idPublicacion = mysqli_real_escape_string($conexion,$params->idPublicacion);
  $idUsuario = mysqli_real_escape_string($conexion,$params->idUsuario);
  $comentario = mysqli_real_escape_string($conexion,$params->comentario);
}

try {      
  $resultado = null;    
  // Consulta SQL que se debe aplicar para el registro
  $resultado = mysqli_query($conexion,"INSERT INTO `comentarios` (`idComentario`,	`idPublicacion`,	`idUsuario`,	`comentario`)
  VALUES (NULL, '".$idPublicacion."', '".$idUsuario."', '".$comentario."');");
}catch (Exception $e) {
  $response->resultado = false; // Mensaje de error porque hubo algún error
  $response->mensaje   = 'No se pudo registrar'; // Respuesta que se le dará al frontend
  echo json_encode($response); // Respuesta de la API
    exit();
}

if($resultado){ // Si la consulta SQL no dió error entrará en el if
  $response->resultado = true; // Mensaje de éxito porque ya se registró
  $response->mensaje = 'Datos guardados'; // Respuesta que se le dará al frontend
} else { // Si la consulta SQL dió error entrará en el else
  $response->resultado = true; // Mensaje de error porque hubo algún error
  $response->mensaje = 'No se pudo registrar'; // Respuesta que se le dará al frontend
}

echo json_encode($response); // Respuesta de la API
?>