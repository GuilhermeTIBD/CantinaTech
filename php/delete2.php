<?php
include 'estoque.php'; // Inclui o arquivo de configuração do banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }
    if (!$stmt->bind_param("s", $id)) {
        die('Erro na vinculação dos parâmetros: ' . $stmt->error);
    }
    if ($stmt->execute()) {
        header('Location: estoque.php');
        exit();
    } else {
        echo "Erro ao excluir aluno: " . $stmt->error;
    }
    $stmt->close();
} else {
    header('Location: sistema.php');
    exit();
}
?>
