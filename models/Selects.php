<?php

/**
 * Selects[modela]<br/>
 * classe de selects 
 * @copyright (c) 2018, Guilherme da Silva Pedrazzi
 */
class Selects extends model
{
    //select que mostra a sigla do estado (UF)
    public function selectUf()
    {
        $ufselect = $this->pdo->prepare('SELECT * FROM estado');
        $ufselect->execute();
        $retorno = "";
        if($ufselect->errorCode() != "00000")
        {// Erro padrão do PDO
            $erro = "<b>Ops!</b><br/>Erro código: ";
            $erro .= implode(", ", $ufselect->errorInfo());
            $retorno = $erro;
        }
        else
        {
            foreach ($ufselect as $value) 
            {
                $uf = $value['uf'];
                $id = $value['id'];
                $retorno .= "<option value='$id'>$uf</option>";
            }
        }

        return $retorno;
    }

    //select que mostra o nome do estado
    public function selectEstado()
    {
        $ufselect = $this->pdo->prepare('SELECT * FROM estado');
        $ufselect->execute();        
        $retorno = "";

        if($ufselect->errorCode() != "00000")
        {// Erro padrão do PDO
            $erro = "<b>Ops!</b><br/>Erro código: ";
            $erro .= implode(", ", $ufselect->errorInfo());
            $retorno = $erro;
        }
        else
        {
            foreach ($ufselect as $value) 
            {
                $estado = $value['nome'];
                $id = $value['id'];
                $retorno .= "<option value='$id'>$estado</option>";
            }
        }
        
        return $retorno;
    }

    //select que mostra os pedintes
    public function selectPedinte()
    {
        $ufselect = $this->pdo->prepare('SELECT * FROM pedinte ORDER BY nome');
        $ufselect->execute();        
        $retorno = "<option disabled selected >Selecione...</option>";

        if($ufselect->errorCode() != "00000")
        {// Erro padrão do PDO
            $erro = "<b>Ops!</b><br/>Erro código: ";
            $erro .= implode(", ", $ufselect->errorInfo());
            $retorno = $erro;
        }
        else
        {
            foreach ($ufselect as $value) 
            {
                $nome = $value['nome'];
                $id = $value['id'];
                $retorno .= "<option value='$id'>$nome</option>";
            }
        }
        
        return $retorno;
    }

    //select que puxa cidades pelo uf (estado)
    public function selectCidadePorEstado($idUF) 
    {
        $retorno = "<option value='' disabled selected>Selecione...</option>";
        $comarca = $this->pdo->prepare('SELECT * FROM cidade WHERE estado = :id ORDER BY nome');
        $comarca->bindValue(':id',$idUF, PDO::PARAM_INT);
        $comarca->execute();

        if ($comarca->rowCount() > 0) 
        {
            foreach ($comarca as $value) 
            {
                $idComarca      = $value['id'];
                $nomeComarca    = $value['nome'];
                $retorno       .= "<option value='$idComarca'>$nomeComarca</option>";
            }
        }
        else
        {
            $retorno = "<option value='' disabled selected>Nenhuma cidade encontrada</option>";
        }
        return $retorno;
    }

    //function that bring options of users which the type is 1 in db
    public function selectUserTypeOne()
    {
        $retorno = "";
        $adv = $this->pdo->query('SELECT * FROM user_details WHERE type < 3 AND type > 0 AND id_user > 1');
        if ($adv->rowCount() > 0) 
        {
            foreach ($adv as $value) 
            {
                $iduser      = $value['id_user'];
                $nomeuser    = $value['name'];
                $retorno       .= "<option value='$iduser'>$nomeuser</option>";
            }
        }
        else
        {
            $retorno = "<option value='' disabled selected>Nenhum usuário encontrado</option>";
        }
        return $retorno;
    }

}


?>