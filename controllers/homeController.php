<?php

class homeController extends controller
{
    public function index() 
    {
        $dados = array();
    
       // print_r($dados['tempo']);
        $this->templateView('home',$dados);

    }
}

?>
