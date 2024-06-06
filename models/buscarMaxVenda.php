<?php
include_once ('conexao.php'); // Inclua o arquivo que contém a função conectarBanco

// Conecta ao banco de dados
$conn = conectarBanco();

// Consulta para buscar o máximo de vendas
$sql = "SELECT MAX(cod_venda) FROM vendas";

// Executa a consulta
$result = mysqli_query($conn, $sql);

// Verifica se há resultados
if ($result) {
    // Obtém o resultado da consulta
    $row = mysqli_fetch_row($result);

    // Verifica se o resultado é válido
    if ($row && isset($row[0])) {
        // Retorna o máximo de vendas encontrado
        echo $row[0];
    } else {
        // Se não houver resultados, retorna 0
        echo 0;
    }
} else {
    // Se houver um erro na consulta, retorna uma mensagem de erro
    echo "Erro na consulta: " . mysqli_error($conn);
}

// Fecha a conexão
mysqli_close($conn);
?>