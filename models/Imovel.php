<?php 
/**
 * Model do Imóvel
 */
class Imovel extends model
{
	//Atributos
	public $lastID;

	// ADICIONAR IMOVEL
    public function adicionarImovel($arr)
    {
        $this->pdo->beginTransaction(); //start transaction

        $query = "INSERT INTO imovel (data_cadastro ";
        $value = "VALUES (:data_cadastro ";
        $bind = '$sql->bindValue(":data_cadastro","'.date("Y-m-d").'"); ';

        // DADOS DO IMOVEL

        if(isset($arr['tipo']) && !empty($arr['tipo']))
        {
            $query .= ",tipo";
            $value .= ",:tipo";
            $bind .= '$sql->bindValue(":tipo","'.$arr['tipo'].'"); ';
        }

        if(isset($arr['metros_quadrados']) && !empty($arr['metros_quadrados']))
        {
            $query .= ",metros_quadrados";
            $value .= ",:metros_quadrados";
            $bind .= '$sql->bindValue(":metros_quadrados","'.$arr['metros_quadrados'].'"); ';
        }

        if(isset($arr['quartos']) && !empty($arr['quartos']))
        {
            $query .= ",quartos";
            $value .= ",:quartos";
            $bind .= '$sql->bindValue(":quartos","'.$arr['quartos'].'"); ';
        }

        if(isset($arr['banheiros']) && !empty($arr['banheiros']))
        {
            $query .= ",banheiros";
            $value .= ",:banheiros";
            $bind .= '$sql->bindValue(":banheiros","'.$arr['banheiros'].'"); ';
        }

        if(isset($arr['vagas_garagem']) && !empty($arr['vagas_garagem']))
        {
            $query .= ",vagas_garagem";
            $value .= ",:vagas_garagem";
            $bind .= '$sql->bindValue(":vagas_garagem","'.$arr['vagas_garagem'].'"); ';
        }

        // if(isset($arr['descricao']) && !empty($arr['descricao']))
        // {
        //     $query .= ",descricao";
        //     $value .= ",:descricao";
        //     $bind .= '$sql->bindValue(":descricao","'.addslashes(strip_tags($arr['descricao'])).'"); ';
        // }

        // ENDEREÇO

        if(isset($arr['estado_endereco']) && !empty($arr['estado_endereco']))
        {
            $query .= ",estado_endereco";
            $value .= ",:estado_endereco";
            $bind .= '$sql->bindValue(":estado_endereco","'.$arr['estado_endereco'].'"); ';
        }

        if(isset($arr['cidade_endereco']) && !empty($arr['cidade_endereco']))
        {
            $query .= ",cidade_endereco";
            $value .= ",:cidade_endereco";
            $bind .= '$sql->bindValue(":cidade_endereco","'.$arr['cidade_endereco'].'"); ';
        }

        if(isset($arr['bairro_endereco']) && !empty($arr['bairro_endereco']))
        {
            $query .= ",bairro_endereco";
            $value .= ",:bairro_endereco";
            $bind .= '$sql->bindValue(":bairro_endereco","'.addslashes(strip_tags($arr['bairro_endereco'])).'"); ';
        }

        if(isset($arr['rua_endereco']) && !empty($arr['rua_endereco']))
        {
            $query .= ",rua_endereco";
            $value .= ",:rua_endereco";
            $bind .= '$sql->bindValue(":rua_endereco","'.addslashes(strip_tags($arr['rua_endereco'])).'"); ';
        }

        if(isset($arr['num_endereco']) && !empty($arr['num_endereco']))
        {
            $query .= ",num_endereco";
            $value .= ",:num_endereco";
            $bind .= '$sql->bindValue(":num_endereco","'.addslashes(strip_tags($arr['num_endereco'])).'"); ';
        }

        if(isset($arr['comple_endereco']) && !empty($arr['comple_endereco']))
        {
            $query .= ",comple_endereco";
            $value .= ",:comple_endereco";
            $bind .= '$sql->bindValue(":comple_endereco","'.addslashes(strip_tags($arr['comple_endereco'])).'"); ';
        }

        //OBSERVAÇÃO
        if(isset($arr['observacao']) && !empty($arr['observacao']))
        {
            $query .= ",observacao";
            $value .= ",:observacao";
            $bind .= '$sql->bindValue(":observacao","'.addslashes(strip_tags($arr['observacao'])).'"); ';
        }

        // if(isset($arr['nome_dono']) && !empty($arr['nome_dono']))
        // {
        //     $query .= ",nome_dono";
        //     $value .= ",:nome_dono";
        //     $bind .= '$sql->bindValue(":nome_dono","'.addslashes(strip_tags($arr['nome_dono'])).'"); ';
        // }

        // if(isset($arr['informacoes_dono']) && !empty($arr['informacoes_dono']))
        // {
        //     $query .= ",informacoes_dono";
        //     $value .= ",:informacoes_dono";
        //     $bind .= '$sql->bindValue(":informacoes_dono","'.addslashes(strip_tags($arr['informacoes_dono'])).'"); ';
        // }


        $query .= ",hora_cadastro";
        $value .= ",:hora_cadastro";
        $bind .= '$sql->bindValue(":hora_cadastro","'.date("H:i:s").'"); ';

        $query .= ",id_user_cadastro";
        $value .= ",:id_user_cadastro";
        $bind .= '$sql->bindValue(":id_user_cadastro","'.$_SESSION['id_user'].'"); ';
       
        $query .= ")";
        $value .= ")";
        $query .= $value;

        $sql = $this->pdo->prepare($query);
        eval($bind);
        $sql->execute();
        $this->lastID = $this->pdo->lastInsertId();


        if($this->pdo->commit())
        {
            return true;
        }
        else
        {
            $this->pdo->rollBack();
            return false;
        }
    }

