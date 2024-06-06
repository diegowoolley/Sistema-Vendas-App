<?php
include_once('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco(); // Utilize a função conectarBanco para obter a conexão

    $stmt = $conn->prepare("SELECT nome_fornecedor FROM cad_fornecedores WHERE nome_fornecedor LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row['nome_fornecedor'];
    }

    echo json_encode($clientes);

    $stmt->close();
    $conn->close();
}
?>
