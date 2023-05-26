<?php 
/**
 * Classe responsável por editar os dados de login e detalhes dos usuários
 */
class User extends model
{
    protected $login;
    protected $password;
    protected $typeUser; //if type 1 = 'funcionário', if type 2 = 'medico'
    protected $name;
    protected $passwordN;//senha sem encrypt

    public $email;
    public $phone;
    public $birthdate;

    /*
    * GET FUNCTIONS 
    */
    public function getTypeUser()
    {
        return $this->typeUser;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPasswordN()
    {
        return $this->passwordN;
    }
    
    /*
    * SET FUNCTIONS 
    */
    public function setLogin($login)
    {
        if(isset($login) && !empty($login) && strlen($login) >= 4)
        {
            $this->login = $login;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function setName($name)
    {
        if(isset($name) && !empty($name) && strlen($name) >= 4)
        {
            $this->name = $name;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function setPassword($password)
    {
        if(isset($password) && !empty($password) && strlen($password) >= 6)
        {
            $this->password = password_hash($password,PASSWORD_DEFAULT);
            $this->passwordN = $password;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    public function setTypeUser($type)
    {
        if(isset($type) && !empty($type) && is_numeric($type))
        {
            $this->typeUser = $type;
            return true;
        }
        else
        {
            return false;
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////
    public function getUsersList()
    {
    	$arr = array();
    	$sql = $this->pdo->query("SELECT ud.id_user, ud.name, ud.phone, ud.email, ud.type, ul.login FROM user_details as ud INNER JOIN user_login as ul ON ud.id_user = ul.id_user");
    	if($sql->rowCount() > 0)
    	{
    		while ($vet = $sql->fetch(PDO::FETCH_ASSOC))
    		{
    			$arr[] = $vet;    
    		}
    	}

    	return $arr;

    }

    public function getDadosUserById($id_user)
    {
    	$arr = array();
    	$sql = $this->pdo->prepare("SELECT ud.id_user, ud.name, ud.phone, ud.email, ud.birthdate, ud.type, ul.login FROM user_details as ud INNER JOIN user_login as ul ON ud.id_user = ul.id_user WHERE ud.id_user = :id");
    	$sql->bindValue(":id",$id_user);
    	$sql->execute();
    	if($sql->rowCount() > 0)
    	{
    		$arr = $sql->fetch(PDO::FETCH_ASSOC);
    	}
    	return $arr;
    }

    public function editUserDetails($arrSalvo,$arrDados) 
    {
        $this->pdo->beginTransaction();
        $query = " UPDATE user_details SET ";
        $binds = "";
        $arrSet = array();
        $set = "";

        //foreach para preencher a query e bind
        foreach ($arrDados as $key => $valueF)
        {
        	//ESSA PARTE BUGADA, TO ACHANDO Q TEREI Q FAZER NA MÃO ESSE UPDATE
        	if($key == "login" && !empty($valueF))
        	{
        		$this->editUserLogin($valueF,$arrSalvo['id_user']);
        		continue;
        	}
            //vejo se o valor do POST é diferente do valor que vem do BANCO
            if($valueF !== $arrSalvo[$key]  )
            {
                //se o valor não for numérico então coloca aspas para ficar como string
                $value = !is_numeric($valueF)?'"'.$valueF.'"':$valueF;
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
        $query .= $set." WHERE id_user = ".$arrSalvo['id_user'];

        // return $query." - ".$binds;
        $sql = $this->pdo->prepare($query);
        eval($binds);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $this->pdo->commit();
            return true;
        }

        $this->pdo->rollBack();
        return false;
    }

    public function editUserLogin($loginNovo,$idUser)
    {
    	$sql = $this->pdo->query("UPDATE user_login SET login = '{$loginNovo}' WHERE id_user = {$idUser}");
    	if($sql->rowCount() > 0)
    	{
    		return true;
    	}
    	return true;
    }
    
    public function editandoSenha($novoSenha,$id)
    {
        return $this->editarSenha($novoSenha, $id);
    }

    private function editarSenha($novoSenha,$id)
    {
        // Usando as opções default
        $cripSenha = password_hash($novoSenha,PASSWORD_DEFAULT);
        
        $editaSenha = $this->pdo->prepare('UPDATE user_login SET senha = :senha WHERE id_user = :id');
        $editaSenha->bindValue(':senha', $cripSenha);
        $editaSenha->bindValue(':id', $id);
        $editaSenha->execute();
        
        if($editaSenha->errorCode() != "00000")
        {
            $cod_erro = $editaSenha->errorCode();
            $erro = "<b>Erro código: $cod_erro</b><br/>";
            $erro .= implode(", ", $editaSenha->errorInfo());
            //echo $erro;
            return FALSE;
        }
        else
        {
            return TRUE;
            //echo "editou";
        }
    }

    public function editaUser($idUser)
    {
        if(!empty($this->getSenha()) || !empty($this->getNome()) || !empty($this->getNomeUser()) )
        {       
            $query = "UPDATE user SET";
            $bind = "";
            if(!empty($this->getSenha()))
            {
                $query .= " senha = :senha ,";
                $bind .= ' $sql->bindValue(":senha",$this->getSenha()); ';
            }

            if(!empty($this->getNome()))
            {
                $query .= " email = :email ,";
                $bind .= ' $sql->bindValue(":email",$this->getNome()); ';
            }

            if(!empty($this->getNomeUser()))
            {
                $query .= " nome = :nome ";
                $bind .= ' $sql->bindValue(":nome",$this->getNomeUser()); ';
            }

            $query .= "WHERE id = $idUser ";

            $sql = $this->pdo->prepare($query);
            eval($bind);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                $_SESSION['nome'] = $this->getNomeUser();
                $_SESSION['email'] = $this->getNome();
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }


    public function excluirUser($idUser)
    {
        $sql = $this->pdo->prepare("DELETE FROM user WHERE id = $idUser ");
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            session_destroy();
            return true;
        }
        else
        {
            return false;
        }
    }
}