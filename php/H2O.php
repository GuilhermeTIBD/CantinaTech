<?php
// Inclui a conexão com o banco de dados
include_once('link_estoque.php');

// Obtém a conexão com o banco de dados
$conn = getDatabaseConnection();

// ID do produto que você quer verificar
$id = 14;

// Consulta para obter a quantidade do produto e o preço
$sql = "SELECT quantidade_estoque, preco FROM produtos WHERE id = $id";
$result = $conn->query($sql);

// Verifica se o produto existe no banco de dados
if ($result->num_rows > 0) {
    // Obter os valores da quantidade e do preço
    $row = $result->fetch_assoc();
    $quantidade = $row['quantidade_estoque'];
    $preco = $row['preco'];

    // Exibir os valores obtidos
    // echo "<p style='color: white;'>R$$preco</p>";
    if ($quantidade > 1) {
        echo "<p style='color: green;'>Tem estoque</p>";
    } else {
        echo "<p style='color: red;'>Não tem estoque</p>";
    }
} else {
    echo "<p>Produto não encontrado.</p>";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
