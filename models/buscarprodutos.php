<?php
session_start(); // Iniciar sessão
include_once('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco(); // Utilize a função conectarBanco para obter a conexão

    // Verifique se a variável de sessão está definida
    if (isset($_SESSION['codigoEmpresa'])) {
        $codigoEmpresa = $_SESSION['codigoEmpresa'];

        // Adicione a condição cod_empresa = ?
        $stmt = $conn->prepare("SELECT nome_produto FROM cad_produtos WHERE nome_produto LIKE ? AND cod_empresa = ? LIMIT 10");
        
        // Adicione o valor de $codigoEmpresa para bind_param
        $searchTerm = "%" . $term . "%";
        $stmt->bind_param("si", $searchTerm, $codigoEmpresa); // 's' para string, 'i' para inteiro
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
    } else {
        // Se a variável de sessão 'codigoEmpresa' não estiver definida, retorna uma mensagem de erro
        echo json_encode(array("error" => "Empresa não encontrada"));
    }

    $conn->close();
}



