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


    <div class="container">
        <h1 class="mt-5">Lista de Produtos</h1>
        <div style="overflow-x: auto;">
            <table class="table table-striped mt-3">
                <thead>
                    <tr class='text-center'>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Valor Unitário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'models/metodos.php';
                    listarprodutos(); ?>
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>