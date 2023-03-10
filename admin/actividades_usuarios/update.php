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

if (!isset($params->estado) || !isset($params->liberacion)) {
  $response->resultado = false;
  $response->mensaje   = "Datos incompletos";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $estado = mysqli_real_escape_string($conexion,$params->estado);
  $liberacion = mysqli_real_escape_string($conexion,$params->liberacion);
}

$resultado = mysqli_query($conexion,"UPDATE `actividades_usuarios` SET `estado` = '".$params->estado."', `liberacion` = '".$params->liberacion."'  WHERE `actividades_usuarios`.`idActividadUsuario` = '".$idActividadUsuario."';");

if($resultado){
  $response->resultado = true;
  $response->mensaje = 'Actualización correcta';
} else {
  $response->resultado = false;
  $response->mensaje = 'No se pudo actualizar';
}

echo json_encode($response);
?>
