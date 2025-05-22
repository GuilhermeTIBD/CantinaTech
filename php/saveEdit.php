<?php 
   include_once('config.php');

   if(isset($_POST['update']))
   {
    $Nome = $_POST['Nome'];
    $RA = $_POST['RA'];
    $Digito = $_POST['Digito'];

    $sqlUpdate = "UPDATE alunos SET Nome='$Nome', RA='$RA', Digito='$Digito'
    WHERE RA='$RA' ";

    $result = $conexao->query($sqlUpdate);

   }
   header('Location: sistema.php');

?>