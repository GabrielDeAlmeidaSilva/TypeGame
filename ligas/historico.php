<?php
    require "../bd/credenciais.php";

    if(session_status() === PHP_SESSION_NONE){
	session_start();
    }
    if(isset($_SESSION["idUsuario"])){
	$idUser = $_SESSION["idUsuario"];
    }

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
	die("Erro ao tentar estabelecer conexão: " . mysqli_connect_error());
    }

    $sql = "SELECT pontuacao, dataPartida FROM Partida WHERE fk_idUsuario = " . $idUser . " GROUP BY dataPartida, pontuacao ORDER BY dataPartida;";

    $tuplas = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width", initial-scale=1">
    <title> TypeGame </title>
    <link rel="icon" type="image/x-icon" href="../assets/patoIconCor.png">
    <link rel="stylesheet" href="./styleLigas.css">    
</head>
<body>
    <div id="tudo">
        <div id="header">
            <a href="../index.php">
	        <img id="pato" src="../assets/patoIcon.png" alt="Retornar ao jogo">
	    </a>
	    <div id="titulo">
		<h1> Histórico </h1>
	    </div>
	</div>
	<div id="partidas">
	    <?php
  	        if(mysqli_num_rows($tuplas) > 0){
		    while($row = mysqli_fetch_assoc($tuplas)){
			$data = $row["dataPartida"];
			echo "<div class='partida'><span class='data'>" . $data . "</span><span class='pont'>" . $row['pontuacao'] . "</span></div>";
		    }
	        }
    	    ?>
	</div>
    </div>
</body>
</html>
<?php
    mysqli_close($conn);
?>
