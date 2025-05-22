<?php 
session_start();
include_once('config.php');

// Verificação de sessão
if ((!isset($_SESSION['RA']) == true) && (!isset($_SESSION['Digito']) == true)) {
    unset($_SESSION['RA']);
    unset($_SESSION['Digito']);
    header('Location: tela_cadastro.php');
    exit;
}

include_once('link_estoque.php');

// Captura o valor da pesquisa, se existir
$data = $_GET['search'] ?? '';
$sql = $data 
    ? "SELECT * FROM produtos WHERE id LIKE '%$data%' OR nome LIKE '%$data%' OR preco LIKE '%$data%' OR quantidade_estoque LIKE '%$data%'"
    : "SELECT * FROM produtos";

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #141e30, #243b55);
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .navbar-custom {
            background-color: #007bff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
            font-weight: bold;
        }
        .table-hover tbody tr:hover {
            background-color: #34495e;
            color: #fff;
        }
        .box-search {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .container {
            margin-top: 30px;
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        input[type="search"] {
            border-radius: 50px;
            border: 1px solid #007bff;
            padding: 10px 20px;
            width: 100%;
            max-width: 500px;
            background-color: #2c3e50;
            color: #ffffff;
            transition: box-shadow 0.3s ease;
        }
        input[type="search"]:focus {
            box-shadow: 0px 0px 5px 2px #007bff;
            outline: none;
        }
        .btn-search {
            margin-left: -40px;
            background-color: transparent;
            border: none;
            color: #007bff;
            transition: transform 0.2s ease;
        }
        .btn-search:hover {
            transform: scale(1.1);
            color: #ffffff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: transform 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .table {
            background-color: #2c3e50;
            border-radius: 8px;
        }
        .table th, .table td {
            color: #ffffff;
        }
        .navbar-custom .navbar-text .btn-light {
        color: #007bff;
        background-color: #ffffff;
        border-radius: 20px;
        margin-left: 10px;
        font-weight: bold;
        padding: 8px 15px;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-custom .navbar-text .btn-light:hover {
        background-color: #007bff;
        color: #ffffff;
        transform: scale(1.05);
    }

    .navbar-custom .navbar-text .btn-light:focus {
        outline: none;
        box-shadow: 0px 0px 5px 2px #007bff;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Estoque</a>
        <span class="navbar-text">
            <a href="gerenciamento.html" class="btn btn-light">Gerenciamento de Pagamentos</a>
            <a href="INICIOlogin.php" class="btn btn-light">Acesso ao Site</a>
            <a href="sistema.php" class="btn btn-light">Sistema de Alunos</a>
            <a href="tela_cadastro.php" class="btn btn-light">Tela de Login</a>
            <a href="tela_adm.html" class="btn btn-light">Voltar pra Tela Inicial</a>

            
           
        </span>
    </div>
</nav>

<div class="container">
    <h1 class="text-center">Acessou o sistema</h1>
    
    <div class="box-search">
        <input type="search" class="form-control" placeholder="Pesquisar..." id="pesquisar">
        <button onclick="searchData()" class="btn-search">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <table class="table mt-5 table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php 
while($user_data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$user_data['id']."</td>";
    echo "<td>".$user_data['nome']."</td>";
    echo "<td>".$user_data['preco']."</td>";
    echo "<td>".$user_data['quantidade_estoque']."</td>";
    echo "<td class='text-center'>
            <a class='btn btn-sm btn-primary me-2' href='tela_cadastro4.php?id={$user_data['id']}'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                </svg>
            </a>
            <a class='btn btn-sm btn-danger' href='delete2.php?id={$user_data['id']}'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                    <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.348a2.5 2.5 0 0 1-2.482 2.152H5.373a2.5 2.5 0 0 1-2.482-2.152L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1h6zM3.5 3h9l.5 7H3l.5-7z'/>
                </svg>
            </a>
          </td>";
    echo "</tr>";
}
?>

        </tbody>
    </table>
</div>

<script>
    document.getElementById('pesquisar').addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        const searchValue = document.getElementById('pesquisar').value;
        window.location.href = `link_estoque.php?search=${searchValue}`;
    }
    function searchData() {
    const searchValue = document.getElementById('pesquisar').value;
    window.location.href = `estoque.php?search=${searchValue}`;
}

</script>
</body>
</html>
