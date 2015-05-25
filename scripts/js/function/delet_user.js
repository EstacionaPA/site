var deletUser = {
    
    init: function () {
        deletUser.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('editar');
        
        form.addEventListener('submit', function (event) {
                                deletUser.sendValues();
                                event.preventDefault();
                              });
    },
    
    sendValues: function () {
        
        var user = $('#usuario').val();
        
        $.post('../../php/operation/delet_user.php',
               {user: user},
               function (data) {
                    deletUser.report(data);
                });
    },
    
    report: function (data) {
        
        if(data=='success')
            alert('Usuario excluido com sucesso!');
        
        else if(data=='!user')
            alert('Usuario Inválido!');
        
        else if(data=='nullField')
            alert('Informe um Usuário!');
        
        else
            alert(data);
    }
                  
};

deletUser.init();
                              