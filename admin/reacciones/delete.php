<?php
  header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Es para recibir el tipo de dato

  require "../../config/conexion.php"; // Trae la conexión de la base de datos

  // Consulta SQL que se debe aplicar para eliminar un registro
  $delete = mysqli_query($conexion,"DELETE FROM `reacciones` WHERE `reacciones`.`idReaccion`= '".$_GET['idReaccion']."'"); // Se obtiene de la peticion GET en la URL

  class Result {} // Creacion de la clase
  $response = new Result(); // Instancia para la respuesta de la API

  if ($delete){ // Si funcionó la consulta entra en el if
    $response->resultado = true; // Mensaje de éxito porque ya se elimino
    $response->mensaje = 'Reaccion eliminada'; // Respuesta que se le dará al frontend
  }else{
    $response->resultado = false; // Mensaje de error porque hubo algún error
    $response->mensaje = 'No se pudo eliminar'; // Respuesta que se le dará al frontend
  }
  header('Content-Type: application/json');
  echo json_encode($response);
?>
