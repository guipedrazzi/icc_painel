<?php

/**
 * controller[pai]<br/>
 * Classe que será herdada por todos os Controllers
 * @copyright (c) 2018, Guilherme da Silva Pedrazzi
 */
class controller 
{
    /**
     * Essa função chama os dados para um fronte em branco
     * onde é mais recomendado para ajax
     * @param string $viewName = nome do front que desejo chamar
     * @param array $viewData = dados a serem passados para o front
     */
    public function loadView($viewName, $viewData = array()) 
    {
        extract($viewData); //transformo os indices do vetor em variáveis
        include_once 'view/'.$viewName.'.php';
    }
    
    /**
     * Essa função chama os dados e o front padrão do sistema
     * (header e footer)
     * @param string $viewName = nome do front que desejo chamar
     * @param array $viewData = dados a serem passados para o front
     */
    public function templateView($viewName, $viewData = array()) 
    {
        include_once 'assets/comum/header.php';
        $this->loadView($viewName, $viewData);
        include_once 'assets/comum/footer.php';
    }
    
  
}

?>
