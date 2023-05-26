//submit do formulário para adicionar um histórico
$("#form_senha").submit(function(e) {

    var url = "../../ajax_/trocarSenha"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#form_senha").serialize(), // serializes the form's elements.
           success: function(data)
           {
               	console.log(data); // show response from the php script.
           		if (data == '1' || data == 1) {
					$.confirm 
					({
						useBootstrap: false,
						title: "<b>Senha trocada com <span class='green-text'>sucesso</span>.</b>",
						content: "",
						buttons: {
							OK: function()
							{
								location.reload();
							}
						}
					});
				}
				else if(data == '2' || data == 2)
				{
					alert('Ocorreu um erro, favor entrar em contato com setor de T.I!');
				}
				else
				{
					$.confirm 
					({
						useBootstrap: false,
						title: "<b>Repetição de senha <span class='red-text'>inválida</span>.</b>",
						content: "",
						buttons: {
							OK: function()
							{
								return;
							}
						}
					});
				}
               // location.reload();
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
