<?php
require "./bd/credenciais.php";


if (session_status() === PHP_SESSION_NONE){
  session_start();
  $_SESSION["idUsuario"] = 1;
    }
 if (isset($_SESSION["idUsuario"])) {
	$idUser = $_SESSION["idUsuario"];
    } else {
    header("Location: login.php");
    exit();
}
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
	die("Erro ao tentar estabelecer conexao com o BD: " . mysqli_connect_error());
    }
    

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if (isset($_POST['pontos'])) {
    $pontuacao =$_POST['pontos'];
} else {
    die("Pontuação não informada.");
}

$stmt = mysqli_prepare($conn, "INSERT INTO Partida (pontuacao, fk_idUsuario, dataPartida) VALUES (?,?, CURRENT_TIMESTAMP)");
mysqli_stmt_bind_param($stmt, "ii", $pontuacao, $idUser);

if(mysqli_stmt_execute($stmt)) {
    echo "pontuacao inserida id:" . mysqli_stmt_insert_id($stmt);
} else {
    echo "Erro ao inserir: " . mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);

}
    mysqli_close($conn);
