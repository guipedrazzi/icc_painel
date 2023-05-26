<?php if (isset($title_msg) && !empty($title_msg)): ?>
	<script>
		$.confirm 
        ({
            useBootstrap: false,
            title: "<span class='red-text'><?php echo $title_msg ?></span>",
            content: "<ul> <?php echo $content_msg ?> </ul>",
            buttons: {
                OK: function (){
                    <?php echo $func_msg; ?>
                }

            }
        });
    </script>
<?php endif ?>
<div class="row container">
    <div class="col s12">
      	<div class="card card-padrao">
            <div class="card-content">
              	<span class="card-title" style="text-align: center;"><h1>Imóveis Caparaó Capixaba</h1></span><h4 style="text-align: center;"></h4>
              	<div class="row">
					<div class="col s12"> 
						<div class="row">
							<form method="POST" id="login-form" action=""><br>
								<div class="col s12 input-field">
									<input class='input-field' type="text" id="login" name="login" required="" minlength="4">
									<label class="label" for="login">Login:</label>
								</div>
								<div class="col s12 input-field">
									<input type="password" name="senha" id="senha" required="" minlength="6">
									<label for="senha">Senha:</label>
								</div>
								<div class="col s12 input-field"><br>
									<button class="btn wave-effects right">Log in<i class="material-icons left">done</i></button>
									<a href="cadastrar.php" class="btn indigo wave-effects left tooltipped" data-position="bottom" data-tooltip="Se você não é cadastrado ainda, cadastre-se aqui">Cadastrar-se<i class="material-icons left">person_outline</i></a>
								</div>
							</form>
						</div>
					</div>	
				</div>
            </div>
      	</div>
    </div>
</div>