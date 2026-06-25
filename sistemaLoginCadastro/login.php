<?php
session_start();

// Se já estiver logado, sai
if (isset($_SESSION["usuario_id"])) {
    header("Location: logout.php");
    exit;
}

$erro = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    require "conexao.php";

    $name = $_POST["name"] ?? "";
    $senha = $_POST["password"] ?? "";
    
    if(empty($name) || empty($senha)){
        $erro = "Preencha todos os campos!";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT idUsuario, nome, senha FROM Usuario WHERE nome = ?");
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if($usuario = mysqli_fetch_assoc($result)){
            //verifica com password
            if(password_verify($senha, $usuario["senha"])){
                //login sucedido
                session_regenerate_id(true);
                $_SESSION["idUsuario"] = $usuario["idUsuario"];
                $_SESSION["nome"] = $usuario["nome"];
                
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                header("Location: ../index.php");
                exit;
            }
        }
        $erro = "Senha ou Nome incorretos.";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="image/png" href="../assets/patoIconCor.png">
</head>
<body>
    <div class="navbar">
        <img src="../assets/patoIcon.png" alt="Pato">
        <span></span>
        <h1>Login</h1>
    </div>
    <div class="main">
        <form action="" method="post">
            <label for="name">Nome:</label> <span class="name-span"></span>
            <input type="text" name="name" id="name" placeholder="Insira sua nome">

            <label for="password">Senha:</label> <span class="password-span"></span>
            <input type="password" name="password" id="password" placeholder="Insira a sua senha">

            <div class="but">
                <button type="submit">Enviar</button>
                <button type="button" onclick="window.location.href='cadastro.php'">Cadastrar</button>
            </div>
            <?=$erro?>
        </form>
        <script src="js/login.js"></script>
    </div>
</body>
</html>