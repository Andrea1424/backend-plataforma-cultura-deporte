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

if (!isset($params->idInstructor) || !isset($params->actividad) || !isset($params->cupo) || !isset($params->lugar) || !isset($params->descripcion) || !isset($params->material) || !isset($params->publicar)) {
  $response->resultado = false;
  $response->mensaje   = "Datos incompletos";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $idInstructor = mysqli_real_escape_string($conexion,$params->idInstructor);
  $actividad = mysqli_real_escape_string($conexion,$params->actividad);
  $cupo = mysqli_real_escape_string($conexion,$params->cupo);
  $lugar = mysqli_real_escape_string($conexion,$params->lugar);
  $descripcion = mysqli_real_escape_string($conexion,$params->descripcion);
  $material = mysqli_real_escape_string($conexion,$params->material);
  $publicar = mysqli_real_escape_string($conexion,$params->publicar);
  $idTipoActividad = mysqli_real_escape_string($conexion,$params->idTipoActividad);
}

$res = mysqli_query($conexion, "SELECT * FROM `actividades` WHERE `actividad`='" . $actividad . "'"); // Consulta para saber si ya existe ese valor

// Sino se necesita verificar que ya existe ese registro omitir el if y solo hacer la consulta

if ($res->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
  $response->resultado = false; // Mensaje de error porque ya existe un registro
  $response->mensaje   = 'Instructor existente'; // Respuesta que se le dará al frontend
} else { // Si la consulta no dío algún registro significa que no existe y entra en el else
    
  try {      
    $resultado = null;    
    // Consulta SQL que se debe aplicar para el registro
    $resultado = mysqli_query($conexion, "INSERT INTO `actividades` (`idActividad`, `idInstructor`, `actividad`, `cupo`, `lugar`, `descripcion`, `material`, `publicar`, `idTipoActividad`)
    VALUES (NULL, '" . $idInstructor . "', '" . $actividad . "', '" . $cupo . "', '" . $lugar . "', '" . $descripcion . "', '" . $material . "', '" . $publicar . "', '" . $idTipoActividad . "');");
  }catch (Exception $e) {
    $response->resultado = false; // Mensaje de error porque hubo algún error
    $response->mensaje   = 'No se pudo registrar'; // Respuesta que se le dará al frontend
    echo json_encode($response); // Respuesta de la API
      exit();
  }
    
  if ($resultado) { // Si la consulta SQL no dió error entrará en el if
    $response->resultado = true; // Mensaje de éxito porque ya se registró
    $response->mensaje   = 'Datos guardados'; // Respuesta que se le dará al frontend
  } else { // Si la consulta SQL dió error entrará en el else
    $response->resultado = false; // Mensaje de error porque hubo algún error
    $response->mensaje   = 'Error interno'; // Respuesta que se le dará al frontend
  }
}

echo json_encode($response); // Respuesta de la API
?>