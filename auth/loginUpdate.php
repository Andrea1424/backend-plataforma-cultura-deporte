<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header(
    "Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"
);

$json = file_get_contents("php://input"); // RECIBE EL JSON DE ANGULAR

$params = json_decode($json); // DECODIFICA EL JSON Y LO GUARADA EN LA VARIABLE

require "../config/conexion.php"; // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB

// REALIZA LA QUERY A LA DB
$resultado = mysqli_query($conexion,"SELECT * FROM `usuarios` WHERE `usuario` = '".$params->usuario."'");
while ($row = mysqli_fetch_array($resultado)) {
    $idUser = $row["idUser"];
    $pass = $row["password"];
}

class Result{}
// GENERA LOS DATOS DE RESPUESTA
$response = new Result();

$Pass_Encrytp = password_hash($params->passNew, PASSWORD_DEFAULT);
$resultado = mysqli_query(
    $conexion,
    "UPDATE `usuarios` SET `contrasenia` = '".$Pass_Encrytp."' WHERE `idUser`='" .$idUser."'");
if ($resultado) {
    $response->resultado = "OK";
    $response->mensaje = "Contraseña actualizada";
} else {
    $response->resultado = "FAIL";
    $response->mensaje = "Datos incorrectos";
}

header("Content-Type: text/html");

echo json_encode($response); // MUESTRA EL JSON GENERADO
?>
