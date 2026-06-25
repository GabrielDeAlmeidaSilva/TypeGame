<?php
    require "../bd/credenciais.php";

    if(session_status() === PHP_SESSION_NONE){
	session_start();
    }

    if (isset($_SESSION["idUsuario"])) {
	$idUser = $_SESSION["idUsuario"];
    }
    else{
	header("Location: ../sistemaLoginCadastro/login.php");
    }

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
	die("Erro ao tentar estabelecer conexao com o BD: " . mysqli_connect_error());
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width", initial-scale=1">
    <title> TypeGame </title>
    <link rel="icon" type="image/x-icon" href="../assets/patoIconCor.png">
    <link rel="stylesheet" href="./styleLigas.css">    
    <script src="./scriptLiga.js" defer></script>
</head>
<body>
    <div id="ahh">
        <div id="header">
            <a href="../index.php">
	        <img id="pato" src="../assets/patoIcon.png" alt="Retornar ao jogo">
	    </a>
	    <div id="titulo">
		<h1> Rank Global </h1>
	    </div>
	</div>
       	<div id="semanal" class="leaderboard">
	    <h2> Semanal </h2>
	    <ol>
    		<?php
   //mesma coisa do ligas.php, mas sem a restricao de liga
		    $getPlayers = "SELECT U.nome, MAX(P.pontuacao) AS MaiorPont FROM Usuario U, Partida P WHERE U.idUsuario = P.fk_idUsuario AND P.dataPartida >= CURRENT_DATE - INTERVAL 7 DAY AND P.dataPartida <= CURRENT_DATE + INTERVAL 1 DAY GROUP BY U.idUsuario, U.nome ORDER BY MaiorPont DESC;";
		    $players = mysqli_query($conn, $getPlayers);
		    while($linhaPlyr = mysqli_fetch_assoc($players)){
		        echo "<li><span class='nome'>" . $linhaPlyr['nome'] . "</span><span class='pont'>" . $linhaPlyr['MaiorPont'] . "</span></li>";
		    }
		?> 
	    </ol>
	</div>
        <div id="geral" class="leaderboard">
	    <h2> Geral </h2>
	    <ol>
    		<?php
	 	    $getPlayers = "SELECT U.nome, MAX(P.pontuacao) AS MaiorPont FROM Usuario U, Partida P WHERE U.idUsuario = P.fk_idUsuario GROUP BY U.idUsuario, U.nome ORDER BY MaiorPont DESC;";
		    $players = mysqli_query($conn, $getPlayers);
		    while($linhaPlyr = mysqli_fetch_assoc($players)){
		        echo "<li><span class='nome'>" . $linhaPlyr['nome'] . "</span><span class='pont'>" . $linhaPlyr['MaiorPont'] . "</span></li>";
		    }
		?> 
	    </ol>
	</div>
    </div>
</body>
</html>

<?php 
    mysqli_close($conn);
?>
