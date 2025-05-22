<?php 
session_start();
include_once('config.php');
//print_r($_SESSION);
if((!isset($_SESSION['RA']) == true) and (!isset ($_SESSION['Digito']) == true))
{
    unset($_SESSION['RA']);
    unset($_SESSION['Digito']);
    header('Location: tela_cadastro.php');
}
$logado = $_SESSION['RA'];

if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    $sql = "SELECT * FROM alunos WHERE Nome LIKE '%$data%' or RA LIKE '%$data%' or Digito LIKE '%$data%'";
}
else
{
   $sql = "SELECT * FROM alunos ";
}




