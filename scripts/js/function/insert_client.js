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
        p = {   'name': form.nome.value,
                'user': form.usuario.value,
                'pass': form.senha.value,
                'access': 'vazio',
                'email': form.email.value,
                'cpf':  form.cpf.value,
                'address': form.endereco.value,
                'number': form.numero.value,
                'comp': form.complemento.value,
                'cep': form.cep.value,
                'block': form.bairro.value,
                'city': form.cidade.value,
                'tel': form.telefone.value,
                'state' : form.estado.value,
                'cel' : form.celular.value
        };
    
        post = $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: '/register/client/added',
            data: JSON.stringify(p),
            success: function (data) {
                cadPerson.showResult(data);
            }
        });

    },
    
    showResult: function (data) {
        
        if(data == 'success') {
            alert('Cadastro Realizado com sucesso!');
            document.location = '/register';
        }
        else if(data == 'nullFields')
            alert('Preencha todos os campos!');
        else if(data == 'user')
            alert('Já existe uma pessoa cadastrada com esse usuário!');
        else if(data == 'email')
            alert('Já existe uma pessoa cadastrada com esse email!');
        else if(data == 'cpf')
            alert('Já exite uma pessoa cadastrada com esse CPF!');
        else
            alert(data); 
    }
}

cadPerson.init();