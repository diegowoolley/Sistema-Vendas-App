<?php
include 'conexao.php';

$conn = conectarBanco();

// Dados recebidos via POST
$cod_venda = $_POST['cod_venda'];
$tipo = $_POST['tipo'];
$cliente = $_POST['cliente'];
$vendedor = $_POST['vendedor'];
$desconto = $_POST['desconto'];
$forma_pagamento = $_POST['forma_pagamento'];
$valor_total = $_POST['valor_total'];
$valor_pago = $_POST['valor_pago'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$dinheiro = $_POST['dinheiro'];
$pix = $_POST['pix'];
$cartao = $_POST['cartao'];
$vencimento = $_POST['vencimento'];
$taxa = $_POST['taxa'];
$cod_empresa = $_POST['cod_empresa'];
$status = $_POST['status'];
$favorecido = $_POST['favorecido'];
$documento = $_POST['documento'];
$descricao = $_POST['descricao'];

// SQL para inserir dados na tabela caixa
$sql = "INSERT INTO caixa (cod_venda, tipo, cliente, vendedor, desconto, forma_pagamento, valor_total, valor_pago, data, hora, dinheiro, pix, cartao, vencimento, taxa, cod_empresa, status, favorecido, documento, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssss", $cod_venda, $tipo, $cliente, $vendedor, $desconto, $forma_pagamento, $valor_total, $valor_pago, $data, $hora, $dinheiro, $pix, $cartao, $vencimento, $taxa, $cod_empresa, $status, $favorecido, $documento, $descricao);

if ($stmt->execute()) {
    echo "Novo registro no caixa inserido com sucesso.";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
