<?php
require_once "credenciais.php";


$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Erro de conexao " . mysqli_connect_error());
}

$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
    echo "Database criado!";
} else {
    echo "Erro ao criar conexao" . mysqli_error($conn);
}

mysqli_close($conn);

