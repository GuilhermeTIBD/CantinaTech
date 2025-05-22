<?php 
//para não acessar pela URL
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

 if(!empty($_GET['RA']))
 {

   include_once('config.php');

   $RA = $_GET['RA'];

   $sqlSelect = "SELECT * FROM alunos WHERE RA=$RA";

   $result = $conexao->query($sqlSelect);

   if($result->num_rows > 0)
{
    while($user_data = mysqli_fetch_assoc($result))
    {
        $Nome = $user_data['Nome'];
        $RA = $user_data['RA'];
        $Digito = $user_data['Digito'];
    }
    //print_r($Nome);
}
else
{
     header('Location: sistema.php');
}

 
 }

?>
<style>
        body { 
         background: linear-gradient(135deg, #1e1e1e, #2b2b2b); 
         color: #f4f4f4;
         text-align: center; 
         padding: 50px; 
         display: flex; 
         justify-content: center;
         align-items: center; 
         height: 100vh;
         overflow: hidden;
         margin: 0; /* Remove a margem padrão do body */
         box-sizing: border-box; /* Define o box-sizing para incluir padding e borda no tamanho total dos elementos */
   }
.container {
  text-align: center; /* Centraliza o texto dentro do container */
  position: relative; /* Define a posição como relativa para suportar o pseudo-elemento */
  display: flex; /* Define o container como flexível */
  justify-content: center; /* Alinha os itens no centro horizontalmente */
  align-items: center; /* Alinha os itens no centro verticalmente */
  flex-direction: column; /* Alinha os itens na vertical */
}

.container::before {
  content: ''; /* Adiciona um conteúdo vazio para o pseudo-elemento */
  position: absolute; /* Define a posição como absoluta para permitir que o pseudo-elemento ocupe todo o espaço do container */
  top: -20px; /* Posiciona o elemento 20px acima do container */
  left: -20px; /* Posiciona o elemento 20px à esquerda do container */
  right: -20px; /* Posiciona o elemento 20px à direita do container */
  bottom: -20px; /* Posiciona o elemento 20px abaixo do container */
  background: radial-gradient(circle, rgba(243, 156, 18, 0.15) 20%, transparent 40%); /* Define um gradiente radial com uma cor amarela esmaecida */
  filter: blur(50px); /* Aplica um efeito de desfoque */
  z-index: 0; /* Define a ordem de empilhamento para que o pseudo-elemento fique atrás do conteúdo */
  opacity: 0.8; /* Define a opacidade do pseudo-elemento */
  
}

.input {
  background-color:#24ff99; /* Define a cor de fundo como verde escuro */
  color: black; /* Define a cor do texto*/
  border: none; /* Remove a borda padrão */
  padding: 16px 0px; /* Define o espaçamento interno do botão */
  cursor: pointer; /* Altera o cursor para um ponteiro ao passar o mouse */
  border-radius: 10px; /* Arredonda as bordas do botão */
  transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s; /* Define animações de transição */
  width: 200px; /* Aumenta a largura do botão */
  height: 50px;
  outline: none;
  cursor: pointer;
  font-weight: 800;
  box-shadow: 0px 10px 40px -12px #00ff8052;
}

.input:hover {
  background-color: #00FA9A; /* Altera a cor de fundo para um verde mais escuro ao passar o mouse */
  transform: translateY(-2px); /* Aplica um efeito de elevação ao passar o mouse */
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.7); /* Aumenta a sombra ao passar o mouse */
}

.btn-container {
  display: flex; /* Define o container como flexível */
  flex-direction: column; /* Alinha os itens na vertical */
  align-items: center; /* Centraliza os itens horizontalmente */
}

.btn-container a {
  text-decoration: none; /* Remove a decoração do texto nos links */
  margin: 10px 0; /* Define uma margem vertical entre os links */
}

h1 {
  color: #24ff99; /* Define a cor do texto do h1 (tom verde claro) */
  font-family: 'Arial', sans-serif; /* Define a fonte como Arial */
  margin-bottom: 20px; /* Define uma margem inferior */
}
.card-login > h1 {
  color: #24ff99; /* Define a cor do texto como verde claro */
  font-weight: 700; /* Define o peso da fonte como grosso */
  margin: 0; /* Remove a margem */
}
.card-login {
  width: 60%; /* Define a largura como 60% do container */
  display: flex; /* Define o container como flexível */
  justify-content: center; /* Centraliza os itens horizontalmente */
  align-items: center; /* Centraliza os itens verticalmente */
  flex-direction: column; /* Alinha os itens na vertical */
  padding: 30px 35px; /* Define o espaçamento interno */
  background: #2f2841; /* Define uma cor de fundo escura */
  border-radius: 20px; /* Arredonda as bordas */
  box-shadow: 0px 10px 40px #00000056; /* Adiciona uma sombra ao cartão */
}


