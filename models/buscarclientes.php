<?php
session_start(); // Iniciar sessão
include_once('conexao.php');

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $conn = conectarBanco();

    // Verifique se a variável de sessão está definida
    if (isset($_SESSION['codigoEmpresa'])) {
        $codigoEmpresa = $_SESSION['codigoEmpresa'];

        // Adicione a condição cod_empresa = ?
        $stmt = $conn->prepare("SELECT nome_clientes FROM cad_clientes WHERE nome_clientes LIKE ? AND cod_empresa = ? LIMIT 10");

        // Adicione o valor de $codigoEmpresa para bind_param
        $searchTerm = "%" . $term . "%";
        $stmt->bind_param("si", $searchTerm, $codigoEmpresa); // 's' para string, 'i' para inteiro
        $stmt->execute();
        $result = $stmt->get_result();

        $clientes = [];
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row['nome_clientes'];
        }

        if (count($clientes) > 0) {
            // Se foram encontrados clientes, retorna os nomes dos clientes
            echo json_encode($clientes);
        } else {
            // Se nenhum cliente foi encontrado, retorna uma mensagem indicando que nenhum cliente foi encontrado
            echo json_encode(array("error" => "Nenhum cliente encontrado"));
        }

        $stmt->close();
    } else {
        // Se a variável de sessão 'codigoEmpresa' não estiver definida, retorna uma mensagem de erro
        echo json_encode(array("error" => "Empresa não encontrada"));
    }

    $conn->close();
}
