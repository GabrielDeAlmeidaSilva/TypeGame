<?php
    require "conexao.php";

    $nome = "";
    $senha = "";
    $confirmacao_senha = "";

    $mensagem = "";
    $pass = FALSE;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        //puxando as informações do usuario com cuidado
        $nome = $_POST["name"] ?? "";
        $senha = $_POST["password"] ?? "";
        $confirmacao_senha = $_POST["c-password"] ?? "";

        // validar nome é vazio
        $nome_vazio = $nome === "";
        // senha é vazio
        $senha_vazia = $senha === "";
        //c senha é vazio
        $c_senha_vazia = $confirmacao_senha === "";
        //senhas diferentes
        $senha_diferente = $senha != $confirmacao_senha;

        if($nome_vazio || $senha_vazia || $c_senha_vazia || $senha_diferente){
            $mensagem = "Preencha corretamente os campos! (Validaçaão Backend)";
        } else {
            $mensagem = "Cadastro feito com sucesso!";
            $pass = TRUE;
        }
    }
//SIMPLES É MELHOR QUE COMPLEXO!
    
    $pode_inserir = FALSE;

    //checar je ja tem no banco
    if($pass){
        $stmt = mysqli_prepare($conn, "SELECT nome FROM Usuario WHERE nome = ?");
        mysqli_stmt_bind_param($stmt, "s", $nome);
        
        //executar
        mysqli_stmt_execute($stmt);

        //pegar res
        $resultado = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($resultado) == 0){
            $pode_inserir = TRUE;
        } else {
            $mensagem = "Nome ja cadastrado!";
        }
        mysqli_stmt_close($stmt);
    }
    
    if ($pode_inserir){
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO Usuario (nome, senha) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nome, $senha_hash);

        if(mysqli_stmt_execute($stmt)){
            $mensagem = "Usuario cadastrado com sucesso!";

            //limpar
            $nome = "";
            $senha = "";
            $confirmacao_senha = "";
        } else {
            $mensagem = "Erro: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua conta</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="icon" type="image/png" href="../assets/patoIconCor.png">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <img src="../assets/patoIcon.png" alt="Pato">
            <span></span>
            <h1>typegame</h1>
        </div>
        <form action="" method="post">
            <h2>Crie sua conta</h2>
            <label for="nome">Nome:</label>
            <input type="text" name="name" placeholder="Insira seu nome" id="name" value="<?=htmlspecialchars($nome)?>">
            <span class="e-name"></span>

            <label for="senha">Senha:</label>
            <input type="password" name="password" placeholder="Insira sua senha" id="password">
            <span class="e-password"></span>

            <label for="senha">Confirme sua senha:</label>
            <input type="password" name="c-password" placeholder="Confirme sua senha" id="c-password">
            <span class="e-c-password"></span>

            <div class="but">
                <button type="submit">Enviar</button>
                <button type="button" onclick="window.location.href='login.php'">Login</button>
                <br>
                <p style="color: #fff;"><?=$mensagem?></p>
            </div>
        </form>
    </div>
    <script src="js/cadastro.js"></script>
</body>
</html>