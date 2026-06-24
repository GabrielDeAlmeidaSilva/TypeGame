<?php

require "./bd/credenciais.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();

}

if (!isset($_SESSION["idUsuario"])) {
    header("Location: login.php");
    exit;
}

$idUsuario = $_SESSION["idUsuario"];

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro ao conectar ao banco: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT idUsuario FROM Usuario WHERE idUsuario = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: login.php");
    exit;
}

$stmt->close();

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeLiga = trim($_POST["nomeLiga"]);
    $senhaLiga = $_POST["senhaLiga"];
    $confirmarSenha = $_POST["confirmarSenha"];
    

    if (empty($nomeLiga)) {
        $mensagem = "Digite um nome para sua Liga.";
    }

    else if ($senhaLiga != $confirmarSenha) {
    $mensagem = "As senhas não coincidem. Tente novamente.";
    }

else {
    $stmt = $conn->prepare("
        INSERT INTO Liga (nome, codigo, fk_idUsuario)
        VALUES (?, ?, ?)
    ");

    $senhaHash = password_hash($senhaLiga, PASSWORD_DEFAULT);

    $stmt->bind_param("ssi", $nomeLiga, $senhaHash, $idUsuario);

    if ($stmt->execute()) {
        $mensagem = "Liga criada com sucesso!";
        header("Location: ligas.php");
        exit;
    } else {
        $mensagem = "Erro ao criar liga.";
    }

    $stmt->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="criacaoLigas/style_criar_liga.css">        <title>Criar Liga</title>
    </head>
    <body>
        <header class="cabecalho cabecalhoLiga">
             <img class="iconImagem logoLiga" src="assets/patoIcon.png" alt="Logo do TypeGame">
             <h1>TypeGame</h1>
        </header>
            <main>
                <h2 class="tituloLiga">Criação de nova Liga</h2>
                <?php 
                //exibe a mensagem de erro caso as senha não coincidam.
                if ($mensagem != "") { ?>
                    <p class="mensagemErro"><?php echo $mensagem; ?></p>
                <?php } ?>
                <div class="containerLiga">
                <form method="POST">
                    <label for="nomeLiga">Qual vai ser o nome da Liga?</label>
                    <input type="text" id="nomeLiga" name="nomeLiga">


                    <label for="senhaLiga">Crie uma senha para a sua liga.</label>
                    <input type="password" id="senhaLiga" name="senhaLiga">


                    <label for="confirmarSenha">Confirme a senha da sua liga.</label>
                    <input type="password" id="confirmarSenha" name="confirmarSenha">

                    <div class="botoesLiga">
                        <button type="submit">Criar</button>
                        <button type="button" onclick="window.location.href='ligas.php'">Voltar</button>
                    </div>
                </form>
                </div>
            </main>
    </body>
</html>