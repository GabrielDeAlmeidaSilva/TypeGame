<?php
    require "../bd/credenciais.php";

    if(session_status() === PHP_SESSION_NONE){
	session_start();
    }

    if(isset($_SESSION["idUsuario"])){
	$idUser = $_SESSION["idUsuario"];
    }
    else{
	header("Location: ../sistemaLoginCadastro/login.php");
    }


    $idLigaAtual = isset($_GET['idLiga']) ? $_GET['idLiga'] : '';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
	die("Erro ao tentar estabelecer conexao com o BD: " . mysqli_connect_error());
    }

    if(!mysqli_set_charset($conn, "utf8mb4")){
	die("Erro ao carregar characteres de utf8mb4: " . mysqli_error($conn));
    }

    if($_SERVER["REQUEST_METHOD"] === 'POST'){
	$nomeLiga = $_POST["nomeLiga"] ?? "";
    	$codLiga = $_POST["codLiga"] ?? "";

        $sql = "SELECT idLiga, nome, codigo FROM Liga WHERE nome = '" . $nomeLiga . "' LIMIT 1;";

    	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
	    $liga = mysqli_fetch_assoc($result);
	    if(password_verify($codLiga, $liga['codigo'])){
	    	$entrarLiga = "INSERT INTO UsuarioLiga (fk_idUsuario, fk_idLiga) VALUES (" . $idUser . ", " . $liga['idLiga'] . ");";
	    	if(!mysqli_query($conn, $entrarLiga)){ die("Erro ao entrar na liga" . mysqli_error($conn)); }
	    }
	}
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
		<h1> Ligas </h1>
	    </div>
	    <div id="entrar">
		<form class="formulario" action="./ligas.php" method="POST">
		    <input type="text" id="nomeLiga" name="nomeLiga" placeholder="Nome" required>
	            <input type="text" id="codLiga" name="codLiga" placeholder="Código" required>
		    <button id="entraLiga" type="submit"> Entrar </button>
		</form>
		<p id="alerta"></p>
	    </div>
   	    <button id="criaLiga" type="button"> + </button>
	    <a href="./historico.php"><img src="../assets/history.png" href="https://www.flaticon.com/authors/tempo-doloe" style="width: 50px"></a>
	</div>
        <div id="ligaAtual">
	    <?php		
			//navegacao entre ligas do usuario, ao acessar a tela via './index.php' nenhuma liga eh escolhida por padrao
    		if($idLigaAtual === ''){
		    echo "<h2>Entre em uma liga...</h2>";
		} 
		else {
		    $getLiga = "SELECT L.nome FROM Liga L WHERE L.idLiga = " . $idLigaAtual . ";";
		    if($result = mysqli_query($conn, $getLiga)) {
			$linha = mysqli_fetch_array($result);
		        echo "<h2>" . $linha['nome'] . "</h2>";
		    }
		}	
	    ?> 
        </div>
        <div id="main">
	    <div id="ligasAtivas">
    	    	<?php 
    //pega todas as ligas q o usuario participa
		    $sql = "SELECT L.idLiga, L.nome FROM Liga L, UsuarioLiga UL, Usuario U WHERE U.idUsuario = " . $idUser . " AND U.idUsuario = UL.fk_idUsuario AND L.idLiga = UL.fk_idLiga;";

 	 	    $ligas = mysqli_query($conn, $sql);
		    if(mysqli_num_rows($ligas) > 0){
			while($row = mysqli_fetch_assoc($ligas)){
			    echo "<div class='ligaAtiva'><a href='ligas.php?idLiga=" . $row['idLiga'] . "'><span>" . $row['nome'] . "</span></a></div>";
			}
		    }    
		?>
		<a href="rankGlobal.php">
		    <img id="globo" src="../assets/globo.png" alt="Rank global">
	        </a>
	    </div>
	<div id="semanal" class="leaderboard">
	    <h2> Semanal </h2>
	    <ol>
    		<?php
		    if(!$idLigaAtual){
			echo "<h3>Quack</h3>";
		    }
		    else {
			    //junta as tuplas em grupos do mesmo idUsuario e retornam apenas a maior pontuacao de cada grupo(a maior pontuacao do usuario em especifico). A propria marcacao da tag <ol> ja mostra a posicao dos jogadores, pois ja estao ordenados.
			$getPlayers = "SELECT U.nome, MAX(P.pontuacao) AS MaiorPont FROM Usuario U, Partida P, Liga L, UsuarioLiga UL WHERE U.idUsuario = P.fk_idUsuario AND UL.fk_idUsuario = U.idUsuario AND UL.fk_idLiga = L.idLiga AND L.idLiga = " . $idLigaAtual . " AND P.dataPartida >= CURRENT_DATE - INTERVAL 7 DAY AND P.dataPartida <= CURRENT_DATE + INTERVAL 1 DAY GROUP BY U.idUsuario, U.nome ORDER BY MaiorPont DESC;";
			$players = mysqli_query($conn, $getPlayers);
			while($linhaPlyr = mysqli_fetch_assoc($players)){
			    echo "<li><span class='nome'>" . $linhaPlyr['nome'] . "</span><span class='pont'>" . $linhaPlyr['MaiorPont'] . "</span></li>";
			}
		    }
		?> 
	    </ol>
	</div>
        <div id="geral" class="leaderboard">
	    <h2> Geral </h2>
	    <ol>
    		<?php
		    if(!$idLigaAtual){
			echo "<h3>Quack</h3>";
		    }
		    else {
			$getPlayers = "SELECT U.nome, MAX(P.pontuacao) AS MaiorPont FROM Usuario U, Partida P, Liga L, UsuarioLiga UL WHERE U.idUsuario = P.fk_idUsuario AND UL.fk_idUsuario = U.idUsuario AND UL.fk_idLiga = L.idLiga AND L.idLiga = " . $idLigaAtual . " GROUP BY idUsuario ORDER BY MaiorPont DESC;";
			$players = mysqli_query($conn, $getPlayers);
			while($linhaPlyr = mysqli_fetch_assoc($players)){
			    echo "<li><span class='nome'>" . $linhaPlyr['nome'] . "</span><span class='pont'>" . $linhaPlyr['MaiorPont'] . "</span></li>";
			}
		    }
		?> 
	    </ol>
	</div>
        </div>
    </div>
</body>
</html>

<?php 
    mysqli_close($conn);
?>
