<?php
session_start();
if (!isset($_SESSION['payment_id'])) {
    header('Location: index.php');
    exit();
}

// Limpa os dados de sessão após a confirmação
unset($_SESSION['payment_id']);
unset($_SESSION['pix_qr_code']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamento Realizado</title>
</head>
<body>
    <h2>Pagamento realizado com sucesso!</h2>
    <p>Obrigado por seu pagamento.</p>
</body>
</html>
