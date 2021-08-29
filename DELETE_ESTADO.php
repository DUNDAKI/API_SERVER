<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-type: application/json');

    $api_token = $_POST["api_token"];
    $api_idEstado = $_POST["api_idEstado"];
    
    if ($api_token == 'fabricadedesenvolvedor') {

        require_once('dbConnect.php');
        mysqli_set_charset($conn, $charset);
        $response = array();
      
        $sql =  "DELETE FROM estado WHERE id = $api_idEstado";
       
        $stmt = mysqli_prepare($conn, $sql);
        
        mysqli_stmt_execute($stmt);
        
        // Verifica se algo foi deletado
        if (mysqli_stmt_affected_rows($stmt) > 0) {

           $response["deletado"] = true;
            
            echo json_encode($response);
            
        } else {

            $response["deletado"] = false;
            $response["SQL"] = $sql;
            
            echo json_encode($response);
        } 
    } else {

        $response['auth_token_acesso_negado'] = false;

        echo json_encode($response);
    }
}
?>