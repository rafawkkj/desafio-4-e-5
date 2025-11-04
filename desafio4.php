<?php
// === VARIÁVEIS E CONFIGURAÇÕES ===
$resultado = "";
$erros = [];
$exercicio_atual = $_GET['exercicio'] ?? 'home';

$dados_form = [
    'reais' => '', 'cotacao' => '',
    'base' => '', 'altura' => '',
    'distancia' => '', 'combustivel' => '',
    'n1' => '', 'n2' => '',
    'ano_nascimento' => '',
    'numero' => '',
    'numero_dia' => '',
    'calc_n1' => '', 'calc_n2' => '', 'operacao' => '',
    'numero_mes' => '',
    'fatorial_num' => '',
    'somatorio_num' => '',
    'inicio' => '', 'fim' => '',
    'notas' => ['', '', '', '', ''],
    'itens_selecionados' => [],
    'numeros_array' => ['', '', '', '', '']
];

// === PROCESSAMENTO DOS EXERCÍCIOS ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exercicio_atual = $_POST['exercicio'] ?? 'home';
    switch ($exercicio_atual) {
        case '1_conversor_moedas': processarConversorMoedas(); break;
        case '2_area_perimetro': processarAreaPerimetro(); break;
        case '3_consumo_combustivel': processarConsumoCombustivel(); break;
    }
}

function processarConversorMoedas() {
    global $dados_form, $resultado, $erros;
    $dados_form['reais'] = $_POST['reais'] ?? '';
    $dados_form['cotacao'] = $_POST['cotacao'] ?? '';
    if (validarFloat($dados_form['reais'], 'Reais') && validarFloat($dados_form['cotacao'], 'Cotação')) {
        $reais = floatval(str_replace(',', '.', $dados_form['reais']));
        $cotacao = floatval(str_replace(',', '.', $dados_form['cotacao']));
        $dolares = $reais / $cotacao;
        $resultado = "<strong>R$ " . number_format($reais, 2, ',', '.') . " equivalem a US$ " . number_format($dolares, 2, ',', '.') . "</strong>";
    }
}

function processarAreaPerimetro() {
    global $dados_form, $resultado, $erros;
    $dados_form['base'] = $_POST['base'] ?? '';
    $dados_form['altura'] = $_POST['altura'] ?? '';
    if (validarFloat($dados_form['base'], 'Base') && validarFloat($dados_form['altura'], 'Altura')) {
        $base = floatval(str_replace(',', '.', $dados_form['base']));
        $altura = floatval(str_replace(',', '.', $dados_form['altura']));
        $area = $base * $altura;
        $perimetro = 2 * ($base + $altura);
        $resultado = "<strong>Área:</strong> " . number_format($area, 2, ',', '.') . " m² | <strong>Perímetro:</strong> " . number_format($perimetro, 2, ',', '.') . " m";
    }
}

function processarConsumoCombustivel() {
    global $dados_form, $resultado, $erros;
    $dados_form['distancia'] = $_POST['distancia'] ?? '';
    $dados_form['combustivel'] = $_POST['combustivel'] ?? '';
    if (validarFloat($dados_form['distancia'], 'Distância') && validarFloat($dados_form['combustivel'], 'Combustível')) {
        $distancia = floatval(str_replace(',', '.', $dados_form['distancia']));
        $combustivel = floatval(str_replace(',', '.', $dados_form['combustivel']));
        $consumo = $distancia / $combustivel;
        $resultado = "<strong>Consumo médio:</strong> " . number_format($consumo, 2, ',', '.') . " Km/L";
    }
}

function validarFloat($valor, $campo, $min = 0.01) {
    global $erros;
    if (empty(trim($valor))) { $erros[] = "$campo é obrigatório."; return false; }
    $valor_float = str_replace(',', '.', trim($valor));
    if (!is_numeric($valor_float) || floatval($valor_float) < $min) {
        $erros[] = "$campo inválido. Deve ser um número positivo."; return false;
    }
    return true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Portal de Exercícios PHP</title>
<style>
body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 1100px;
    margin: 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    overflow: hidden;
}

.header {
    background: #0077b6;
    color: white;
    text-align: center;
    padding: 30px;
}

.header h1 {
    font-size: 2em;
    margin: 0;
}

