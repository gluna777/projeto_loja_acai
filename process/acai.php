<?php

    include_once("connection.php");

    $method = $_SERVER["REQUEST_METHOD"];

    //Resgate dos dados, montagem do pedido
    if ($method === "GET") {

        $tamanhosQuery = $conn->query("SELECT * FROM tamanhos;");
        $tamanhos  = $tamanhosQuery->fetchAll();

        $saboresQuery = $conn->query("SELECT * FROM sabores;");
        $sabores  = $saboresQuery->fetchAll();

        $cremesQuery = $conn->query("SELECT * FROM cremes;");
        $cremes  = $cremesQuery->fetchAll();

        $frutasQuery = $conn->query("SELECT * FROM frutas;");
        $frutas  = $frutasQuery->fetchAll();

        $complementosQuery = $conn->query("SELECT * FROM complementos;");
        $complementos  = $complementosQuery->fetchAll();

    } 
    else if ($method === "POST") {
        $data = $_POST;

        $tamanho = $data["tamanho"];
        $sabor = $data["sabor"];
        $creme = $data["creme"];
        $frutas = $data["frutas"];
        $complementos = $data["complementos"];

        //validação de frutas e complementos máximos
        if(count($frutas) > 3) {

            $_SESSION["msg"] = "Selecione no máximo 3 frutas";
            $_SESSION["status"] = "warning";

        }
        else {

            echo "Passou";
            exit;

        }
        //Retorna para a home
        header("Location:..");

        if(count($complementos) > 3) {

            $_SESSION["msg"] = "Selecione no máximo 3 complementos";
            $_SESSION["status"] = "warning";

        }
        else {

            echo "Passou";

        }
        //Retorna para a home
        header("Location:..");
    }

?>