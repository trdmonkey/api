<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Request-With');

$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == "GET") {

    
    /* $customerList = getCustomerList(); */

} else {

    $data = [
        'status' => 405, 
        'message' => $requestMethod . 'Metodo no permitido.', 
    ];
    header('HTTP/1.0 405 Metodo no permitido.');
    echo json_encode($data);

}


?>