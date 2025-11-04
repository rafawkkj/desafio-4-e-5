<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades PHP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            margin: 40px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }
        .exercicio {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .exercicio h3 {
            color: #2c3e50;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        .exercicio form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="text"], input[type="number"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
        }
        input[type="submit"], button {
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover, button:hover {
            background: #2ecc71;
        }
        .resultado {
            background: #ecf0f1;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
            font-size: 1.1em;
        }
        .bilhete {
            border: 1px dashed #333;
            padding: 10px;
            border-radius: 10px;
            margin: 5px 0;
            text-align: center;
            background: #fafafa;
        }
        .imprimir {
            background: #2980b9;
        }
        .imprimir:hover {
            background: #3498db;
        }
        .jogo img {
            width: 80px;
            height: 80px;
        }
    </style>
</head>
<body>
<h1>Atividades em PHP</h1>

<!-- ======================== -->
<!-- ATIVIDADE 1 - GERADOR DE RIFAS -->
<!-- ======================== -->
<div class="exercicio">
    <h3>Atividade 1 – Gerador de Rifas em PHP</h3>
    <form method="post">
        <label>Nome da Campanha:</label>
        <input type="text" name="campanha" required>

        <label>Nome do Prêmio:</label>
        <input type="text" name="premio" required>

        <label>Valor da Rifa (R$):</label>
        <input type="number" name="valor" step="0.01" required>

        <label>Quantidade de Bilhetes:</label>
        <input type="number" name="quantidade" required>

        <input type="submit" name="gerar_rifa" value="Gerar Bilhetes">
    </form>

    <?php
    if (isset($_POST['gerar_rifa'])) {
        $campanha = $_POST['campanha'];
        $premio = $_POST['premio'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];

        echo "<div class='resultado'>";
        echo "<h4>Campanha: <strong>$campanha</strong></h4>";
        echo "<p>Prêmio: <strong>$premio</strong></p>";
        echo "<p>Valor da Rifa: <strong>R$$valor</strong></p>";
        echo "<h4>Bilhetes Gerados:</h4>";

        for ($i = 1; $i <= $quantidade; $i++) {
            $numero = str_pad($i, 3, "0", STR_PAD_LEFT);
            echo "<div class='bilhete'>Bilhete Nº <strong>$numero</strong></div>";
        }

        echo "<br><button class='imprimir' onclick='window.print()'>Imprimir Bilhetes</button>";
        echo "</div>";
    }
    ?>
</div>

<!-- ======================== -->
<!-- ATIVIDADE 2 - JOGO DO JOKEMPÔ -->
<!-- ======================== -->
<div class="exercicio">
    <h3>Atividade 2 – Jogo do Jo-Ken-Pô</h3>
    <form method="post">
        <label>Escolha sua jogada:</label>
        <select name="jogador" required>
            <option value="1">Pedra</option>
            <option value="2">Papel</option>
            <option value="3">Tesoura</option>
        </select>
        <input type="submit" name="jogar" value="Jogar">
    </form>

    <?php
    function jogar($jogador, $computador) {
        if ($jogador == $computador) return "Empate!";
        if (
            ($jogador == 1 && $computador == 3) ||
            ($jogador == 2 && $computador == 1) ||
            ($jogador == 3 && $computador == 2)
        ) return "Você venceu!";
        return "Computador venceu!";
    }

    if (isset($_POST['jogar'])) {
        $jogador = $_POST['jogador'];
        $computador = rand(1,3);

        $opcoes = ["", "Pedra", "Papel", "Tesoura"];
        $resultado = jogar($jogador, $computador);

        echo "<div class='resultado jogo'>";
        echo "<p>Você escolheu: <strong>{$opcoes[$jogador]}</strong></p>";
        echo "<p>Computador escolheu: <strong>{$opcoes[$computador]}</strong></p>";
        echo "<p>Resultado: <strong>$resultado</strong></p>";
        echo "<br><form method='post'><input type='submit' value='Jogar Novamente'></form>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
