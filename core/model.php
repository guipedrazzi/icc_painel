<?php

class model 
{
    protected $pdo;
    public $msgErro;
    public $imagemBanco;
    //atributos para paginação
    public $paginacaoAcima;
    public $paginacaoAbaixo;
    public $pagePaginacao = 1;
    public $maxPaginacao;
    
    public function __construct() 
    {
        global $configr;
        $this->pdo = new PDO($configr['TIPO'].':dbname='.$configr['BDNOME'].';charset=UTF8;host='.$configr['BDSERVER'],$configr['USER'],$configr['PASS']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('America/Sao_Paulo');
    }
    
    //Paginação separada| $page = valor inicial do LIMIT| $tot =  toatal de linhas da query|$max = maximo de linhas da pesquisa|$funcaoPesquisa = a função que será chamada no onclick da paginação
    public function paginacao($page, $tot, $max = 10, $funcaoPesquisa = 'pesquisaSimples')
    {
        
        //Abaixo pego a quantidade de resultados e divido pela quantidade de resultados que desejo mostrar em cada página 
        $quantResultadosMostrar = $max;
        $this->maxPaginacao = $max;

        //Abaixo vejo a quantidade de resultados que obtive e faço o calculo pra ver quantas páginas vão ter nessa páginação
        if(!empty($tot) && is_numeric($tot)) 
        {
            $total = $tot;
        }
        else
        {
            $total = 0;
        }

        //caso a quantidade de resultados for menor que quantidade que deseja ser mostrada
        if ($total <= $quantResultadosMostrar) 
        {
            $paginacaoUnica = TRUE; //isso vai servir para o iF (lá em baixo) verificar se precisa ou não fazer os links de paginação
        }
        else
        {
            $paginacaoUnica = FALSE;
        }


        $paginas = ($total / $quantResultadosMostrar);
        $paginas = ceil($paginas); //aqui na variável $paginas tenho o valor inteiro do total de páginas que vou ter nessa pesquisa(query)

        if (!empty($page) && $page != 0) 
        {
            $page = strip_tags(trim($page));
        }
        else
        {
            $page = 1;
        }

        $this->pagePaginacao = ($page - 1) * $quantResultadosMostrar;
        //Acima o cálculo responsável pelo onde vai iniciar o LIMIT da query;


        //Aqui começa a paginação de fato
        if (!$paginacaoUnica) //caso exista mais de uma página
        {

            $mudaPageCima = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
            $mudaPageBaixo = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';

            $proximo;
            $anterior;

            if($page == 1) // PESSOA ESTÁ NA PRIMEIRA PÁGINA
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='active btn-pagination'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='active btn-pagination'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";

                //PROXIMO

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(2)'>Proximo</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(2)'>Proximo</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
            }
            else if($page == $paginas) //PESSOA ESTÁ NA ULTIMA PÁGINA
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";

                //ANTERIOR
                $anterior = ($paginas - 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior)'>Anterior</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior)'>Anterior</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='active btn-pagination'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='active btn-pagination'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
            }
            else
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1)'>Primeira</a></li>";


                //ANTERIOR

                $anterior = ($page - 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior)'>Anterior</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior)'>Anterior</a></li>";

                //pagina em que a pessoa escolheu

                $mudaPageCima  .= "<li class='active btn-padrao'><a onclick='$funcaoPesquisa($page)'>$page</a></li>";
                $mudaPageBaixo .= "<li class='active btn-padrao'><a onclick='$funcaoPesquisa($page)'>$page</a></li>";

                //PROXIMO

