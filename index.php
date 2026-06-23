<?php
session_start();
if (isset($_SESSION['usuario_id'])){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela_inicial</title>
</head>
<body>
    
<h1>Mineração </h1>

<div id="opcoes">
    <a href="login.php">Entrar</a>
    <a href="cadastro.php">Cadastrar</a>
</div>

</body>
</html>
