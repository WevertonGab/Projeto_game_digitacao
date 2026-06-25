<?php 
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$usuario_id = $_SESSION['usuario_id'];

$sql_liga_usuario = "SELECT liga_id FROM liga_membro WHERE usuario_id = ?";
$stmtm_liga = mysqli_prepare($conn, $sql_liga_usuario);
mysqli_stmt_bind_param($stmtm_liga, "i", $usuario_id);
mysqli_stmt_execute($stmtm_liga);
$result_liga = mysqli_stmt_get_result($stmtm_liga);
$liga_usuario = mysqli_fetch_assoc($result_liga);
if ($liga_usuario == null) {
    $liga_id = null;
} else {
    $liga_id = $liga_usuario['liga_id'];
}


$rank_global = [];
$sql_rank_global = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
GROUP BY u.id
ORDER BY total_pontos DESC";
$stmtm_global = mysqli_prepare($conn, $sql_rank_global);
mysqli_stmt_execute($stmtm_global);
$rank_global = mysqli_stmt_get_result($stmtm_global);

$rank_semanal = [];
$sql_rank_semanal = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
WHERE YEARWEEK(p.criado_em, 1) = YEARWEEK(NOW(), 1)
GROUP BY u.id
ORDER BY total_pontos DESC";
$stmtm_semanal = mysqli_prepare($conn, $sql_rank_semanal);
mysqli_stmt_execute($stmtm_semanal);
$rank_semanal = mysqli_stmt_get_result($stmtm_semanal);

$sql_lista_ligas = "SELECT l.id, l.nome, l.criado_em, u.nickname AS criador
FROM ligas l
JOIN usuario u ON u.id = l.criador_id
ORDER BY l.criado_em DESC";
$stmt_lista = mysqli_prepare($conn, $sql_lista_ligas);
mysqli_stmt_execute($stmt_lista);
$lista_ligas = mysqli_stmt_get_result($stmt_lista);

$liga_dados = null;
$rank_exibir_ligas = [];

if($liga_id !== null) {
$sql_liga_dados = "SELECT l.nome, l.criado_em, u.nickname AS criador
FROM ligas l
JOIN usuario u ON u.id = l.criador_id
WHERE l.id = ?";
    
    $stmt_liga_dados = mysqli_prepare($conn, $sql_liga_dados);
    mysqli_stmt_bind_param($stmt_liga_dados, "i", $liga_id);
    mysqli_stmt_execute($stmt_liga_dados);
    $result_liga_dados = mysqli_stmt_get_result($stmt_liga_dados);
    $liga_dados = mysqli_fetch_assoc($result_liga_dados);

$rank_liga_geral = [];
$sql_liga_geral = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
JOIN liga_membro lm ON lm.usuario_id = u.id
WHERE lm.liga_id = ?
GROUP BY u.id
ORDER BY total_pontos DESC";

    $stmt_liga_geral = mysqli_prepare($conn, $sql_liga_geral);
    mysqli_stmt_bind_param($stmt_liga_geral, "i", $liga_id);
    mysqli_stmt_execute($stmt_liga_geral);
    $rank_liga_geral = mysqli_stmt_get_result($stmt_liga_geral);

$rank_liga_semanal = [];
$sql_liga_semanal = "SELECT u.nickname, SUM(p.pontos) AS total_pontos
FROM usuario u
JOIN partida p ON p.usuario_id = u.id
JOIN liga_membro lm ON lm.usuario_id = u.id
WHERE lm.liga_id = ?
AND YEARWEEK(p.criado_em, 1) = YEARWEEK(NOW(), 1)
GROUP BY u.id
ORDER BY total_pontos DESC";

    $stmt_liga_semanal = mysqli_prepare($conn, $sql_liga_semanal);
    mysqli_stmt_bind_param($stmt_liga_semanal, "i", $liga_id);
    mysqli_stmt_execute($stmt_liga_semanal);
    $rank_liga_semanal = mysqli_stmt_get_result($stmt_liga_semanal);

$filtro_liga = $_GET['filtro_liga'] ?? 'geral';
$rank_exibir_ligas   = ($filtro_liga === 'semanal') ? $rank_liga_semanal : $rank_liga_geral;
}


$filtro = $_GET['filtro'] ?? 'global';
$rank_exibir = ($filtro === 'semanal') ? $rank_semanal : $rank_global;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ligas</title>
    <link rel="stylesheet" href="styleliga.css">
</head>
<body>

<a href="dashboard.php">Voltar</a>

<section id="rank_global">
    <h2>Rank Global</h2>
    <a href="ligas.php?filtro=global">Desde o início</a>
    <a href="ligas.php?filtro=semanal">Semanal</a>
    <table>
    <thead>
        <tr>
            <th>Posição</th>
            <th>Nickname</th>
            <th>Pontos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $posicao = 1;
        While ($linha = mysqli_fetch_assoc($rank_exibir)) {
            echo "<tr>";
            echo "<td>" . $posicao++ . "</td>";
            echo "<td>" . $linha['nickname'] . "</td>";
            echo "<td>" . $linha['total_pontos'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>    
</table>
</section>

<section id="liga_privada"> 
<?php
if ($liga_id === null){
    echo "<a href='criar_liga.php'>Criar Liga</a>";
    
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Nome da Liga</th>";
                echo "<th>Criador</th>";
                echo "<th>Data de Criação</th>";
                echo "<th>Ação</th>";
            echo "</tr>";
        echo "</thead>";
    
        echo "<tbody>";
            while ($linha = mysqli_fetch_assoc($lista_ligas)) {
                echo "<tr>";
                echo "<td>" . $linha['nome'] . "</td>";
                echo "<td>" . $linha['criador'] . "</td>";
                echo "<td>" . $linha['criado_em'] . "</td>";
                echo "<td><a href='entrar_liga.php?liga_id=" . $linha['id'] . "'>Entrar</a></td>";
                echo "</tr>";
            }   
        echo "</tbody>";
    echo "</table>";
}
else {
    echo "<h2>Nome da Liga: " . $liga_dados['nome'] . "</h2>";
    echo "<h3>Criador: " . $liga_dados['criador'] . "</h3>";
    echo "<h3>Data de Criação: " . $liga_dados['criado_em'] . "</h3>";
    echo "<a href='sair_liga.php'>Sair da Liga</a>";
    echo "<a href='ligas.php?filtro_liga=geral'>Geral</a>";
    echo "<a href='ligas.php?filtro_liga=semanal'>Semanal</a>";
    
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Posição</th>";
                echo "<th>Nickname</th>";
                echo "<th>Pontos</th>";
            echo "</tr>";
        echo "</thead>";
    
        echo "<tbody>";
            $posicao = 1;
            while ($linha = mysqli_fetch_assoc($rank_exibir_ligas)) {
                echo "<tr>";
                echo "<td>" . $posicao++ . "</td>";
                echo "<td>" . $linha['nickname'] . "</td>";
                echo "<td>" . $linha['total_pontos'] . "</td>";
                echo "</tr>";
            }   
        echo "</tbody>";
    echo "</table>";
}
?> 
</section>

</body>
</html>