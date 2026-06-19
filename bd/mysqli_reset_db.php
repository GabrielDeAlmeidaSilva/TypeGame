<?php
require_once "credenciais.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro de conexao: " . mysqli_connect_error());
}

$sqlDelete = "DROP DATABASE IF EXISTS $dbname";

if (mysqli_query($conn, $sqlDelete)) {
    echo "Database Excluido </br>";
} else {
    echo "Erro ao excluir:" . mysqli_error($conn);
}

$sqlCreate = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sqlCreate)) {
    echo "Database criado!";
} else {
    echo "Erro ao criar conexao" . mysqli_error($conn);
}

mysqli_close($conn);

