<?php

class ajax_Controller extends controller
{

	public function pesquisarCidadePorEstado()
	{
		$selects = new Selects();

		echo $selects->selectCidadePorEstado($_POST['uf']); 

	}


	public function listImovel()
	{
		$objImovel = new Imovel();
		$arr = array();
		//echo "oi";
		if (isset($_POST['page'])) {


			$retorno = $objImovel->listarImovel($_POST['page']);
			$arr['data'] = $retorno;
			$arr['pagCima'] = $objImovel->paginacaoAcima;
			$arr['pagAbaixo'] = $objImovel->paginacaoAbaixo;
			
			$i = 0;
			//COLOCAR AS INFORMAÇÕES TRATADAS PARA IR PRO VIEW
			foreach ($arr['data'] as $value) {
				$arr['data'][$i]['link_img'] = $objImovel->getFotoDestaque($arr['data'][$i]['id_imovel']);
				//echo $value['id_imovel']."<br>";
				//PEGA UF e CIDADE 
				$arr['data'][$i]['estado_endereco'] = $value['estado_endereco'] != null ? $objImovel->pegaUfEstado($value['estado_endereco']) : 'UF não Informado';
				$arr['data'][$i]['cidade_endereco'] = $value['cidade_endereco'] != null ? $objImovel->pegaNomeCidade($value['cidade_endereco']) : 'Cidade não Informada';
				$arr['data'][$i]['observacao'] = $value['observacao'] != null ? $value['observacao'] : 'Nenhuma observação';
				
				$i++;
			}

			echo json_encode($arr);
		}
	}

	public function excluirImovel()
	{
		$objImovel = new Imovel();
		if($objImovel->excluirImovel($_POST['id_imovel']))
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
		
	}

	public function ajax_envia_arquivo()
	{
		$objImovel = new Imovel();

		if ($objImovel->verifQntFotos($_POST['id_imovel'])) //VEJO SE TEM MAIS QUE 5 FOTOS, SE TIVER RETORNA ERRO
		{
			$arrRetorno = array('success' => 0,'msgTitulo' => 'Ocorreu um erro ao enviar seu arquivo.','msg' => 'Cada imóvel só poderá ter 5 fotos no máximo.');

			echo json_encode($arrRetorno);
			exit();
		}

		// print_r($_FILES);
		// print_r($_POST);
		// exit();
		// Pasta onde o arquivo vai ser salvo
		$_UP['pasta'] = FILE_UPLOAD;
		// Tamanho máximo do arquivo (em Bytes)
		$_UP['tamanho'] = 2048 * 2048 * 2; // 4Mb
		// Array com as extensões permitidas
		$_UP['extensoes'] = array('jpg', 'png', 'jpeg');
		// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
		$_UP['renomeia'] = false;
		// Array com os tipos de erros de upload do PHP
		$_UP['erros'][0] = 'Não houve erro';
		$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite de 4mb';
		$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
		$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
		$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
		// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
		if ($_FILES['fileUpload']['error'] != 0) {
		  die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['fileUpload']['error']]);
		  exit; // Para a execução do script
		}
		// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
		// Faz a verificação da extensão do arquivo
		//separa o arquivo nome e extensão
		$arrArquivo = explode('.', $_FILES['fileUpload']['name']);
		$extensao = strtolower(end($arrArquivo));
		if (array_search($extensao, $_UP['extensoes']) === false) {
			$arrRetorno = array('success' => 0,
									'msgTitulo' => 'Ocorreu um erro ao enviar seu arquivo.',
									'msg' => 'Por favor, envie arquivos com as seguintes extensões: jpg, jpeg ou png');

				echo json_encode($arrRetorno);
		  exit;
		}
		// Faz a verificação do tamanho do arquivo
		if ($_UP['tamanho'] < $_FILES['fileUpload']['size']) {
			$arrRetorno = array('success' => 0,
									'msgTitulo' => 'Ocorreu um erro ao enviar seu arquivo.',
									'msg' => 'O arquivo enviado é muito grande, envie arquivos de até 4Mb.');

				echo json_encode($arrRetorno);
		  exit;
		}
		// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) {
		  // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
		  $nome_final = md5(time()).'.jpg';
		} else {
		  // Mantém o nome original do arquivo mais uma doideirinha
		  $nome_final = "foto".$_POST['id_imovel'].date("YmdHis").'.'.end($arrArquivo);
		}
		  
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $_UP['pasta'] . $nome_final)) 
		{
			$arr = array('name' => $_FILES['fileUpload']['name'], 'link_arq' => $_UP['pasta'].$nome_final);
			if($objImovel->adicionarFotos($_POST['id_imovel'],$arr))
			{
				$arrRetorno = array('success' => 1,
									'nome_arquivo' => $_FILES['fileUpload']['name'],
									'link_arq' => $_UP['pasta'].$nome_final,
									'id_arquivo' => $objImovel->lastID);

				echo json_encode($arrRetorno);
			  
			}
			else
			{
				$arrRetorno = array('success' => 0,
									'msgTitulo' => 'Ocorreu um erro ao enviar seu arquivo.',
									'msg' => 'Verifique o tipo do arquivo e o tamanho.');

				echo json_encode($arrRetorno);
			}

		} else {
		  	// Não foi possível fazer o upload, provavelmente a pasta está incorreta
		  	$arrRetorno = array('success' => 0,'msgTitulo' => 'Ocorreu um erro ao enviar seu arquivo.','msg' => 'Tente novamente mais tarde.');

			echo json_encode($arrRetorno);
		}
	}

	public function ajax_deleta_arquivo()
	{
		//print_r($_POST);

		$objImovel = new Imovel();

		if(isset($_POST) && !empty($_POST))
		{
			$dadosArq = $objImovel->getArquivoByIdArquivo($_POST['idarquivo']);

			if($objImovel->excluirArquivoByIdArquivo($_POST['idarquivo']))
			{
				unlink($dadosArq['link_img']);

				$arrJson = array('success' => 1,
								'msg' => 'Arquivo excluído com sucesso!');

			}
			else
			{
				$arrJson = array('success' => 0,
								'msg' => 'O sistema não pôde excluir o arquivo!');
			}

			echo json_encode($arrJson);
		}
	}

	public function ajax_lista_arquivo()
	{
		$arr = array();
		$objImovel = new Imovel();

		if(isset($_POST['id_imovel']) && !empty($_POST['id_imovel']))
		{
			$arr = $objImovel->getArquivosByIdImovel($_POST['id_imovel']);
		}

		echo json_encode($arr);
	}

	public function ajax_marca_foto_destaque()
	{
		if ( (isset($_POST['id_foto']) && !empty($_POST['id_foto'])) && (isset($_POST['id_imovel']) && !empty($_POST['id_imovel'])) )
		{
			$objImovel = new Imovel();

			$objImovel->marcarFotoDestaque($_POST['id_foto'],$_POST['id_imovel']);
		}
	}
}

?>
