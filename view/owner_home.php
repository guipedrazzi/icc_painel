<!-- ===== Faixa Card Top ===== -->
<div class="row">
	<div class="col s12 l12">
		<div class="card-panel card-faixa z-depth-0">

		</div><!-- card-panel -->
	</div><!-- col -->
</div><!-- row -->


<div class="row margin-padrao">
	<div class="col s12">
		<div class="card ">
			<div class="card-content">

				<nav class="bread-menu">
					<div class="nav-wrapper">
						<div class="row">
							<div class="col s12 l6">
								<a href="<?php echo RAIZ;?>/" class="breadcrumb">Início</a>
								<a href="<?php echo RAIZ; ?>/owner/" class="breadcrumb bread-icon">Proprietários</a>
							</div><!-- col -->

							<div class="col s12 l6 hide-on-med-and-down">
								<div class="btn-content btn-add-imovel">
									<!-- === Botão Voltar === -->
									<a href="<?php echo RAIZ;?>/owner/add" class="waves-effect waves-light btn btn-margin right">Adicionar Proprietário</a>
								</div><!-- btn-content -->
							</div><!-- col -->
						</div><!-- row -->

					</div><!-- nav-wrapper -->
				</nav>
				<hr class="line-divider">


				<!-- === Icone Título === -->
				<div class="row">
					<div class="col s12">
						<div class="title-content">
							<p class="title-icon">
								<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/question.svg" height="40">
								<span class="flow-text title-text">Pesquisa de Proprietários</span>
							</p>
							<div class="subtitle-info">
								<p>
									<span>Nesta área você podera realizar a pesquisa dos proprietários adicionados.</span>
								</p>
								<p class="text-info-obrigatorio">Clique no botão realizar pesquisa, um campo de pesquisa aparecerá abaixo.</p>
							</div><!-- subtitle-info -->
						</div><!-- title-content -->
					</div><!-- col -->
				</div><!-- row -->


				<!-- ===== Botão - Visualizar  ===== --> 
				<div class="row">
					<div class="col s12 l6">
						<button class="waves-effect waves-light btn btn-padrao" onclick="log('btn-log');"><i class="material-icons right">search</i>Realizar Pesquisa</button>
					</div><!-- col -->
				</div><!-- row -->


				<!-- ===== CONTENT Pesquisa ===== --> 
                <div class="display logFuncao" id="btn-log">

	                <form method="get" accept-charset="utf-8" id="form_pesquisar">
						<div class="row">
							<div class="input-field col s12 l4">
								<input type="text" name="id_imovel" id="id_imovel">
								<label for="id_imovel">ID imóvel</label>
							</div><!-- col -->

							<div class="input-field col s12 l4">
								<input type="text" name="metros_quadrados" id="metros_quadrados">
								<label for="metros_quadrados">Metros quadrados</label>
							</div><!-- col -->

							<div class="input-field col s12 l4">
								<input type="text" name="nome_dono" id="nome_dono">
								<label for="nome_dono">Nome do proprietário</label>
							</div><!-- col -->

							<div class="input-field col s12 m6 l6">
								<select name="tipo" id="tipo">
									<option value="" disabled selected>Selecione...</option>
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
								<label for="tipo">Tipo de imóvel</label>
							</div><!-- col -->

							<div class="input-field col s12 m6 l6">
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

							<div class="input-field col s12 m6 l6">
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

							<div class="input-field col s12 m6 l6">
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

							<div class="input-field col s12">
								<input type="text" name="observacao" id="observacao" >
								<label for="observacao">Observação do imóvel</label>
							</div><!-- col -->
						</div><!-- row -->

						<!-- === Botão Pesquisar === -->
						<div class="row">
							<div class="col s12">
								<button class="waves-effect waves-light btn btn-padrao btn-pesquisar right">Pesquisar Imóvel</button> 
							</div><!-- col -->
						</div><!-- row -->
	                </form>	

				</div><!-- logFuncao -->
				<!-- === FIM - Content Pesquisa === -->

		
			</div><!-- card-content -->
		</div><!-- card -->
	</div><!-- col -->
</div><!-- row -->



<!-- ===== Faixa Card Top ===== -->
<div class="row margin-card">
	<div class="col s12 l12">
		<div class="card-panel card-faixa z-depth-0">

		</div><!-- card-panel -->
	</div><!-- col -->
</div><!-- row -->


<div class="row margin-padrao">
	<div class="col s12">
		<div class="card ">
			<div class="card-content">			


				<!-- === Icone Título === -->
				<div class="row">
					<div class="col s12 m8 l8">
						<div class="title-content">
							<p class="title-icon">
								<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/search.svg" height="40">
								<span class="flow-text title-text">Resultado da Pesquisa</span>
							</p>
							<div class="subtitle-info">
								<p>
									<span>Nesta área você terá a lista de todos imóveis em ordem decrescente de quando foi adicionado.
									</span>
								</p>
							</div>
						</div><!-- title-content -->
					</div><!-- col -->
				</div><!-- row -->


				<!-- ==== Card Imóvel ==== -->
				<div class="row">
					<!-- PAGINAÇÃO ACIMA -->
					<div class="pagCima col s12 pagination-no-padding"></div>

					<div id="listaimoveis">

					</div>

					<!-- PAGINAÇÃO ABAIXO -->
					<div class="pagAbaixo col s12 pagination-no-padding"></div>
				</div><!-- row -->
				<!-- ==== Fim Card Imóvel ==== -->


			</div><!-- card-content -->
		</div><!-- card -->
	</div><!-- col -->
</div><!-- row -->







	<script type="text/javascript" src="<?php echo RAIZ; ?>/assets/js/jsImovel.js"></script>