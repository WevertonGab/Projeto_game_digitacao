<?php
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$usuario_id = $_SESSION['usuario_id'];
$liga_id = $_GET['liga_id'] ?? null;

$sql_liga = "SELECT id, nome, senha FROM ligas WHERE id = ?";
$stmt_liga = mysqli_prepare($conn, $sql_liga);
mysqli_stmt_bind_param($stmt_liga, "i", $liga_id);
mysqli_stmt_execute($stmt_liga);
$result_liga = mysqli_stmt_get_result($stmt_liga);
$liga = mysqli_fetch_assoc($result_liga);

if (!$liga) {
    header("Location: ligas.php");
    exit();
}
if ($liga['senha'] !== null) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $senha_digitada = $_POST['senha'];
        if (password_verify($senha_digitada, $liga['senha'])) {
            $sql_membro = "INSERT INTO liga_membro (liga_id, usuario_id, entrou_em) VALUES (?, ?, NOW())";
            $stmt_membro = mysqli_prepare($conn, $sql_membro);
            mysqli_stmt_bind_param($stmt_membro, "ii", $liga_id, $usuario_id);
                mysqli_stmt_execute($stmt_membro);
                header("Location: ligas.php");
                exit();
        } else {
            $erro = "Erro ao entrar na liga.";
        }
    }
}
else {
    $sql_membro = "INSERT INTO liga_membro (liga_id, usuario_id, entrou_em) VALUES (?, ?, NOW())";
    $stmt_membro = mysqli_prepare($conn, $sql_membro);
    mysqli_stmt_bind_param($stmt_membro, "ii", $liga_id, $usuario_id);
    mysqli_stmt_execute($stmt_membro);
    header("Location: ligas.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>entrar liga</title>
</head>
<body>
    <h2>Entrar na Liga: <?php echo htmlspecialchars($liga['nome']); ?></h2>
    <?php if ($liga['senha'] !== null): ?>
        <form method="POST" action="entrar_liga.php?liga_id=<?php echo $liga_id; ?>">
            <input type="password" name="senha" placeholder="Digite a senha da liga">
            <button type="submit">Entrar</button>
            <a href="ligas.php">Voltar</a>
        </form>
        <?php if (isset($erro)) echo($erro); ?>
    <?php endif; ?>
</body>
</html>
