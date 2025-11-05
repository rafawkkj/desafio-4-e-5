<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades PHP – Rifas e Jo-Ken-Pô</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f2f6f7;
            margin: 40px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 40px;
        }
        .exercicio {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
            max-width: 750px;
            margin-left: auto;
            margin-right: auto;
        }
        .exercicio h3 {
            color: #27ae60;
            border-bottom: 3px solid #27ae60;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            font-size: 15px;
        }
        input[type="submit"], button {
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
        }
        input[type="submit"]:hover, button:hover {
            background: #2ecc71;
        }
        .resultado {
            background: #ecf0f1;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
        }
        /* ======== RIFAS ======== */
        .rifa-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }
        .canhoto {
            width: 320px;
            border: 1px solid #000;
            border-radius: 8px;
            background: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }
        .lado {
            width: 48%;
            border-right: 1px dashed #000;
            padding-right: 5px;
        }
        .lado:last-child {
            border-right: none;
            padding-left: 5px;
        }
        .campo {
            margin-bottom: 8px;
        }
        .numero {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .imprimir {
            background: #2980b9;
            color: #fff;
            margin-top: 15px;
        }
        .imprimir:hover {
            background: #3498db;
        }
        @media print {
            body { background: #fff; margin: 0; }
            .exercicio form, .imprimir { display: none; }
            .canhoto { page-break-inside: avoid; }
        }

        /* ======== JO-KEN-PÔ ======== */
        .jogo {
            text-align: center;
        }
        .opcoes {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
        }
        .botao-jogo {
            background: #2980b9;
            color: white;
            border: none;
            border-radius: 15px;
            width: 100px;
            height: 100px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .botao-jogo:hover {
            background: #3498db;
            transform: scale(1.05);
        }
        .resultado-jogo {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 10px;
            display: inline-block;
            text-align: left;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Atividades em PHP</h1>

<!-- ======================== -->
<!-- ATIVIDADE 1 - GERADOR DE RIFAS -->
<!-- ======================== -->
<div class="exercicio">
    <h3>Atividade 1 – Gerador de Rifas com Canhotos Duplos</h3>
    <form method="post">
        <label>Nome da Campanha:</label>
        <input type="text" name="campanha" required>

        <label>Nome do Prêmio:</label>
        <input type="text" name="premio" required>

        <label>Valor da Rifa (R$):</label>
        <input type="number" name="valor" step="0.01" required>

        <label>Quantidade de Bilhetes:</label>
        <input type="number" name="quantidade" required>

        <input type="submit" name="gerar_rifa" value="Gerar Rifas">
    </form>

    <?php
    if (isset($_POST['gerar_rifa'])) {
        $campanha = htmlspecialchars($_POST['campanha']);
        $premio = htmlspecialchars($_POST['premio']);
        $valor = number_format($_POST['valor'], 2, ',', '.');
        $quantidade = (int)$_POST['quantidade'];

        echo "<div class='resultado'>";
        echo "<h3>Campanha: <strong>$campanha</strong></h3>";
        echo "<p>Prêmio: <strong>$premio</strong></p>";
        echo "<p>Valor da Rifa: <strong>R$$valor</strong></p>";
        echo "<h4>Canhotos Gerados:</h4>";
        echo "<div class='rifa-container'>";

        for ($i = 1; $i <= $quantidade; $i++) {
            $numero = str_pad($i, 5, "0", STR_PAD_LEFT);
            echo "
            <div class='canhoto'>
                <div class='lado'>
                    <div class='campo'>Nome: _____________________</div>
                    <div class='campo'>End.: _____________________</div>
                    <div class='campo'>Tel.: ______________________</div>
                    <div class='numero'>Nº $numero</div>
                </div>
                <div class='lado'>
                    <div class='campo'>Nome: _____________________</div>
                    <div class='campo'>End.: _____________________</div>
                    <div class='campo'>Tel.: ______________________</div>
                    <div class='numero'>Nº $numero</div>
                </div>
            </div>";
        }

        echo "</div>";
        echo "<button class='imprimir' onclick='window.print()'>Imprimir Rifas</button>";
        echo "</div>";
    }
    ?>
</div>

<!-- ======================== -->
<!-- ATIVIDADE 2 - JOGO DO JO-KEN-PÔ -->
<!-- ======================== -->
<div class="exercicio jogo">
    <h3>Atividade 2 – Jogo do Jo-Ken-Pô</h3>

    <form method="post">
        <div class="opcoes">
            <button type="submit" name="jogador" value="1" class="botao-jogo">🪨<br>Pedra</button>
            <button type="submit" name="jogador" value="2" class="botao-jogo">📄<br>Papel</button>
            <button type="submit" name="jogador" value="3" class="botao-jogo">✂️<br>Tesoura</button>
        </div>
    </form>

    <?php
    function jogar($jogador, $computador) {
        if ($jogador == $computador) return "Empate!";
        if (
            ($jogador == 1 && $computador == 3) ||
            ($jogador == 2 && $computador == 1) ||
            ($jogador == 3 && $computador == 2)
        ) return "Você venceu! 🎉";
        return "Computador venceu! 💻";
    }

    if (isset($_POST['jogador'])) {
        $jogador = $_POST['jogador'];
        $computador = rand(1,3);
        $opcoes = ["", "🪨 Pedra", "📄 Papel", "✂️ Tesoura"];
        $resultado = jogar($jogador, $computador);

        echo "<div class='resultado-jogo'>";
        echo "<p><strong>Você escolheu:</strong> {$opcoes[$jogador]}</p>";
        echo "<p><strong>Computador escolheu:</strong> {$opcoes[$computador]}</p>";
        echo "<p><strong>Resultado:</strong> $resultado</p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
