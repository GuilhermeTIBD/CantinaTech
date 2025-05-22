<?php
require_once('funcoes.php');

// Obtendo o token OAuth2
$token = obterToken();

// Definindo o valor e a descrição da cobrança
$valor = 100.00; // Valor da cobrança
$descricao = "Pagamento de Serviço";

// Gerando a cobrança via Pix
$linkQRCode = gerarCobrancaPix($token, $valor, $descricao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento Banco Inter</title>
</head>
<body>
    <h1>Pagamento via Pix</h1>
    <p>Valor a pagar: R$ <?php echo number_format($valor, 2, ',', '.'); ?></p>
    <p>Descrição: <?php echo $descricao; ?></p>
    <p><a href="<?php echo $linkQRCode; ?>" target="_blank">Clique aqui para pagar via Pix</a></p>

    <p>Ou escaneie o QR Code abaixo:</p>
    <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=<?php echo urlencode($linkQRCode); ?>" alt="QR Code">
</body>
</html>
