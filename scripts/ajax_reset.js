//coleta as informacoes do formulario de login

$("button#submit").click( function() {

//se usuario e senha em brancos retorna a mensagem 
  if( $("#email").val() == "")
    $("span#resultado").add(alert("Email em Branco"));
	
  else
  	//chama o formulario de id logar, e executa a sql do action do form o login_user.php

    $.post( $("#resetar").attr("action"),
	        $("#resetar :input").serializeArray(),
			function(data) {
			  $("span#resultado").html(data);
			});
 
	$("#resetar").submit( function() {

	   return false;	
	});
 
});