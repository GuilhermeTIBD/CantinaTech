<?php
include 'config.php'; // Inclui o arquivo de configuração do banco de dados

if (isset($_GET['RA'])) {
    $RA = $_GET['RA'];

    $sql = "DELETE FROM alunos WHERE RA = ?";
    $stmt = $conexao->prepare($sql);
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error);
    }
    if (!$stmt->bind_param("s", $RA)) {
        die('Erro na vinculação dos parâmetros: ' . $stmt->error);
    }
    if ($stmt->execute()) {
        header('Location: sistema.php');
        exit();
    } else {
        echo "Erro ao excluir aluno: " . $stmt->error;
    }
    $stmt->close();
} else {
    header('Location: link_estoque.php');
    exit();
}
?>
