<?php
    require "../bd/credenciais.php";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!conn){
	die("Erro ao tentar estabelecer conexão" . mysqli_connect_error());
    }

    if(isset($_SESSION["idUsuario"])){
	$idUser = $_SESSION["idUsuario"];
    }
    else{
	header("Location: ../sistemaLoginCadastro/login.php");
    }

    $nomeLiga = 
    $codLiga = 

    $sql = "SELECT idLiga, nome, codigo FROM Liga WHERE nome = " . $nomeLiga . " AND codigo = " . $codLiga . ";";

    $results = mysqli_query($conn, $sql);

    if(mysqli_num_rows($results) > 0){
	$liga = mysqli_fetch_assoc($results);
	$entrarLiga = "INSERT INTO UsuarioLiga (fk_idUsuario, fk_idLiga) VALUES (" . $liga['idLiga'] . ", " . $idUser . ");";

	if(!mysqli_query($conn, $entrarLiga)){ die("Erro ao entrar na liga" . mysqli_error($conn)); }
    }

    mysqli_close($conn);