.header p {
    margin-top: 8px;
    opacity: 0.9;
}

.content {
    display: flex;
    min-height: 500px;
}

.sidebar {
    width: 280px;
    background: #f0f0f0;
    border-right: 1px solid #ddd;
    padding: 20px;
}

.sidebar h3 {
    color: #0077b6;
    font-size: 1.1em;
    margin-bottom: 15px;
    border-bottom: 2px solid #0077b6;
    padding-bottom: 5px;
}

.exercicio-link {
    display: block;
    background: white;
    color: #333;
    text-decoration: none;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 6px 0;
    transition: all 0.2s;
}

.exercicio-link:hover,
.exercicio-link.active {
    background: #0077b6;
    color: white;
}

.main-content {
    flex: 1;
    padding: 30px;
}

h2 {
    color: #0077b6;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.btn {
    background: #0077b6;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    transition: 0.3s;
}

.btn:hover {
    background: #005f88;
}

.resultado {
    background: #e0f7e9;
    border: 1px solid #b2dfbb;
    color: #1b5e20;
    padding: 15px;
    border-radius: 6px;
    margin-top: 20px;
}

.erro {
    background: #fdecea;
    border: 1px solid #f5c2c0;
    color: #a12622;
    padding: 15px;
    border-radius: 6px;
    margin-top: 20px;
}

.home {
    text-align: center;
    padding: 60px 20px;
}
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Portal de Exercícios PHP</h1>
        <p>Exercícios práticos para treinar lógica de programação</p>
    </div>
    <div class="content">
        <div class="sidebar">
            <h3>Algoritmos Sequenciais</h3>
            <a href="?exercicio=1_conversor_moedas" class="exercicio-link <?= $exercicio_atual=='1_conversor_moedas'?'active':'' ?>">Conversor de Moedas</a>
            <a href="?exercicio=2_area_perimetro" class="exercicio-link <?= $exercicio_atual=='2_area_perimetro'?'active':'' ?>">Área e Perímetro</a>
            <a href="?exercicio=3_consumo_combustivel" class="exercicio-link <?= $exercicio_atual=='3_consumo_combustivel'?'active':'' ?>">Consumo de Combustível</a>
        </div>

        <div class="main-content">
            <?php if ($exercicio_atual == 'home'): ?>
                <div class="home">
                    <h2>Bem-vindo!</h2>
                    <p>Escolha um exercício no menu ao lado para começar.</p>
                </div>
            <?php else: ?>
                <form method="post">
                    <input type="hidden" name="exercicio" value="<?= $exercicio_atual ?>">
                    <?php if ($exercicio_atual == '1_conversor_moedas'): ?>
                        <h2>Conversor de Moedas</h2>
                        <div class="form-group">
                            <label>Valor em Reais (R$):</label>
                            <input type="text" name="reais" class="form-control" value="<?= $dados_form['reais'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Cotação do Dólar:</label>
                            <input type="text" name="cotacao" class="form-control" value="<?= $dados_form['cotacao'] ?>">
                        </div>
                        <button class="btn">Converter</button>
                    <?php elseif ($exercicio_atual == '2_area_perimetro'): ?>
                        <h2>Área e Perímetro</h2>
                        <div class="form-group">
                            <label>Base (m):</label>
                            <input type="text" name="base" class="form-control" value="<?= $dados_form['base'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Altura (m):</label>
                            <input type="text" name="altura" class="form-control" value="<?= $dados_form['altura'] ?>">
                        </div>
                        <button class="btn">Calcular</button>
                    <?php elseif ($exercicio_atual == '3_consumo_combustivel'): ?>
                        <h2>Consumo de Combustível</h2>
                        <div class="form-group">
                            <label>Distância percorrida (Km):</label>
                            <input type="text" name="distancia" class="form-control" value="<?= $dados_form['distancia'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Combustível gasto (L):</label>
                            <input type="text" name="combustivel" class="form-control" value="<?= $dados_form['combustivel'] ?>">
                        </div>
                        <button class="btn">Calcular</button>
                    <?php endif; ?>
                </form>

                <?php if (!empty($erros)): ?>
                    <div class="erro">
                        <?= implode('<br>', $erros) ?>
                    </div>
                <?php elseif (!empty($resultado)): ?>
                    <div class="resultado"><?= $resultado ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
