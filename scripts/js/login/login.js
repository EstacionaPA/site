var controlerLogin = {
    
    init: function () {
        controlerLogin.read();
    },
    
    read: function () {
        
        var form = document.getElementById('logar');
        
        form.addEventListener('submit', function (event) {
                                            controlerLogin.sendValues();
                                            event.preventDefault();
                                            document.location = '../../../php/login/valid_login.php';
                                        }
                             )
    },
    
    sendValues: function () {
        
        var user = document.getElementById('usuario').value;
        var pass = document.getElementById('senha').value;
        
        var data = $.post('../../../php/login/login_user.php',
                   {user:user, pass: pass},
                   function(data) {
                       controlerLogin.report(data);
                    } 
              );
    },
    
    report: function (data) {
        
        if(data==1){
            alert('Login realizado com sucesso!');
        }

        else if(data==2)
            alert('Login e/ou senha inválidos!');

        else if(data==3)
            alert('Preencha todos os campos!');

        else    
            alert('Não foi possível realizar o login!');
    }
       
}

controlerLogin.init();
