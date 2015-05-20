var cadPerson = {
    
    init: function () {
        cadPerson.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('cadastrar');
        
        form.addEventListener('submit', function (event) {
                                            var data = cadPerson.sendValues();
                                            cadPerson.showResult(data);
                                            event.preventDefault();
                                            
                                        }
                             )
    },
    
    sendValues: function () {

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
             
        $.post("../../../php/operation/insert_user.php", {
            nome: nomePost, usuario: usuarioPost, senha: senhaPost, 
            email: emailPost, cpf: cpfPost, endereco: enderecoPost, 
            numero: numeroPost, complemento: complementoPost, bairro: bairroPost, 
            cep: cepPost, cidade: cidadePost, estado: estadoPost, telefone: telefonePost,
            celular:celularPost
        },
               
        function(data){
            return data;  
         });
    },
    
    showResult: function (data) {
        
        if(data == '1') 
            alert('Cadastro Realizado com sucesso!');
        else if(data == '2')
            alert('Preencha todos os campos!');
        else
            alert('Não possível realizar o cadastro! Contacte o administrador.'); 
    }
}

cadPerson.init();