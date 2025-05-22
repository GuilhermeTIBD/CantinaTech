<?php 
   include_once('estoque.php');

   if(isset($_POST['update']))
   {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade_estoque = $_POST['quantidade_estoque'];

    $sqlUpdate = "UPDATE produtos SET id='$id', nome='$nome', preco='$preco', quantidade_estoque='$quantidade_estoque'
    WHERE id='$id' ";

    $result = $conexao->query($sqlUpdate);

   }
   header('Location: estoque.php');

?>