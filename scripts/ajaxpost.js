    $("#enviar").click(function() {
        var nome = $("#nome");
        var nomePost = nome.val();
        var usuario = $("#usuario");
        var usuarioPost = usuario.val(); 
        var senha = $("#senha");
        var senhaPost = senha.val(); 
        var email = $("#email");
        var emailPost = email.val(); 
        var cpf = $("#cpf");
        var cpfPost = cpf.val(); 
        var endereco = $("#endereco");
        var enderecoPost = endereco.val(); 
        var numero = $("#numero");
        var numeroPost = numero.val(); 
        var complemento = $("#complemento");
        var complementoPost = complemento.val(); 
        var bairro = $("#bairro");
        var bairroPost = bairro.val(); 
        var cep = $("#cep");
        var cepPost = cep.val(); 
        var cidade = $("#cidade");
        var cidadePost = cidade.val(); 
        var estado = $("#estado");
        var estadoPost = estado.val(); 
        var telefone = $("#telefone");
        var telefonePost = telefone.val(); 
        var celular = $("#celular");
        var celularPost = celular.val(); 
             
        $.post("../php/insert_user.php", {nome: nomePost, usuario: usuarioPost, senha: senhaPost, 
            email: emailPost, cpf: cpfPost, emdereco: enderecoPost, 
            numero: numeroPost, complemento: complementoPost, bairro: bairroPost, 
            cep: cepPost, cidade: cidadePost, estado: estadoPost, teleone: telefonePost, celular: celularPost},
        function(data){
         $("#resposta").html(data);
         }
         , "html");
    });
});