<?php
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$historico = [];
$sql_historico = "SELECT pontos, wpm, precisao, criado_em
FROM partida
WHERE usuario_id = ?
ORDER BY criado_em DESC";
$stmtm_historico = mysqli_prepare($conn, $sql_historico);
mysqli_stmt_bind_param($stmtm_historico, "i", $_SESSION['usuario_id']);
mysqli_stmt_execute($stmtm_historico);
$historico = mysqli_stmt_get_result($stmtm_historico);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>historico</title>
</head>
<body>
    <h1>Seu Histórico de Partidas</h1>
    <table>
    <thead>
        <tr>
            <th>Pontos</th>
            <th>WPM</th>
            <th>Precisão</th>
            <th>criado_em</th>
        </tr>
    </thead>
    <tbody>
        <?php
        While ($linha = mysqli_fetch_assoc($historico)) {
            echo "<tr>";
            echo "<td>" . $linha['pontos'] . "</td>";
            echo "<td>" . $linha['wpm'] . "</td>";
            echo "<td>" . $linha['precisao'] . "</td>";
            echo "<td>" . $linha['criado_em'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody> 
    <a href="dashboard.php">Voltar</a>   
</table>
</body>
</html>