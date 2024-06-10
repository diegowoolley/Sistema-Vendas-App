<?php
include 'conexao.php';

$conn = conectarBanco();

$sql = "SELECT cod, nome FROM cad_empresas ORDER BY nome ASC";
$result = $conn->query($sql);

$nomesEmpresas = [];
$codigoEmpresas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $codigoEmpresas[$row["nome"]] = $row["cod"];
        $nomesEmpresas[] = $row["nome"];
    }
} else {
    echo "0 resultados";
}
$conn->close();

