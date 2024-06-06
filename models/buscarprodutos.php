<?php
include_once('conexao.php');

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco();

    $stmt = $conn->prepare("SELECT * FROM cad_produtos WHERE nome_produto LIKE ? LIMIT 10");
    $searchTerm = "%" . $term . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $produtos = [];
    while ($row = $result->fetch_assoc()) {
        
        $produtos[] = $row['nome_produto'];         
           
    }
    
    echo json_encode($produtos);

    $stmt->close();
    $conn->close();
}
?>