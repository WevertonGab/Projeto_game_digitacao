<?php

/*Varifica sejá tem alguém conectado, caso tenha manda para dahsboard*/
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<h1 class="titulo_index" >MINING GAME</h1>

<div id="opcoes">
    <a class="login_button" href="login.php">Entrar</a>
    <a class="login_button" href="cadastro.php">Cadastrar</a>
</div>

</body>
</html>
