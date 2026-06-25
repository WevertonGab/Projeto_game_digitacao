<?PHP
/*Verifica se o usuário está conectado*/
require_once __DIR__ . "/verifica_login.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<h1 class="titulo_nick"> Bem-Vindo <?php echo $_SESSION['usuario_nickname']; ?> </h1>

<div id="opcoes">
    <a class="btn_dashboard" href="jogo.php">Jogar</a>
    <a class="btn_dashboard" href="ligas.php">Ligas</a>
    <a class="btn_dashboard" href="historico.php">Historico</a>
    <a class="btn_logout" href="logout.php">Sair</a>
</div>

</body>
</html>