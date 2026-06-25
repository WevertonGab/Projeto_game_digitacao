<?php

/*Puxa conexão.php para pode acessar e manipular o BD*/
require_once __DIR__ . "/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $nome = $_POST['nome'];
    $nickname = $_POST['nickname'];
    $senha = $_POST['senha'];
    
    if (empty($nome) || empty($nickname) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios.";
    }
    elseif (strlen($senha) < 8) {
        $erro = "A senha deve conter pelo menos 8 caracteres.";
    }
    else{
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario(nome, nickname, senha) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $nome, $nickname, $senha_hash);
        
       try {
            mysqli_stmt_execute($stmt);
            header("Location: dashboard.php");
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { 
                $erro = "Nickname já existe. Por favor, escolha outro.";
            } else {
                $erro = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <h1 class="titulo_cadastro" >Tela de Cadastro</h1>

    <div id="cadastro">
        <form id="form_cadastro" method="POST" action="cadastro.php"> 
            <input class="campo_form" type="text" name="nome" placeholder="Digite seu nome">
            <input class="campo_form" type="text" name="nickname" placeholder="Digite um apelido">
            <input class="campo_form" type="password" name="senha" placeholder="Crie uma senha">
            <button class="cadastrar" type="submit">Cadastrar</button>
            <a class="botao_voltar" href="index.php">Voltar</a>
        </form>    
    </div>

    <?php if (isset($erro)): ?>
    <p class="mensagem_erro"><?= $erro ?></p>
    <?php endif; ?>

</body>
</html>