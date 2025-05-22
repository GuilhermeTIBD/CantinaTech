// Função para ir para o pagamento
function irParaPagamento() {
    // Calcular o total do carrinho
    let total = carrinho.reduce((acc, item) => acc + item.preco, 0);
    // Redirecionar para a página de pagamento com o valor total como parâmetro de consulta na URL
    window.location.href = `pagamento.html?total=${total}`;
}
