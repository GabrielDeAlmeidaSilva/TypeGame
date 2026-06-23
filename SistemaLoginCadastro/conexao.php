<?php
require "../bd/credenciais.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_error()) {
    die("Erro de conexão: " . mysqli_connect_error());
}

?>
