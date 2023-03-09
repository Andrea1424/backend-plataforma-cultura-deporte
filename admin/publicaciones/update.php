<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

$json = file_get_contents('php://input');
$params = json_decode($json);

require "../../config/conexion.php";

$response = new Result();
class Result {}

$resultado = mysqli_query($conexion,"UPDATE `publicaciones` SET `titulo` = '".$params->titulo."', `descripcion` = '".$params->descripcion."', `imagen` = '".$params->imagen."' WHERE `publicaciones`.`idPublicacion` = '".$_GET['idPublicacion']."';");

if($resultado){
  $response->resultado = true;
  $response->mensaje = 'Actualización correcta';
} else {
  $response->resultado = false;
  $response->mensaje = 'No se pudo actualizar';
}

header('Content-Type: text/html');
echo json_encode($response);
?>
