<?php
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

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

$response->mensaje   = "Datos incompletos";
$response->resultado = false;

if (!isset($params->idInstructor) || !isset($_GET['idActividad']) || !isset($params->actividad) || !isset($params->cupo) || !isset($params->lugar) || !isset($params->descripcion) || !isset($params->material) || !isset($params->publicar)) {
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $idActividad = mysqli_real_escape_string($conexion,$_GET['idActividad']);
  $actividad = mysqli_real_escape_string($conexion,$params->actividad);
  $idInstructor = mysqli_real_escape_string($conexion,$params->idInstructor);
  $cupo = mysqli_real_escape_string($conexion,$params->cupo);
  $lugar = mysqli_real_escape_string($conexion,$params->lugar);
  $descripcion = mysqli_real_escape_string($conexion,$params->descripcion);
  $material = mysqli_real_escape_string($conexion,$params->material);
  $publicar = mysqli_real_escape_string($conexion,$params->publicar);
}

$res = mysqli_query($conexion, "SELECT * FROM `actividades` WHERE `actividad`='".$idActividad."'"); // Consulta para saber si ya existe ese valor
   
// Sino se necesita verificar que ya existe ese registro omitir el if y solo hacer la consulta

if($res->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
  $response->resultado = false; // Mensaje de error porque ya existe un registro
  $response->mensaje = 'Actividad existente'; // Respuesta que se le dará al frontend
}else{ // Si la consulta no dío algún registro significa que no existe y entra en el else

  try {      
    $resultado = null;    
    // Consulta SQL que se debe aplicar para el registro
    $resultado = mysqli_query($conexion,"UPDATE `actividades` SET `actividad` = '".$actividad."', `cupo` = '".$cupo."', `lugar` = '".$lugar."', `descripcion` = '".$descripcion."', `material` = '".$material."', `publicar` = '".$publicar."' WHERE `actividades`.`idActividad` = '".$idActividad."';");
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
    $response->mensaje = 'Error interno';
  }
}

  echo json_encode($response);
  ?>
