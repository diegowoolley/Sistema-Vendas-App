<?php
session_start(); // Iniciar sessão
include_once ('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco(); // Utilize a função conectarBanco para obter a conexão

    // Verifique se a variável de sessão está definida
    if (isset($_SESSION['codigoEmpresa'])) {
        $codigoEmpresa = $_SESSION['codigoEmpresa'];

        // Adicione a condição cod_empresa = ?
        $stmt = $conn->prepare("SELECT nome_fornecedor FROM cad_fornecedores WHERE nome_fornecedor LIKE ? AND cod_empresa = ? LIMIT 10");

        // Adicione o valor de $codigoEmpresa para bind_param
        $searchTerm = "%" . $term . "%";
        $stmt->bind_param("si", $searchTerm, $codigoEmpresa); // 's' para string, 'i' para inteiro
        $stmt->execute();
        $result = $stmt->get_result();

        $fornecedores = [];
        while ($row = $result->fetch_assoc()) {
            $fornecedores[] = $row['nome_fornecedor'];
        }

        if (count($fornecedores) > 0) {
            // Se foram encontrados fornecedores, retorna os nomes dos fornecedores
            echo json_encode($fornecedores);
        } else {
            // Se nenhum fornecedor foi encontrado, retorna uma mensagem indicando que nenhum fornecedor foi encontrado
            echo json_encode(array("error" => "Nenhum fornecedor encontrado"));
        }

        $stmt->close();
    } else {
        // Se a variável de sessão 'codigoEmpresa' não estiver definida, retorna uma mensagem de erro
        echo json_encode(array("error" => "Empresa não encontrada"));
    }

    $conn->close();
}
?>