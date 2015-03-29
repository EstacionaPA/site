$(document).ready(function(){
	$('#errolog').hide(); //Esconde o elemento com id errolog
	$('#formLogin').submit(function(){ 	//Ao submeter formulário
		var login=$('#username').val();	//Pega valor do campo email
		var senha=$('#password').val();	//Pega valor do campo senha
		$.ajax({			//Função AJAX
			url:"../php/login_user.php",			//Arquivo php
			type:"post",				//Método de envio
			data: "login="+login+"&senha="+senha,	//Dados
   			success: function (result){			//Sucesso no AJAX
                		if(result==1){						
                			location.href='restrito.php'	//Redireciona
                		}else{
                			$('#errolog').show();		//Informa o erro
                		}
            		}
		})
		return false;	//Evita que a página seja atualizada
	})
})