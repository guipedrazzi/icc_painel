<?php

/**
 * Core[base]<br/>
 * Essa classe serve de base para o meu padrão MVC
 * @copyright (c) 2018, Guilherme da Silva Pedrazzi
 */
class Core 
{
    private $currentController;
    private $currentAction;


    public function run() 
    {
        $urlCompleta = $_SERVER['PHP_SELF']; 
        $urlCompleta = explode('index.php', $urlCompleta);
        
        $url = $urlCompleta[1];
        
        //echo "<h1> chegou: $url </h1>"; //teste
        //exit();//para o código aqui
        
        //array que vai conter os parametros passados
        $parametros = array();
        
        if (!empty($url)) //vejo se o usuario digitou alguma coisa
        {
            $url = explode('/', $url);
            array_shift($url); //tiro a primeira '/' 
            //abaixo pego o controller que vou usar
            if (isset($url[0]) && $url[0] != '') 
            {   
                $this->currentController = $url[0]."Controller";
                array_shift($url); //guardo o valor na variavel acima e tiro ele do vetor aqui
            }
            else 
            {
                $this->currentController    = 'homeController';
            }
            //abaixo vejo qual função do controller vou chamar
            if (isset($url[0]) && $url[0] != '') 
            {
                $this->currentAction = $url[0];
                array_shift($url); //guardo o valor na variavel acima e tiro ele do vetor aqui
            }
            else
            {
                $this->currentAction = 'index';
            }
            //abaixo pego os parametros enviados
            if (count($url) > 0) 
            {
                $parametros = $url;
            }
        }
        else
        {
            $this->currentController    = 'homeController';
            $this->currentAction        = 'index';
        }
        
        $currentController  = $this->currentController;
        $currentAction      = $this->currentAction;
        
        if(!file_exists('controllers/'.$currentController.".php") || !method_exists($currentController, $currentAction))
        {
            $currentController = 'notfoundController';
            $currentAction = 'index';
        }

        //abaixo vou puxar o meu controller e sua function
        // require_once 'core/controller.php';
        $chamaController = new $currentController();
        //$chamaController->$currentAction($parametros);
        call_user_func_array(array($chamaController,$currentAction), $parametros);//isso transforma meu array $parametros em varios parametros
    }
                
}

?>
