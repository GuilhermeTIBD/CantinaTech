<?php
require_once('config.php');

// Função para obter o token OAuth2
function obterToken() {
    $url = URL_OAUTH;
    
    $data = array(
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'grant_type' => 'client_credentials'
    );

    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        die('Erro ao obter o token de acesso.');
    }

    $response = json_decode($result, true);
    return $response['access_token'];
}

// Função para gerar uma cobrança via Pix
function gerarCobrancaPix($token, $valor, $descricao) {
    $url = URL_COBRANCA_PIX;
    
    $data = array(
        'calendario' => array(
            'expiracao' => 3600 // 1 hora para expirar o QR Code
        ),
        'devedor' => array(
            'cpf' => '12345678909', // CPF do pagador
            'nome' => 'Nome do Cliente'
        ),
        'valor' => array(
            'original' => number_format($valor, 2, '.', '') // Valor em formato correto
        ),
        'chave' => PIX_CHAVE, // Sua chave Pix
        'solicitacaoPagador' => $descricao // Descrição da cobrança
    );
    
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n" .
                        "Authorization: Bearer " . $token . "\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        die('Erro ao gerar cobrança via Pix.');
    }

    $response = json_decode($result, true);
    return $response['location']; // Retorna o link do QR Code
}
?>
