
//////////////////////////////////////////////
// [LOG Função - Efeito Toggle LOG Hide and Show (LOG - Utilizado nas Páginas)]
var logGlobal;

function log(id){

    if (logGlobal == id){

        if ( $('#'+id).css('display') == 'none'){
            $('#'+id).toggle('slow');
        }else{
            $('.logFuncao').css('display','none');
        }
        
    } else {
        $('.logFuncao').css('display','none');
        $('#'+id).toggle('slow');
    }

    logGlobal = id;

}

