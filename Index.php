<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DW Sistemas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>  
<?php
include 'models/navbar.php'; // Inclua a classe NavBar

$navBar = new NavBar(); // Instancie a classe NavBar

// Renderize a barra de navegação
$navBar->render();
?>


<div class="container">
  <h1 class="mt-5">Vendas Hoje</h1>  
  <div style="overflow-x: auto;">
    <table class="table table-striped mt-3">
      <thead>
        <tr class='text-center'>
          <th scope="col">Código da Venda</th>
          <th scope="col">Cliente</th>
          <th scope="col">Vendedor</th>        
          <th scope="col">Total Pago</th>
          <th scope="col">Valor Total</th>
          <th scope="col">Forma de Pagamento</th>
          <th scope="col">Desconto</th>
          <th scope="col">Taxa</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
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
        ?>
      </tbody>
    </table>
  </div>
</div>


       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
