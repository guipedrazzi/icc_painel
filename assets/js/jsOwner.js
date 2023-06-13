$(document).ready(function() {
      // Máscara de CPF CNPJ da biblioteca jquer.mask
  $(".cpfCnpj").keydown(function(){
    try {
        $(".cpfCnpj").unmask();
    } catch (e) {}

    var tamanho = $(".cpfCnpj").val().length;

    if(tamanho < 11){
        $(".cpfCnpj").mask("999.999.999-99");
    } else {
        $(".cpfCnpj").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val('');
    $(this).val(currentValue);
  });
});