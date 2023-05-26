 	

 	<!-- ===== Faixa Card Top ===== -->
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
					
					<nav class="bread-menu">
					    <div class="nav-wrapper">
					      	<div class="col s12">
								<a href="<?php echo RAIZ;?>/" class="breadcrumb">Início</a>
								<a href="<?php echo RAIZ; ?>/usuarios/" class="breadcrumb bread-icon">Usuários</a>
					        </div><!-- col -->
					    </div><!-- nav-wrapper -->
					</nav>
					<hr class="line-divider">

					
					<!-- === Icone Título === -->
					<div class="row">
	                    <div class="col s12">
	                    	<div class="title-content">
								<p class="title-icon">
						        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/id-card.svg" height="40">
									<span class="flow-text title-text">Gerenciar Usuários</span>
								</p>

								<div class="subtitle-info">
									<p>
										<span>Aqui você terá uma lista de usuários cadastrados no sistema onde poderá ver e editar informações, apenas as suas informações.</span>
									</p>
								</div><!-- subtitle-info -->
							</div><!-- title-content -->
				 		</div><!-- col -->
	                </div><!-- row -->

	                <div class="row">
	                    <div class="col s12">
	                    	<div class="title-content title-margin-table">
								<p class="title-icon">
						        	<img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/icons/businessman.svg" height="40">
									<span class="flow-text title-text">Usuários Cadastrados</span>
								</p>		

								<div class="subtitle-info">
									<p>
										<span>Clique em acessar para ter acesso aos dados do usuário.</span>
									</p>
								</div><!-- subtitle-info -->							
							</div><!-- title-content -->
				 	
								<table class="highlight responsive-table">
							        <thead>
							          <tr>
							              <th>Name</th>
							              <th>E-Mail</th>
							              <th>Telefone</th>
							              <th>Acessar</th>
							          </tr>
							        </thead>

							        <tbody>
							        	<?php foreach ($lista as $value): ?>
									        <tr>
									            <td><?php echo $value['name']; ?></td>
									            <td><?php echo !empty($value['email'])?$value['email']:' - '; ?></td>
									            <td><?php echo !empty($value['phone'])?$value['phone']:' - '; ?></td>
									            <td>
									            	<?php if ($value['id_user'] == $_SESSION['id_user']): ?>
														<a href="<?php echo RAIZ.'/usuarios/detalhes/'.$value["id_user"] ?>" class="tooltipped" data-position="bottom" data-tooltip="Visualizar detalhes do usuário">
														<i class="material-icons icon-acessar">arrow_forward</i></a>
													<?php endif ?>
												</td>
									        </tr>
								        <?php endforeach ?>							       					        
							        </tbody>
						      </table>
						</div><!-- col -->
					</div><!-- row -->

				</div><!-- card-content -->
			</div><!-- card -->
		</div><!-- col -->
	</div><!-- row -->