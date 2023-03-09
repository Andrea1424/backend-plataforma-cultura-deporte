<?php
  header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Es para recibir el tipo de dato

  require "../../config/conexion.php"; // Trae la conexión de la base de datos

  // Consulta SQL que se debe aplicar para eliminar un registro
  $delete = mysqli_query($conexion,"DELETE FROM `empleados` WHERE `empleados`.`Id_usuario`= '".$_GET['Id_usuario']."'");

  $response = new Result(); // Instancia para la respuesta de la API
  class Result {} // Creacion de la clase

  if ($delete){ // Si funcionó la consulta
    $response->resultado = 'OK'; 
    $response->mensaje = 'Empleado eliminado';
  }else{
    $response->resultado = 'FAIL';
    $response->mensaje = 'No se pudo eliminar';
  }
  header('Content-Type: application/json');
  echo json_encode($response);
?>
