<?php
include_once('conexao.php');

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco();

    $stmt = $conn->prepare("SELECT cod_produto, nome_produto, categoria_produto, valor_venda FROM cad_produtos WHERE nome_produto LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $produtos = [];
    while ($row = $result->fetch_assoc()) {
        // Adiciona os detalhes do produto ao array de produtos
        $produto = array(
            'cod_produto' => $row['cod_produto'],
            'nome_produto' => $row['nome_produto'],
            'categoria_produto' => $row['categoria_produto'],
            'valor_venda' => $row['valor_venda']
        );
        $produtos[] = $produto;
    }

    // Retorna os produtos encontrados como JSON
    echo json_encode($produtos);

    $stmt->close();
    $conn->close();
}
