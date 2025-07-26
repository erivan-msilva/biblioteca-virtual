<?php
//incluir classe conexao
include_once 'Conexao.class.php';

//classe Editora
class Editora extends Conexao
{
    //atributos
    private $id_editora;
    private $nome;

    //getters e setters
    public function getIdEditora()
    {
        return $this->id_editora;
    }

    public function setIdEditora($id_editora)
    {
        $this->id_editora = $id_editora;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    //método inserir Editora
    public function inserirEditora($nome_editora)
    {
        //setar os atributos
        $this->setNome($nome_editora);

        //montar query
        $sql = "INSERT INTO tb_editora (id_editora, nome) VALUES (NULL, :nome)";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
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
    public function consultarEditora($nome_editora)
    {
        //setar os atributos
        $this->setNome($nome_editora);

        //montar query
        $sql = "SELECT * FROM tb_editora where true ";

        //vericar se o nome é nulo
        if ($this->getNome() != null) {
            $sql .= " and nome like :nome";
        }

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome_editora . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
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

    //método alterar Editora
    public function alterarEditora($id_editora, $nome_editora)
    {
        //setar os atributos
        $this->setIdEditora($id_editora);
        $this->setNome($nome_editora);

        //montar query
        $sql = "UPDATE tb_editora SET nome = :nome WHERE id_editora = :id_editora";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_editora', $this->getIdEditora(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
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

    //método excluir Editora
    public function excluirEditora($id_editora)
    {
        //setar os atributos
        $this->setIdEditora($id_editora);

        //montar query
        $sql = "DELETE FROM tb_editora WHERE id_editora = :id_editora";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_editora', $this->getIdEditora(), PDO::PARAM_INT);
            //excutar a query
            $query->execute();
            //retorna o resultado
            print "Excluido";
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
