var editUser = {
    
    init: function () {
        editUser.readPage();
    },
    
    readPage: function () {
        
        var form = document.querySelector('form');
        
        form.addEventListener('submit', function (event) {
                                editUser.sendValues(form);
                                event.preventDefault();
                              });
    },
    
    sendValues: function (form) {
    
        var p = '',
            json = '',
            acao = '',
            newArray = '';
            
         //Building the JSON array  
        p = {
              'usuario': form.usuario.value,
              'acesso': form.acesso.value,
              'telefone': form.telefone.value,
              'email': form.email.value,
              'endereco': form.endereco.value,
              'complemento': form.complemento.value,
              'bairro': form.bairro.value,
              'numero': form.numero.value,
              'cep': form.cep.value,
              'cidade': form.cidade.value,
              'estado': form.estado.value
            };
         
        newArray = editUser.fillNullFields(p);
                              
        json = JSON.stringify(newArray);
    
        post = $.post('../../php/account_manager/manager_controller.php', 
                      {acao:'editar', objeto:json},
                      function (data) {
                        editUser.report(data);
                      });
    },
    
    fillNullFields: function (oldArray) {

        //This logic will be used when the user dont fill the fileld. The PHP needs this to use JSON correctly 
        for(var key in oldArray){
            if(oldArray[key] == '')
                oldArray[key] = '----NULO----';
        }
        
        return oldArray;
    },
    
    report: function(data) {
        
        if(data == 'success') 
            alert('Edição realizada com sucesso!');
        else if(data == 'nullFields')
            alert('Preencha pelo menos algum dos campos!');
        else if(data == 'user')
            alert('Este usuário já esta cadastrado!');
        else if(data == 'email')
            alert('Já existe uma pessoa cadastrada com esse email!');
        else if(data == 'cpf')
            alert('Já exite uma pessoa cadastrada com esse CPF!');
        else if(data == 'acesso')
            alert('Um acesso deve ser definido!');
        else if(data == '!user')
            alert('Este usuário não existe!');
        else if(data == 'inactive')
            alert('Este usuário esta inativado!');
        else
            alert('Por algum motivo, não foi possivel realizar a edição. Contacte um Administrador!'); 
    }
}

editUser.init();   