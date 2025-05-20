<?php

    include_once("connection.php");

    $method = $_SERVER["REQUEST_METHOD"];

    if ($method === "GET") {

        $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

        $pedidos = $pedidosQuery->fetchAll();

        $acais = [];

        foreach($pedidos as $pedido) {

            $acai = [];

            //Definir um array para o açaí
            $acai["id_acai"] = $pedido["acai_id"];

            //Resgatando o açaí
            $acaiQuery = $conn->prepare("SELECT * FROM acais WHERE id_acai = :acai_id");

            $acaiQuery->bindParam(":acai_id", $acai["id_acai"]);

            $acaiQuery->execute();

            $acaiData = $acaiQuery->fetch(PDO::FETCH_ASSOC);

            //Resgatando o creme
            $cremeQuery = $conn->prepare("SELECT * FROM cremes WHERE id_creme = :creme_id");

            $cremeQuery->bindParam(":creme_id", $acaiData["creme_id"]);

            $cremeQuery->execute();

            $creme = $cremeQuery->fetch(PDO::FETCH_ASSOC);

            $acai["creme"] = $creme["nome"];

            //Resgatando o sabor
            $saborQuery = $conn->prepare("SELECT * FROM sabores WHERE id_sabor = :sabor_id");

            $saborQuery->bindParam(":sabor_id", $acaiData["sabor_id"]);

            $saborQuery->execute();

            $sabor = $saborQuery->fetch(PDO::FETCH_ASSOC);

            $acai["sabor"] = $sabor["sabor"];

            //Resgatando o tamanho
            $tamanhoQuery = $conn->prepare("SELECT * FROM tamanhos WHERE id_tamanho = :tamanho_id");

            $tamanhoQuery->bindParam(":tamanho_id", $acaiData["tamanho_id"]);

            $tamanhoQuery->execute();

            $tamanho = $tamanhoQuery->fetch(PDO::FETCH_ASSOC);

            $acai["tamanho"] = $tamanho["copo"];

            //Resgatando as frutas
            $frutasQuery = $conn->prepare("SELECT * FROM acai_fruta WHERE acai_id = :acai_id");

            $frutasQuery->bindParam(":acai_id", $acai["id_acai"]);

            $frutasQuery->execute();

            $frutas = $frutasQuery->fetchAll(PDO::FETCH_ASSOC);

            //Nome das frutas
            $frutasDoAcai = [];

            $frutaQuery = $conn->prepare("SELECT * FROM frutas WHERE id_fruta = :fruta_id");
            foreach($frutas as $fruta) {
                $frutaQuery->bindValue(":fruta_id", $fruta["fruta_id"]);
                $frutaQuery->execute();
                $frutaAcai = $frutaQuery->fetch(PDO::FETCH_ASSOC);
                array_push($frutasDoAcai, $frutaAcai["nome"]);
            }


            $acai["frutas"] = $frutasDoAcai;

            //Resgatando os complementos
            $complementosQuery = $conn->prepare("SELECT * FROM acai_complemento WHERE acai_id = :acai_id");

            $complementosQuery->bindParam(":acai_id", $acai["id_acai"]);

            $complementosQuery->execute();

            $complementos = $complementosQuery->fetchAll(PDO::FETCH_ASSOC);

            //Nome das complementos
            $complementosDoAcai = [];

            $complementoQuery = $conn->prepare("SELECT * FROM complementos WHERE id_complemento = :complemento_id");
            foreach($complementos as $complemento) {
                $complementoQuery->bindValue(":complemento_id", $complemento["complemento_id"]);
                $complementoQuery->execute();
                $complementoAcai = $complementoQuery->fetch(PDO::FETCH_ASSOC);
                array_push($complementosDoAcai, $complementoAcai["nome"]);
            }

            $acai["complementos"] = $complementosDoAcai;

            // Adicionar o status do pedido
            $acai["status"] = $pedido["status_id"];

            //Adicionar array de acai, ao array dos acais
            array_push($acais, $acai);
        }
        
        // Resgatando os status
        $statusQuery = $conn->query("SELECT * FROM status;");
        $status = $statusQuery->fetchAll();


    } 
    else if ($method === "POST") {

        //verificando tipo de POST
        $type = $_POST["type"];

        //excluir pedido
        if($type === "delete"){

            $acaiId = $_POST["id"];

            $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE acai_id = :acai_id;");
            $deleteQuery->bindParam(":acai_id", $acaiId, PDO::PARAM_INT);
            $deleteQuery->execute();

            $_SESSION["msg"] = "Pedido removido com sucesso";
            $_SESSION["status"] = "success";
        }
    
        header("Location:../dashboard.php");

    }

?>