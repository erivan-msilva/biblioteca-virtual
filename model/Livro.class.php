<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Livro
class Livro extends Conexao
{
    //atributos
    private $id_livro;
    private $preco;
    private $id_editora;
    private $id_genero;
    private $titulo;
    private $imagem;

    //getters e setters
    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($value)
    {
        $this->imagem = $value;
    }

    public function getIdLivro()
    {
        return $this->id_livro;
    }

    public function setIdLivro($value)
    {
        $this->id_livro = $value;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($value)
    {
        $this->preco = $value;
    }

    public function getIdEditora()
    {
        return $this->id_editora;
    }

    public function setIdEditora($value)
    {
        $this->id_editora = $value;
    }

    public function getIdGenero()
    {
        return $this->id_genero;
    }

    public function setIdGenero($value)
    {
        $this->id_genero = $value;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($value)
    {
        $this->titulo = $value;
    }

    //método inserir Livro
    public function inserirLivro($preco, $id_editora, $id_genero, $titulo, $autor, $imagem)
    {
        //setar os atributos
        $this->setPreco($preco);
        $this->setIdEditora($id_editora);
        $this->setIdGenero($id_genero);
        $this->setTitulo($titulo);
        $this->setImagem($imagem);

        //montar query
        $sql = "INSERT INTO tb_livro
        (id_livro,
        preco,
        id_genero,
        id_editora,
        titulo,
        imagem)
        VALUES
        (null,
        :preco,
        :id_genero,
        :id_editora,
        :titulo,
        :imagem)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':preco', $this->getPreco(), PDO::PARAM_STR);
            $query->bindValue(':id_genero', $this->getIdGenero(), PDO::PARAM_INT);
            $query->bindValue(':id_editora', $this->getIdEditora(), PDO::PARAM_INT);
            $query->bindValue(':titulo', $this->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(':imagem', $this->getImagem(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Inserido";

            //ultimo id
            $id_livro = $bd->lastInsertId();
            //inserir autor livro
            for ($i = 0; $i < count($autor); $i++) {
                $this->inserirAutorLivro($autor[$i], $id_livro);
            }

            return true;

        } catch (PDOException $e) {
            //print "Erro ao inserir";
            return false;
        }
    }

    public function inserirAutorLivro($id_autor, $id_livro)
    {
        //setar os atributos
        $this->setIdLivro($id_livro);

        //montar query
        $sql = "INSERT INTO tb_livro_autor (id_livro, id_autor) VALUES (:id_livro, :id_autor)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_livro', $this->getIdLivro(), PDO::PARAM_INT);
            $query->bindValue(':id_autor', $id_autor, PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Autor livro inserido";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao inserir autor livro";
            return false;
        }

    }

    //metodo consultar
    public function consultarLivro($titulo, $id_genero)
    {
        //setar os atributos
        $this->setTitulo($titulo);
        $this->setIdGenero($id_genero);

        //montar query
        $sql = "select imagem, id_livro, preco, titulo, tg.descricao, te.nome, tg.id_genero, te.id_editora
                from tb_livro tl
                left join tb_editora te on tl.id_editora= te.id_editora
                left join tb_genero tg on tl.id_genero = tg.id_genero where true ";

        //vericar se o titulo é nulo
        if ($this->getTitulo() != null) {
            $sql .= " and titulo like :titulo";
        }

        //vericar se o id_genero é nulo
        if ($this->getIdGenero() != null) {
            $sql .= " and tg.id_genero = :id_genero ";
        }

        //ordenar a tabela
        $sql .= " order by titulo ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getTitulo() != null) {
                $this->setTitulo("%" . $titulo . "%");
                $query->bindValue(':titulo', $this->getTitulo(), PDO::PARAM_STR);
            }
            if ($this->getIdGenero() != null) {
                $query->bindValue(':id_genero', $this->getIdGenero(), PDO::PARAM_INT);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar".$e->getMessage();
            // dir();
            return false;
        }
    }

    //método alterarLivro
    public function alterarLivro($id_livro, $titulo)
    {
        //setar os atributos
        $this->setIdLivro($id_livro);
        $this->setTitulo($titulo);

        //montar query
        $sql = "UPDATE tb_livro SET titulo = :titulo WHERE id_livro = :id_livro";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_livro', $this->getIdLivro(), PDO::PARAM_INT);
            $query->bindValue(':titulo', $this->getTitulo(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Alterado";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao alterar";
            return false;
        }
    }

    //método excluir livro
    public function excluirLivro($id_livro)
    {
        //setar os atributos
        $this->setIdLivro($id_livro);

        //montar query
        $sql = "DELETE FROM tb_livro WHERE id_livro = :id_livro";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_livro', $this->getIdLivro(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Excluido";
            return true;

        } catch (PDOException $e) {
            // print "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }

    //metodo consultar Geral
    public function consultarGeral($palavra)
    {
        //montar query
        $sql = "select imagem, titulo, tg.descricao, te.nome from tb_livro tl
                left join tb_editora te on tl.id_editora= te.id_editora
                left join tb_genero tg on tl.id_genero = tg.id_genero
                where titulo LIKE :palavra or tg.descricao LIKE :palavra  or te.nome LIKE :palavra ";

        //ordenar a tabela
        $sql .= " order by titulo ";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':palavra', "%" . $palavra . "%", PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
           // print "Erro ao consultar" . $e->getMessage();
           // die();
            return false;
        }
    }
}

// //testar a classe
// $objAutor = new Autor();
// //inserir
// //$objAutor->inserirAutor('Maria Vai com as Outras');
// //consultar
// //$autores = $objAutor->consultarAutor('');
// //alterar
// //$objAutor->alterarAutor(1, "Pedro Dev");
// //excluir
// $objAutor->excluirAutor(12);

// //mostrar dados
// foreach ($autores as $key => $valor) {
//     print "id = {$valor->id_autor} / nome = {$valor->nome}";
//     print "<br>";
// }

// // //tabela
// // print '<table border="1">';
// // print '  <tr>';
// // print '   <td>ID</td>';
// // print '   <td>Nome</td>';
// // print '  </tr>';
// // foreach ($autores as $key => $valor) {
// //     print '  <tr>';
// //     print '   <td>' . $valor->id_autor . '</td>';
// //     print '   <td>' . $valor->nome . '</td>';
// //     print '  </tr>';
// // }
// // print '</table>';

// //select
// print '<select name="nome_autor">';
// foreach ($autores as $key => $valor) {
//     print '<option value="' . $valor->id_autor . '">' . $valor->nome . '</option>';
// }
// print '</select>';
