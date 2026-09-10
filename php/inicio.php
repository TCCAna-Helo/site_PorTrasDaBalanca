<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.html");
    exit;
}

$nome = $_SESSION["usuario_nome"];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Início - Transtornos Alimentares</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f0f8;
            color: #333;
        }

        header {
            background: #803ca8;
            color: white;
            padding: 20px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
        }

        .sair {
            color: white;
            text-decoration: none;
            background: #6d3290;
            padding: 10px 18px;
            border-radius: 8px;
        }

        .conteudo {
            max-width: 900px;
            margin: 60px auto;
            padding: 20px;
        }

        .boas-vindas {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .boas-vindas h2 {
            color: #803ca8;
        }
    </style>
</head>

<body>

    <header>

        <h1>Transtornos Alimentares</h1>

        <a href="logout.php" class="sair">
            Sair
        </a>

    </header>

    <main class="conteudo">

        <div class="boas-vindas">

            <h2>
                Olá, <?php echo htmlspecialchars($nome); ?>! 👋
            </h2>

            <p>
                Bem-vindo(a) ao seu espaço.
            </p>

            <p>
                Aqui você poderá encontrar informações e recursos
                relacionados aos transtornos alimentares.
            </p>

        </div>

    </main>

</body>

</html>
