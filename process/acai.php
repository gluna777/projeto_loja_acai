<?php

    include_once("connection.php");

    $method = $_SERVER["REQUEST_METHOD"];

    //Resgate dos dados, montagem do pedido
    if ($method === "GET") {

        $cremesQuery = $conn->query("SELECT * FROM cremes;");
        $cremes  = $cremesQuery->fetchAll();

        $saboresQuery = $conn->query("SELECT * FROM sabores;");
        $sabores  = $saboresQuery->fetchAll();

        $tamanhosQuery = $conn->query("SELECT * FROM tamanhos;");
        $tamanhos  = $tamanhosQuery->fetchAll();

        $frutasQuery = $conn->query("SELECT * FROM frutas;");
        $frutas  = $frutasQuery->fetchAll();

        $complementosQuery = $conn->query("SELECT * FROM complementos;");
        $complementos  = $complementosQuery->fetchAll();

    } 
    else if ($method === "POST") {
        $data = $_POST;

        $creme = $data["creme"];
        $sabor = $data["sabor"];
        $tamanho = $data["tamanho"];
        $frutas = $data["frutas"];
        $complementos = $data["complementos"];

        //validação de frutas e complementos máximos
        if (count($frutas) > 3 || count($complementos) > 3) {
            $_SESSION["msg"] = "Selecione no máximo 3 frutas e 3 complementos.";
            $_SESSION["status"] = "warning";
            header("Location: ..");
            exit();
        }
             
        // Salavando creme, sabor e tamanho
        $stmt = $conn->prepare("INSERT INTO acais (creme_id, sabor_id, tamanho_id) 
        VALUES (:creme, :sabor, :tamanho)");

        //filtrando inputs
        $stmt->bindParam(":creme", $creme, PDO::PARAM_INT);
        $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);
        $stmt->bindParam(":tamanho", $tamanho, PDO::PARAM_INT);

        $stmt->execute();

        //Salvando frutas e complementos
        //Resgatando ultimo id do ultimo açaí
        $acaiId = $conn->lastInsertId();

        //frutas
        $stmt = $conn->prepare("INSERT INTO acai_fruta (acai_id, fruta_id)
        VALUES (:acai, :fruta)");

        // Repetição até terminar de salvar as frutas
        foreach($frutas as $fruta) {
            $stmt->bindParam(":acai", $acaiId, PDO::PARAM_INT);
            $stmt->bindParam(":fruta", $fruta, PDO::PARAM_INT); // CORRETO
            $stmt->execute();
        


        //complementos
        $stmt = $conn->prepare("INSERT INTO acai_complemento (acai_id, complemento_id)
        VALUES (:acai, :complemento)");

        // Repetição até terminar de salvar as frutas
        foreach($complementos as $complemento) {
        $stmt->bindParam(":acai", $acaiId, PDO::PARAM_INT);
        $stmt->bindParam(":complemento", $complemento, PDO::PARAM_INT); // CORRETO
        $stmt->execute();
        }



        //criar pedido do açaí
        $stmt = $conn->prepare("INSERT INTO pedidos(acai_id, status_id) 
        VALUES(:acai, :status)");

        //status -> sempre inicia em 1 = Em produção
        $statusId =1;

        //filtrar inputs
        $stmt->bindParam(":acai", $acaiId);
        $stmt->bindParam(":status", $statusId);

        $stmt->execute();

        //Mensagem de sucesso
        $_SESSION["msg"] = "Pedido Realizado com sucesso";
        $_SESSION["status"] = "success";
        //Retorna para a home
        header("Location:..");
        exit;
        }
    }


?>