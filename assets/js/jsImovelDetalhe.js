$(document).ready(function() {
	form = "";

	//PARA VERIFICAR TAMANHO DO ARQUIVO COM JAVASCRIPT
	const input = document.querySelector("#fileUpload")
	input.addEventListener("change", function(e) {
	const fileSize = e.target.files[0].size / 1024 / 1024; // para mb
	
		if (fileSize > 4) {
			alert("O arquivo tem mais de 4mb!")
			$("#fileUpload").val('');
			$(".file-path").val('');
		}
	
	});

	
	//PARA UTILIZAR O FORMDATA, MELHOR JEITO DE ENVIAR DADOS DO FORMULARIO
	$('#fileUpload').change(function (event) {
        form = new FormData();
        form.append('fileUpload', event.target.files[0]); // para apenas 1 arquivo
        //var name = event.target.files[0].content.name; // para capturar o nome do arquivo com sua extenção
    });

	//AJAX DAS FOTOS
    $.ajax({
    	url: '../../ajax_/ajax_lista_arquivo',
    	type: 'POST',
    	data: {id_imovel: $("#id_imovel").val()},
    	success: function (data) {
    		data = JSON.parse(data);

            var img = "";
    		for (var i = data.length - 1; i >= 0; i--) {
    			//console.log(data[i]);
    			var chek = '';
    			if (data[i].destaque !== null) 
    			{
    				chek = 'checked';
    			}


    			var ret = "<tr id='arquivo_"+data[i].id_foto+"'>";
            	ret += "<td>"+data[i].nome_arquivo+"</td>";
            	ret += "<td><a href='../../"+data[i].link_img+"' target='_blank' class='btn btn-floating btn-visualizar-foto' ><i class='material-icons'>visibility</i></a></td>";
            	ret += "<td><a href='#!' class='btn red btn-floating' onclick='excluirArquivo("+data[i].id_foto+","+'"'+data[i].nome_arquivo+'"'+")'><i class='material-icons left' >clear</i></a></td>";
                ret += "<td><p><label><input class='with-gap' name='destaque' onChange='marcarFotoDestaque();' type='radio' value='"+data[i].id_foto+"' "+chek+" id='test"+data[i].id_foto+"'  /><span for='test"+data[i].id_foto+"'></span></label</p></td>";
            	// ret += "<td><p><input name='destaque' type='radio' id='test"+data[i].id_foto+"' /><label for='test"+data[i].id_foto+"'>Destaque?</label></p></td>";
            	ret += "</tr>";

            	//IMG CARROUSEL
            	var url = window.location.href;

            	// img += "<a class='carousel-item' href='../../"+data[i].link_img+"'' target='_blank' ><img src='http://localhost/icc_painel/"+data[i].link_img+"'></a>"
            	img += "<li><a href='../../"+data[i].link_img+"' target='_blank'><img src='http://localhost/icc_painel/"+data[i].link_img+"' width='250' ></a></li>"


             	//mostrar os arquivos já enviados
            	$("#respostaAjax").append(ret);
    		}
  			
  			$(".fotoscarousel").html(img);
			  $('.slider').slider();

    	}
    });

         
});
//VARIÁVEL DE TESTE PARA VER SE HÁ ARQUIVO SELECIONADO MESMO
var teste = "";

