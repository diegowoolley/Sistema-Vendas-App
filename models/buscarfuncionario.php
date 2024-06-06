<?php
include_once('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco(); // Utilize a função conectarBanco para obter a conexão

    $stmt = $conn->prepare("SELECT nome_funcionario FROM cad_funcionarios WHERE nome_funcionario LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $clientes = [];
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row['nome_funcionario'];
    }    
    
    if (count($clientes) > 0) {
        // Se foram encontrados clientes, retorna os nomes dos clientes
        echo json_encode($clientes);
    } else {
        // Se nenhum cliente foi encontrado, retorna uma mensagem indicando que nenhum cliente foi encontrado
        echo json_encode(array("error" => "Nenhum vendedor encontrado"));
    }

    $stmt->close();
    $conn->close();
}
?>
