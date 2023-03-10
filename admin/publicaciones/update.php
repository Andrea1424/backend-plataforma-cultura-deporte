<?php
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

class Result{} // Creacion de la clase
$response = new Result(); // Instancia para la respuesta de la API

if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
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

if (!isset($params->titulo) || !isset($params->descripcion) || !isset($params->imagen)) {
  $response->resultado = false;
  $response->mensaje   = "Datos incompletos";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $titulo = mysqli_real_escape_string($conexion,$params->titulo);
  $descripcion  = mysqli_real_escape_string($conexion,$params->descripcion) ;
  $imagen = mysqli_real_escape_string($conexion,$params->imagen);
}

try {      
  $resultado = null;    
  // Consulta SQL que se debe aplicar para el registro
  $resultado = mysqli_query($conexion,"UPDATE `publicaciones` SET `titulo` = '".$titulo."', `descripcion` = '".$descripcion."', `imagen` = '".$imagen."' WHERE `publicaciones`.`idPublicacion` = '".$idPublicacion."';");
}catch (Exception $e) {
  $response->resultado = false; // Mensaje de error porque hubo algún error
  $response->mensaje   = 'No se pudo registrar'; // Respuesta que se le dará al frontend
  echo json_encode($response); // Respuesta de la API
    exit();
}


if($resultado){
  $response->resultado = true;
  $response->mensaje = 'Actualización correcta';
} else {
  $response->resultado = false;
  $response->mensaje = 'No se pudo actualizar';
}

echo json_encode($response);
?>
