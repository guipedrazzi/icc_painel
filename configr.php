<?php
require './ambient.php';
global $configr;

//pasta raiz do sistema
define('CNFGR_DBTYPE', 'mysql');
define('CNFGR_DBHOST', 'localhost');
define('CNFGR_DBNAME', 'id5126023_avaliacaodrp');
define('CNFGR_DBUSER', 'id5126023_gsppedra');
define('CNFGR_DBPASS', 'gk9no9');

$configr = array();

if (ENVIRONMENT == 'development') 
{
    define('RAIZ', '/icc_painel');
    define('FILE_UPLOAD', 'assets/images/imoveis_fotos/');
    $configr['TIPO']        = 'mysql';
    $configr['BDSERVER']    = 'localhost';
    $configr['BDNOME']      = 'icc_db';
    $configr['USER']        = 'root';
    $configr['PASS']        = '';
}
else //caso não esteja no ambiente de desenvolvimento
{
    //setar esse ,vetor com os valores do servidor
    define('RAIZ', '/icc_painel');
    define('FILE_UPLOAD', 'assets/uploaded_files/');
    $configr['TIPO']        = CNFGR_DBTYPE;
    $configr['BDSERVER']    = CNFGR_DBHOST;
    $configr['BDNOME']      = CNFGR_DBNAME;
    $configr['USER']        = CNFGR_DBUSER;
    $configr['PASS']        = CNFGR_DBPASS;
}

?>