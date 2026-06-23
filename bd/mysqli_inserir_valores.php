<?php
require_once "credenciais.php";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Erro de conexao: " . mysqli_connect_error());
}

$senhaPadrao = password_hash('123mudar', PASSWORD_DEFAULT);
$senhaRyu = password_hash('hadouken', PASSWORD_DEFAULT);

$inserirUsuario = "INSERT INTO Usuario (idUsuario, nome, senha) VALUES
    (1, 'jogador1', '$senhaPadrao'), 
    (2, 'jogador2', '$senhaPadrao'),
    (3, 'jogador3', '$senhaPadrao'),
    (4, 'jogador4', '$senhaPadrao'),
    (100, 'Ryu', '$senhaRyu' );
";

if (!mysqli_query($conn, $inserirUsuario)) {
    die("Erro ao inserir valores em Usuario" . mysqli_error($conn));
}

$senhaPadraoLiga = password_hash('123mudar', PASSWORD_DEFAULT);

$inserirLiga = "INSERT INTO Liga (idLiga, nome, codigo, fk_idUsuario) VALUES
    (1, 'Ouro', '$senhaPadraoLiga', 1),
    (2, 'Prata', '$senhaPadraoLiga', 2),
    (3, 'Street', '$senhaPadraoLiga',100);
";

if (!mysqli_query($conn, $inserirLiga)) {
    die("Erro ao inserir valores em Liga" . mysqli_error($conn));
}


$inserirPartida ="INSERT INTO Partida (pontuacao, fk_idUsuario) VALUES
    (20, 1),
    (30, 2),
    (25, 3),
    (40, 4),
    (100, 100);
";

if (!mysqli_query($conn, $inserirPartida)) {
    die("Erro ao inserir valores em Partida" . mysqli_error($conn));
}

$inserirUsuarioLiga ="INSERT INTO UsuarioLiga (fk_idUsuario, fk_idLiga) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 1),
    (100, 2);
";

if (!mysqli_query($conn, $inserirUsuarioLiga)) {
    die("Erro ao inserir valores em UsuarioLiga" . mysqli_error($conn));
}



echo "Informaçoes inseridas";

mysqli_close($conn);