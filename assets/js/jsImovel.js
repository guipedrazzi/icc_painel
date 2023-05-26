//TRATANDO A URL PRO AJAX E IMGS FUNCIONAR
var url = window.location.href;

//alert(url);
var a = url.split('/');
//console.log(a);
var urlajax;
var urlimg;

if(a.length == 5)
{
	urlajax = 'ajax_/listImovel';
	urlimg = '';
	urldetalhe = 'imovel/detalhes/';
}
else
{
	urlajax = '../ajax_/listImovel';
	urlimg = '../';
	urldetalhe = 'detalhes/';
}
//FIM

$(function() {

	listarImovel();
});

function listarImovel(page = 0)
{
	ret = '';
	$.ajax({
		url: urlajax,
		type: 'POST',
		data: {page: page},
		success: function(data)
		{
			console.log(data);
			data = JSON.parse(data);

			$(".pagCima").html(data['pagCima']);
			for (var i = 0; i < data['data'].length; i++) {

				data['data'][i]['link_img']

				data['data'][i]['metros_quadrados'] = data['data'][i]['metros_quadrados'] !== null ? data['data'][i]['metros_quadrados']+'<br>m²' : ' - ';
				data['data'][i]['quartos'] = data['data'][i]['quartos'] !== null ? data['data'][i]['quartos']+'<br>Quartos' : ' - ';
				data['data'][i]['banheiros'] = data['data'][i]['banheiros'] !== null ? data['data'][i]['banheiros']+'<br>Banheiros' : ' - ';
				data['data'][i]['vagas_garagem'] = data['data'][i]['vagas_garagem'] !== null ? data['data'][i]['vagas_garagem']+'<br>Vagas' : ' - ';
				data['data'][i]['link_img'] = data['data'][i]['link_img'] !== null ? data['data'][i]['link_img'] : 'assets/images/house.jpg';

				//arrumando a data
				//arrData = data['tabela'][i]['data_aud'].split("-");
				//dataCert = arrData[2]+'/'+arrData[1]+'/'+arrData[0];

				ret += '<div class="col s12 m6 l4 card-tamanho">';
				ret += 	'<div class="card">';
				ret +=		'<div class="card-image">';
				ret +=			'<img src="'+urlimg+data['data'][i]['link_img']+'" height="370">';
				ret += 			'<span class="card-title">ID '+data['data'][i]['id_imovel']+' </span>';
				ret +=	    '</div><!-- card-image -->';

				ret +=	    '<div class="card-content card-padding">';
				ret +=	        '<div class="margin-local">';
				ret +=		        '<i class="material-icons icon-local">place</i>';
				ret +=		        '<span class="info-local">'+data['data'][i]['cidade_endereco']+' - '+data['data'][i]['estado_endereco']+'</span>';
				ret +=			'</div><!-- material-icons -->';
				ret +=	        '<ul class="imovel-content">';
				ret +=             '<li class="info-imovel">';
				ret +=               '<i class="material-icons icon-imovel">open_with</i>';
				ret +=               '<span class="info-imovel2">'+data['data'][i]['metros_quadrados']+'</span><br>';
				ret +=             '</li>';

				ret +=             '<li class="info-imovel">';
				ret +=               '<i class="material-icons icon-imovel">hotel</i>';
				ret +=               '<span class="info-imovel2">'+data['data'][i]['quartos']+'</span><br>';
				ret +=             '</li>';

				ret +=             '<li class="info-imovel">';
				ret +=               '<i class="material-icons icon-imovel">opacity</i>';
				ret +=	             '<span class="info-imovel2">'+data['data'][i]['banheiros']+'</span><br>';
				ret +=             '</li>';

				ret +=				 '<li class="info-imovel">';
				ret +=               '<i class="material-icons icon-imovel">directions_car</i>';
				ret +=	             '<span class="info-imovel2">'+data['data'][i]['vagas_garagem']+'</span><br>';
				ret +=             '</li>';

			    ret +=          '</ul>';
				ret +=			'<p class="text-content">'+data['data'][i]['observacao']+'.</p>';
				ret +=	    '</div>';
				ret +=	    '';
				ret +=	    '<div class="card-action">';
				ret +=	       '<a href="'+urldetalhe+data['data'][i]['id_imovel']+'"><span class="link-imovel">VER TODOS OS DETALHES</span></a>';
				ret +=	    '</div><!-- card-action -->';
				ret += '</div><!-- card -->';
				ret +='</div><!-- col -->';
				
				//ret += "<td><a href='#modaledit_"+data['tabela'][i]['id']+"' class='btn btn-flat modal-trigger'><i class='material-icons'>edit</i></a></td>";
				//ret += "</tr>";
			}
			$('#listaimoveis').html(ret);
			$(".pagAbaixo").html(data['pagAbaixo']);

		}
	});
	
}