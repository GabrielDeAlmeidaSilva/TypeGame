<?php
require "./bd/credenciais.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    $_SESSION["idUsuario"] = 1;
}

if (isset($_SESSION["idUsuario"])) {
    $idUser = $_SESSION["idUsuario"];
} else {
    header("Location: sistemaLoginCadastro/login.php");
    exit();
}

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die(
        "Erro ao tentar estabelecer conexao com o BD: " .
        mysqli_connect_error()
    );
}

$stmt = mysqli_prepare($conn,"SELECT pontuacao FROM Partida WHERE fk_idUsuario = ? ORDER BY pontuacao DESC LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "i", $idUser);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$linha = mysqli_fetch_assoc($resultado);

$maiorPontuacao = $linha['pontuacao'] ?? 0;

$stmt = mysqli_prepare($conn,"SELECT pontuacao FROM Partida WHERE fk_idUsuario = ? ORDER BY idPartida DESC LIMIT 1");

mysqli_stmt_bind_param($stmt, "i", $idUser);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$linha = mysqli_fetch_assoc($resultado);

$atualPontuacao = $linha['pontuacao'] ?? 0;
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TypeGame</title>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
    <link rel="icon" href="assets/patoIconCor.png" />
  </head>
  <body class="container">
    <main>
      <header>
        <div class="cabecalho">
          <div class ="botoes">
            <button class= "btnComecar" id = "btnSair">Logout</button>
          </div>
          <img class="iconImagem" src="./assets/patoIcon.png" alt="" />
          <h1>TypeGame</h1>
          <nav class="divNavegacao">
            <ul>
	      <li>
		<a href="./ligas/ligas.php">
                  <img
                    class="iconNav"
                    src="./assets/rankIcon.png"
                    alt="rankIcon"
                  />
		</a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="containerInfos">
        <div class="info">30</div>
        <div class="info">Record: <?="$maiorPontuacao";?></div>
        <div class="info">ultimo Jogo: <?="$atualPontuacao";?></div>
        <div class="botoes">
          <button class="btnComecar">Restart Game</button>
        </div>
      </div>

      <div class="jogo" tabindex="0">
        <div class="DivPalavras"></div>
        <div class="cursor"></div>
        <div class="focus-erro">Click aqui para começar</div>
      </div>
    </main>
  </body>
</html>

<?php 
    mysqli_close($conn);
?>
