<?php

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $confirmar_senha = $_POST["confirmar_senha"] ?? "";

    // Verifica se todos os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        die("Preencha todos os campos.");
    }

    // Verifica se as senhas são iguais
    if ($senha !== $confirmar_senha) {
        die("As senhas não são iguais.");
    }

    // Cria uma versão protegida da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o e-mail já existe
    $consulta = $conexao->prepare(
        "SELECT id FROM usuarios WHERE email = ?"
    );

    $consulta->bind_param("s", $email);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows > 0) {
        $consulta->close();

        die("Este e-mail já está cadastrado.");
    }

    $consulta->close();

    // Salva o usuário no banco
    $sql = $conexao->prepare(
        "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)"
    );

    $sql->bind_param("sss", $nome, $email, $senha_hash);

    if ($sql->execute()) {

        echo "
        <h2>Cadastro realizado com sucesso!</h2>
        <p>Agora você pode fazer login.</p>
        <a href='../login.html'>Ir para o login</a>
        ";

    } else {

        echo "Erro ao realizar o cadastro.";
    }

    $sql->close();
    $conexao->close();

} else {

    echo "Acesso inválido.";
}

?>
