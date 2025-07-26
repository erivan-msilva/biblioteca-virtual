<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Autor
class Autor extends Conexao
{
    //atributos
    private $id_autor;
    private $nome;

    //getters e setters
    public function getIdAutor()
    {
        return $this->id_autor;
    }

    public function setIdAutor($id_autor)
    {
        $this->id_autor = $id_autor;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    //método inserir Autor
    public function inserirAutor($nome_autor)
    {
        //setar os atributos
        $this->setNome($nome_autor);

        //montar query
        $sql = "INSERT INTO tb_autor (id_autor, nome) VALUES (NULL, :nome_autor)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':nome_autor', $this->getNome(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            //print "Inserido";
            return true;

        } catch (PDOException $e) {
            //print "Erro ao inserir";
            return false;
        }
    }

    //metodo consultar
    public function consultarAutor($nome_autor)
    {
        //setar os atributos
        $this->setNome($nome_autor);

        //montar query
        $sql = "SELECT * FROM tb_autor where true ";

        //vericar se o nome é nulo
        if ($this->getNome() != null) {
            $sql .= " and nome like :nome_autor ";
        }

        $sql .= " order by nome";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome_autor . "%");
                $query->bindValue(':nome_autor', $this->getNome(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar";
            return false;
        }

    }

    //método alterar Autor
    public function alterarAutor($id_autor, $nome_autor)
    {
        //setar os atributos
        $this->setIdAutor($id_autor);
        $this->setNome($nome_autor);

        //montar query
        $sql = "UPDATE tb_autor SET nome = :nome_autor WHERE id_autor = :id_autor";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_autor', $this->getIdAutor(), PDO::PARAM_INT);
            $query->bindValue(':nome_autor', $this->getNome(), PDO::PARAM_STR);
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

    //método excluir Autor
    public function excluirAutor($id_autor)
    {
        //setar os atributos
        $this->setIdAutor($id_autor);

        //montar query
        $sql = "DELETE FROM tb_autor WHERE id_autor = :id_autor";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_autor', $this->getIdAutor(), PDO::PARAM_INT);
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

    public function nomeAutorLivro($id_livro)
    {
        //montar query
        $sql = "SELECT ta.nome FROM tb_autor ta
                LEFT JOIN tb_livro_autor tla on ta.id_autor = tla.id_autor
                where tla.id_livro = :id_livro";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue('id_livro', $id_livro, PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar";
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
