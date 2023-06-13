$(function () {
  $(".dropdown-trigger").dropdown();
  $('.tabs').tabs();
  $('.carousel').carousel();
  $('.parallax').parallax();
  $('.materialboxed').materialbox();
  $('.modal').modal();
  $('.tooltipped').tooltip({delay: 50});
  $('.collapsible').collapsible();
  $('.sidenav').sidenav();  
  $('select').formSelect();
  $('.slider').slider();
  // Materialize.updateTextFields();
  //$('#datatable').DataTable();
 $('.carousel.carousel-slider').carousel({fullWidth: true});

  //$('.telefone').maskbrphone();
  $('.telefone').maskbrphone({  
    useDdd           : true, // Define se o usuário deve digitar o DDD  
    useDddParenthesis: true,  // Informa se o DDD deve estar entre parênteses  
    dddSeparator     : ' ',   // Separador entre o DDD e o número do telefone  
    numberSeparator  : '-'    // Caracter que separa o prefixo e o sufixo do telefone  
  });

  $('.date').mask('11/11/1111');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
  $('.phone_us').mask('(000) 000-0000');
  $('.mixed').mask('AAA 000-S0S');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});

});




// <script>$.confirm 
//               ({
//                   useBootstrap: false,
//                   title: '<?php echo $msgTitulo; ?>',
//                   content: '<?php echo $msgConteudo; ?>',
//                   buttons: {
//                       OK: function (){
//                           <?php echo $msgFuncao; ?>
//                        }

//                   }
//               });
//     </script>