<?php
    session_start();

    require_once 'env.php'; // este arquivo contém $user, $pass, etc.
    // Exemplo para desenvolvedores locais
    $user = "SEU_USUARIO";
    $pass = "SUA_SENHA";
    $db   = "SEU_BANCO";
    $host = "localhost";

    try {
        $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
        print "Erro: " . $e->getMessage() . "<br/>";
        die();
    }
?>
