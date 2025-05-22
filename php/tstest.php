<?php
// Inclui a conexão com o banco de dados
include_once('link_estoque.php');

// Função para obter a conexão com o banco de dados
function getDatabaseConnection() {
    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'sistema_estoque';
    
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    return $conn;
}   

