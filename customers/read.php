<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Request-With');

include('function.php');

$requestMethod = $_SERVER['REQUEST_METHOD'];
if($requestMethod == "GET") {

    if(isset($_GET['id'])) {

        $customer = getCustomer($_GET);
        echo $customer;

    } else {
        
        $customerList = getCustomerList();
        echo $customerList;

    }

} else {

    $data = [
        'status' => 405, 
        'message' => $requestMethod . 'Metodo no permitido.', 
    ];
    header('HTTP/1.0 405 Metodo no permitido.');
    echo json_encode($data);

}

// https://www.youtube.com/watch?v=zVoFXxgfWlU&list=PLRheCL1cXHrtmbYl5LN733N9uSv-oU-UJ&index=3
/* 3 - 9:20 */

?>