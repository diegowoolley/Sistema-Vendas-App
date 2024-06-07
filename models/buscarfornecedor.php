<?php
include_once ('conexao.php');

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco();

    $stmt = $conn->prepare("SELECT nome_fornecedor FROM cad_fornecedores WHERE nome_fornecedor LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row['nome_fornecedor'];
    }

    if (count($clientes) > 0) {
        // Se foram encontrados clientes, retorna os nomes dos clientes
        echo json_encode($clientes);
    } else {
        // Se nenhum cliente foi encontrado, retorna uma mensagem indicando que nenhum cliente foi encontrado
        echo json_encode(array("error" => "Nenhum fornecedor encontrado"));
    }

    $stmt->close();
    $conn->close();
}
