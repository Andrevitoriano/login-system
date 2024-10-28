<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['name']; ?>!</h2>
    <p>Você está logado.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
