<?php
session_start();
require_once __DIR__ . "/conexao.php";

header("Content-Type: application/json");

$dados = json_decode(file_get_contents("php://input"), true);
$pontos = $dados['pontos'];
$wpm = $dados['wpm'];
$precisao = $dados['precisao'];

$usuario_id = $_SESSION['usuario_id'];

$sql = "INSERT INTO partida (usuario_id, pontos, wpm, precisao, criado_em) VALUES (?, ?, ?, ?, NOW())";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iiii", $usuario_id, $pontos, $wpm, $precisao);
try {
    mysqli_stmt_execute($stmt);
    echo json_encode(["sucesso" => true, "mensagem" => "Partida salva com sucesso"]);
} catch (mysqli_sql_exception $e) {
    echo json_encode(["sucesso" => false, "mensagem" => "Erro ao salvar partida: " . $e->getMessage()]);
    exit();
}
?>