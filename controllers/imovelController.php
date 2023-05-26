<?php
// A ideia é que façamos todos as operações de imoveis aqui, tanto pro usuario quanto para a área admin

class imovelController extends controller
{
    // INDEX do IMOVEL PORÉM SERÁ A LISTA JÁ DOS IMOVEIS PRO VISITANTE
    public function index() 
    {
        $data = array();
        $objImovel = new Imovel();

        // print_r($objImovel->listarImovel());
        $data['imoveis'] = $objImovel->listarImovel();
        $this->templateView('imovel_home', $data) ;
    }

    // ADD IMOVEL
    public function adicionar() 
    {
        $data = array();

        $selects = new Selects();
        $objImovel = new Imovel();

        $data['ufs'] = $selects->selectUf();
        $data['estados'] = $selects->selectEstado();

        if (isset($_POST) && !empty($_POST))
        {
            //print_r($_POST);    

            if (isset($_POST['tipo']) && !empty($_POST['tipo']) ) 
            {
                $ret = $objImovel->adicionarImovel($_POST);     
                
                //se add true
                if ($ret)
                {
                    $lastInsertId = $objImovel->lastID;
                    $data['msgTitulo'] = "Imóvel <span class='green-text'>adicionado</span> com sucesso!";
                    $data['msgCorpo'] = "";
                    $data['msgFuncao'] = "location.href = '".RAIZ."/imovel/detalhes/".$lastInsertId."'; ";
                       
                }
                else 
                {
                    $data['msgTitulo'] = "Não foi possível adicionar o imóvel. <span class='red-text'><br>ERROR!</span>";
                    $data['msgCorpo'] = "Gentileza verificar os campos";
                    $data['msgFuncao'] = "return";   
                }   
            }
            else
            {
                $data['msgTitulo'] = "Não foi possível adicionar o imóvel. <span class='red-text'><br>ERRO!</span>";
                    $data['msgCorpo'] = "Gentileza verificar os campos";
                    $data['msgFuncao'] = "return";  
            }
        }


        $this->templateView('imovel_adicionar', $data) ;
        
        // $this->templateViewAdmin('404notfound', $data) ;
    }

    // DETALHES IMOVEL
    public function detalhes() 
    {
        $objImovel = new Imovel();

        $data = array();//array de dados que vai pra view

        $arrDados = array(); //array de dados pego no bd

    	//aqui pego os argumentos e coloco em um array
        $params = func_get_args();

        //pegar o id pelo parâmetro      
        $id_imovel = (isset($params[0]) && !empty($params[0]) ) ? $params[0] : NULL ;

        //pegando dados do bd com o id passado
        $arrDados = $objImovel->pesquisarImovelID($id_imovel);

        //se não for passado nenhum ID como parâmetro ou ele não existir no banco de dados, então vai volta pra lista
        if($id_imovel === NULL || empty($arrDados))
        {
            header("Location: ".RAIZ."/imovel");
            exit;
        }
        else
        {
            $data['dados'] = $arrDados;
            $data['dados']['nome_user_cadastro'] = $objImovel->pegaNomeUser($arrDados['id_user_cadastro']);
            $data['dados']['nome_user_edit'] = !empty($arrDados['id_user_edit']) ? $objImovel->pegaNomeUser($arrDados['id_user_edit']) : "";

            $data['dados']['data_cadastro'] = $objImovel->data_cliente($arrDados['data_cadastro']);
            $data['dados']['data_edit'] = !empty($arrDados['data_edit']) ? $objImovel->data_cliente($arrDados['data_edit']) : "";

            //EDIT DO IMOVEL
            if (isset($_POST) && !empty($_POST))
            {   
                //print_r($_POST); exit();
                if(!empty($_POST['tipo']) )
                {
                    //$data['teste'] = $_POST;
                    if($objImovel->editarImovel($_POST,$arrDados))
                    {
                        $data['msgTitulo'] = "Imóvel <span class='green-text'>editado</span> com sucesso!";
                        $data['msgCorpo'] = "";
                        $data['msgFuncao'] = "location.href = '".RAIZ."/imovel/detalhes/".$id_imovel."'; ";
                    }
                    else
                    {
                        $data['msgTitulo'] = "<b class='red-text'>ERRO</b>";
                        $data['msgCorpo'] = "Provável imóvel já cadastrado.<br>Faça uma pesquisa para saber se realmente já foi cadastrado!";
                        $data['msgFuncao'] = "location.href = '".RAIZ."/imovel/detalhes/".$id_imovel."'; ";
                    }
                }
                else
                {
                    $data['msgTitulo'] = "<b class='red-text'>ERRO</b>";
                    $data['msgCorpo'] = "Gentileza preencher todos os campos obrigatórios corretamente";
                    $data['msgFuncao'] = "location.href = '".RAIZ."/imovel/detalhes/".$id_imovel."'; ";
                }
            }

        }

        $selects = new Selects();

        $data['ufs'] = $selects->selectUf();
        $data['estados'] = $selects->selectEstado();
        $data['select_cidade'] = $selects->selectCidadePorEstado($arrDados['estado_endereco']);

        $this->templateView('imovel_detalhes', $data) ;
        
        // $this->templateViewAdmin('404notfound', $data) ;
    }

}