.main-login {
  width: 100vw; /* Define a largura como 100% da largura da viewport */
  height: 100vh; /* Define a altura como 100% da altura da viewport */
  background: #201b2c; /* Define uma cor de fundo escura */
  display: flex; /* Define o container como flexível */
  justify-content: center; /* Centraliza os itens horizontalmente */
  align-items: center; /* Centraliza os itens verticalmente */
}

.left-login {
  width: 50vw; /* Define a largura como metade da viewport */
  height: 100vh; /* Define a altura como a altura da viewport */
  display: flex; /* Define o container como flexível */
  justify-content: center; /* Centraliza os itens horizontalmente */
  align-items: center; /* Centraliza os itens verticalmente */
  flex-direction: column; /* Alinha os itens na vertical */
}

.left-login-image {
  width: 50vw; /* Define a largura da imagem como metade da viewport */
}

.right-login {
  width: 50vw; /* Define a largura como metade da viewport */
  height: 100vh; /* Define a altura como a altura da viewport */
  display: flex; /* Define o container como flexível */
  justify-content: center; /* Centraliza os itens horizontalmente */
  align-items: center; /* Centraliza os itens verticalmente */
}

.textfield {
  width: 100%; /* Define a largura como 100% */
  display: flex; /* Define o container como flexível */
  flex-direction: column; /* Alinha os itens na vertical */
  align-items: flex-start; /* Alinha os itens à esquerda */
  justify-content: center; /* Centraliza os itens verticalmente */
  margin: 10px 0px; /* Define uma margem vertical */
}

.textfield > input {
  width: 100%; /* Define a largura como 100% */
  border: none; /* Remove a borda */
  border-radius: 10px; /* Arredonda as bordas */
  padding: 15px; /* Define o espaçamento interno */
  background: #514869; /* Define uma cor de fundo escura */
  color: #f7fbfbde; /* Define a cor do texto */
  font-size: 12pt; /* Define o tamanho da fonte */
  box-shadow: 0px 10px 40px #00000056; /* Adiciona uma sombra ao campo de texto */
  outline: none; /* Remove o contorno padrão */
  box-sizing: border-box; /* Inclui padding e borda no tamanho total */
}

.textfield > label {
  color: #f0ffffde; /* Define a cor do texto */
  margin-bottom: 10px; /* Define uma margem inferior */
}

.textfield > input::placeholder {
  color: #f0ffff94; /* Define a cor do texto do placeholder */
}

@media only screen and (max-width: 950px) {
  .card-login {
    width: 85%; /* Ajusta a largura do cartão em telas menores */
  }
}

@media only screen and (max-width: 600px) {
  .main-login {
    flex-direction: column; /* Alinha os itens na vertical em telas menores */
  }
  .left-login {
    width: 100%; /* Define a largura como 100% em telas menores */
    height: auto; /* Ajusta a altura automaticamente */
  }
  .right-login {
    width: 100%; /* Define a largura como 100% em telas menores */
    height: auto; /* Ajusta a altura automaticamente */
  }
  .card-login {
    width: 90%; /* Ajusta a largura do cartão em telas muito pequenas */
  }
}




    </style>
   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tela_cadastro1.css">
    <title>Login</title>
</head>
<body>
    <div class="main-login">
        <div clas="left-login">
       <center> <h1>EDITAR <br> 
       </h1></center>
        <img src="img/Slide1__1_-removebg-preview.png" class="left-login-image"  alt="logo">
        </div>
        <div class="right-login">
          <div class="card-login">

        

            <h1>EDITAR</h1>              

                <form action="saveEdit.php" method="POST">
            <div class="textfield">
        <label for="usuario">Nome</label>
        <input type="text" name="Nome" placeholder="Nome" value = "<?php echo $Nome ?>">

        <div class="textfield">
            <label for="Digito">Senha</label>
            <input type="text" name="Digito" placeholder="Digito" value = "<?php echo $Digito ?>">
            </div>

            <div class="textfield">
        <label for="usuario">RA</label>
        <input type="text" name="RA" placeholder="RA" value = "<?php echo $RA ?>">
        <br>

            <input type="hidden" name="RA" value="<?php echo $RA?>">
           <input class="inputSubmit"  type="submit" name="update" value="Enviar">
        
           <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

        
        </input>
        </div>
        </div>
        </div>
        </form>
        
</body>
</html>