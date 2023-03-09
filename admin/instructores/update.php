<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

$json = file_get_contents('php://input');
$params = json_decode($json);

require "../../config/conexion.php";

$response = new Result();
class Result {}

$res = mysqli_query($conexion, "SELECT * FROM `instructores` WHERE `email`='".$params->email."' OR `telefono` = '".$params->telefono."'"); // Consulta para saber si ya existe ese valor
   
// Sino se necesita verificar que ya existe ese registro omitir el if y solo hacer la consulta

if($res->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
  $response->resultado = false; // Mensaje de error porque ya existe un registro
  $response->mensaje = 'Instructor existente'; // Respuesta que se le dará al frontend
}else{ // Si la consulta no dío algún registro significa que no existe y entra en el else

  $resultado = mysqli_query($conexion,"UPDATE `instructores` SET `nombre` = '".$params->nombre."', `apellidos` = '".$params->apellidos."', `email` = '".$params->email."', `telefono` = '".$params->telefono."', `tituloAcademico` = '".$params->tituloAcademico."' WHERE `instructores`.`idInstructor` = '".$_GET['idInstructor']."';");

  if($resultado){
    $response->resultado = true;
    $response->mensaje = 'Actualización correcta';
  } else {
    $response->resultado = false;
    $response->mensaje = 'No se pudo actualizar';
  }
}

  header('Content-Type: text/html');
  echo json_encode($response);
  ?>
