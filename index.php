<?php
ob_start();
session_start();
require_once './configr.php';

//tempo do server
$time = $_SERVER['REQUEST_TIME'];

//tempo de duração da session (em segundos)
$timeout_duration = 1800;

if ( isset($_SESSION['id_user']) && $_SESSION['logged_in'] === true  && !empty($_SESSION['id_session']) && $_SESSION['session_name'] == "Protocolo") 
{
   
   //controle de session para inatividade do usuário
    if (isset($_SESSION['LAST_ACTIVITY']) && 
       ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        header("location: ".RAIZ."?msg=1");
    }

    //se houver a msg, é pq o usuário foi deslogado por inatividade
    if(isset($_GET['msg']) && $_GET['msg'] == 1)
    {
        echo "<script>alert('Você foi desconectado! Inatividade por 30 minutos');location.href='".RAIZ."/login/sair';</script>";
    }

    //toda vez q ele utilizar o sistema, atualizar a página e talz, atualiza
    //o tempo da última atividade do usuário
    $_SESSION['LAST_ACTIVITY'] = $time;

    //print_r($_SESSION);
    //$urlAtual = $_SERVER['REQUEST_URI'];
    //echo $urlAtual;
        
    global $session_id;//inicio da sessão
    $session_id = $_SESSION['id_session'];
    //Auto load de classes
    spl_autoload_register
    (
        function ($class)
        {
            if (strpos($class, 'Controller') > -1) 
            {
                if (file_exists('controllers/'.$class.'.php')) 
                {
                    require_once 'controllers/'.$class.'.php';
                }
            }
            else
            {
                if (file_exists('models/'.$class.'.php')) 
                {
                    require_once 'models/'.$class.'.php';
                }
                else
                {
                    require_once 'core/'.$class.'.php';
                }
            }
        }
    );
    
    $core = new Core();
    $core->run();

}//if da session
else
{
    if($_GET['msg'] == 1)
    {
        echo "<script>alert('Você foi desconectado por falta de atividade em 30 minutos');location.href='".RAIZ."/login/sair';</script>";
    }
    else
    {
        header("location: ".RAIZ."/login.php");
    }
}
ob_flush();
?>