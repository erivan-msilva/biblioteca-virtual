<?php
session_start();
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SGL</a>
        <form class="d-flex" action="login.php">
            <button type="subtmit" class="btn btn-warning">Entrar</button>
        </form>
    </div>
</nav>
    <div class="container">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <h1 class="mb-4">Bem-vindo à Livraria</h1>
            </div>
        </div>
        <form action="index.php" method="post">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <div class="input-group">
                        <input type="text" name="palavra" required class="form-control"
                            placeholder="Consulte pelo nome do livro, editora ou genero...">
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="input-group">
                        <button type="submit" name="consultar_geral" class="btn btn-primary"><i
                                class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <?php
            //verifica tem dados para mostrar
            if (empty($_SESSION['resultado'])) {
                print '<div class="row justify-content-center">';
                print 'Nenhum resultado encontrado!';
                print '</div>';
            }
            else {
                print '<br>';
                print '<table class="table table-hover">';
                print '     <thead>';
                print '       <tr>';
                print '         <th>#</th>';
                print '         <th>Título</th>';
                print '         <th>Editora</th>';
                print '         <th>Genero</th>';
                print '       </tr>';
                print '     </thead>';
                print ' <tbody>';
                //mostrar os resultados
                foreach ($_SESSION['resultado'] as $key => $valor) {
                    print '<tr>';
                    print '  <td scope="row"><img src="'.$valor->imagem.'" width="40px" height="40px"></td>';
                    print '  <td scope="row">' . $valor->titulo . '</td>';
                    print '  <td scope="row">' . $valor->nome . '</td>';
                    print '  <td scope="row">' . $valor->descricao . '</td>';
                    print '</tr>';
                }
                print ' </tbody>';
                print '</table>';
                $_SESSION['resultado']=null;
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
