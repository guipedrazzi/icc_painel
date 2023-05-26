	<script type="text/javascript" src="assets/bibliotecas/jquery/jquery-3.3.1.js"></script>

	<script src="assets/bibliotecas/maskbrphone/maskbrphone.js"></script>
    
    <!-- Framework Front-end Matelialize (JS) -->

	<!-- <script src="assets/framework/materialize/js/materialize.js"></script> -->
   
    <!-- Jquery AJAX.forms -->
    <script src="assets/js/jquery.form.min.js"></script>

    <script src="assets/js/jqueryconfirm/jquery-confirm.min.js"></script>
    

    <script src="assets/js/jsconfig.js"></script>
<?php 	
	include 'configr.php';
	include 'core/model.php';
	include 'models/Login.php';

	if((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['senha']) && !empty($_POST['senha'])) )
	{
		$objLogin = new Login();

		$erro = "";

		if(!$objLogin->setPassword($_POST['senha']))
		{
			$erro .= "<li>Senha fora do padrão, favor preencher o campo com 6 caracteres ou mais. </li>";
		}

		if(!$objLogin->setLogin($_POST['login']))
		{
			$erro .= "<li>Login fora do padrão, favor preencher o campo com 4 caracteres ou mais. </li>";
		}

		//erros no backend
		if(!empty($erro))
		{
			echo "<script>$.confirm 
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
		else
		{
			if($objLogin->logInUser())
			{
				echo "<script>
							location.href = 'home';
						</script>";
			}
			else
			{
				echo "<script>$.confirm 
				({
					useBootstrap: false,
					title: '<span class=".'red-text'."><b>ERRO</b></span>',
					content: 'Login não encontrado! <br> Gentileza verifique seu login e senha.',
					buttons: {
						Entendi: function (){
							return;
						}

					}
				});</script>";
			}
		} 

		

	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	  	<title>ICC Painel Administrativo</title>
	  	<meta charset="UTF-8">
	    
	    <!-- Material Icons -->
	    <link rel="stylesheet" href="assets/fonts/material-icon/material-icons.css">

	    <!-- Font Roboto -->
	    <link rel="stylesheet" href="assets/fonts/roboto/roboto.css">

	    <!-- Framework Front-end Matelialize (CSS) -->
	    <link rel="stylesheet" href="assets/framework/materialize/css/materialize.css">

	    <!-- CSS Principal -->
	    <link rel="stylesheet" href="assets/js/jqueryconfirm/jquery-confirm.min.css">

		<!-- CSS Login -->
	    <link rel="stylesheet" href="assets/css/login.css">

	    <!-- Otimização para equipamentos Mobile -->
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>

		<div class="row height-row no-margin bg-mobile">
		    <div class="col s12 m12 l5 center-left">
		        
		        <div class="row">
		            <div class="col s12 content-logo">
		            	<div class="hide-on-med-and-down">
		            		<div class="logo-icc">
			                	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/logo-icc.png" title="Logo Imóveis Caparaó Capixaba">
							</div>
						</div>
						<div class="hide-on-large-only">
		               		<div class="logo-icc">
			                	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/logo-icc2.png" title="Logo Imóveis Caparaó Capixaba">
							</div>
		                </div>
		                <br/>
		            </div><!-- col -->
		        </div><!-- row -->

		        <div class="row no-margin">
		        	<div class="col s12">
			            <form method="POST" id="login-form" action="" class="container"><br>
							<div class="col s12 input-field">
								<i class="material-icons prefix color-icon">account_circle</i>
								<input class="input-field text-form" type="text" id="login" name="login" required="" minlength="4">
								<label class="label" for="login">Login:</label>
							</div><!-- col -->

							<div class="col s12 input-field">
								<i class="material-icons prefix color-icon">https</i>
								<input type="password" name="senha" id="senha" required="" minlength="6" class="text-form">
								<label for="senha">Senha:</label>
							</div><!-- col -->


							<div class="col s12"><br>
								<!-- === Botão Entrar === -->
								<button class="waves-effect waves-light btn btn-entrar btn-margin right"><i class="material-icons right">play_arrow</i>Entrar</button>
									<!-- 	<a href="cadastrar.php" class="waves-effect waves-light btn btn-padrao btn-margin left"><i class="material-icons right">person_outline</i>Cadastrar-se</a>
 									-->		
 							</div><!-- col -->
 							<div class="col s12">
 								<p class="text-criarConta right">Ainda não possui um cadastro? <a href="cadastrar.php">Criar cadastro</a></p>
							</div><!-- col -->

						</form>
			        </div><!-- col -->
			    </div><!--  row -->

		    </div><!-- col -->

		    <div class="col s12 m12 l7 background-login hide-on-med-and-down">
		        <div class="content-background">
		            <h2>Bem-vindo!</h2>
		            <h3 class="sub-titulo-1">Painel administrativo <strong>Imóveis Caparaó Capixaba.</strong></h3>
		            <p class="sub-titulo-2">Para acessar entre com o seu <strong>login</strong> e <strong> senha </strong> <br> já cadastrado em nossa plataforma!</p>
		        </div><!-- content-background -->
		    </div><!-- col -->
		</div><!-- row -->


	</body>

	<!-- <footer class="page-footer blue">
	  	<div class="footer-copyright">
		    <div class="container">
			    © Guilherme Pedrazzi 
			    <span class="grey-text text-lighten-4 right" >Protocolo PMDRP</span>
		    </div>
	  	</div>
	</footer> -->


	<script type="text/javascript" src="assets/bibliotecas/jquery/jquery-3.3.1.js"></script>

    <!-- Framework Front-end Matelialize (JS) -->
	<script src="assets/framework/materialize/js/materialize.js"></script>
    <!-- Jquery AJAX.forms -->
    <script src="assets/js/jquery.form.min.js"></script>

    <script src="assets/js/jqueryconfirm/jquery-confirm.min.js"></script>
    
    <script src="assets/js/jsconfig.js"></script>


</html>
