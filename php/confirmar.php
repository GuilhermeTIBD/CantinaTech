<?php
session_start();

if (!isset($_SESSION['payment_id']) || !isset($_SESSION['pix_qr_code'])) {
    header('Location: index.php');
    exit();
}

$qr_code_base64 = $_SESSION['pix_qr_code'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pagamento</title>
</head>
<body>
    <h2>Escaneie o QR Code para pagar</h2>
    <img src="data:image/png;base64,<?php echo htmlspecialchars($qr_code_base64); ?>" alt="QR Code Pix">
    <p>Após o pagamento, você será redirecionado automaticamente.</p>

    <script type="text/javascript">
        setTimeout(function(){
            window.location.href = "pagamento_realizado.php";
        }, 20000); // Redireciona após 20 segundos
    </script>
</body>
</html>
