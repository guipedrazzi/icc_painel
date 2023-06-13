<?php if(isset($msgTitulo)): ?>
	<script type="text/javascript">
		$.confirm 
	      ({
	          useBootstrap: false,
	          title: "<?php echo $msgTitulo; ?>",
	          content: "<?php echo $msgCorpo; ?>",
	          buttons: {
	              OK: function (){
	                  <?php echo $msgFuncao; ?>
	               }
	          }
	      });
	</script>
<?php endif; ?>


<div class="row">
    <div class="col s12 l12">
        <div class="card-panel card-faixa z-depth-0">

        </div><!-- card-panel -->
    </div><!-- col -->
</div><!-- row -->


<div class="row margin-padrao"> <!-- ROW -->
	<div class="col s12"> <!-- COL -->
		<div class="card">
			<div class="card-content">
				<!-- BREADCRUMB -->
				<nav class="bread-menu">
			    	<div class="nav-wrapper">
			    		<div class="col s12">
							<a href="<?php echo RAIZ;?>" class="breadcrumb">Início</a>
							<a href="<?php echo RAIZ;?>/owner/" class="breadcrumb bread-icon">Proprietário</a>
							<a href="<?php echo RAIZ;?>/owner/add" class="breadcrumb bread-icon disabled">Adicionar</a>
						</div><!-- col -->
					</div><!-- nav-wrapper -->
				</nav>
				<!-- FIM BREADCRUMB -->

                <hr class="line-divider">

				<!-- === Icone Título === -->
				<div class="row">
                    <div class="col s12 m8 l8">
                    	<div class="title-content">
							<p class="title-icon">
					        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/man.svg" height="40">
								<span class="flow-text title-text">Adicionar um proprietário</span>
							</p>
							<div class="subtitle-info">
								<p>
								<span>Nesta área você poderá adicionar um proprietário.
								</span>
								<p class="text-info-obrigatorio">(Campos obrigatórios: *)</p>								
							</div>
						</div><!-- title-content -->
			 		</div><!-- col -->
				</div><!-- row -->

				<div class="row">
					<form method="POST" action="">	
						<!-- === Title === -->
						<div class="col s12">
							<p class="flow-text title_green margin-title">Dados do proprietário:</p>
						</div><!-- col -->

						<div class="col s12 m5 input-field">
							<input type="text" name="nome_proprietario" id="nome_proprietario">
							<label for="nome_proprietario">Nome</label>
						</div>

						<div class="col s12 m7 input-field">
							<input type="text" id="cpf_cnpj" name="cpf_cnpj" class="materialize-input cpfCnpj" placeholder="Apenas números"></input>
							<label for="cpf_cnpj">CPF ou CNPJ</label>
						</div>


				 		<!-- === Botão === -->
						<div class="col s12">
				 			<div class="btn-content">
				 				<!-- === Botão Voltar === -->
								<button class="waves-effect waves-light btn btn-padrao btn-margin right"><i class="material-icons right">add</i>Adicionar proprietário</button>
							</div><!-- btn-content -->
						</div><!-- col -->


					</form>	

				</div><!-- row -->

			</div><!-- card-content -->			
		</div><!-- card -->
	</div> <!-- col -->
</div><!-- row -->


<script type="text/javascript" src="<?php echo RAIZ; ?>/assets/js/jsOwner.js"></script>