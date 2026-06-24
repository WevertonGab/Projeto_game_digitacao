<?php 
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$usuario_id = $_SESSION['usuario_id'];

$sql_liga_usuario = "SELECT liga_id FROM liga_membro WHERE usuario_id = ?";
$stmtm = mysqli_prepare($conn, $sql_liga_usuario);
mysqli_stmt_bind_param($stmtm, "i", $usuario_id);
mysqli_stmt_execute($stmtm);
$resultm = mysqli_stmt_get_result($stmtm);

$rank_global = [];
$sql_rank_global = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
GROUP BY u.id
ORDER BY total_pontos DESC";
$stmtm = mysqli_prepare($conn, $sql_rank_global);
mysqli_stmt_execute($stmtm);
$rank_global = mysqli_stmt_get_result($stmtm);

$rank_semanal = [];
$sql_rank_semanal = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
WHERE YEARWEEK(p.criado_em, 1) = YEARWEEK(NOW(), 1)
GROUP BY u.id
ORDER BY total_pontos DESC";
$stmtm = mysqli_prepare($conn, $sql_rank_semanal);
mysqli_stmt_execute($stmtm);
$rank_semanal = mysqli_stmt_get_result($stmtm);

?>