<?php

require '../inc/dbcon.php';

function getCustomerList() {

    global $conn;

    $query = "SELECT * FROM customers";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {

        if(mysqli_num_rows($query_run) > 0) {

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200, 
                'message' => 'Lista de clientes obtenida!', 
            ];
            header('HTTP/1.0 200 Ok!');
            return json_encode($data);

        } else {
        
            $data = [
                'status' => 404, 
                'message' => 'Ningun cliente encontrado.', 
            ];
            header('HTTP/1.0 404 Ningun cliente encontrado.');
            return json_encode($data);

        }

    } else {

        $data = [
            'status' => 500, 
            'message' => 'Error interno del servidor.', 
        ];
        header('HTTP/1.0 500 Error interno del servidor.');
        return json_encode($data);

    }

}


?>