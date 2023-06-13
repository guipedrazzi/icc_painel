<?php

class ownerController extends controller
{
    public function index() 
    {
        $dados = array();
    
       // print_r($dados['tempo']);
        $this->templateView('owner_home',$dados);

    }

    public function add()
    {

        $this->templateView('owner_add',[]);
    }
}

?>