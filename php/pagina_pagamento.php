<?php
session_start();

// Verifica se o total foi passado
if (isset($_GET['total'])) {
    $total = $_GET['total']; // Pega o total do carrinho
} else {
    // Se não, redireciona de volta
    header('Location: loja.php'); // Substitua "loja.php" pelo nome correto da sua página de loja
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
</head>
<body>
    <h1>Página de Pagamento</h1>
    <p>Total a pagar: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
    <!-- Aqui você pode incluir o formulário de pagamento do Mercado Pago -->
</body>
</html>