//ADICIONAR FOTO
function enviaArq()
{
	// console.log($('#fileUpload'));
	teste = document.getElementById('arqtxt').value
	 form = new FormData();
	 form.append('fileUpload', $('#fileUpload')[0].files[0]);
	if(teste.length > 0)
	{
		form.append('id_imovel',$("#id_imovel").val());
		$('.div-botao').html('<a name="" class="right btn btn-large btn-flat disabled" id="envia_arq" ><i class="material-icons right"></i>Aguarde um momento...</a>');
        
        $.ajax({
            url: '../../ajax_/ajax_envia_arquivo', // Url do lado server que vai receber o arquivo
            data: form,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                // utilizar o retorno
                // console.log(data);
                data = JSON.parse(data);
                console.log(data);
                if(data.success == 1)
                {
                	//mostra a div
                	$("#ajaxresult").show();

                	var ret = "<tr id='arquivo_"+data.id_arquivo+"'>";
                	ret += "<td>"+data.nome_arquivo+"</td>";
                	ret += "<td><a href='../../"+data.link_arq+"' target='_blank' class='btn btn-floating btn-visualizar-foto' ><i class='material-icons'>visibility</i></a></td>";
                	ret += "<td><a href='#!' class='btn red btn-floating' onclick='excluirArquivo("+data.id_arquivo+","+'"'+data.nome_arquivo+'"'+")'><i class='material-icons left' >clear</i></a></td>";
                	ret += "<td><p><label><input class='with-gap' name='destaque' onChange='marcarFotoDestaque();' type='radio' value='"+data.id_arquivo+"' id='test"+data.id_arquivo+"'  /><span for='test"+data.id_arquivo+"'></span></label</p></td>";
                	ret += "</tr>";
                	//mostrar os arquivos já enviados
                	$("#respostaAjax").append(ret);
                	alert("Foto adicionada com sucesso!");
					$('#modal_addfotos').modal('close');
                }
                else
                {
                	alert(data.msgTitulo+' \n'+data.msg);
                }

                
                $("#fileUpload").val('');
                $(".file-path").val('');
    			$(".div-botao").html('<a class="right btn btn-padrao" id="envia_arq" onclick="enviaArq()"><i class="material-icons right">add</i>Adicionar Arquivo</a>')

                

            },
        });

	}
	else
	{
		alert('Você deve selecionar ao menos um arquivo.');
	}
	form = '';
	teste = '';
}

//MARCA A FOTO COMO DESTAQUE
function marcarFotoDestaque()
{
	var id_foto = $("input[name='destaque']:checked").val();
	var id_imovel = $("#id_imovel").val();

	// console.log(id_foto+id_imovel);
	$.ajax({
		url: '../../ajax_/ajax_marca_foto_destaque',
		type: 'POST',
		data: {id_foto: id_foto, id_imovel: id_imovel},
	})
	.done(function(data) {
		console.log(data);
	});
	
}

//EXCLUI A FOTO
function excluirArquivo(id_arq,nome_arq)
{
	var confirmar = confirm('Deseja realmente excluir o arquivo '+nome_arq+' ?')
	if(confirmar)
	{
		$.ajax({
			url: '../../ajax_/ajax_deleta_arquivo',
			type: 'post',
			data: {idarquivo: id_arq},
			success: function (data) {
				//console.log(data);
				data = JSON.parse(data);
				//console.log(data);

				if(data.success == 1)
                {
                	$("#arquivo_"+id_arq).remove();
                	alert(data.msg);
                }
                else
                {
                	alert(data.msg);
                }
			}
		});
	}

}

// EXCLUI O IMOVEL
function excluirImovel(id_imovel)
{
	$.confirm 
	({
		useBootstrap: false,
		title: "<b class='red-text'> Você deseja realmente excluir este Imóvel?</b>",
		content: "Uma vez excluido, não poderá recuperar posteriormente!<br>Isso também excluirá todas as fotos vinculadas ao imóvel!",
		buttons: {
			EXCLUIR: function (){

				$.ajax({
					url: '../../ajax_/excluirImovel',
					type: 'post',
					data: {id_imovel: id_imovel},
					success: function (data) {
						if (data == '1' || data == 1) {
							$.confirm 
							({
								useBootstrap: false,
								title: "Imóvel excluído com sucesso!",
								content: "",
								buttons: {
									OK: function()
									{
										location.href = "imovel";
									}
								}
							});
						}
						else
						{
							alert('Ocorreu um erro, favor entrar em contato com setor de T.I!');
						}
					}
				});

			},
			CANCELAR: function()
			{
				return;
			}
		}
	});
}
