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



<div class="row margin-padrao">
	<div class="col s12">
		<div class="card">
			<div class="card-content">

				<!-- BREADCRUMB -->
				<nav class="bread-menu">
					<div class="nav-wrapper">						
						<div class="row">
							<div class="col s12 l6">
								<a href="<?php echo RAIZ;?>" class="breadcrumb">Início</a>
								<a href="<?php echo RAIZ;?>/imovel/" class="breadcrumb bread-icon">Imovel</a>
								<a href="#!" class="breadcrumb bread-icon disabled">Detalhes</a>
							</div>		
							<div class="col s12 l6">
								<div class="btn-content btn-excluir-imovel ">
									<a href="#!" class="btn right tooltipped" onclick="excluirImovel(<?php echo $dados['id_imovel'];?>)" data-position="bottom" data-tooltip="Excluir este imóvel.">Excluir imóvel</a>
								</div>							
							</div><!-- col -->
						</div><!-- row -->				
					</div><!-- nav-wrapper -->
				</nav>
				<!-- FIM BREADCRUMB -->
				
				<hr class="line-divider">

				<!-- === Icone Título === -->
				<div class="row">
					<div class="col s12">
						<div class="title-content">
							<p class="title-icon">
								<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/folder.svg" height="40">
								<span class="flow-text title-text">Detalhes do Imóvel de ID <b><?= $dados['id_imovel'] ?></b></span>
							</p>
							<div class="subtitle-info">
								<span>Nesta área você poderá editar e/ou excluir o imóvel selecionado.
								</span>	
								<p class="text-info-obrigatorio">(Campos obrigatórios: *)</p>	
								<br>	
							</div>
						</div><!-- title-content -->
					</div><!-- col -->
				</div><!-- row -->



				<div class="row">
					<div class="col s12">

						<ul class="content-user-add">
							<li>
								<p class="title-icon">
									<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/man.svg" height="22">
									<span class="text-add-info">Imóvel adicionado por: <b><?= $dados['nome_user_cadastro'] ?></b>
								</p>
							</li>
							<li>
								<p class="title-icon">
									<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/event.svg" height="22">
									<span class="text-add-info">Data: <b><?= $dados['data_cadastro'] ?></b> 
								</p>
							</li>
							<li>
								<p class="title-icon">
									<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/wall-clock.svg" height="22">
									<span class="text-add-info">Hora: <b><?= $dados['hora_cadastro'] ?></b>
								</p>
							</li>
						</ul>

						<br>

						<?php if (!empty($dados['nome_user_edit'])): ?>
							<span class="grey-text">Editado por <b><?= $dados['nome_user_edit'] ?></b> em <b><?= $dados['data_edit'] ?></b> às <b><?= $dados['hora_edit'] ?></b></span>
						<?php endif ?>

						<!-- PARTE FOTOS -->
						<div class="col s12 m6 l6 slide_tamanho">
							<div class="slider">
								<!-- PREENCHER VIA AJAX -->
								<!-- <a class="carousel-item" href="#one!"><img src="https://lorempixel.com/800/400/food/1"></a> -->
								<ul class="slides fotoscarousel">

								</ul>
							</div><!-- slider -->
							<button data-target="modal_fotos" class="waves-effect waves-light btn btn-padrao btn-foto modal-trigger btn-large"><i class="material-icons left">camera_alt</i>FOTOS</button>
						</div><!-- col -->

					</div><!-- col -->
				</div><!-- row -->


				<div class="row">
					<div class="col s12">

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
							</div>

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
							</div>

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
							</div>

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
							</div>

							<div class="col s12 m12 l4 input-field">
								<input type="number" name="metros_quadrados" value="<?= $dados['metros_quadrados'] ?>" placeholder="Apenas Números">
								<label for="vagas_garagem">Metros quadrados</label>
							</div>

							<!-- === Title === -->
							<div class="col s12">
								<p class="flow-text title_green margin-title">Endereço:</p>
							</div><!-- col -->

							<div class="col s12 m3 input-field">
								<select name="estado_endereco" id="estado_endereco" onchange="selecionarCidadePorUFEdit(this.id,'cidade_endereco');">
									<option value="">Selecione...</option>
									<?php echo $ufs; ?>
								</select>
								<label for="estado_endereco">Estado</label>
							</div>
							<div class="col s12 m9 input-field">
								<select name="cidade_endereco" id="cidade_endereco">
									<option value="">Selecione o estado primeiro...</option>
									<?= $select_cidade; ?>
								</select>
								<label for="cidade_endereco">Cidade</label>
							</div>
							<div class="col s12 m6 input-field">
								<input type="text" name="bairro_endereco" id="bairro_endereco" value="<?= $dados['bairro_endereco'] ?>">
								<label for="bairro_endereco">Bairro</label>
							</div>
							<div class="col s12 m6 input-field">
								<input type="text" name="rua_endereco" id="rua_endereco" value="<?= $dados['rua_endereco'] ?>">
								<label for="rua_endereco">Logradouro/Rua</label>
							</div>
							<div class="col s12 m3 input-field">
								<input type="text" name="num_endereco" id="num_endereco" value="<?= $dados['num_endereco'] ?>">
								<label for="num_endereco">Número</label>
							</div>
							<div class="col s12 m9 input-field">
								<input type="text" name="comple_endereco" id="comple_endereco" value="<?= $dados['comple_endereco'] ?>">
								<label for="comple_endereco">Complemento</label>
							</div>

							<!-- === Title === -->
							<div class="col s12">
								<p class="flow-text title_green margin-title">Observações:</p>
							</div><!-- col -->

							<div class="col s12 input-field">
								<textarea id="observacao" name="observacao" class="materialize-textarea"><?= $dados['observacao'] ?></textarea>
								<label for="observacao">Observações sobre o imóvel</label>
							</div>

							<!-- === Title === -->
							<div class="col s12">
								<p class="flow-text title_green margin-title">Dados do proprietário:</p>
								<span class="grey-text"><b>Estas informações não aparecerão para os visitantes</b></span>
							</div><!-- col -->

							<div class="col s12 input-field">
								<input type="text" name="nome_dono" id="nome_dono" value="<?= $dados['nome_dono'] ?>">
								<label for="nome_dono">Nome</label>
							</div>

							<div class="col s12 input-field">
								<textarea id="informacoes_dono" name="informacoes_dono" class="materialize-textarea"><?= $dados['informacoes_dono'] ?></textarea>
								<label for="informacoes_dono">Informações</label>
							</div>


							<div class="col s12">
								<div class="btn-content">
									<!-- === Botão Voltar === -->
									<button class="waves-effect waves-light btn btn-padrao btn-margin right"><i class="material-icons right">save</i>Salvar alterações</button>

									<a href="<?php echo RAIZ; ?>/imovel" class="btn btn-back left">Voltar <i class="material-icons left">arrow_back</i></a>
								</div><!-- btn-content -->
							</div><!-- col -->
						</form>	

					</div><!-- col -->
				</div><!-- row -->	

			</div><!-- card-content -->
		</div><!-- card -->
	</div><!-- col -->
