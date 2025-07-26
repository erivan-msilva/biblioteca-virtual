<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title></title>
</head>

<body>
    <div class="container-fluid">
        <br>
        <form method="post" action="index.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" required name="titulo" class="form-control" id="titulo" placeholder="Digite o título do livro...">
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <?php $this->selectEditora(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <?php $this->selectGenero(); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" required name="preco" class="form-control" id="titulo" placeholder="Digite o preço do livro...">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <?php $this->selectAutor(); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Insira a imagem</label>
                <input class="form-control" type="file" id="imagem" name="imagem">
            </div>
        </div>
        <br>
        <button type="reset" class="btn btn-warning"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button type="submit" name="inserir_livro" class="btn btn-primary"><i class="bi bi-floppy"></i> Salvar</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
