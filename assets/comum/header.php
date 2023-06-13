<!DOCTYPE html>
<html>
    <head>
        <title>Imóveis Caparaó Capixaba - Área Administrativa</title>
        <meta charset="UTF-8">
          
        <!-- Material Icons -->
        <link rel="stylesheet" href="<?php echo RAIZ; ?>/assets/fonts/material-icon/material-icons.css">

        <!-- Font Roboto -->
        <link rel="stylesheet" href="<?php echo RAIZ; ?>/assets/fonts/roboto/roboto.css">

        <!-- Framework Front-end Matelialize (CSS) -->
        <link rel="stylesheet" href="<?php echo RAIZ; ?>/assets/framework/materialize/css/materialize.css">

        <!-- CSS Principal -->
        <link rel="stylesheet" href="<?php echo RAIZ; ?>/assets/css/style.css">

        <link rel="stylesheet" href="<?php echo RAIZ; ?>/assets/js/jqueryconfirm/jquery-confirm.min.css">

        <!-- Otimização para equipamentos Mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- Datatables -->
        <link rel="stylesheet" type="text/css" href="<?php echo RAIZ; ?>/assets/bibliotecas/datatables/DataTables-1.10.16/css/jquery.dataTables.css">
    </head>
    <body>
        <script type="text/javascript" src="<?php echo RAIZ; ?>/assets/bibliotecas/jquery/jquery-3.3.1.js"></script>
        <script src="<?php echo RAIZ; ?>/ajax/baseAjax.js"></script>
        <script src="<?php echo RAIZ; ?>/assets/js/jqueryconfirm/jquery-confirm.min.js"></script>


        <ul id="slide-out" class="sidenav sidenav-fixed collapsible collapsible-accordion flow-text sidenav-menu text-menu">
            <li>
                <div class="user-view user-content">
                    <div class="background" style="background-color: #6b6b6b">
                        <div class="bg-info-user">
                        </div>
                    </div><!-- background -->
                        <!-- <span class="hide-on-large-only"><a href="#" data-target="slide-out" class="sidenav-close  white-text"><i class="material-icons">menu</i></a><br></span> -->                 
                    <span class=" white-text flow-text">Bem vindo(a)!</span>
                    <span class="white-text name text-name"><i class="material-icons left">account_circle</i><?php echo !empty($_SESSION['user_name'])?$_SESSION['user_name']:""; ?>
                    </span>
                 
                    <span class="white-text email text-email no-padding"><i class="material-icons left">email</i> <?php echo !empty($_SESSION['user_email'])?$_SESSION['user_email']:"Email Não informado"; ?>
                    </span>
                    <span class="white-text email text-tel"><i class="material-icons left">phone</i> <?php echo !empty($_SESSION['user_phone'])?$_SESSION['user_phone']:"Telefone Não informado"; ?>
                    </span>
                </div><!-- user-view -->
            </li>
            <li><a href="<?php echo RAIZ; ?>/" class=""><i class="material-icons">home</i>Início</a></li>
            <li>
                <a class="collapsible-header sidenav-header-drop"><i class="material-icons icon-cor">store</i>Imóveis<i class="material-icons right icon-sidenav-drop">arrow_drop_down</i></a>
                <div class="collapsible-body sidenav-body-drop">
                    <ul>
                        <li><a href="<?php echo RAIZ; ?>/imovel"><i class="material-icons icon-cor">keyboard_arrow_right</i>Pesquisar</a></li> 
                        <li><a href="<?php echo RAIZ; ?>/imovel/adicionar"><i class="material-icons icon-cor">keyboard_arrow_right</i>Adicionar</a></li>

                    </ul>
                </div><!-- collapsible-body -->
            </li>
             <li>
                <a class="collapsible-header sidenav-header-drop"><i class="material-icons icon-cor">people</i>Proprietários<i class="material-icons right icon-sidenav-drop">arrow_drop_down</i></a>
                <div class="collapsible-body sidenav-body-drop">
                    <ul>
                        <li><a href="<?php echo RAIZ; ?>/owner"><i class="material-icons icon-cor">keyboard_arrow_right</i>Pesquisar</a></li> 
                        <li><a href="<?php echo RAIZ; ?>/owner/add"><i class="material-icons icon-cor">keyboard_arrow_right</i>Adicionar</a></li>

                    </ul>
                </div><!-- collapsible-body-->
            </li> 
            <li>
                <a class="collapsible-header sidenav-header-drop"><i class="material-icons icon-cor">person</i>Usuário<i class="material-icons right icon-sidenav-drop">arrow_drop_down</i></a>
                <div class="collapsible-body sidenav-body-drop">
                    <ul>
                        <li><a href="<?php echo RAIZ; ?>/usuarios"><i class="material-icons icon-cor">keyboard_arrow_right</i>Usuário Cadastrado</a></li>
                        <li><a href="<?php echo RAIZ; ?>/"><i class="material-icons icon-cor">keyboard_arrow_right</i>Cadastrar Usuário</a></li>
                        <li><a href="<?php echo RAIZ; ?>/usuarios/detalhes/<?php echo $_SESSION['id_user']; ?>"><i class="material-icons icon-cor">keyboard_arrow_right</i>Perfil do Usuário</a></li>

                    </ul>
                </div><!-- collapsible-body -->
            </li>
            <li class="text-sair"><a href="<?php echo RAIZ; ?>/login/sair"><i class="material-icons">power_settings_new
                </i>Sair do Sistema</a>
            </li>

        </ul>

          
        <div class="navbar-fixed">
            <nav class="nav-menu">
                <div class="nav-wrapper">
                    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <a href="#" class="brand-logo logo-icc show-on-med-and-down">                               
                        <img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/logo-icc.png" title="Logo Imóveis Caparaó Capixaba">
                    </a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li class="logo-menu logo-icc">
                            <a href="#" class="brand-logo"> 
                                <img class="icon-padrao" src="<?php echo RAIZ; ?>../assets/images/logo-icc.png" title="Logo Imóveis Caparaó Capixaba">
                            </a>
                        </li>
                        <li><a href="<?php echo RAIZ; ?>/login/sair" class="btn btn-flat btn-sair">Sair<i class="material-icons left">power_settings_new</i></a></li>
                    </ul>
                </div><!-- nav-wrapper -->
            </nav>
        </div><!-- navbar-fixed -->
        
    <main>
