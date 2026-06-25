<?php
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if (empty($nome)) {
        $erro = "Nome é obrigatório.";
    }
}
else {
    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    }
    else {
        $senha= null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Liga</title>
</head>
<body>

    <div id="criar_liga">
        <h2>Criar Liga</h2>
        <form method="POST" action="criar_liga.php" >
            <input type="text" name="nome" placeholder="Digite o nome da liga">
            <input type="password" name="senha" placeholder="Crie uma senha">
            <button type="submit">Criar</button>
            <a href="ligas.php">Voltar</a>
        </form>
</body>
</html>