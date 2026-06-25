<?php
require_once __DIR__ . "/verifica_login.php";
require_once __DIR__ . "/conexao.php";

$partida = [];

$sql_partida ="SELECT pontos, wpm, tempo
    FROM partida
    WHERE usuario_id = ?
    ORDER BY criado_em DESC
    LIMIT 1";
$stmt = mysqli_prepare($conn, $sql_partida);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['usuario_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$partida = mysqli_fetch_assoc($result) ?? [];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylepontos.css">
</head>
<body>
     <section id="telapontos">
        <div id="tela3">
            <div id="txt">Sua pontuação foi de</div>

            <div id="valor">
                <?= $partida['pontos'] ?? 0 ?>
            </div>

            <div id="relatorio">
                <div id="WPM" class="jv">
                    <div class="tab">WPM :</div>
                    <div id="valor_wpm" class="tab">
                        <?= $partida['wpm'] ?? 0 ?>
                    </div>
                </div>

                <div id="Precisão" class="jv">
                    <div class="tab">PRECISÃO :</div>
                    <div id="valor_precisao" class="tab">
                        <?= $partida['precisao'] ?? 0 ?>%
                    </div>
                </div>
            </div>

            <div id="finalizar">
                <button
                    id="denovo"
                    onclick="window.location.href='dashboard.php'">
                    voltar ao inicio
                </button>
            </div>
        </div>
    </section>


<script src="scriptpontos.js"></script>
</body>
</html>