<?php
include 'conexao.php';

$conn = conectarBanco();

// Dados recebidos via POST
$cod_venda = $_POST['cod_venda'];
$tipo = $_POST['tipo'];
$cliente = $_POST['cliente'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$categoria = $_POST['categoria'];
$cod_produto = $_POST['cod_produto'];
$valor_unitario = $_POST['valor_unitario'];
$dinheiro = $_POST['dinheiro'];
$pix = $_POST['pix'];
$cartao = $_POST['cartao'];
$vencimento = $_POST['vencimento'];
$taxa = $_POST['taxa'];
$vendedor = $_POST['vendedor'];
$descontos = $_POST['descontos'];
$forma_pagamento = $_POST['forma_pagamento'];
$valor_total = $_POST['valor_total'];
$valor_pago = $_POST['valor_pago'];
$troco = $_POST['troco'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$cod_empresa = $_POST['cod_empresa'];

// SQL para inserir dados na tabela vendas
$sql = "INSERT INTO vendas (cod_venda, tipo, cliente, produto, quantidade, categoria, cod_produto, valor_unitario, dinheiro, pix, cartao, vencimento, taxa, vendedor, descontos, forma_pagamento, valor_total, valor_pago, troco, data, hora, cod_empresa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssss", $cod_venda, $tipo, $cliente, $produto, $quantidade, $categoria, $cod_produto, $valor_unitario, $dinheiro, $pix, $cartao, $vencimento, $taxa, $vendedor, $descontos, $forma_pagamento, $valor_total, $valor_pago, $troco, $data, $hora, $cod_empresa);

if ($stmt->execute()) {
    echo "Nova venda inserida com sucesso.";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>