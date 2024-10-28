<?php
session_start();

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'login_system');

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar usuário na tabela login
    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar senha
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $user['name'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "<p style='color: red;'>Senha incorreta!</p>";
        }
    } else {
        echo "<p style='color: red;'>Email não cadastrado!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif; /* Fonte padrão */
            background: linear-gradient(135deg, #6dd5ed, #2193b0); /* Gradiente de fundo */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Preencher toda a altura da tela */
            margin: 0; /* Remover margens */
        }

        /* Caixa de login */
        .container {
            background-color: white; /* Fundo branco para a caixa */
            padding: 30px; /* Espaçamento interno */
            border-radius: 20px; /* Bordas arredondadas de 20px */
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.3); /* Sombra */
            width: 300px; /* Largura fixa */
            text-align: center; /* Centraliza o texto na caixa */
        }

        h2 {
            margin-bottom: 20px; /* Margem abaixo do título */
            color: #333; /* Cor do texto do título */
        }

        /* Estilos para os campos de entrada */
        input[type="email"],
        input[type="password"] {
            width: 100%; /* Largura total */
            padding: 10px; /* Espaçamento interno */
            margin: 10px 0; /* Margem acima e abaixo */
            border: 1px solid #ccc; /* Borda cinza clara */
            border-radius: 5px; /* Bordas arredondadas */
            transition: border-color 0.3s; /* Transição suave */
        }

        /* Estilo do botão de submit */
        input[type="submit"] {
            width: 100%; /* Largura total */
            padding: 10px; /* Espaçamento interno */
            background-color: #007bff; /* Cor de fundo do botão */
            color: white; /* Cor do texto do botão */
            border: none; /* Sem borda */
            border-radius: 5px; /* Bordas arredondadas */
            cursor: pointer; /* Cursor de ponteiro */
            transition: background-color 0.3s; /* Transição suave */
        }

        /* Efeito de hover no botão */
        input[type="submit"]:hover {
            background-color: #0056b3; /* Cor mais escura ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            Email: <input type="email" name="email" required><br>
            Senha: <input type="password" name="password" required><br>
            <input type="submit" value="Entrar">
        </form>
        <br>
        <!-- Botão de Cadastro -->
        <form action="register.php" method="get">
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>


