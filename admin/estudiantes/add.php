<?php
header('Content-Type: text/html');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

$json = file_get_contents('php://input'); // RECIBE EL JSON DE ANGULAR

$params = json_decode($json); // DECODIFICA EL JSON Y LO GUARADA EN LA VARIABLE

require "../../config/conexion.php"; // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB

// GENERA LOS DATOS DE RESPUESTA
$response = new Result();
class Result {}

// REALIZA LA QUERY A LA DB
$res = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE `telefono`='".$params->telefono."' or matricula = '".$params->matricula."'");
  if($res->num_rows > 0) {
    $response->resultado = false;
    $response->mensaje = 'Matricula o numero telefonico ya ha sido registrado';
  }else{

    $res = mysqli_query($conexion, "SELECT * FROM `actividades_usuarios`au inner join usuarios u on u.idUsuario = au.idUsuario WHERE `telefono`='".$params->telefono."'");
    if($res->num_rows > 0) {
        $response->resultado = false;
        $response->mensaje = 'Actividad existente';
    }else{

    $resultado = mysqli_query($conexion,"INSERT INTO `usuarios` (`idUsuario`, `idCarrera`, `nombres`, `apellidos`, `matricula`, `telefono`, `sexo`, `grupo`) VALUES
      (NULL, '".$params->idCarrera."', '".$params->nombres."', '".$params->apellidos."', '".$params->matricula."', '".$params->telefono."', '".$params->sexo."', '".$params->grupo."');");

    $idUsuario = "";

    $res2 = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE `telefono`='".$params->telefono."'");
    while($row = mysqli_fetch_array($res2)){
        $idUsuario = $row['idUsuario'];
    }

    $resultado2 = mysqli_query($conexion,"INSERT INTO `actividades_usuarios` (`idActividadUsuario`, `idActividad`, `idUsuario`, `estado`, `liberacion`) VALUES
      (NULL, '".$params->idActividad."', '".$idUsuario."','1','0');");

      if($resultado & $resultado2){
        $response->resultado = true;
        $response->mensaje = 'Registro completado';
      } else {
        $response->resultado = false;
        $response->mensaje = 'No se pudo registrar';
      }
    }
}

echo json_encode($response); // MUESTRA EL JSON GENERADO
?>
