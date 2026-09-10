<?php

session_start();

header("Content-Type: application/json");

if (isset($_SESSION["usuario_id"])) {

    echo json_encode([
        "logado" => true,
        "nome" => $_SESSION["usuario_nome"]
    ]);

} else {

    echo json_encode([
        "logado" => false
    ]);

}

?>
