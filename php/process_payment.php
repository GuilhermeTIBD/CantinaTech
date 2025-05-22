<?php
// Ativar a exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações do banco de dados
$servername = "127.0.0.1";
$username = "root";  // Ajuste conforme necessário
$password = "";      // Ajuste conforme necessário
$dbname = "checkoutDB";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['cardholder'];
$numero_cartao = $_POST['cardnumber'];
$validade = $_POST['date'];
$cvv = $_POST['verification'];
$total = $_POST['total'];
$metodo_pagamento = $_POST['payment'];

// Preparar e vincular
$stmt = $conn->prepare("INSERT INTO pedidos (nome, numero_cartao, validade, cvv, total, metodo_pagamento) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssds", $nome, $numero_cartao, $validade, $cvv, $total, $metodo_pagamento);

// Executar a query
if ($stmt->execute()) {
    echo "Pedido realizado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
header("Location: success_page.html");
exit();

?>
