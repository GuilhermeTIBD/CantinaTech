<?php
session_start();
require 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer está incluído

// Defina o token de acesso (use o token de sandbox ou produção conforme o ambiente)
MercadoPago\SDK::setAccessToken('TEST-3878087002182328-053113-c82ff4b07b13b09f8e19e0efd217730e');

// Criar uma nova preferência de pagamento
$preference = new MercadoPago\Preference();

// Criar um item de exemplo para a preferência
$item = new MercadoPago\Item();
$item->title = 'Produto Exemplo';
$item->quantity = 1;
$item->unit_price = 150.00; // Valor do produto em reais

// Atribuir o item à preferência
$preference->items = array($item);

// Salvar a preferência no MercadoPago
$preference->save();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar com Mercado Pago</title>
</head>
<body>
    <h1>Finalizar Pagamento</h1>

    <!-- Botão de pagamento que redireciona para o link de pagamento gerado pelo MercadoPago -->
    <a href="<?php echo $preference->init_point; ?>" target="_blank">Pagar com Mercado Pago</a>
</body>
</html>
