<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>E-Mail Imóvel Adicionado</title>


		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>


	</head>

	<body>


		<!-- ========================================================
			============= E-Mail  Contato ===========================
			========================================================= -->


		<!-- CONTAINER -->
		<table  class="container" style="border: solid 1px; border-color: #c3c3c370">
			<tr>
				<td>
					
				    <!-- ===== Banner ===== -->   
				    <div class="banner">
				        <p class="title-banner">Imóvel Adicionado</p>
				    </div>

				    <p class="text-info">Imóvel Adicionado com Sucesso!</p>

	    			<p class="text-subinfo">Clique aqui para acessar a nossa plataforma.</p>


					<div class="">
						<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
							<tbody>
								<tr>
									<td>
							        	<a href="#">        
							    			<button  class="btn-vermais" name="" type="button" value="" id="">Acessar</button>	
						  				</a>
						  			</td>
								</tr>								
							</tbody>
						</table>
					</div>

					<div class="divider"></div>

					<div class="info-contato">
						<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
							<tbody>							
							    <tr>
									<td class="contato"><p>Rogerio</p>
									<p>(28) 9 9984-1712</p>
									<p>(28) 9 9913-0854</p>
									<p>rogeriocaparao@gmail.com</p></td>

									<td class="contato contato-display"><p>José Miguel Benelli</p>
									<p>(28) 9 9977-9036</p></td>								
								</tr>						  											
							</tbody>
						</table>
					</div><!-- info-contato -->


				</td>
			</tr>
		</table>
		<!-- FIM CONTAINER -->




		<!-- =================================
			============= CSS ===============
			================================= -->


		<style>


			body {
				background-color: #fafafa;
				font-family: "Roboto", sans-serif;
				font-weight: normal;
				padding: 10px;
			}

			.container {   
				padding-bottom: 10px;
				background-color: #fff; 
				margin-bottom:  100px;
				margin: 0 auto;
				width: 40%;
			}


			#logo {    
				align-content: center;
			    align-items: center;
			    width: 100%;
			    position: relative;
			    padding-top: 7px;
			    margin-bottom: 10px;
			    top: -15%;
			}

			.banner {
		        background-image: url(../../assets/images/add-imovel.png);
		        -webkit-background-size: cover;
		        -moz-background-size: cover;
		        -o-background-size: cover;
		        background-size: cover;
		        background-repeat: no-repeat;
		        background-position: center;
		        width: 100%;
		        height: 250px;
		        display: flex;
		        align-items: center;
		        justify-content: center;
		    }

		    .title-banner {
		        font-size: 26px;
		        width: 100%;
		        color: #FFF;
		        font-weight: 500;
		        text-align: center;
		        margin: 0;
		    }

			ul  {
				list-style-type: none;
			}

			p {
				color: #3ba99c;
				margin-left: 25px;
				margin-right: 25px;
				word-break: break-word;    
				line-height: 0.5;
			}

			.text-dados {
				word-break: break-word;
				color: #6b6b6b;
				font-weight: 400;
			}

			.text-info {
				line-height: 1.5;    
				margin: 30px auto;
			    text-align: center;
			    font-size: 20px;
			    width: 65%;
			}

			.text-subinfo {
				text-align: center;    
				line-height: 1.5;
			}
						
			.txt-content {
				font-size: 15px;
				margin: auto;
				margin: 15px 0 15px 0;
				font-weight: 600;
			}

			.divider {
				height: 1px;
				overflow: hidden;
				background-color: #e0e0e0;
			}

			.footer {
				padding-bottom: 10px;
				background-color: ; 
				margin-bottom:  10px;
				margin: 0 auto;
				width: 40%;
			}

			tr {
				margin-top: -40px;    
				border-bottom: none;
			}

			td {
				padding: 0;
				color: #3ba99c !important;
				padding-top:0;				
			}



			.btn-vermais  {
			    color: #fff !important;
			    padding: 10px 40px 10px 40px;
			    font-weight: 500;
			    font-size: 14px;
			    text-transform: uppercase;
			    border: none;
			    position: relative;
			    background: #349895;
			    -webkit-border-radius: 5px;
			    -moz-border-radius: 5px;
			    border-radius: 5px;
			    margin: 20px auto 10px 0;
			    cursor: pointer;
			    transition: all 500ms ease-in-out;

			    left: 50%;
			    margin-right: -50%;
			    transform: translate(-50%, -50%);

			    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
			    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
			    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
			}

			.contato p {
				line-height: 1;
			}

			.contato-display {
				display: block;
			}

			.info-contato {
				margin: 15px 0 15px 0;
			}


			/* ===== @mediaQuery -   CONTANER ===== */


			@media only screen and (max-width: 1492px)
			{
				.container {
					width: 55%;
				}
			}


			@media only screen and (max-width: 1092px)
			{
				.container {
					width: 65%;
				}

			}


			@media only screen and (max-width: 992px)
			{
				.container {
					width: 80%;
				}
			}


			@media only screen and (max-width: 685px)
			{
				.container {
					width: 100%;
					max-width: 100%
				}
			}



			@media only screen and (max-width: 360px)
			{
				.container {
					width: 100%;
					max-width: 100%
				}
			}



			/* ===== @mediaQuery - TÍTULO ===== */

			@media only screen and (max-width: 685px)
			{
				#title {
					margin-top: 12px;
				}
			}



			@media only screen and (max-width: 600px)
			{    
				.banner {
			        background-image: url(../../assets/images/add-imovel.png);
			        -webkit-background-size: cover;
			        -moz-background-size: cover;
			        -o-background-size: cover;
			        background-size: cover;
			        background-repeat: no-repeat;
			        background-position: center;
			        width: 100%;
			        height: 160px;
			        display: flex;
			        align-items: center;
			        justify-content: center;
			    }

				.text-info {
					line-height: 1.5;    
					margin: 30px auto;
				    text-align: center;
				    width: 85%;			
				} 

				.title-banner {
			        font-size: 22px;
			        width: 100%;
			        color: #FFF;
			        font-weight: 500;
			        text-align: center;
			        margin: 0;
			    }

			    .btn-vermais {
				    color: #fff !important;
				    padding: 10px 40px 10px 40px;
				    font-weight: 500;
				    font-size: 12px;
				    text-transform: uppercase;
				    border: none;
				    position: relative;
				    background: #349895;
				    -webkit-border-radius: 5px;
				    -moz-border-radius: 5px;
				    border-radius: 5px;
				    margin: 20px auto 10px 0;
				    cursor: pointer;
				    transition: all 500ms ease-in-out;
				    left: 50%;
				    margin-right: -50%;
				    transform: translate(-50%, -50%);
				    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
				    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
				    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.2);
				}

			    .contato  {
					display: inherit;
				}		

				.contato p {
				line-height: 1;
				font-size: 14px;
			}	

		}


		</style>



	</body>
</html>





