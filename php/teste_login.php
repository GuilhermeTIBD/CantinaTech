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





class Usuario {
    private $conexao;
    private $RA;
    private $Digito;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function login($RA, $Digito) {
        $this->RA = $RA;
        $this->Digito = $Digito;

        if ($this->validarEntrada()) {
            $sql = "SELECT * FROM alunos WHERE RA = ? AND Digito = ?";
            $stmt = $this->conexao->prepare($sql);
            if ($stmt === false) {
                die('Erro na preparação da consulta: ' . $this->conexao->error);
            }
            if (!$stmt->bind_param("ss", $this->RA, $this->Digito)) {
                die('Erro no bind_param: ' . $stmt->error);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows < 1) {
                // Login não existe
                unset($_SESSION['RA']);
                unset($_SESSION['Digito']);
                header('Location: tela_cadastro.php');
                exit();
            } else {
                // Login existe
                $_SESSION['RA'] = $this->RA;
                $_SESSION['Digito'] = $this->Digito;

                // Pega o nome do usuário
                $row = $result->fetch_assoc();
                $_SESSION['Nome'] = $row['Nome'];

                if ($this->RA === '123' && $this->Digito === '1') {
                    // Redireciona o usuário especial
                    header('Location: tela_adm.html');
                } else {
                    // Redireciona os usuários comuns
                    header('Location: INICIOlogin.php');
                }
                exit();
            }

            $stmt->close();
        } else {
            // Não acessa
            header('Location: tela_cadastro.php');
            exit();
        }
    }

    private function validarEntrada() {
        return !empty($this->RA) && !empty($this->Digito);
    }
}

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    include_once('config.php');
    $usuario = new Usuario($conexao);
    $usuario->login($_POST['RA'], $_POST['Digito']);
}
?>
