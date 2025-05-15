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

    }

?>