<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('status' => false));
    exit;
}
$path = './subidas/';

if (isset($_FILES['file'])) {
    $originalName = $_FILES['file']['name'];
    $ext = '.'.pathinfo($originalName, PATHINFO_EXTENSION);
    if(pathinfo($originalName, PATHINFO_EXTENSION) == "php" || pathinfo($originalName, PATHINFO_EXTENSION) == "PHP"  ){
        echo json_encode(array(
            'status' => false,
            'msg'    => 'No puede subir php.'
        ));
        exit;
    }
    $generatedName = md5($_FILES['file']['tmp_name']).$ext;
    $filePath = $path.$generatedName;

    if (!is_writable($path)) {
        echo json_encode(array(
            'status' => false,
            'msg'    => 'Destination directory not writable.'
        ));
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            echo json_encode(array(
                'status' => true,
                'generatedName' => $generatedName
            ));
            
    }else{
            echo json_encode(array(
                'status' => false,
                'generatedName' => $generatedName
            ));
        }
        
}else{
    echo json_encode(
        array('status' => false, 'msg' => 'No file uploaded.')
    );
    exit;

}