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

if (!isset($params->carrera) || !isset($_GET['idCarrera'])) {
  $response->resultado = false;
  $response->mensaje   = "Datos incompletos";
    
  echo json_encode($response); // Respuesta de la API
  exit();
}else{
  $carrera = mysqli_real_escape_string($conexion,$params->carrera);
  $idCarrera = mysqli_real_escape_string($conexion,$_GET['idCarrera']);
}

$res = mysqli_query($conexion, "SELECT * FROM `carreras` WHERE `carrera`='".$carrera."'"); // Consulta para saber si ya existe ese valor
   
// Sino se necesita verificar que ya existe ese registro omitir el if y solo hacer la consulta

if($res->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
  $response->resultado = false; // Mensaje de error porque ya existe un registro
  $response->mensaje = 'Carrera existente'; // Respuesta que se le dará al frontend
}else{ // Si la consulta no dío algún registro significa que no existe y entra en el else

  try {      
    $resultado = null;    
    // Consulta SQL que se debe aplicar para el registro
    $resultado = mysqli_query($conexion,"UPDATE `carreras` SET `carrera` = '".$carrera."' WHERE `idCarrera` = '".$idCarrera."'");
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
    $response->mensaje = 'Error interno'; // Respuesta que se le dará al frontend
  }
}

  echo json_encode($response);
  ?>
