<?php


function vendashoje()
{
    include 'models/conexao.php';
    $conn = conectarBanco(); // Conecta ao banco de dados

    global $codigoEmpresaGlobal;

    $sql = "SELECT * FROM caixa WHERE cod_empresa = ? AND (tipo = 'VENDA' OR tipo = 'VENDA PDV' OR tipo = 'ORDEM DE SERVIÇO') AND data = CURDATE()";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Vincula o parâmetro
    $stmt->bind_param("i", $codigoEmpresaGlobal); // "i" indica que é um parâmetro inteiro

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibe os dados na tabela
        while ($row = $result->fetch_assoc()) {
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
    include 'models/conexao.php';
    $conn = conectarBanco(); // Conecta ao banco de dados

    global $codigoEmpresaGlobal;

    // Consulta SQL para listar os produtos da empresa específica
    $sql = "SELECT * FROM cad_produtos WHERE cod_empresa = ?";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Vincula o parâmetro
    $stmt->bind_param("i", $codigoEmpresaGlobal); // "i" indica que é um parâmetro inteiro

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados
    $result = $stmt->get_result();

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Exibe os dados na tabela
        while ($row = $result->fetch_assoc()) {
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

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}


function listartransacoes()
{
    include 'models/conexao.php';

    global $codigoEmpresaGlobal;

    $conn = conectarBanco(); // Conecta ao banco de dados

    $sql = "SELECT cod_venda, tipo, cliente, vendedor, valor_pago, valor_total, forma_pagamento, desconto, taxa, status 
            FROM caixa 
            WHERE cod_empresa = ? 
            AND DATE(data) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Vincula o parâmetro
    $stmt->bind_param("i", $codigoEmpresaGlobal); // "i" indica que é um parâmetro inteiro

    // Executa a consulta
    $stmt->execute();

    // Obtém os resultados
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibe os dados na tabela
        while ($row = $result->fetch_assoc()) {
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

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}

// Função para verificar se o usuário está autenticado
function verificarAutenticacao()
{
    // Inicia a sessão
    session_start();
    // Verifica se a sessão do usuário está ativa
    if (!isset($_SESSION['usuario'])) {
        // Se não estiver, redireciona o usuário de volta para a página de login
        header("Location: login.php");
        exit;
    }
}

function fazerLogout()
{
    // Inicie ou retome a sessão
    session_start();

    // Remova todas as variáveis de sessão
    $_SESSION = array();

    // Destrua a sessão
    session_destroy();

    // Redirecione para a página de login
    header("Location: ../login.php");
    exit;
}

// Verifica se a ação de logout foi solicitada
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    fazerLogout();
}

function buscarProdutos()
{
    global $codigoEmpresaGlobal;

    include 'models/conexao.php';
    $con = conectarBanco();
    echo "<script>document.getElementById('tb_produto').innerHTML = 
        <div style='overflow-x: auto;'>
            <table class='table table-primary table-striped mt-3 table table-hover table-bordered table-sm'; 
                id='tb_produto'>
                <thead>
                    <tr class='text-center'>
                        <th scope='col'>Código</th>
                        <th scope='col'>Descrição</th>
                        <th scope='col'>Categoria</th>
                        <th scope='col'>Valor Unitário</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </script>";
    if (isset($_GET['buscarprodutos'])) {
        $pesquisa = mysqli_real_escape_string($con, $_GET['buscarprodutos']); // Escapa a string de busca
        $sql = "SELECT * FROM cad_produtos WHERE cod_empresa = '{$codigoEmpresaGlobal}' AND (cod_produto LIKE '%" . $pesquisa . "%' OR nome_produto LIKE '%" . $pesquisa . "%')";
        $sql_query = $con->query($sql) or die("Erro ao Consultar: " . $con->error); // Executa a consulta SQL

        if ($sql_query->num_rows > 0) {
            // Loop através dos resultados
            while ($row = $sql_query->fetch_assoc()) {
                echo "<tr class='text-center'>";
                echo "<td>" . $row["cod_produto"] . "</td>";
                echo "<td>" . $row["nome_produto"] . "</td>";
                echo "<td>" . $row["categoria_produto"] . "</td>";
                echo "<td>R$ " . number_format($row["valor_venda"], 2, ',', '.') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum registro encontrado.</td></tr>";
        }
    }
}


function buscarTransacoes()
{
    global $codigoEmpresaGlobal;

    include 'models/conexao.php';
    $con = conectarBanco();
    echo "<script>document.getElementById('tb_produto').innerHTML = 
    <div style='overflow-x: auto;'>
        <table class='table table-primary table-striped mt-3 table table-hover table-bordered table-sm'; 
            id='tb_produto'>
            <thead>
                <tr class='text-center'>
                    <th scope='col'>Cód. Venda</th>
                    <th scope='col'>Tipo</th>
                    <th scope='col'>Cliente</th>
                    <th scope='col'>Vendedor</th>
                    <th scope='col'>Valor Pago</th>
                    <th scope='col'>Valor Total</th>                   
                    <th scope='col'>Forma de Pagamento</th>
                    <th scope='col'>Desconto</th>
                    <th scope='col'>Taxa</th>
                    <th scope='col'>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</script>";
    if (isset($_GET['buscartransacoes'])) {
        $pesquisa = mysqli_real_escape_string($con, $_GET['buscartransacoes']); // Escapa a string de busca
        $sql = "SELECT * FROM caixa WHERE cod_empresa = '{$codigoEmpresaGlobal}' AND (cod_venda LIKE '%" . $pesquisa . "%' OR cliente LIKE '%" . $pesquisa . "%')";
        $sql_query = $con->query($sql) or die("Erro ao Consultar: " . $con->error); // Executa a consulta SQL

        if ($sql_query->num_rows > 0) {
            // Loop através dos resultados

            while ($row = $sql_query->fetch_assoc()) {
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
            echo "<tr><td colspan='10'>Nenhum registro encontrado.</td></tr>";
        }
    }
}

function buscarvendas()
{
    include 'models/conexao.php';
    $con = conectarBanco();
    echo "<script>document.getElementById('tb_produto').innerHTML = 
    <div style='overflow-x: auto;'>
        <table class='table table-primary table-striped mt-3 table table-hover table-bordered table-sm'; 
            id='tb_produto'>
            <thead>
                <tr class='text-center'>
                    <th scope='col'>Cód. Venda</th>
                    <th scope='col'>Tipo</th>
                    <th scope='col'>Cliente</th>
                    <th scope='col'>Vendedor</th>
                    <th scope='col'>Valor Pago</th>
                    <th scope='col'>Valor Total</th>                   
                    <th scope='col'>Forma de Pagamento</th>
                    <th scope='col'>Desconto</th>
                    <th scope='col'>Taxa</th>
                    <th scope='col'>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</script>";
    if (isset($_GET['buscarvendas'])) {
        $pesquisa = mysqli_real_escape_string($con, $_GET['buscarvendas']); // Escapa a string de busca
        $sql = "SELECT * FROM caixa WHERE (tipo = 'VENDA' OR tipo = 'VENDA PDV' OR tipo = 'ORDEM DE SERVIÇO') AND cod_venda LIKE '%" . $pesquisa . "%' AND data = CURDATE()";
        $sql_query = $con->query($sql) or die("Erro ao Consultar: " . $con->error); // Executa a consulta SQL

        if ($sql_query->num_rows > 0) {
            // Loop através dos resultados

            while ($row = $sql_query->fetch_assoc()) {
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
            echo "<tr><td colspan='9'>Nenhum registro encontrado.</td></tr>";
        }
    }
}
