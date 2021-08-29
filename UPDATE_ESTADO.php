<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-type: application/json');

    $api_token = $_POST["api_token"];
    $api_idEstado = $_POST["api_idEstado"];
    $api_nome = trim($_POST["api_nome"]);
    
    if ($api_token == 'fabricadedesenvolvedor') {

        require_once('dbConnect.php');

        mysqli_set_charset($conn, $charset);
 
        $response = array();
      
        $sql =  "UPDATE estado SET nome = '$api_nome' WHERE id = $api_idEstado";
       
        $stmt = mysqli_prepare($conn, $sql);
        
        mysqli_stmt_execute($stmt);
        
        // Verifica se algo foi alterado
        if (mysqli_stmt_affected_rows($stmt) > 0) {

           $response["alterado"] = true;
            
            echo json_encode($response); //Objeto Json
            
        } else {

            $response["alterado"] = false;
            $response["SQL"] = $sql;
            
            echo json_encode($response);
        }
    } else {

        $response['auth_token'] = false;

        echo json_encode($response);
    }
}
?>