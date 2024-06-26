<?php

require '../inc/dbcon.php';

function error422($message) {

    $data = [
        'status' => 422, 
        'message' => $message, 
    ];
    header('HTTP/1.0 422 Entidad no procesable.');
    echo json_encode($data);
    exit();

}

function storeCustomer($customerInput) {

    global $conn;

    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if(empty(trim($name))) {

        return error422('Ingresa tu nombre!');

    } elseif(empty(trim($email))) {

        return error422('Ingresa tu email!');

    } elseif(empty(trim($phone))) {

        return error422('Ingresa tu phone!');

    } else {

        $query = "INSERT INTO customers(name, email, phone) VALUES('$name','$email','$phone')";
        $result = mysqli_query($conn, $query);

        if($result) {

            $data = [
                'status' => 201, 
                'message' => 'Cliente creado con exito.', 
            ];
            header('HTTP/1.0 201 Creacion!');
            return json_encode($data);

        } else {

            $data = [
                'status' => 500, 
                'message' => 'Error interno del servidor.', 
            ];
            header('HTTP/1.0 500 Error interno del servidor.');
            return json_encode($data);

        }

    }
}


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
                'data' => $res
            ];
            header('HTTP/1.0 200 Success');
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

function getCustomer($customerParams) {

    global $conn;

    if($customerParams['id'] == null) {

        return error422('Ingresa tu id cliente.');

    }  
    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $query = "SELECT * FROM customers WHERE id='$customerId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result) {

        if(mysqli_num_rows($result) == 1) {

            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200, 
                'message' => 'Cliente encontrado exitosamente!', 
                'data' => $res
            ];
            header('HTTP/1.0 200 WIN!');
            return json_encode($data);

        } else {
            $data = [
                'status' => 404, 
                'message' => 'Cliente no encontrado.', 
            ];
            header('HTTP/1.0 404 Not Found!');
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

function updateCustomer($customerInput, $customerParams) {

    global $conn;

    if(!isset($customerParams['id'])) {

        return error422('Id cliente no encontrado en la URL.');

    } elseif($customerParams['id'] == null) {

        return error422('Ingresa el Id cliente.');

    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);
    $name = mysqli_real_escape_string($conn, $customerInput['name']);
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);

    if(empty(trim($name))) {

        return error422('Ingresa tu nombre!');

    } elseif(empty(trim($email))) {

        return error422('Ingresa tu email!');

    } elseif(empty(trim($phone))) {

        return error422('Ingresa tu phone!');

    } else {

        $query = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id='$customerId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result) {

            $data = [
                'status' => 200, 
                'message' => 'Cliente ACTUALIZADO con exito.', 
            ];
            header('HTTP/1.0 200 Creacion!');
            return json_encode($data);

        } else {

            $data = [
                'status' => 500, 
                'message' => 'Error interno del servidor.', 
            ];
            header('HTTP/1.0 500 Error interno del servidor.');
            return json_encode($data);

        }

    }
}

function deleteCustomer($customerParams) {

    global $conn;

    if(!isset($customerParams['id'])) {

        return error422('Id cliente no encontrado en la URL.');

    } elseif($customerParams['id'] == null) {

        return error422('Ingresa el Id cliente.');

    }

    $customerId = mysqli_real_escape_string($conn, $customerParams['id']);

    $query = "DELETE FROM customers WHERE id=$customerId LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result) {

        $data = [
            'status' => 204, 
            'message' => 'Cliente eliminado con exito.', 
        ];
        header('HTTP/1.0 204 Eliminado.');
        return json_encode($data);

    } else {

        $data = [
            'status' => 404, 
            'message' => 'Cliente no encontrado.', 
        ];
        header('HTTP/1.0 404 Not Found.');
        return json_encode($data);

    }



}










?>