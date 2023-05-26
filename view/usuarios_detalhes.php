
	<?php 
		if(isset($msg))
		{
			echo $msg;
		}
	?>

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
					        <div class="col s12">
								<a href="<?php echo RAIZ;?>/" class="breadcrumb">Início</a>
								<a href="<?php echo RAIZ; ?>/usuarios/" class="breadcrumb bread-icon">Usuários</a>
								<a href="<?php echo RAIZ; ?>/usuarios/detalhes/" class="breadcrumb bread-icon">Detalhes</a>
					        </div><!-- col -->
					    </div><!-- nav-wrapper -->
					 </nav>
                    <hr class="line-divider">
      
					<!-- === Icone Título === -->
					<div class="row">
	                    <div class="col s12 m8 l8">
	                    	<div class="title-content">
								<p class="title-icon">
						        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/curriculum-vitae.svg" height="40">
									<span class="flow-text title-text">Dados do usuário: <strong class="text-name-usuario"><?php echo $user['name']; ?></strong></span>
								</p>
								<div class="subtitle-info">
									<p>
									<span>Nesta área você tem acesso aos dados do usuário, você pode editar os campos que aparecem nessa exibição e alterar a sua senha facilmente clicando no botão editar senha.
									</span>
									</p>
								</div>
							</div><!-- title-content -->
				 		</div><!-- col -->

				 		<!-- <div class="col s12  m4 l4 hide-on-med-and-down">
				 			<div class="btn-content">
				 				<a href="<?php // echo RAIZ ?>/usuarios" class="btn-flat btn-voltar right tooltipped" data-position="bottom" data-tooltip="Voltar para a página anterior"><i class="material-icons icon-btn-voltar">keyboard_return</i>Voltar</a>
							</div>
						</div> --> 
	                </div><!-- row -->

					<div class="row">						
						<div class="col s12"> 

							<div class="row">								
								<form method="POST" id="cadastro-form" action="" class=""><br>
									<div class="col s12 m12 l6 input-field">
										<input type="text" name="name" id="name" required="" minlength="4" value="<?php echo $user['name']; ?>">
										<label class="label" for="name">Nome completo (mínimo 4 caracteres) *</label>
									</div><!-- col -->

									<div class="col s12 m12 l6 input-field">
										<input class='input-field' type="text" id="login" name="login" required="" minlength="4" value="<?php echo $user['login']; ?>">
										<label class="label" for="login">Login (mínimo 4 caracteres) *</label>
									</div><!-- col -->

									<div class="col s12 m12 l6 input-field">
										<input type="text" name="email" id="email" placeholder="xxxxxx@xxxxxx.xxx.xx" value="<?php echo isset($user['email'])?$user['email']:''; ?>">
										<label class="label" for="email">Email</label>
									</div><!-- col -->

									<div class="col s12 m12 l6 input-field">
										<input type="text" name="phone" id="phone" placeholder="(99)99999-9999 ou (33)3333-3333" class="telefone" value="<?php echo isset($user['phone'])?$user['phone']:''; ?>">
										<label class="label" for="phone">Telefone</label>
									</div><!-- col -->

									<div class="col s12 input-field">
										<input type="date" name="birthdate" id="birthdate" value="<?php echo isset($user['birthdate'])?$user['birthdate']:''; ?>">
										<label class="label" for="birthdate">Data de nascimento</label>
									</div><!-- col -->
									
									<!-- <div class="col s12 input-field">
										<input type="password" name="password" id="password" required="" minlength="6">
										<label for="password">Senha (mínimo 6 caracteres) *</label>
									</div>
									<div class="col s12 input-field">
										<input type="password" name="repsenha" id="repsenha" required="" minlength="6">
										<label for="repsenha">Repita a senha* </label>
									</div> -->
																		
									<div class="col s12">
										<div class="btn-content-margin">
											<!-- === Botão Salvar Dados === -->
											<button class="waves-effect waves-light btn btn-padrao btn-margin right"><i class="material-icons left">save</i>Salvar</button>


											<!-- === Botão Editar Senha === -->
											<a  href="#modal1" class="waves-effect waves-light btn btn-padrao right modal-trigger"><i class="material-icons left">lock</i>Editar Senha</a>
										</div><!-- btn-content-margin -->
									</div><!-- col -->

								</form>

								<div class="modal modal-content" id="modal1">

									<!-- === Icone Título === -->
									<div class="row">
					                    <div class="col s12 m6 l6">
					                    	<div class="title-content-modal">
												<p class="title-icon">
										        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/employee.svg" height="40">
													<span class="flow-text title-text">Nova Senha</span>
												</p>
												<div class="subtitle-info">
													<p>
														<span>Digite a nova senha e clique no botão salvar para concluir.
														</span>
													</p>
													<label>(Mínimo 6 caracteres)</label>
												</div>
											</div><!-- title-content -->
								 		</div><!-- col -->
								 	</div><!-- row -->

									<div class="row">
										<div class="col s12">
											<form id="form_senha">
												<div class="col s12 input-field">
													<input type="password" name="password" id="password" required="" minlength="6">
													<label for="password">Nova Senha*</label>
												</div><!-- col -->

												<div class="col s12 input-field margin-modal-senha">
													<input type="password" name="repsenha" id="repsenha" required="" minlength="6">
													<label for="repsenha">Repita a nova senha* </label>
												</div><!-- col -->
												
												<input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id_user']; ?>">

												<div class="btn-content-margin">
													<!-- === Botão Salvar Dados === -->
													<button class="waves-effect waves-light btn btn-padrao btn-margin right"><i class="material-icons left">save</i>Salvar</button>
																		
													<!-- === Botão Editar Senha === -->
													<a  href="#modal1" class="waves-effect waves-light btn btn-cancelar right modal-close"><i class="material-icons left">clear</i>Cancelar</a>
												</div><!-- btn-content-margin -->
											</form>
										</div><!-- col -->
									</div><!-- row -->

								</div><!-- modal -->
							</div><!-- row -->

						</div><!-- col -->
					</div><!-- row -->

				</div><!-- card-content -->
			</div><!-- card -->
		</div><!-- col -->
	</div><!-- row -->

	<script type="text/javascript" src="<?php echo RAIZ; ?>/assets/js/jsUsuario.js"></script>



