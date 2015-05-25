var editUser = {
    
    init: function () {
        editUser.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('editar');
        
        form.addEventListener('submit', function (event) {
                                editUser.sendValues();
                                event.preventDefault();
                              });
    },
    
    sendValues: function () {
        
        var user = $("#usuario").val();
        var access = $("#acesso").val();
        var tel = $("#telefone").val();
        var cel = $("#celular").val();
        var email = $("#email").val();
        var end = $("#endereco").val();
        var comp = $("#complemento").val();
        var num = $("#numero").val();
        var cep = $("#cep").val();
        var city = $("#cidade").val();
        var state = $("#estado").val();
        
        $.post('../../php/operation/edit_users.php',
               {user: user, access: access, tel: tel, cel: cel, email: email, end: end,
                comp: comp, num: num, cep: cep, city: city, state: state},
               function(data){
                    editUser.report(data);
                });
    },
    
    report: function(data) {
        
        if(data=='success')
            alert('O usuario foi alterado com sucesso!');
        
        else if(data=='noUserField')
            alert('Favor informar um usuario!');
        
        else if(data=='nullFields')
            alert('Favor informar pelo menos um campo!'); 
        
        else if(data=='!user')
            alert('Usuário inválido!'); 
        
        else
            alert(data);
    }
}

editUser.init();   