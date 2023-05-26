<?php

class Login extends model
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
    
///////////////////////////////////////////////////////////////////////////

    //função que verifica se já tem um login como aquele, se não, faz o registro
    public function registerUser($arr)
    {
        //para verificar se já existe este login no banco de dados
        $sql = $this->pdo->prepare("SELECT * FROM user_login WHERE login = :login");
        $sql->bindValue(":login",$this->getLogin());
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false;
        }

        try {

            $this->pdo->beginTransaction(); //start transaction

            /*
            * DETALHES DO USER
            */    
            $query = "INSERT INTO user_details (name ";
            $value = "VALUES (:name ";
            $bind = '$sql->bindValue(":name","'.$this->getName().'"); ';

            if(isset($arr['email']) && !empty($arr['email']))
            {
                $query .= ",email";
                $value .= ",:email";
                $bind .= '$sql->bindValue(":email","'.$arr['email'].'"); ';
            }

            if(isset($arr['phone']) && !empty($arr['phone']))
            {
                $query .= ",phone";
                $value .= ",:phone";
                $bind .= '$sql->bindValue(":phone","'.$arr['phone'].'"); ';
            }

            if(isset($arr['birthdate']) && !empty($arr['birthdate']))
            {
                $query .= ",birthdate";
                $value .= ",:birthdate";
                $bind .= '$sql->bindValue(":birthdate","'.$arr['birthdate'].'"); ';
            }

            // if(isset($arr['type']) && !empty($arr['type']))
            // {
            //     $query .= ",type";
            //     $value .= ",:type";
            //     $bind .= '$sql->bindValue(":type",'.$arr['type'].'); ';
            // }

            $query .= ")";
            $value .= ")";
            $query .= $value;

            //echo "<h1>".$bind."</h1>"; 
            $sql = $this->pdo->prepare($query);
            eval($bind);
            $sql->execute();
            $id_user = $this->pdo->lastInsertId();

            /*
            * LOGIN DO USER
            */
            $sql2 = $this->pdo->prepare("INSERT INTO user_login (login,senha,id_user) VALUES (:login,:senha,:id_user)");
            $sql2->bindValue(":login",$this->getLogin());
            $sql2->bindValue(":senha",$this->getPassword());
            $sql2->bindValue(":id_user",$id_user);
            $sql2->execute();

            if($this->pdo->commit())
                //inicia session
                $this->initSession($arr,$id_user);
                return true;
            //print_r($this->pdo);
                
        } catch (Exception $e) {

            // Something borked, undo the queries!!
            $this->pdo->rollBack();
            // echo 'ERROR: ' . $e->getMessage();
            return false;
        }
    }

    //função para criar a session e inicia-la
    public function initSession($arr,$id_user)
    {   
        //session_name("Procuradoria");
        if(session_start())
        {
            $_SESSION['session_name'] = "Protocolo"; //para verificação de session, e não confundir a session no mesmo server
            $_SESSION['id_session'] = session_id();
            $_SESSION['id_user'] = $id_user;
            $_SESSION['logged_in'] = true;
            $_SESSION['user_name'] = $this->getName();
            $_SESSION['user_email'] = $arr['email'];
            $_SESSION['user_type'] = isset($arr['type'])?$arr['type']:0;
            $_SESSION['user_phone'] = $arr['phone'];
            $_SESSION['user_birthdate'] = $arr['birthdate'];
            $_SESSION['user_login_date'] = date("Y-m-d");
            $_SESSION['user_login_time'] = date("H:i:s");
            $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];

            $this->setLastLoginUser();

            return true;
        }

        return false;
    }

    //função para fazer login
    public function logInUser()
    {
        $sql = $this->pdo->prepare("SELECT * FROM user_login WHERE login = :login");
        $sql->bindValue(":login",$this->getLogin());
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $value = $sql->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->getPasswordN(),$value['senha']))
            {
                $sql2 = $this->pdo->prepare("SELECT * FROM user_details WHERE id_user = ?");
                $sql2->execute(array($value['id_user']));
                $user = $sql2->fetch(PDO::FETCH_ASSOC);

                $this->setName($user['name']);
                $this->initSession($user, $value['id_user']);
                return true;
            }
        }
        return false;
    }

    //função para salvar o ultimo login feito pelo usuário
    public function setLastLoginUser()
    {
        $sql = $this->pdo->query("UPDATE user_login SET last_login = NOW() WHERE id_user = ".$_SESSION['id_user']);
        if($sql->rowCount() > 0)
        {
            return true;
        }

        return false;
    }

    public function duplicidadeLogin($login)
    {
        $sql = $this->pdo->prepare('SELECT * FROM user WHERE email = :login');
        $sql->bindValue(':login', utf8_decode($login));
        $sql->execute();
        
        if($sql->rowCount() > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function duplicidadeLoginEditar($login,$id)
    {
        $sql = $this->pdo->prepare('SELECT * FROM usuario WHERE user = :login AND id_funcionario != :id');
        $sql->bindValue(':login', utf8_decode($login));
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        
        if($sql->rowCount() > 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    
    public function inseriLogin()
    {        

        $sql = $this->pdo->prepare('INSERT INTO user (nome, email, senha)
                                    VALUES(:nome, :email, :senha)
                                    ');
        $sql->bindValue(':nome', utf8_decode($this->nome));
        $sql->bindValue(':email', utf8_decode($this->login)); 
        $sql->bindValue(':senha', $this->password);
        $sql->execute();
        if($sql->errorCode() != "00000")
        {
            $cod_erro = $sql->errorCode();
            $erro = "<b>Erro código: $cod_erro</b><br/>";
            $erro .= implode(", ", $sql->errorInfo());
            //echo $erro;
            $retorno = FALSE;
        }
        else
        {
            $retorno = TRUE;
        }
        
        return $retorno;
    }
    
    public function verificaLogin()
    {
        $sql = $this->pdo->prepare('SELECT * FROM user WHERE email = :login AND senha = :senha');
        $sql->bindValue(':login', utf8_decode($this->login));
        $sql->bindValue(':senha',$this->password);
        $sql->execute();
        if($sql->rowCount() == 1)
        {
            $value = $sql->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['login'] = TRUE;
            $_SESSION['id'] = $value['id'];
            $_SESSION['nome'] = utf8_encode($value['nome']);
            $_SESSION['email'] = utf8_encode($value['email']);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function verificaSenha($login, $password)
    {
        $sql = $this->pdo->prepare('SELECT * FROM usuario WHERE user = :login and ativo = :ativo');
        $sql->bindValue(':login', utf8_decode($login));
        $sql->bindValue(':ativo', 1);
        $sql->execute();
        
        foreach ($sql as $result)
        {
            $idBanco    = $result['id_funcionario'];
            $loginBanco = $result['user'];
            $passwordBanco = $result['senha'];
        }
        
        // Valor salvo no banco de dados
        $hash = $passwordBanco;

        // Senha digitada pelo usuário
        $passwordRecebida = $password;

        $liga = password_verify($password, $hash);
        
        //Agora verifico se os atributos login e senha que estão com o valor do banco conferem com o que passo como parametro
        if($login == $loginBanco && $liga === TRUE)
        {
            session_start();
            $_SESSION['id']    = $idBanco;
            $_SESSION['login'] = TRUE;

            if (preg_match('/^[0-9]+$/',$_SESSION['id'])) 
            {
                $this->sessao($idBanco);
            }

            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
   
}

?>
