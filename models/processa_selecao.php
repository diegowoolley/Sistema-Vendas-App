<?php
session_start();
include 'conexao.php';

$conn = conectarBanco();

if (isset($_POST['cbempresa'])) {
    $nomeEmpresa = $_POST['cbempresa'];

    $sql = "SELECT cod FROM cad_empresas WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nomeEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codigoEmpresa = $row['cod'];

        $_SESSION['codigoEmpresa'] = $codigoEmpresa;
        $_SESSION['nomeEmpresa'] = $nomeEmpresa;

        // Redireciona para index.php
        header("Location: ../index.php");
        exit();
    } else {
        echo "Empresa não encontrada.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Nenhuma empresa selecionada.";
}
?>