<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$json = file_get_contents('php://input'); // RECIBE EL JSON DE ANGULAR

$params = json_decode($json); // DECODIFICA EL JSON Y LO GUARADA EN LA VARIABLE

require "../config/conexion.php";  // IMPORTA EL ARCHIVO CON LA CONEXION A LA DB

// REALIZA LA QUERY A LA DB
$resultado = mysqli_query($conexion, "SELECT * FROM `usuarios_login` WHERE `email`='".$params->email."'");
while($row = mysqli_fetch_array($resultado)){
    // $nombres = $row['nombres'];
    // $apellidos = $row['apellidos'];
    $pass = $row['password'];
    $tipo = $row['tipo'];
    if($tipo == 2){
        $resultado2 = mysqli_query($conexion, "SELECT * FROM `instructores` WHERE `email`='".$params->email."'");
        while($row2 = mysqli_fetch_array($resultado2)){
            $idInstructor = $row2['idInstructor'];
        }
    }
    if($tipo == 1){
        $resultado3 = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE `email`='".$params->email."'");
        while($row3 = mysqli_fetch_array($resultado3)){
            $matricula = $row3['matricula'];
        }
    }
    // $matricula = $row['matricula'];
    // $telefono = $row['telefono'];
    // $sexo = $row['sexo'];
    // $cuatrimestre = $row['cuatrimestre'];
    // $grupo = $row['grupo'];
    // $idUsuario = $row['idUsuario'];
}

    // GENERA LOS DATOS DE RESPUESTA
    class Result {}
    $response = new Result();

    if(($resultado->num_rows > 0) && (password_verify($params->password,$pass))) {
        $response->resultado = true;
        $response->mensaje = 'Bienvenido';
        $response->tipo = $tipo;
        if($tipo == 2){
            $response->idInstructor = $idInstructor;
        }
        if($tipo == 1){
            $response->matricula = $matricula;
        }
        // $response->nombres = $nombres;
        // $response->apellidos = $apellidos;
        // $response->email = $params->email;
        // $response->matricula = $matricula;
        // $response->telefono = $telefono;
        // $response->sexo = $sexo;
        // $response->cuatrimestre = $cuatrimestre;
        // $response->grupo = $grupo;
        // $response->idUsuario = $idUsuario;
    } else {
        $response->resultado = false;
        $response->mensaje = 'Correo o Contraseña incorrecta';
    }

    header('Content-Type: text/html');

    echo json_encode($response); // MUESTRA EL JSON GENERADO
?>
