<?php
session_start();
session_destroy(); // Destruir sessão
header("Location: login.php"); // Redirecionar para a página de login
exit;
?>
