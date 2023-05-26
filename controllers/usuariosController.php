<?php 
/**
 * Controller de usuários. Para modificar os detalhes dos usuários.
 */
class usuariosController extends controller
{
    public function index()
    {
    	// //se não for admin, volta pra home
     //        if($_SESSION['user_type'] != 1)
     //            header("Location: ".RAIZ);

    	$data = array();
    	$objUser = new User();

		$data['lista'] = $objUser->getUsersList();



        $this->templateView('usuarios_home',$data) ;
    }

    public function detalhes()
    {
    	// //se não for admin, volta pra home
     //        if($_SESSION['user_type'] != 1)
     //            header("Location: ".RAIZ);
    	//aqui pego os argumentos e coloco em um array
        $params = func_get_args();
        
        //aqui pego o numero de argumentos recebido
        $num = func_num_args();

        if($num != 1)
        {
        	header("Location: ".RAIZ);
        	return false;
        }

        $id_user = $params[0];
        
        if ($id_user != $_SESSION['id_user']) {
        	header("Location: ".RAIZ);
        	return false;
        }

        $data = array();
		$objUser = new User();

		//pegando os dados do usuário
		$data['user'] = $objUser->getDadosUserById($id_user);

		if(isset($_POST) && !empty($_POST))
		{
	        if((isset($_POST['name']) && !empty($_POST['name'])) &&
			 (isset($_POST['login']) && !empty($_POST['login'])) && 
			 (isset($_POST['type']) && !empty($_POST['type'])) )
			 { 

				$erro = "";

				if(!$objUser->setLogin($_POST['login']))
				{
					$erro .= "<li>Login fora do padrão, favor preencher o campo com 4 caracteres ou mais. </li>";
				}

				if(!$objUser->setName($_POST['name']))
				{
					$erro .= "<li>Nome fora do padrão, favor preencher o campo com 4 caracteres ou mais. </li>";
				}

				if(!$objUser->setTypeUser($_POST['type']))
				{
					$erro .= "<li>Selecione ao menos um tipo de usuário do sistema. </li>";
				}

				// if($_POST['password'] === $_POST['repsenha'])
				// {
				// 	if(!$objUser->setPassword($_POST['password']))
				// 	{
				// 		$erro .= "<li>Senha fora do padrão, favor preencher o campo com 6 caracteres ou mais. </li>";
				// 	}
					
				// }
				// else
				// {
				// 	$erro .= "<li>Repetição de senha incorreta!</li>";
				// }

				//erros no backend
				if(empty($erro))
				{
					if($objUser->editUserDetails($data['user'],$_POST))
					{
						$data['msg'] = "<script>$.confirm 
						({
							useBootstrap: false,
							title: '<span class=".'green-text'."><b>Dados editados com sucesso</b></span>',
							content: '',
							buttons: {
								OK: function (){
									location.href= '".RAIZ."/usuarios/detalhes/".$id_user."';
								}

							}
						});</script>";
					}
					else
					{
						$data['msg'] = "<script>$.confirm 
						({
							useBootstrap: false,
							title: '<span class=".'red-text'."><b>ERRO</b></span>',
							content: 'Gentileza entrar em contato com setor de T.I',
							buttons: {
								Entendi: function (){
									return;
								}

							}
						});</script>";
					}
				}
				else
				{
					$data['msg'] = "<script>$.confirm 
					({
						useBootstrap: false,
						title: '<span class=".'red-text'."><b>ERRO</b></span>',
						content: '<ul>".$erro."</ul>',
						buttons: {
							Entendi: function (){
								return;
							}

						}
					});</script>";
				} 

	    	}
	    	else
	    	{
	    		$data['msg'] = "<script>$.confirm 
					({
						useBootstrap: false,
						title: '<span class=".'red-text'."><b>ERRO</b></span>',
						content: 'Favor preencher todos os campos obrigatórios',
						buttons: {
							Entendi: function (){
								return;
							}

						}
					});</script>";
	    	}
	    }

	    // print_r($data);
    	$this->templateView('usuarios_detalhes',$data);
    }

}