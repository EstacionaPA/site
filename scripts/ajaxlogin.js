//coleta as informacoes do formulario de login

$("button#submit").click( function() {

//se usuario e senha em brancos retorna a mensagem 
  if( $("#usuario").val() == "" || $("#senha").val() == "" )
    $("span#resultado").html("Usuário e senha obrigatórios");
  else
  	//chama o formulario de id logar, e executa a sql do action do form o login_user.php

    $.post( $("#logar").attr("action"),
	        $("#logar :input").serializeArray(),
			function(data) {
			  $("span#resultado").html(data);
			});
 
	$("#logar").submit( function() {
	   return false;	
	});
 
});