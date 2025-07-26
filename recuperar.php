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
                <h1 class="mb-4">Recuperar Senha</h1>
            </div>
        </div>
        <form action="index.php" method="post">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <div class="input-group">
                        <input type="email" name="email" required class="form-control" placeholder="Informe seu e-mail...">
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="input-group">
                        <button type="submit" name="recuperar_senha" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
