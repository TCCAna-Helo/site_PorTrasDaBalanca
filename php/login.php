<?php

session_start();

require_once "conexao.php";

if (!isset($conn)) {
    if (isset($conexao)) {
        $conn = $conexao;
    } elseif (isset($mysqli)) {
        $conn = $mysqli;
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Acesso inválido.";
    exit;
}

// Recebe os dados do formulário
$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

// Verifica se os campos foram preenchidos
if (empty($email) || empty($senha)) {
    echo "Preencha o e-mail e a senha.";
    exit;
}

// Procura o usuário pelo e-mail
$sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Erro ao preparar a consulta.";
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();

$resultado = $stmt->get_result();

// Verifica se encontrou o usuário
if ($resultado->num_rows === 1) {

    $usuario = $resultado->fetch_assoc();

    // Confere a senha digitada com a senha armazenada no banco
    if (password_verify($senha, $usuario["senha"])) {

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["usuario_nome"] = $usuario["nome"];
        $_SESSION["usuario_email"] = $usuario["email"];
    
        header("Location: ../index.html");
        exit;
    
    } else {

        echo "E-mail ou senha incorretos.";

    }

} else {

    echo "E-mail ou senha incorretos.";

}

$stmt->close();
$conn->close();

?>
