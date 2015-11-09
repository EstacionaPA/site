var deletUser = {
    
    init: function () {
        deletUser.readPage();
    },
    
    readPage: function () {
        
        var form = document.querySelector('form');
        
        form.addEventListener('submit', function (event) {
                                deletUser.sendValues(form);
                                event.preventDefault();
                              });
    },
    
    sendValues: function (form) {
        
        var inactive = {
              'user': form.usuario.value,
              'cause': form.causa.value
            };
         
                              
        json = JSON.stringify(inactive);
        
        $.post('../../php/account_manager/manager_controller.php',
               {acao:'inativarPessoa', pessoa:json},
               function (data) {
                    deletUser.report(data);
                });
    },
    
    report: function (data) {
        
        if(data=='done')
            alert('Usuario inativado com sucesso!');
        
        else if(data=='!user')
            alert('Usuario Inválido!');
        
        else if(data=='nullUser')
            alert('Informe um Usuário!');
            
        else if(data=='nullCause')
            alert('Informe uma causa!');
        
        else
            alert(data);
    }
                  
};

deletUser.init();
                              