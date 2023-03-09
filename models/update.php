<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

$json = file_get_contents('php://input');
$params = json_decode($json);

require "../../config/conexion.php";

$response = new Result();
class Result {}

  $resultado = mysqli_query($conexion,"UPDATE `empleados` SET `Nombre` = '".$params->Nombre."', `Apellido_paterno` = '".$params->Apellido_paterno."',
  `Apellido_materno` = '".$params->Apellido_materno."', `Sexo` = '".$params->Sexo."', `Usuario` = '".$params->Usuario."', `Cargo` = '".$params->Cargo."',
  `Id_sucursal` = '".$params->Id_sucursal."', `Telefono` = '".$params->Telefono."' WHERE `empleados`.`Id_usuario` = '".$params->Id_usuario."'");

  if($resultado){
    $response->resultado = 'OK';
    $response->mensaje = 'Actualización correcta';
  } else {
    $response->resultado = 'FAIL';
    $response->mensaje = 'No se pudo registrar';
  }

  header('Content-Type: text/html');
  echo json_encode($response);
  ?>
