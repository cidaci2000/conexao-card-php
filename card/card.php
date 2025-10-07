<?php
// 1. Inclui o arquivo de conexão
require_once 'conexao.php';

// Verifica se o formulário de compra foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comprar'])) {
    
    // Obtém e sanitiza os dados do formulário
    $id_produto = $conexao->real_escape_string($_POST['id_produto']);
    $nome_produto = $conexao->real_escape_string($_POST['nome_produto']);
    $preco = $conexao->real_escape_string($_POST['preco']);
    $quantidade = $conexao->real_escape_string($_POST['quantidade']);

    // 2. Query de Inserção
    $sql_insert = "INSERT INTO compras_usuario (id_produto, nome_produto, preco, quantidade) 
                   VALUES ('$id_produto', '$nome_produto', '$preco', '$quantidade')";

    // 3. Executa a query
    if ($conexao->query($sql_insert) === TRUE) {
        $mensagem_status = "Produto **$nome_produto** comprado com sucesso!";
        $classe_status = "sucesso";
    } else {
        $mensagem_status = "Erro ao registrar a compra: " . $conexao->error;
        $classe_status = "erro";
    }
}

// Dados de Exemplo para o Card (em um sistema real, viriam do banco de dados)
$produto_card = [
    'id' => 42,
    'nome' => 'Camisa Geek Dev',
    'preco' => 69.90,
    'descricao' => 'Uma camisa perfeita para codificar com estilo.',
];

// Fecha a conexão (boa prática)
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Card de Produto</title>
    <style>
        .card { border: 1px solid #ccc; padding: 20px; width: 300px; margin: 50px auto; box-shadow: 2px 2px 5px #aaa; }
        .sucesso { color: green; font-weight: bold; }
        .erro { color: red; font-weight: bold; }
        input[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <?php if (isset($mensagem_status)): ?>
        <p class="<?= $classe_status; ?>"><?= $mensagem_status; ?></p>
    <?php endif; ?>

    <div class="card">
        <h2><?= $produto_card['nome']; ?></h2>
        <p><strong>Preço:</strong> R$ <?= number_format($produto_card['preco'], 2, ',', '.'); ?></p>
        <p><?= $produto_card['descricao']; ?></p>

        <form method="POST" action="">
            <input type="hidden" name="id_produto" value="<?= $produto_card['id']; ?>">
            <input type="hidden" name="nome_produto" value="<?= $produto_card['nome']; ?>">
            <input type="hidden" name="preco" value="<?= $produto_card['preco']; ?>">
            
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" value="1" min="1" required><br><br>

            <input type="submit" name="comprar" value="Comprar Agora">
        </form>
    </div>

</body>
</html>