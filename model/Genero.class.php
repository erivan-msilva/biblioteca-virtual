<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Editora
class Genero extends Conexao
{
    //atributos
    private $id_genero;
    private $descricao;

    //getters e setters
    public function getIdGenero()
    {
        return $this->id_genero;
    }

    public function setIdGenero($id_genero)
    {
        $this->id_genero = $id_genero;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    //método inserir Genero
    public function inserirGenero($descricao_genero)
    {
        //setar os atributos
        $this->setDescricao($descricao_genero);

        //montar query
        $sql = "INSERT INTO tb_genero (id_genero, descricao) VALUES (NULL, :descricao_genero)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':descricao_genero', $this->getDescricao(), PDO::PARAM_STR);
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

    //metodo consultar Genero
    public function consultarGenero($descricao_genero)
    {
        //setar os atributos
        $this->setDescricao($descricao_genero);

        //montar query
        $sql = "SELECT * FROM tb_genero where true ";

        //vericar se o nome é nulo
        if ($this->getDescricao() != null) {
            $sql .= " and descricao like :descricao_genero";
        }

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getDescricao() != null) {
                $this->setDescricao("%" . $descricao_genero . "%");
                $query->bindValue(':descricao_genero', $this->getDescricao(), PDO::PARAM_STR);
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

    //método alterar Genero
    public function alterarGenero($id_genero, $descricao_genero)
    {
        //setar os atributos
        $this->setIdGenero($id_genero);
        $this->setDescricao($descricao_genero);

        //montar query
        $sql = "UPDATE tb_genero SET descricao = :descricao_genero WHERE id_genero = :id_genero";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_genero', $this->getIdGenero(), PDO::PARAM_INT);
            $query->bindValue(':descricao_genero', $this->getDescricao(), PDO::PARAM_STR);
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

    //método excluir Genero
    public function excluirGenero($id_genero)
    {
        //setar os atributos
        $this->setIdGenero($id_genero);

        //montar query
        $sql = "DELETE FROM tb_genero WHERE id_genero = :id_genero";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_genero', $this->getIdGenero(), PDO::PARAM_INT);
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
}

// //testar a classe
// $objEditora = new Editora();
// //inserir
// //$objEditora->inserirEditora('Maria Vai com as Outras');
// //consultar
// //$Editoraes = $objEditora->consultarEditora('');
// //alterar
// //$objEditora->alterarEditora(1, "Pedro Dev");
// //excluir
// $objEditora->excluirEditora(12);

// //mostrar dados
// foreach ($Editoraes as $key => $valor) {
//     print "id = {$valor->id_editora} / nome = {$valor->nome}";
//     print "<br>";
// }

// // //tabela
// // print '<table border="1">';
// // print '  <tr>';
// // print '   <td>ID</td>';
// // print '   <td>Nome</td>';
// // print '  </tr>';
// // foreach ($Editoraes as $key => $valor) {
// //     print '  <tr>';
// //     print '   <td>' . $valor->id_editora . '</td>';
// //     print '   <td>' . $valor->nome . '</td>';
// //     print '  </tr>';
// // }
// // print '</table>';

// //select
// print '<select name="nome_editora">';
// foreach ($Editoraes as $key => $valor) {
//     print '<option value="' . $valor->id_editora . '">' . $valor->nome . '</option>';
// }
// print '</select>';
