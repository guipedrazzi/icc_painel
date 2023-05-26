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
							<a href="<?php echo RAIZ;?>/imovel/" class="breadcrumb bread-icon">Imovel</a>
							<a href="<?php echo RAIZ;?>/imovel/adicionar" class="breadcrumb bread-icon disabled">Adicionar</a>
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
					        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/house-things.svg" height="40">
								<span class="flow-text title-text">Adicionar um Imóvel</span>
							</p>
							<div class="subtitle-info">
								<p>
								<span>Nesta área você poderá adicionar um imóvel.
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
							<p class="flow-text title_green margin-title">Dados informativos:</p>
						</div><!-- col -->

						<div class="col s12 m6 l6 input-field">
							<select name="tipo" id="tipo" >
								<option value="">Selecione...</option>
								<option value="Apartamento">Apartamento</option> 
								<option value="Casa">Casa</option> 
								<option value="Comercial">Comercial</option> 
								<option value="Fazenda">Fazenda</option> 
								<option value="Flat">Flat</option> 
								<option value="Galpao">Galpão</option> 
								<option value="Garagem">Garagem</option> 
								<option value="Kitnet">Kitnet</option> 
								<option value="Loja">Loja</option> 
								<option value="Sala">Sala</option> 
								<option value="Sitio">Sitio</option> 
								<option value="SobreLoja">SobreLoja</option> 
								<option value="Terreno">Terreno</option> 
							</select>
							<label for="tipo">Tipo de imóvel *</label>
						</div><!-- col -->

						<div class="col s12 m6 l6 input-field">
							<select name="quartos" id="quartos" class="combox"> 
								<option value="" selected="">0</option> 
								<option value="1">1</option> 
								<option value="2">2</option> 
								<option value="3">3</option> 
								<option value="4">4</option> 
								<option value="5">5+</option> 
							</select> 
							<label for="quartos">Quartos</label>
						</div><!-- col -->

						<div class="col s12 m6 l4 input-field">
							<select name="banheiros" id="banheiros" class="combox"> 
								<option value="" selected="">0</option> 
								<option value="1">1</option> 
								<option value="2">2</option> 
								<option value="3">3</option> 
								<option value="4">4</option> 
								<option value="5">5+</option> 
							</select> 
							<label for="banheiros">Banheiros</label>
						</div><!-- col -->

						<div class="col s12 m6 l4 input-field">
							<select name="vagas_garagem" id="vagas_garagem" class="combox"> 
								<option value="" selected="">0</option> 
								<option value="1">1</option> 
								<option value="2">2</option> 
								<option value="3">3</option> 
								<option value="4">4</option> 
								<option value="5">5+</option> 
							</select> 
							<label for="vagas_garagem">Vagas na garangem</label>
						</div><!-- col -->

						<div class="col s12 m12 l4 input-field">
							<input type="number" name="metros_quadrados" value="" placeholder="Apenas Números">
							<label for="vagas_garagem">Metros quadrados</label>
						</div><!-- col -->

						<!-- === Title === -->
						<div class="col s12">
							<p class="flow-text title_green margin-title">Endereço:</p>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<select name="estado_endereco" id="estado_endereco" onchange="selecionarCidadePorUF(this.id,'cidade_endereco');">
								<option value="">Selecione...</option>
								<?php echo $ufs; ?>
							</select>
							<label for="estado_endereco">Estado</label>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<select name="cidade_endereco" id="cidade_endereco">
								<option value="">Selecione o estado primeiro...</option>
							</select>
							<label for="cidade_endereco">Cidade</label>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<input type="text" name="bairro_endereco" id="bairro_endereco">
							<label for="bairro_endereco">Bairro</label>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<input type="text" name="rua_endereco" id="rua_endereco">
							<label for="rua_endereco">Logradouro/Rua</label>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<input type="text" name="num_endereco" id="num_endereco">
							<label for="num_endereco">Número</label>
						</div><!-- col -->

						<div class="col s12 l6 input-field">
							<input type="text" name="comple_endereco" id="comple_endereco">
							<label for="comple_endereco">Complemento</label>
						</div><!-- col -->

						<!-- === Title === -->
						<div class="col s12">
							<p class="flow-text title_green margin-title">Observações:</p>
						</div><!-- col -->

						<div class="col s12 input-field">
							<textarea id="observacao" name="observacao" class="materialize-textarea"></textarea>
							<label for="observacao">Observações sobre o imóvel</label>
						</div><!-- col -->

						<!-- === Title === -->
						<div class="col s12">
							<p class="flow-text title_green margin-title">Dados do proprietário:</p>
							<span class="grey-text"><b>Estas informações não aparecerão para os visitantes</b></span>
						</div><!-- col -->

						<div class="col s12 m5 input-field">
							<input type="text" name="nome_dono" id="nome_dono">
							<label for="nome_dono">Nome</label>
						</div>

						<div class="col s12 m7 input-field">
							<textarea id="informacoes_dono" name="informacoes_dono" class="materialize-textarea"></textarea>
							<label for="informacoes_dono">Informações</label>
						</div>


				 		<!-- === Botão === -->
						<div class="col s12">
				 			<div class="btn-content">
				 				<!-- === Botão Voltar === -->
								<button class="waves-effect waves-light btn btn-padrao btn-margin right"><i class="material-icons right">add</i>Adicionar Imóvel</button>
							</div><!-- btn-content -->
						</div><!-- col -->

	                	<!-- <div class="col s12">
							<a href="<?php // echo RAIZ; ?>/imovel" class="btn btn-flat left">Voltar <i class="material-icons left">arrow_back</i></a>
						</div> -->

					</form>	

				</div><!-- row -->

			</div><!-- card-content -->			
		</div><!-- card -->
	</div> <!-- col -->
</div><!-- row -->
