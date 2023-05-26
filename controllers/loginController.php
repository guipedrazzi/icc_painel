<?php
class loginController extends controller
{
    public function sair() 
    {
        //aqui pego os argumentos e coloco em um array
        $params = func_get_args();
        
        //aqui pego o numero de argumentos recebido
        $num = func_num_args();
        
        if($num > 2)
        {
            die('<h1>Link não acessível!</h1>');
        }
        elseif ($num == 2) 
        {
            $completaR = '/..'; //isso é por causa da url
            $p = ' - '.$params[0];
            $d = ' - '.$params[1];
        }
        elseif ($num == 1) 
        {
            $completaR = '';
            $p = ' - '.$params[0];
            $d = '';
        }
        else 
        {
            $completaR = '';
            $p = '';
            $d = '';
            //die('<h2>Favor passar as informações adequadas!</h2>');
        }
        $dados = array();
        $this->loadView('sair',$dados);
    }
}