    // EDITAR IMOVEL
    public function editarImovel($arrDados,$arrSalvo)
    {
        try {

            $this->pdo->beginTransaction();
            $query = " UPDATE imovel SET ";
            $binds = "";
            $arrSet = array();
            $set = "";

            //foreach para preencher a query e bind
            foreach ($arrDados as $key => $valueF)
            {
                // $binds .= $valueF." = ".$arrSalvo[$key]." ][";
                //vejo se o valor do POST é diferente do valor que vem do BANCO
                if($valueF != $arrSalvo[$key])
                {
                    //se o valor não for numérico então coloca aspas para ficar como string
                    $value = '"'.$valueF.'"';
                    //binds
                    $binds .=  ' $sql->bindValue(":'.$key.'",'.$value.');  ';

                    $set = $key." = :".$key; 
                    array_push($arrSet, $set);

                }
            }

            if(!empty($set))
                $set = implode($arrSet, ", ");

            //se não houver campos modificados, eu retorno falso
            if(empty($arrSet)) return false;

            //monto o final da query e ta tudo certo
            $query .= $set.", data_edit = :data_edit, hora_edit = :hora_edit, id_user_edit = :id_user_edit WHERE id_imovel = ".$arrSalvo['id_imovel'];

            // return $query;
            $sql = $this->pdo->prepare($query);
            eval($binds);
            $sql->bindValue(":data_edit",date("Y-m-d"));
            $sql->bindValue(":hora_edit",date("H:i:s"));
            $sql->bindValue(":id_user_edit",$_SESSION['id_user']);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                $this->pdo->commit();
                return true;
            }
            
        } catch (Exception $e) {
            
            $this->pdo->rollBack();
            return false;
        }
    }

    //PEGANDO O ULTIMO ID INSERIDO QUE PODE EDITAR
    public function getLastIDReg()
    {
        $sql = $this->pdo->query("SELECT id_imovel FROM imovel ORDER BY id_imovel DESC LIMIT 1");
        if ($sql->rowCount() == 1)
        {
            $ret = $sql->fetch(PDO::FETCH_ASSOC);
            $ret = $ret['id_imovel'];  
        }
        else
        {
            $ret = 0;
        }
        return $ret;
    }

    // DETALHES IMOVEL
    public function pesquisarImovelID($id)
    {
        $arr = array();
        $sql = $this->pdo->prepare("SELECT * FROM imovel WHERE id_imovel = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $arr = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $arr;
    }

    // LISTAR IMOVEIS ARRAY
    public function listarImovel($page = 0)
    {
        $arr = array();

        //PEGANDO O TOTAL DE REGISTROS
        $qc = $this->pdo->query("SELECT COUNT(*) as tot FROM imovel WHERE 1 ");
        if($qc->rowCount() > 0)
        {
            $tot = $qc->fetch(PDO::FETCH_ASSOC);
            $tot = $tot['tot'];
        }

        //PAGINAÇÃO
        $this->paginacao($page, $tot, 6, 'listarImovel');

        $sql = $this->pdo->query("SELECT * FROM imovel ORDER BY id_imovel DESC LIMIT $this->pagePaginacao , $this->maxPaginacao");
        if($sql->rowCount() > 0)
        {
            while ($vet = $sql->fetch(PDO::FETCH_ASSOC))
            {
                $arr[] = $vet;    
            }
        }

        return $arr;
    }

    // EXCLUIR IMÓVEL
    public function excluirImovel($id_imovel)
    {
        try 
        {

            $this->pdo->beginTransaction();
            $sql = $this->pdo->prepare("DELETE FROM imovel WHERE id_imovel = :id");
            $sql->bindValue(":id",$id_imovel);
            $sql->execute();
            if ($sql->rowCount() > 0) 
            {
                if ($this->verifFotosImovel($id_imovel)) //SE NO IMÓVEL EXISTE FOTO, ENTÃO APAGA TODAS
                {
                    $sql2 = $this->pdo->query("DELETE FROM imovel_fotos WHERE id_imovel = {$id_imovel}");
                }                

                $this->pdo->commit();
                return true;
            }
        } 
        catch (Exception $e) 
        {
        
            $this->pdo->rollBack();
            return false;
        }
    }

    // VERIF SE IMOVEL TEM FOTOS
    public function verifFotosImovel($id_imovel)
    {
        $sql = $this->pdo->query("SELECT * FROM imovel_fotos WHERE id_imovel = {$id_imovel}");
        if ($sql->rowCount() > 0)
        {
            return true;    
        }

        return false;
    }

    // VERIF SE IMOVEL TEM 5 FOTOS OU MAIS
    public function verifQntFotos($id_imovel)
    {
        $sql = $this->pdo->query("SELECT COUNT(*) as tot FROM imovel_fotos WHERE id_imovel = {$id_imovel}");
        if ($sql->rowCount() > 0)
        {
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result['tot'] > 4)
            {
                return true;    
            }
            else
            {
                return false;
            }
        }

        return false;
    }

    // DESMARCA TODAS AS FOTOS DAQUELE IMÓVEL E MARCA A PASSADA
    public function marcarFotoDestaque($id_foto,$id_imovel)
    {   
        //$this->pdo->beginTransaction();
        //LIMPO TODOS OS DESTAQUES DAQUELE IMÓVEL
        $sql = $this->pdo->query("UPDATE imovel_fotos SET destaque = NULL WHERE id_imovel = {$id_imovel}");
        
        //SETO O DESTAQUE DAQUELE SELECIONADO
        $sql2 = $this->pdo->query("UPDATE imovel_fotos SET destaque = '1' WHERE id_foto = {$id_foto}"); 
        if($sql2->rowCount() > 0)
        {
            //$this->pdo->commit();
            return true;
        } 

        // $this->pdo->rollBack();
        return false;
    }

    //MARCAR COMO DESTAQUE A ULTIMA FOTO ADICIONADA NAQUELE IMÓVEL.
    public function markLastAddPhoto($id_imovel)
    {
        $query = $this->pdo->prepare("SELECT id_foto FROM imovel_fotos WHERE id_imovel = :id_imovel ORDER BY id_foto DESC LIMIT 1");
        $query->bindValue(":id_imovel",$id_imovel);
        $query->execute();
        if($query->rowCount() == 1)
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $sql = $this->pdo->query("UPDATE imovel_fotos SET destaque = '1' WHERE id_foto = {$result['id_foto']}");
            if($sql->rowCount() > 0)
            {
                return true;
            }
        }
        return false;
    }

    // ADICIONAR FOTOS NO IMÓVEL SE FOR A PRIMEIRA FOTO DAQUELE MOVEL, MARCA COMO DESTAQUE
    //função que irá salvar o nome, link, id imovel
    //no banco de dados de arquivos
    public function adicionarFotos($id_imovel,$arrFile)
    {


        $sql = $this->pdo->prepare("INSERT INTO imovel_fotos (id_imovel, nome_arquivo, link_img) VALUES (:id_imovel, :nome, :link)");
        $sql->bindValue(':id_imovel',$id_imovel);
        $sql->bindValue(":nome",utf8_encode($arrFile['name']));
        $sql->bindValue(':link',$arrFile['link_arq']);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $this->lastID = $this->pdo->lastInsertId();

            //SE HAVER APENAS 1 FOTO DAQUELE IMOVEL APÓS INSERIR A FOTO, ENTÃO SERÁ DESTAQUE
            $query = $this->pdo->prepare("SELECT id_imovel FROM imovel_fotos WHERE id_imovel = :id_imovel");
            $query->bindValue(":id_imovel",$id_imovel);
            $query->execute();
            if($query->rowCount() == 1)
            {
                $this->pdo->query("UPDATE imovel_fotos SET destaque = '1' WHERE id_foto = {$this->lastID}");
            }

            return true;
        }
        else
        {
            return false;
        }
    }

    //FUNÇÃO PARA PEGAR OS DADOS DO ARQUIVO PELO ID DELE
    public function getArquivoByIdArquivo($id_arquivo)
    {
        $arrRetorno = array();
        $sql = $this->pdo->prepare("SELECT * FROM imovel_fotos where id_foto = :id");
        $sql->bindValue(":id",$id_arquivo);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            $arrRetorno = $dado;
        }

        return $arrRetorno;
    }

    //função para resgatar os arquivos de certo imóvel
    public function getArquivosByIdImovel($id_imovel)
    {
        $arrRetorno = array();
        
        $sql = $this->pdo->prepare("SELECT * FROM imovel_fotos WHERE id_imovel = :id");
        $sql->bindValue(':id',$id_imovel);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            while ($result = $sql->fetch(PDO::FETCH_ASSOC))
            {
                $arrRetorno[] = $result;
            }
        }

        return $arrRetorno;
    }

    //função para resgatar os arquivos de certo imóvel
    public function getFotoDestaque($id_imovel)
    {
        $arrRetorno = null;
        
        $sql = $this->pdo->prepare("SELECT * FROM imovel_fotos WHERE id_imovel = :id AND destaque = '1' ");
        $sql->bindValue(':id',$id_imovel);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            while ($result = $sql->fetch(PDO::FETCH_ASSOC))
            {
                $arrRetorno = $result;
                $arrRetorno = $arrRetorno['link_img'];
            }
        }

        return $arrRetorno;
    }

    //função que irá excluir o arquivo do banco de dados, pegando o id
    public function excluirArquivoByIdArquivo($id_arquivo)
    {
        $sql = $this->pdo->prepare("DELETE FROM imovel_fotos WHERE id_foto = :id");
        $sql->bindValue(":id",$id_arquivo);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}