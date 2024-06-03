<?php
class NavBar {
    public function __construct() {
    }

    public function render() {
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4e8db9;">
            <div class="container-fluid">      
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item me-3">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <img src="src/sales_sale_supermarket_stock_market_icon_153077.ico" alt="imagem inicio" width="35" height="35" class="d-inline-block align-text-center">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link active" aria-current="page" href="produtos.php">
                                <img src="src/shipping_products_22121.png" alt="imagem produtos" width="35" height="35" class="d-inline-block align-text-center">
                                Consulta de Produtos
                            </a>
                        </li>
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="src/Order_36735.png" alt="imagem movimentações" width="35" height="35" class="d-inline-block align-text-center">
                                Movimentações
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="historicodetransacoes.php">Histórico de Transações</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="venda.php">Pedido de Venda</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="compra.php">Pedido de Compra</a></li>
                            </ul>
                        </li>         
                    </ul>    
                </div>
                <form class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-light" type="submit">Buscar</button>
                </form> 
            </div>
        </nav>
        <?php
    }
}
?>