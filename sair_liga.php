<?php
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$usuario_id = $_SESSION['usuario_id'];
$sql_sair_liga = "DELETE FROM liga_membro WHERE usuario_id = ?";
$stmt_sair_liga = mysqli_prepare($conn, $sql_sair_liga);
mysqli_stmt_bind_param($stmt_sair_liga, "i", $usuario_id);
mysqli_stmt_execute($stmt_sair_liga);
header("Location: ligas.php");
exit();
?>