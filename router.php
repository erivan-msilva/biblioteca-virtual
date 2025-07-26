<?php
//pegar a url
$url = explode('?', $_SERVER['REQUEST_URI']);
//escolher na variável $url do link desejado
$pagina = $url[1];

#ROTAS DE REDIRECIONAMENTO
//redirecionar para pagina informada
if (isset($pagina)) {
    $objController = new Controller();
    $objController->redirecionar($pagina);
}

#ROTAS DE ACAO
//verificar o botao login foi acionado
if (isset($_POST['login'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método de validar
    $objController->validar($email, $senha);
}

//recuperar_senha
if (isset($_POST['recuperar_senha'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    //invocar o método recuperar senha
    $objController->recuperarSenha($email);
}

#AUTOR

//inserir autor
if (isset($_POST['inserir_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método de inserir_autor
    $objController->inserir_autor($nome_autor);
}

//consultar consultar_autor
if (isset($_POST['consultar_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método de consultar_autor
    $objController->consultar_autor($nome_autor);
}

//excluir_autor
if (isset($_POST['excluir_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_autor = htmlspecialchars($_POST['id_autor']);
    //invocar o método de excluir_autor
    $objController->excluir_autor($id_autor);
}

//alterar_autor
if (isset($_POST['alterar_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_autor = htmlspecialchars($_POST['id_autor']);
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método de alterar_autor
    $objController->alterar_autor($id_autor, $nome_autor);
}

#EDITORA
//inserir_editora
if (isset($_POST['inserir_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método de _editora
    $objController->inserir_editora($nome_editora);
}

//consultar_editora
if (isset($_POST['consultar_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método de consultar_editora
    $objController->consultar_editora($nome_editora);
}

//excluir_editora
if (isset($_POST['excluir_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_editora = htmlspecialchars($_POST['id_editora']);
    //invocar o método de excluir_autor
    $objController->excluir_editora($id_editora);
}

//alterar_editora
if (isset($_POST['alterar_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_editora = htmlspecialchars($_POST['id_editora']);
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método de alterar_editora
    $objController->alterar_editora($id_editora, $nome_editora);
}

#GENERO
//inserir_genero
if (isset($_POST['inserir_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $descricao_genero = htmlspecialchars($_POST['descricao_genero']);
    //invocar o método de _editora
    $objController->inserir_genero($descricao_genero);
}

#LIVRO
//inserir_livro
if (isset($_POST['inserir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_editora = htmlspecialchars($_POST['id_editora']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    $preco = htmlspecialchars($_POST['preco']);
    //aautores do livro
    $autor = $_POST['autor'];
    //imagem do livro
    $imagem = $_FILES['imagem'];
    //invocar o método de inserir_livro
    $objController->inserir_livro($preco, $id_editora, $id_genero, $titulo, $autor, $imagem);
}

//consultar_livro
if (isset($_POST['consultar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    //invocar o método de consultar_livro
    $objController->consultar_livro($titulo, $id_genero);
}

//excluir_livro
if (isset($_POST['excluir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    //invocar o método de excluir_livro
    $objController->excluir_livro($id_livro);
}

//alterar_livro
if (isset($_POST['alterar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    $titulo = htmlspecialchars($_POST['titulo']);
    //invocar o método alterar_livro
    $objController->alterar_livro($id_livro, $titulo);
}

//consultar_geral
if (isset($_POST['consultar_geral'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $palavra = htmlspecialchars($_POST['palavra']);
    //invocar o método alterar_livro
    $objController->consultar_geral($palavra);
}

//gerar_pdf
if (isset($_POST['gerar_pdf'])) {
    //instanciar controller
    $objController = new Controller();
    //invocar o método gerar pdf
    $objController->gerar_pdf();
}
