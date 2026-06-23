<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Painel do usuario</h1>
    <p><?=htmlspecialchars($_SESSION["usuario_nome"])?></p>
    <a href="logout.php">sair</a>    
</body>
</html>