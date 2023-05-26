/*
    AQUI SERÁ O AJAX QUE TERÁ EM TODA PARTE DO SISTEMA
    usando o controller ajax_Controller.php
*/

function selecionarCidadePorUF(estado_id,cidade_id)
{
    var uf = document.getElementById(estado_id).value;
    var inputEstado = document.getElementById(cidade_id);
    $.ajax({
            url: '../ajax_/pesquisarCidadePorEstado',
            type: 'post',
            data: {uf: uf},
            success: function (data) {
                inputEstado.innerHTML = data;
                M.updateTextFields();
                $('select').formSelect();

            }
        });
}

function selecionarCidadePorUFEdit(estado_id,cidade_id)
{
    var uf = document.getElementById(estado_id).value;
    var inputEstado = document.getElementById(cidade_id);
    $.ajax({
            url: '../../ajax_/pesquisarCidadePorEstado',
            type: 'post',
            data: {uf: uf},
            success: function (data) {
                inputEstado.innerHTML = data;
                M.updateTextFields();
                $('select').formSelect();

            }
        });
}


//esta função serve para os "editar" da vida, pois ele dá o "selected" 
//sem precisar passar por verificações PHP
function selecionarSelect(valor, id)
{
    var combo = document.getElementById(id);

    for (var i = 0; i < combo.options.length; i++)
    {
        if (combo.options[i].value == valor)
        {
            combo.options[i].selected = "true";
            break;
        }
    }
}


function datacerta(data)
{
  if(data !== null)
  {
    var dataparecer = data.split('-');

    data = dataparecer[2]+"/"+dataparecer[1]+"/"+dataparecer[0];
  }
  else
  {
    data = " - ";
  }

  return data;
}

// function drawCharts(period, init_date, show_loading) {
//   var dados = null;
//   $.ajax({
//     url: 'ajax_/estatisticas_media_dist_parec',
//     type: 'POST',
//     data: {param1: 'value1'},
//   })
//   .done(function(data) {
//     console.log(data);
//     dados = data
//     console.log(dados);
//   });
  
//   if(dados == null)
//     return false;

//   var labels = ["Jan", "Fev", "Mar", "Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"];

//   var myChart = new Chart($("#chart_tempo_medio_dist_parec"), {
//     type: 'bar',
//     data: {
//       labels: labels,
//       datasets: [{
//         spanGaps: false,
//         label: 'Hrs',
//         fill: false,
//         backgroundColor: 'rgba(24,177,63,0.4)',
//         borderColor: 'rgba(21,101,51,1)',
        
//         data: [12.4, 22, 7, 18, 3, 7, 9, 19, 5, 7, 8, 24 ],
//         borderWidth: 1
//       }]
//     },
//     options: {
//         maintainAspectRatio: false,
//       title: {
//         display: true,
//         text: 'Tempo médio desde a distribuição até o parecer por mês (em horas)'
//       },
//       legend: {
//         display: false,
//       },
//       layout: {
//         padding: {
//           left: 10,
//           right: 10,
//           top: 10,
//           bottom: 10
//         }
//       },
//       animation: {
//         duration: 500,
//       },
//       hover: {
//         animationDuration: 100,
//       },
//       scales: {
//         yAxes: [{
//           ticks: {
//             beginAtZero: true,
//             // stepSize: 5,
//             callback: function(value, index, values) {
//               return value + " Hrs ";
//             }
//           }
//         }]
//       }
//     }
//   });

// }

