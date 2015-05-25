var controlerLogin = {
    
    init: function () {
        controlerLogin.read();
    },
    
    read: function () {
        
        var form = document.getElementById('logar');
        
        form.addEventListener('submit', function (event) {
                                            controlerLogin.sendValues();
                                            event.preventDefault();
                                        }
                             )
    },
    
    sendValues: function () {
        
        var user = document.getElementById('usuario').value;
        var pass = document.getElementById('senha').value;
        
        var data = $.post('../../php/login/valid_login.php',
                   {user:user, pass: pass},
                   function(data) {
                       controlerLogin.report(data);
                    } 
              );
    },
    
    report: function (data) {
        
        if(data=='success'){
            alert('Login realizado com sucesso!');
            document.location = '../../php/login/valid_access.php';
        }

        else if(data=='!user!pass')
            alert('Login e/ou senha inválidos!');

        else if(data=='nullFields')
            alert('Preencha todos os campos!');

        else    
            alert('Não foi possível realizar o login!');
    }
       
}

controlerLogin.init();
