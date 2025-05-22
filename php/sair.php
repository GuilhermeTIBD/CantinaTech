<?php 
session_start();
 unset($_SESSION['RA']);
 unset($_SESSION['Digito']);
 header("Location: tela_cadastro.php");
?>