</div><!-- row -->


	<!-- MODAL PARA FOTOS -->
	<!-- Modal Structure -->
	<div id="modal_fotos" class="modal modal-fixed-footer">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">
					<p class="title-icon">
						<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/image.svg" height="40">
						<span class="flow-text title-text">Fotos do Imóvel de ID <b><?= $dados['id_imovel'] ?></b></span>
					</p>
				</div><!-- col -->

				<div class="col s12 m12 l8">
					<p class="subtile-modal">Aqui você poderá adicionar ou excluir fotos que representem o imóvel.</p>
					<p class="info-modal">Você poderá adicionar até <strong> 5 </strong>fotos por imóvel.</p>
				</div><!-- col -->

				<div class="col s12  m12 l4">
					<button data-target="modal_addfotos" class="waves-effect waves-light btn btn-padrao btn-modal-add modal-trigger btn-large right"><i class="material-icons left">add</i>ADICIONAR FOTO</button>
				</div><!-- col -->
			</div><!-- row -->

			<br>
			<div class="row">
				<div class="col s12">

					<p class="title-icon">
						<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/pictures.svg" height="48">
						<span class="flow-text title-text">Tabela de fotos</span>
					</p>

					<table class="centered responsive-table highlight">
						<thead>
							<tr>
								<th>Nome do arquivo</th>
								<th>Visualizar</th>
								<th>Excluir</th>
								<th>Destaque?</th>
							</tr>
						</thead>
						<tbody id="respostaAjax">
							<!-- <tr>
								<td>data</td>
								<td><a href="#!" class="btn cyan btn-floating btn-visualizar-foto"><i class="material-icons">visibility</i></a></td>
								<td><a href="#!" class="btn red btn-floating btn-visualizar-foto"><i class="material-icons">clear</i></a></td>
							</tr>
							 -->
						</tbody>
					</table>
				</div><!-- col -->
			</div><!-- row -->

		</div><!-- modal-content -->
		<div class="modal-footer">	
			<div class="row no-margin">
				<div class="col s12">
					<a href="#!" class="modal-action modal-close btn btn-back">FECHAR</a>
				</div><!-- col -->
			</div><!-- row -->	
		</div><!-- modal-footer -->
	</div><!-- modal -->


	<!-- === Modal Adicionar Fotos === -->
	<!-- Modal Structure -->
	<div id="modal_addfotos" class="modal">
		<div class="modal-content">

			<!-- === Icone Título === -->
			<div class="row">
				<div class="col s12">
					<div class="title-content">
						<p class="title-icon">
							<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/photo-camera.svg" height="40">
							<span class="flow-text title-text">Adicionar Foto</span>
						</p>
						<div class="subtitle-info">
							<span>Você pode selecionar de um arquivo vez.</span>	
							<br>	
						</div><!-- subtitle-info -->
					</div><!-- title-content -->
				</div><!-- col -->
			</div><!-- row -->

			<!-- FORM ADD FOTO -->
			<form action="#!" enctype="multipart/form-data" method="POST">
				<div class="file-field input-field">
					<div class="btn">
						<span>Escolher Arquivo</span>
						<input type="file" name="fileUpload" id="fileUpload" >
					</div><!-- btn -->

					<div class="file-path-wrapper">
						<input class="file-path validate" type="text" id="arqtxt" placeholder="Extensões: .jpg .png .jpeg | Tamanho máximo: 4Mb">
					</div><!-- file-path-wrapper -->
				</div><!-- file-field -->

				<input type="hidden" name="id_imovel" id="id_imovel" value="<?php echo isset($dados['id_imovel'])? $dados['id_imovel'] : 0; ?>" />
			</form>
		</div><!-- modal-content -->

		<div class="modal-footer">
			<div class="row">
				<div class="btn-footer-modal">
				<div class="col s12">
					<a class="right btn btn-padrao right btn-addModal" id="envia_arq" onclick="enviaArq()" ><i class="material-icons right">save</i>Salvar Foto</a>

					<a href="#!" class="modal-action modal-close btn btn-back">FECHAR</a>	

				</div><!-- col -->
			</div>
			</div><!-- row -->
		</div><!-- modal-footer -->

	</div><!-- modal -->	
	<!-- === FIM - Modal Adicionar Fotos === -->


	<script type="text/javascript" src="<?php echo RAIZ; ?>/assets/js/jsImovelDetalhe.js"></script>

	<?php 
	if(!empty($dados['estado_endereco'])){ echo "<script>selecionarSelect(".$dados['estado_endereco'].",'estado_endereco');</script>"; }
	if(!empty($dados['cidade_endereco'])){ echo "<script>selecionarSelect(".$dados['cidade_endereco'].",'cidade_endereco');</script>"; }
	if(!empty($dados['tipo'])){ echo "<script>selecionarSelect("."'".$dados['tipo']."'".",'tipo');</script>"; }
	if(!empty($dados['quartos'])){ echo "<script>selecionarSelect(".$dados['quartos'].",'quartos');</script>"; }
	if(!empty($dados['banheiros'])){ echo "<script>selecionarSelect(".$dados['banheiros'].",'banheiros');</script>"; }
	if(!empty($dados['vagas_garagem'])){ echo "<script>selecionarSelect(".$dados['vagas_garagem'].",'vagas_garagem');</script>"; }
	?>