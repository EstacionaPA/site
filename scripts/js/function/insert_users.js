var cadPerson = {
    
    init: function () {
        cadPerson.readPage();
    },
    
    readPage: function () {
        
        var form = document.querySelector('form');
        
        form.addEventListener('submit', function (event) {
                                            cadPerson.sendValues(form);
                                            event.preventDefault(); 
                                        }
                             )
    },
    
    sendValues: function (form) {
    
        var p = '',
            json = '',
            acao = '';
            
         //Building the JSON array  
        p = {
                          'name': form.nome.value,
                          'user': form.usuario.value,
                          'pass': form.senha.value,
                          'access': form.acesso.value,
                          'email': form.email.value,
                          'cpf':  form.cpf.value,
                          'address': form.endereco.value,
                          'number': form.numero.value,
                          'comp': form.complemento.value,
                          'cep': form.cep.value,
                          'block': form.bairro.value,
                          'city': form.cidade.value,
                          'cel': form.celular.value,
                          'state': form.estado.value,
                          'tel': form.telefone.value
                       };
    
        post = $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: '/register/user/added',
            data: JSON.stringify(p),
            success: function (data) {
                cadPerson.showResult(data);
            }
                        
        });

    },
    
    showResult: function (data) {
        
        if(data == 'success') {
            alert('Cadastro Realizado com sucesso!');
            document.location = '/register/user';
        }
        else if(data == 'nullFields')
            alert('Preencha todos os campos!');
        else if(data == 'user')
            alert('Este usuário já esta cadastrado!');
        else if(data == 'email')
            alert('Já existe uma pessoa cadastrada com esse email!');
        else if(data == 'cpf')
            alert('Já exite uma pessoa cadastrada com esse CPF!');
        else if(data == 'acesso')
            alert('Um acesso deve ser definido!');
        else
            alert(data); 
    }
}

cadPerson.init();