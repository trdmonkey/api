<?php

// error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];

if($requestMethod == 'PUT') {

    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)) {

        // echo $_POST['name'];
        $updateCustomer = updateCustomer($_POST, $_GET);

    } else {
        
        $updateCustomer = updateCustomer($inputData, $_GET);
        
    }
    echo $updateCustomer;

} else {

    $data = [
        'status' => 405, 
        'message' => $requestMethod . ' Metodo no permitido.', 
    ];
    header('HTTP/1.0 405 Metodo no permitido.');
    echo json_encode($data);

}







?>