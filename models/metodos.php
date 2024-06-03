<?php


function vendashoje() {
    include 'models/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

    $conn = conectarBanco(); // Conecta ao banco de dados

    $sql = "SELECT cod_venda, cliente, vendedor, valor_pago, valor_total, forma_pagamento, desconto, taxa, status FROM caixa WHERE (tipo = 'VENDA' OR tipo = 'VENDA PDV' OR tipo = 'ORDEM DE SERVIÇO') AND data = CURDATE()";
    $result = $conn->query($sql); // Executa a consulta SQL

    if ($result->num_rows > 0) {
        // Exibe os dados na tabela
        while($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . $row['cod_venda'] . "</td>";
            echo "<td>" . $row['cliente'] . "</td>";
            echo "<td>" . $row['vendedor'] . "</td>";
            echo "<td>R$ " . number_format($row['valor_pago'], 2, ',', '.') . "</td>";
            echo "<td>R$ " . number_format($row['valor_total'], 2, ',', '.') . "</td>";
            echo "<td>" . $row['forma_pagamento'] . "</td>";
            echo "<td>" . $row['desconto'] . "</td>";
            echo "<td>" . $row['taxa'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>Nenhum registro encontrado</td></tr>";
    }
    $conn->close(); // Fecha a conexão com o banco de dados
}



function listarprodutos() 
{
    include 'models/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

    $conn = conectarBanco(); // Conecta ao banco de dados

    $sql = "SELECT cod_produto, nome_produto, categoria_produto, valor_venda FROM cad_produtos";
    $result = $conn->query($sql); // Executa a consulta SQL

    if ($result->num_rows > 0) {
        // Exibe os dados na tabela
        while($row = $result->fetch_assoc()) {
            echo "<tr class='text-center'>";
            echo "<td>" . $row['cod_produto'] . "</td>";
            echo "<td>" . $row['nome_produto'] . "</td>";
            echo "<td>" . $row['categoria_produto'] . "</td>";
            echo "<td>R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum registro encontrado</td></tr>";
    }
    $conn->close(); // Fecha a conexão com o banco de dados
}
          


function listartrasaçoes(){
   
        include 'models/conexao.php'; // Inclui o arquivo de conexão com o banco de dados

        $conn = conectarBanco(); // Conecta ao banco de dados

        $sql = "SELECT cod_venda, tipo, cliente, vendedor, valor_pago, valor_total, forma_pagamento, desconto, taxa, status FROM caixa WHERE DATE(data) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

        $result = $conn->query($sql); // Executa a consulta SQL

        if ($result->num_rows > 0) {
            // Exibe os dados na tabela
            while($row = $result->fetch_assoc()) {
                echo "<tr class='text-center'>";
                echo "<td>" . $row['cod_venda'] . "</td>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "<td>" . $row['cliente'] . "</td>";
                echo "<td>" . $row['vendedor'] . "</td>";
                echo "<td>R$ " . number_format($row['valor_pago'], 2, ',', '.') . "</td>";
                echo "<td>R$ " . number_format($row['valor_total'], 2, ',', '.') . "</td>";
                echo "<td>" . $row['forma_pagamento'] . "</td>";
                echo "<td>" . $row['desconto'] . "</td>";
                echo "<td>" . $row['taxa'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Nenhum registro encontrado</td></tr>";
        }
        $conn->close(); // Fecha a conexão com o banco de dados
  
}


?>
