<?php
include_once('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco(); // Utilize a função conectarBanco para obter a conexão

    $stmt = $conn->prepare("SELECT nome_produto FROM cad_produtos WHERE nome_produto LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $produtos = [];
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row['nome_produto'];
    }    
    
    if (count($produtos) > 0) {
        // Se foram encontrados produtos, retorna os nomes dos produtos
        echo json_encode($produtos);
    } else {
        // Se nenhum produto foi encontrado, retorna uma mensagem indicando que nenhum produto foi encontrado
        echo json_encode(array("error" => "Nenhum produto encontrado"));
    }

    $stmt->close();
    $conn->close();
}
?>
