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

    else {
        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        }
        else {
        $senha_hash= null;
        }
        $sql = "INSERT INTO ligas (nome, senha, criador_id, criado_em) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $senha_hash, $usuario_id);
        try {
            mysqli_stmt_execute($stmt);
            $liga_id = mysqli_insert_id($conn);

            $sql_membro = "INSERT INTO liga_membro (liga_id, usuario_id, entrou_em) VALUES (?, ?, NOW())";
            $stmt_membro = mysqli_prepare($conn, $sql_membro);
            mysqli_stmt_bind_param($stmt_membro, "ii", $liga_id, $usuario_id);
            mysqli_stmt_execute($stmt_membro);

            header("Location: ligas.php");
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) { 
                $erro = "Nome da liga já existe. Por favor, escolha outro.";
            } else {
                $erro = "Erro ao criar liga: " . $e->getMessage();
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
    </div>
    <?php if (isset($erro)) echo $erro; ?>
</body>
</html>