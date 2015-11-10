var ServiceLogin = {
    
    addListener: function (form, callBack) {
        form.addEventListener('submit', function (event) {
            callBack();
            event.preventDefault();
        })
    },
    
    sendValues: function (user, pass, callBack) {
        
        var post = 
        $.post (
            '../../php/login/login_controller.php',
            {user:user, pass: pass},
            function(data) {
                alert(data.length);
                callBack(data);
            } 
        );
    },
    
    report: function (data){
        
        if(data=='done')
            alert('Login realizado com sucesso!');

        else if(data=='!user!pass')
            alert('Login e/ou senha inválidos!');

        else if(data=='nullFields')
            alert('Preencha todos os campos!');
            
        else if(data=='inactive')
            alert('O seu usuario foi inativado!');

        else    
            alert(data);
    },
    
    openPage: function () {
        document.location = '../../php/pages/pages_controller.php';
    },
    
    getPass: function () {
        return document.getElementById('senha').value;
    },
    
    getUSer: function () {
        return document.getElementById('usuario').value;
    }
       
    
}