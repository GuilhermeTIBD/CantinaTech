<?php 
session_start();
include_once('config.php');

if(!isset($_SESSION['RA']) || !isset($_SESSION['Digito'])) {
    unset($_SESSION['RA']);
    unset($_SESSION['Digito']);
    header('Location: tela_cadastro.php');
}

$logado = $_SESSION['RA'];

// Verifica a página atual e calcula o offset
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$limite = 20;  // Número de registros por página
$offset = ($pagina - 1) * $limite;

// Pesquisa por alunos
$searchQuery = "";
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $data = $_GET['search'];
    $searchQuery = "WHERE Nome LIKE '%$data%' OR RA LIKE '%$data%' OR Digito LIKE '%$data%'";
}

// Contagem total de registros
$sqlTotal = "SELECT COUNT(*) AS total FROM alunos $searchQuery";
$resultTotal = $conexao->query($sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$totalRegistros = $rowTotal['total'];

// Calcula o total de páginas
$totalPaginas = ceil($totalRegistros / $limite);

// Consulta com paginação
$sql = "SELECT * FROM alunos $searchQuery LIMIT $limite OFFSET $offset";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
 
</a>
        </span>
    </div>
</nav>
<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema de Alunos</a>
        <span class="navbar-text">
            <a href="gerenciamento.html" class="btn btn-light">Gerenciamento de Pagamentos</a>
            <a href="INICIOlogin.php" class="btn btn-light">Acesso ao Site</a>
            <a href="estoque.php" class="btn btn-light">Estoque</a>
            <a href="tela_cadastro.php" class="btn btn-light">Tela de Login</a>
            <a href="tela_adm.html" class="btn btn-light">Voltar pra Tela Inicial</a>
            
           
        </span>
    </div>
</nav>

<div class="container">
    <div class="box-search">
        <input type="search" class="form-control" placeholder="Pesquisar por nome" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary ms-2">
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
                <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0'/>
            </svg>
        </button>
    </div>

    <table class="table table-striped table-hover mt-3">
        <thead class="table-primary">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Dígito</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$user_data['Nome']."</td>";
                echo "<td>".$user_data['RA']."</td>";
                echo "<td>".$user_data['Digito']."</td>";
                echo "<td class='text-center'>
                        <a class='btn btn-sm btn-primary me-2' href='tela_cadastro3.php?RA=$user_data[RA]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                            </svg>
                        </a>
                        <a class='btn btn-sm btn-danger' href='delete.php?RA=$user_data[RA]'>
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

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php if($pagina > 1): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina - 1; ?><?php echo isset($data) ? '&search=' . $data : ''; ?>">Anterior</a></li>
            <?php endif; ?>
            <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php echo ($i == $pagina) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?><?php echo isset($data) ? '&search=' . $data : ''; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if($pagina < $totalPaginas): ?>
                <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1; ?><?php echo isset($data) ? '&search=' . $data : ''; ?>">Próximo</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script>
function searchData() {
    var data = document.getElementById('pesquisar').value;
    window.location.href = '?search=' + data;
}
</script>

</body>
</html>
