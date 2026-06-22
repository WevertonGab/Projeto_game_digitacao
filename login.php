<<<<<<< HEAD
<?php 

require_once __DIR__ . "/conexao.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $nickname = $_POST['nickname'];
    $senha = $_POST['senha'];

    if (empty($nickname) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios.";
    }
    else{
        $sql = "SELECT * FROM usuario WHERE nickname = ?";
        
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, 's', $nickname);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        $usuario = mysqli_fetch_assoc($result);
        
        if ($usuario){
            if (password_verify($senha, $usuario['senha'])){
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nickname'] = $usuario['nickname'];

                header("Location: dashboard.php");
            }
            else{
                $erro = "Nickname ou senha inválidos";
            }
        }
        else{
            $erro = "Nickname ou senha inválidos";
        }  
    }        
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1>Tela de Login</h1>

    <div class="cadastro">
        <form method="POST" action="login.php"> 
            <input type="text" name="nickname" placeholder="Digite seu apelido">
            <input type="password" name="senha" placeholder="Digite sua senha">
            <button type="submit">Entrar</button>
            <a href="index.php">Voltar</a>
        </form>    
    </div>

    <?php if (isset($erro)) echo $erro; ?>

</body>
=======
<?php 

require_once __DIR__ . "/conexao.php";

session_start();


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    $nickname = $_POST['nickname'];
    $senha = $_POST['senha'];

    if (empty($nickname) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios.";
    }
    else{
        $sql = "SELECT * FROM usuario WHERE nickname = ?";
        
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, 's', $nickname);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        $usuario = mysqli_fetch_assoc($result);
        
        if ($usuario){
            if (password_verify($senha, $usuario['senha'])){
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nickname'] = $usuario['nickname'];

                header("Location: dashboard.php");
            }
            else{
                $erro = "Nickname ou senha inválidos";
            }
        }
        else{
            $erro = "Nickname ou senha inválidos";
        }  
    }        
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <h1>Tela de Login</h1>

    <div class="cadastro">
        <form method="POST" action="login.php"> 
            <input type="text" name="nickname" placeholder="Digite seu apelido">
            <input type="password" name="senha" placeholder="Digite sua senha">
            <button type="submit">Entrar</button>
            <a href="index.php">Voltar</a>
        </form>    
    </div>

    <?php if (isset($erro)) echo $erro; ?>

</body>
>>>>>>> 501e73c (Arquivo Ligas)
</html>