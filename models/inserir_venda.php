<?php
// Inclui o arquivo de conexão
include 'conexao.php';

// Verifica se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados enviados via POST
    $cod_venda = $_POST['cod_venda'];
    $cliente = $_POST['cliente'];
    $vendedor = $_POST['vendedor'];
    $descontos = $_POST['descontos'];
    $valor_total = $_POST['valor_total'];
    $valor_pago = $_POST['valor_pago'];
    $troco = $_POST['troco'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $cod_empresa = $_POST['cod_empresa'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $itens_tb = json_decode($_POST['itens_tb'], true);
    $tipo = $_POST['tipo'];
    $dinheiro = $_POST['dinheiro'];
    $pix = $_POST['pix'];
    $cartao = $_POST['cartao'];
    $vencimento = $_POST['data']; // Recebe a data de vencimento
    $taxa = $_POST['taxa'];
    $status = 'Á RECEBER'; 
    $favorecido = ''; 
    $documento = ''; 
    $descricao = ''; 

    // Conecta ao banco de dados
    $conn = conectarBanco();

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Prepara e executa as consultas SQL para inserção na tabela vendas e caixa
    $sql_vendas = "INSERT INTO vendas (cod_venda, tipo, cliente, produto, quantidade, categoria, cod_produto, valor_unitario, dinheiro, pix, cartao, taxa, vendedor, descontos, forma_pagamento, valor_total, valor_pago, troco, data, hora, cod_empresa, vencimento)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_vendas = $conn->prepare($sql_vendas);

    // Inserção de itens_tb na tabela vendas
    foreach ($itens_tb as $item) {
        $codigo_produto = $item['codigo_produto'];
        $cliente_item = $item['cliente_item'];
        $produto = $item['produto'];
        $quantidade = $item['quantidade'];
        $categoria = $item['categoria'];
        $valor_unitario = $item['valor_unitario'];
        $vendedor_item = $item['vendedor_item'];

        $stmt_vendas->bind_param("ssssssssssssssssssssss", $cod_venda, $tipo, $cliente_item, $produto, $quantidade, $categoria, $codigo_produto, $valor_unitario, $dinheiro, $pix, $cartao, $taxa, $vendedor_item, $descontos, $forma_pagamento, $valor_total, $valor_pago, $troco, $data, $hora, $cod_empresa, $vencimento);
        if (!$stmt_vendas->execute()) {
            echo "Erro ao inserir na tabela vendas: " . $conn->error;
        }
    }

    // Prepara e executa as consultas SQL para inserção na tabela caixa
    $sql_caixa = "INSERT INTO caixa (cod_venda, tipo, cliente, vendedor, desconto, forma_pagamento, valor_total, valor_pago, data, hora, dinheiro, pix, cartao, vencimento, taxa, cod_empresa, status, favorecido, documento, descricao)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt_caixa = $conn->prepare($sql_caixa);
    $stmt_caixa->bind_param("ssssssssssssssssssss", $cod_venda, $tipo, $cliente, $vendedor, $descontos, $forma_pagamento, $valor_total, $valor_pago, $data, $hora, $dinheiro, $pix, $cartao, $vencimento, $taxa, $cod_empresa, $status, $favorecido, $documento, $descricao);

    if ($stmt_caixa->execute()) {
        // Inserção na tabela caixa foi bem-sucedida
    } else {
        echo "Erro ao inserir na tabela caixa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt_vendas->close();
    $stmt_caixa->close();
    $conn->close();

    // Envia uma resposta de sucesso
    $response = array("message" => "Venda salva com sucesso!");
    echo json_encode($response);
} else {
    // Se o método da requisição não for POST, retorna um erro
    http_response_code(405);
    echo json_encode(array("message" => "Método não permitido"));
}

