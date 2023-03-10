<?php
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: *'); // Es para controlar la dirección IP o dominio de donde se hace la petición
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); // Es para recibir el tipo de dato

  class Result{} // Creacion de la clase
  $response = new Result(); // Instancia para la respuesta de la API
  
  if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
    $response->resultado = false;
    $response->mensaje   = "Metodo incorrecto";
      
    echo json_encode($response); // Respuesta de la API
    exit();
  } else {
    require "../../config/conexion.php"; // Trae la conexión de la base de datos
  }

  if (!isset($_GET['idHorario'])) {
    $response->resultado = false;
    $response->mensaje   = "Datos incompletos";
      
    echo json_encode($response); // Respuesta de la API
    exit();
  }else{
    $idHorario = mysqli_real_escape_string($conexion,$_GET['idHorario']);
  }

  $res = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `idHorario`='".$idHorario."'"); // Consulta para saber si ya existe ese valor
   
  // Sino se necesita verificar que ya existe ese registro omitir el if y solo hacer la consulta
  
  if(!$res->num_rows > 0) { // Si la consulta dió algún registro significa que ya existe y entra en el if
    $response->resultado = false; // Mensaje de error porque ya existe un registro
    $response->mensaje = 'No existe ese horario'; // Respuesta que se le dará al frontend
    echo json_encode($response); // Respuesta de la API
      exit();
  }else{
  // Consulta SQL que se debe aplicar para eliminar un registro
  $delete = mysqli_query($conexion,"DELETE FROM `horarios` WHERE `horarios`.`idHorario`= '".$_GET['idHorario']."'"); // Se obtiene de la peticion GET en la URL

  if ($delete){ // Si funcionó la consulta entra en el if
    $response->resultado = true; // Mensaje de éxito porque ya se elimino
    $response->mensaje = 'Horario eliminado'; // Respuesta que se le dará al frontend
  }else{
    $response->resultado = false; // Mensaje de error porque hubo algún error
    $response->mensaje = 'No se pudo eliminar'; // Respuesta que se le dará al frontend
  }
}
  echo json_encode($response);
?>
