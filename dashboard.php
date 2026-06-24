<?PHP
require_once __DIR__ . "/verifica_login.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
<h1> Bem-Vindo <?php echo $_SESSION['usuario_nickname']; ?> </h1>

<div id="opcoes">
    <a href="logout.php">Sair</a>
    <a href="jogo.php">Jogar</a>
    <a href="ligas.php">Ligas</a>
</div>

</body>
</html>