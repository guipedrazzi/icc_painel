    
    <div class="container">
    	<div class="row">
            <div class="col s12">
                <div class="card center z-depth-0">
                    <div class="card-content teal-text">
                        <span class="card-title">ERROR</span>
                        <br>    
                        <img class="img-error" src="<?php echo RAIZ; ?>../assets/images/error.png">
                        <p class="text-error">Pagina não encontrada!</p>
                    </div>
                    <div class="card-action">
                          <a href="<?php echo RAIZ ?>" class="waves-effect waves-light btn btn-padrao">Voltar</a>
                    </div><!-- card-action -->
                </div><!-- card -->
            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->



    <style type="text/css">

    .card .card-content .card-title {
        background: #1db59e;
        border-radius: 0;
        color: white;
    }

    .card-title {
        font-weight: bold !important;
        color: white;
    }

    .img-error {
        width: 40%;
    }


    .text-error {
        margin-top: 25px !important;
        font-size: 20px;
    }



    @media only screen and (max-width: 600px) {
        .img-error {
            width: 80%;
        }

        .card .card-content .card-title {
            background: #1db59e;
            border-radius: 0s;
            display: block;
            padding: 5px 20px;
            font-size: 16px;
            line-height: 32px;
            margin-bottom: 10px;
        }

        .text-error {
            margin-top: 25px !important;
            font-size: 16px;
        }
    }
    </style>