<?php
require_once "credenciais.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro de conexao: " . mysqli_connect_error());
}

//Usuario
$sqlUsuario = "CREATE TABLE IF NOT EXISTS Usuario (
    idUsuario INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);";

if (!mysqli_query($conn, $sqlUsuario)) {
    die("Erro ao criar tabela Usuario: " . mysqli_error($conn));
}

//Liga
$sqlLiga = "CREATE TABLE IF NOT EXISTS Liga (
    idLiga INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    codigo VARCHAR(15) NOT NULL UNIQUE,
    fk_idUsuario INTEGER UNSIGNED,
    FOREIGN KEY(fk_idUsuario) REFERENCES Usuario(idUsuario)
);";

if (!mysqli_query($conn, $sqlLiga)) {
    die("Erro ao criar tabela Liga: " . mysqli_error($conn));
}

//Partida
$sqlPartida = "CREATE TABLE IF NOT EXISTS Partida (
    idPartida INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pontuacao INTEGER UNSIGNED NOT NULL,
    dataPartida DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    fk_idUsuario INTEGER UNSIGNED NOT NULL,
    FOREIGN KEY(fk_idUsuario) REFERENCES Usuario(idUsuario)
);";

if (!mysqli_query($conn, $sqlPartida)) {
    die("Erro ao criar tabela Partida: " . mysqli_error($conn));
}

//UsuarioLiga
$sqlUsuarioLiga = "CREATE TABLE IF NOT EXISTS UsuarioLiga (
    fk_idUsuario INTEGER UNSIGNED NOT NULL,
    fk_idLiga INTEGER UNSIGNED NOT NULL,
    FOREIGN KEY(fk_idUsuario) REFERENCES Usuario(idUsuario),
    FOREIGN KEY(fk_idLiga) REFERENCES Liga(idLiga),
    PRIMARY KEY (fk_idUsuario, fk_idLiga)
);";

if (!mysqli_query($conn, $sqlUsuarioLiga)) {
    die("Erro ao criar tabela UsuarioLiga: " . mysqli_error($conn));
}

echo "Todas as tabelas foram criadas com sucesso!";

mysqli_close($conn);