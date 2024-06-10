<?php
// Inclui o arquivo que contém as funções de autenticação
include_once ('models/metodos.php');

// Chamada da função para verificar autenticação
verificarAutenticacao();
?>


<?php

if (isset($_SESSION['codigoEmpresa']) && isset($_SESSION['nomeEmpresa'])) {
  $codigoEmpresa = $_SESSION['codigoEmpresa'];
  $nomeEmpresa = $_SESSION['nomeEmpresa'];

  // Definindo variáveis globais
  $GLOBALS['codigoEmpresaGlobal'] = $codigoEmpresa;
  $GLOBALS['nomeEmpresaGlobal'] = $nomeEmpresa;

  //echo "Código da Empresa Selecionada: " . htmlspecialchars($codigoEmpresa) . "<br>";
  //echo "Nome da Empresa Selecionada: " . htmlspecialchars($nomeEmpresa) . "<br>";
} else {
  echo "Nenhuma empresa foi selecionada.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>DW Sistemas</title>
</head>

<body>
    <?php
    include 'models/navbar.php'; // Inclua a classe NavBar 
    $navBar = new NavBar(); // Instancie a classe NavBar
    
    // Renderize a barra de navegação
    $navBar->render();


    ?>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: linear-gradient(to bottom, #00008B, #87CEEB);
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            font-size: 0.9em;
        }
    </style>


    <form class="d-flex ms-auto me-2 mt-1" style="width: 35rem;">
        <input name="buscarprodutos" class="form-control me-2" type="search" placeholder="Buscar Produtos"
            aria-label="Buscar">
        <button class="btn btn-sm btn-light" type="submit">
            <img src="src/lupa.png" alt="lupa" width="30" height="30">
        </button>
    </form>

    <div class="container">
        <h4 class="mt-3 text-white">Lista de Produtos</h4>
        <div style="overflow-x: auto;">
            <table class="table table-primary table-striped mt-3 table table-hover table-bordered table-sm"
                id="tb_produto">
                <thead>
                    <tr class='text-center'>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Valor Unitário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once ('models/metodos.php');

                    if (isset($_GET['buscarprodutos']) && $_GET['buscarprodutos'] !== '') {
                        buscarProdutos();
                    } else {
                        listarprodutos();
                    }
                    ;

                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="models/scripts.js"></script>

</body>

</html>