                $proximo = ($page + 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($proximo)'>Proximo</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($proximo)'>Proximo</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas)'>Ultima</a></li>";
            }    

            $mudaPageCima .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';
            $mudaPageBaixo .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';

        }
        else //caso o resultado caiba em apenas uma página
        {
            $mudaPageCima = '';
            $mudaPageBaixo = '';
        }
        $this->paginacaoAcima     = $mudaPageCima;
        $this->paginacaoAbaixo    = $mudaPageBaixo;

    }

 
    
    //Paginação separada com 2 parâmetros na funçãoPesquisa| $page = valor inicial do LIMIT| $tot =  toatal de linhas da query|$max = maximo de linhas da pesquisa|$funcaoPesquisa = a função que será chamada no onclick da paginação| $parametro = parametro extra na função AJAX para pesquisas
    public function paginacaoParametros($page, $tot, $max = 10, $funcaoPesquisa, $parametro)
    {
        
        //Abaixo pego a quantidade de resultados e divido pela quantidade de resultados que desejo mostrar em cada página 
        $quantResultadosMostrar = $max;
        $this->maxPaginacao = $max;

        //Abaixo vejo a quantidade de resultados que obtive e faço o calculo pra ver quantas páginas vão ter nessa páginação
        if(!empty($tot) && is_numeric($tot)) 
        {
            $total = $tot;
        }
        else
        {
            $total = 0;
        }

        //caso a quantidade de resultados for menor que quantidade que deseja ser mostrada
        if ($total <= $quantResultadosMostrar) 
        {
            $paginacaoUnica = TRUE; //isso vai servir para o iF (lá em baixo) verificar se precisa ou não fazer os links de paginação
        }
        else
        {
            $paginacaoUnica = FALSE;
        }


        $paginas = ($total / $quantResultadosMostrar);
        $paginas = ceil($paginas); //aqui na variável $paginas tenho o valor inteiro do total de páginas que vou ter nessa pesquisa(query)

        if (!empty($page) && $page != 0) 
        {
            $page = strip_tags(trim($page));
        }
        else
        {
            $page = 1;
        }

        $this->pagePaginacao = ($page - 1) * $quantResultadosMostrar;
        //Acima o cálculo responsável pelo onde vai iniciar o LIMIT da query;


        //Aqui começa a paginação de fato
        if (!$paginacaoUnica) //caso exista mais de uma página
        {

            $mudaPageCima = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
            $mudaPageBaixo = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';

            $proximo;
            $anterior;

            if($page == 1) // PESSOA ESTÁ NA PRIMEIRA PÁGINA
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";

                //PROXIMO

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(2,".'"'."$parametro".'"'.")'>Proximo</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(2,".'"'."$parametro".'"'.")'>Proximo</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
            }
            else if($page == $paginas) //PESSOA ESTÁ NA ULTIMA PÁGINA
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";

                //ANTERIOR
                $anterior = ($paginas - 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior,".'"'."$parametro".'"'.")'>Anterior</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior,".'"'."$parametro".'"'.")'>Anterior</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
            }
            else
            {
                //PRIMEIRA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa(1,".'"'."$parametro".'"'.")'>Primeira</a></li>";


                //ANTERIOR

                $anterior = ($page - 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior,".'"'."$parametro".'"'.")'>Anterior</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($anterior,".'"'."$parametro".'"'.")'>Anterior</a></li>";

                //pagina em que a pessoa escolheu

                $mudaPageCima  .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa($page,".'"'."$parametro".'"'.")'>$page</a></li>";
                $mudaPageBaixo .= "<li class='active light-blue darken-2'><a onclick='$funcaoPesquisa($page,".'"'."$parametro".'"'.")'>$page</a></li>";

                //PROXIMO

                $proximo = ($page + 1);
                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($proximo,".'"'."$parametro".'"'.")'>Proximo</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($proximo,".'"'."$parametro".'"'.")'>Proximo</a></li>";

                //ULTIMA PAGINA

                $mudaPageCima  .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
                $mudaPageBaixo .= "<li class='waves-effect'><a onclick='$funcaoPesquisa($paginas,".'"'."$parametro".'"'.")'>Ultima</a></li>";
            }    

            $mudaPageCima .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';
            $mudaPageBaixo .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';

        }
        else //caso o resultado caiba em apenas uma página
        {
            /*
            $mudaPageCima = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
            $mudaPageBaixo = '<ul class="pagination"><li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';

                //$mudaPageCima  .= "<li class='active light-blue darken-2'><a href='1'>Primeira</a></li>";
                //$mudaPageBaixo .= "<li class='active light-blue darken-2'><a href='1'>Primeira</a></li>";

            $mudaPageCima .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';
            $mudaPageBaixo .= '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li></ul>';
             * 
             */
            $mudaPageCima = '';
            $mudaPageBaixo = '';
        }
        $this->paginacaoAcima     = $mudaPageCima;
        $this->paginacaoAbaixo    = $mudaPageBaixo;

    }
    

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                                     //FORMATAÇÃO DE DATAS                   
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * <b>data_banco</b><br/>
     * Recebe uma data do cliente e a transforma 
     * no padrão para guardar no banco de dados
     * @param type $data
     * @return string = data no formato AAAA-MM-DD
     */
    protected function data_banco($data)
    {
        $forma = explode('/', $data);
        $data_banco = $forma[2]."-".$forma[1]."-".$forma[0];
        return $data_banco;
    }


    /**
     * <b>data_cliente</b><br/>
     * Recebe uma data do banco de dados e a transforma 
     * no padrão para mostrar ao Cliente. 
     * @param type $data
     * @return string = DD/MM/AAAA
     */
    public function data_cliente($data)
    {
        $forma = explode('-', $data);
        $data_user = $forma[2]."/".$forma[1]."/".$forma[0];
        return $data_user;
    }    

    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                                           //DATA E HORA             
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    /**
     * Essa função retorna a diferença entre duas datas incluindo 
     * a diferença em horas também.
     * @param date time $dataInicio
     * @param date time $dataFuturo
     * @return Array = contendo a diferença em ano, mes, dia, horas, minutos e segundos
     */
    public function intervaloDatasHoras($dataInicio, $dataFuturo) 
    {
    	//$dataInicio = "2017-02-01 17:00:00"; //exemplo
    	//$dataFuturo = "2018-03-02 17:10:05"; //exemplo
    	
    	 $diferenca = Array();
    	
    	 $date_time  = new DateTime($dataInicio);
    	 $diff       = $date_time->diff( new DateTime($dataFuturo));
    	
    	 $diferenca['dif_ano'] 		= $diff->format('%y');
    	 $diferenca['dif_mes'] 		= $diff->format('%m');
    	 $diferenca['dif_dia'] 		= $diff->format('%d');
    	 $diferenca['dif_hora'] 	= $diff->format('%H');
    	 $diferenca['dif_minuto'] 	= $diff->format('%i');
    	 $diferenca['dif_segundo'] 	= $diff->format('%s');
    	
    	//TESTE
    	/*
    	echo "<pre>";
    	print_r($diferenca);
    	echo "</pre>";
    	*/
    	return $diferenca;  //vetor

        /*exemplo COMO USAR 
            date_default_timezone_set('America/Sao_Paulo');
            $vet = diferencaDatasHoras(date('Y-m-d H:i:s'), "2018-01-16 17:10:05");
        */
    }

    
    /**
     * Transforma de minuto para hora
     * @param int $tempo
     * @return String
     */
    public  function minToHora($tempo)
    {
        $hora = floor($tempo/60);
        $resto = $tempo%60;
        return $hora.':'.$resto;
    }
    

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                                              //FORMATAÇÕES ÚTEIS          
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Pega um telefone com apenas números
     * e a função coloca a máscara
     * @param String $nu
     * @return String
     */
    public function formataTelefone($nu) 
    {
        return "(".substr("$nu",0,2).")".substr("$nu",2,-4)."-".substr("$nu",-4);
    }

    //formatação de cpf
    public function formatacpf($nu) 
    {
        return substr("$nu",0,3).".".substr("$nu",3,3).".".substr("$nu",6,3)."-".substr("$nu",9,2);
    }

    //Recebe um valor no formato R$ 00,00
    //Retorna um valor que já está pronto para salvar no banco de dados
    public function valorBanco($string) 
    {
        $origens  = array('R$', '.', ',');
        $destinos = array('', '', '.');
        //abaixo troco o que eu encontrar do array $origens pelo mesmo indeice do array $destinos
        $valor     = (floatval(str_replace($origens, $destinos, $string)));
        return $valor;
    }

    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                                 //PEGANDO NOMES ATRAVÉS DO ID
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function pegaNomeEstado($id)
    {
        $puxa = $this->pdo->prepare('SELECT nome FROM estado WHERE id = :id');
        $puxa->bindValue(':id',$id);
        $puxa->execute();

        $nome = ''; //iniciando a variável
        
        if ($puxa->rowCount() > 0) 
        {
            foreach ($puxa as $value) 
            {
                $nome = $value['nome'];
            }
        }

        return $nome;
    }

    public function pegaNomeCidade($id)
    {
        $puxa = $this->pdo->prepare('SELECT nome FROM cidade WHERE id = :id');
        $puxa->bindValue(':id',$id);
        $puxa->execute();

        $nome = ''; //iniciando a variável
        
        if ($puxa->rowCount() > 0) 
        {
            foreach ($puxa as $value) 
            {
                $nome = $value['nome'];
            }
        }

        return $nome;
    }
    
    public function pegaNomeMes($m)
    {
        if (strlen($m) < 2 )
        {
            $ma = '0'.$m;
        }
        else
        {
            $ma = $m;
        }
        
        switch ($ma) 
        {
                case "01":    $mes = 'Jan';     break;
                case "02":    $mes = 'Fev';   break;
                case "03":    $mes = 'Mar';       break;
                case "04":    $mes = 'Abr';       break;
                case "05":    $mes = 'Mai';        break;
                case "06":    $mes = 'Jun';       break;
                case "07":    $mes = 'Jul';       break;
                case "08":    $mes = 'Ago';      break;
                case "09":    $mes = 'Set';    break;
                case "10":    $mes = 'Out';     break;
                case "11":    $mes = 'Nov';    break;
                case "12":    $mes = 'Dez';    break; 
        }
        return $mes;
    }

    public function pegaUfEstado($id)
    {
        $puxa = $this->pdo->prepare('SELECT uf FROM estado WHERE id = :id');
        $puxa->bindValue(':id',$id);
        $puxa->execute();

        $nome = ''; //iniciando a variável
        
        if ($puxa->rowCount() > 0) 
        {
            foreach ($puxa as $value) 
            {
                $nome = $value['uf'];
            }
        }

        return $nome;
    }

    public function pegaIdEstado($estado)
    {
        $puxa = $this->pdo->prepare('SELECT id FROM estado WHERE nome LIKE :nome');
        $puxa->bindValue(':nome',utf8_decode($estado));
        $puxa->execute();

        $id = ''; //iniciando a variável
        
        if ($puxa->rowCount() > 0) 
        {
            foreach ($puxa as $value) 
            {
                $id = $value['id'];
            }
        }

        return $id;
    }

    public function pegaNomeUser($id)
    {
        $nome = '';
        $sql = $this->pdo->prepare("SELECT name FROM user_details WHERE id_user = :id");
        $sql->bindValue(":id",$id,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
            $nome = $dados['name'];
        }
        return $nome;
    }
    

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                            //UPLOAD DE ARQUIVOS E FUNÇÕES REFERENTES
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * <b>uploadMaster</b><br/>
     * Recebe uma imagem e faz os filtors de tamanho do arquivo, extensão etc. 
     * e passando pelos filtros o arquivo será salvo no FTP 
     * @param Array $vet - imagem que vou receber
     * @param String $caminho - caminho onde será salva a imagem
     * @param String $completaNomeBanco - sera concatenado no inicio do nome do arquivo para melhor identifica-lo (opcional)
     * @return boolean = true se der tudo certo e false se acontecer alguma falha
     */
    public function uploadImagem($vet,$caminho,$completaNomeBanco = '')
    {
        extract($vet); //$name - $type - $tmp_name - $error - $size');

        //regras//////////////////////////////////////////////////////

        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = $caminho; //'designer/images/empresaTemp/';

        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

        // Array com as extensões permitidas
        $_UP['extensoes'] = array('anl','jpg', 'png', 'gif');

        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';



        $vet_arq = explode('.',$name); //aqui crio um vetor separado pelo '.'

        $extensao = $vet_arq[count($vet_arq)-1];  //aqui pego a ultima possição do vetor
        $extensao = strtolower($extensao);

        //condições
        if ($error != 0) 
        {
            $this->msgErro = $_UP['erros'][$error];
            return false;
        }
        elseif ($size > $_UP['tamanho']) 
        {
            $this->msgErro = "Imagem com tamanho superior a 2mb.";
            return false;
        }
        elseif (array_search($extensao, $_UP['extensoes']) === false) 
        {
            $this->msgErro = "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif.";
            return false;
        }
        else
        {

            date_default_timezone_set('America/Sao_Paulo');
            $nomeBanco = $completaNomeBanco.md5($name).date("Y.m.d-H.i.s").".".$extensao;

            if (move_uploaded_file($tmp_name, $_UP['pasta'] . $nomeBanco)) 
            {
                // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
                $this->imagemBanco = $nomeBanco;
                return true;
            } 
            else 
            {
              // Não foi possível fazer o upload, provavelmente a pasta está incorreta
              $this->msgErro = "Não foi possível enviar o arquivo, tente novamente. Persistindo o erro comunique a equipe de TI.";
              return false;
            }
        }
    }
    
    
    /**
     * Muda o diretório de um arquivo
     * @param String $diferente = só muda o diretório se for diferente desse parametro
     * @param String $pastaAntiga = Diretório onde o arquivo se encontra
     * @param String $novaPasta = Diretório onde o arquivo será transferido
     * @param String $imagem = nome do arquivo
     */
    public function mudaPastaImagem($diferente, $pastaAntiga, $novaPasta, $imagem)
    {
        //mudo a imagem para a pasta correta
        if ($imagem != $diferente && $imagem != 'invalido.png') 
        {
            $caminhoNovo      = $novaPasta.$imagem;   //"designer/images/correspondente/".$imagemCorresp;
            $caminhoTemp      = $pastaAntiga.$imagem;   //"designer/images/correspondenteTemp/".$imagemCorresp;
            //mudo a imagem de pasta
            if(copy($caminhoTemp, $caminhoNovo))
            {
                unlink($caminhoTemp);
            }
        }
    }
    

    //método para excluir uma imagem (arquivo)
    public function excluiImagem($img, $diretorio)
    {
        if(file_exists($diretorio.$img))
        {
            if(unlink($diretorio.$img))
            {
                $retorno = true;
            }
            else
            {
                $retorno = false;
            }
        }
        else
        {
            $retorno = false;
        }
        return $retorno;
    }
    

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////                                                                                              //////
                                          //EXPRESSÃO REGULAR              
    //////                                                                                              //////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Passa a string por avaliação de expressão regular
     * @param String $expressao
     * @param String $string
     * @return boolean
     */
    public function expressaoRegular($expressao,$string)
    {
        if(preg_match($expressao,$string))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function soNumero($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

}   
?>
