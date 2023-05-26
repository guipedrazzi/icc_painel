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