var ControllerCadPersonMaster = {

    init: function () {

        $('#dataSystem').show();
        $('#user').focus();

        //REMOVER TODOS OS EVENTOS RELACIONADO AO ANTIGO BOTÃO E TROCANDO POR UM NOVO NOME ID 
        $('#register').off();
        $('#register').attr('id', 'cadPersonMaster');

        $('#cadPersonMaster').click(function(e) {
            e.preventDefault();
            if($('#address').val() == '' || $('#block').val() == '' || $('#number').val() == ''  || 
               $('#cep').val() == '' || $('#city').val() == '' || $('#state').val() == ''){
                    $('#feedBackGeo').text('Preencha todos os campos!');
                    $('#feedBackGeo').addClass('alert alert-warning');
            }else{
                $('#feedBackGeo').text('');
                $('#feedBackGeo').removeClass('alert alert-warning');
                $('#feedBackGeo').removeClass('alert alert-danger');
                var form = ControllerCadPersonMaster.montForm();
                alert(JSON.stringify(form));
                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/register/user/added',
                    data: JSON.stringify(form),
                    success: function (data) {
                        if(data=='success'){
                            $('#feedBackGeo').text('Registrado com sucesso!');
                            $('#feedBackGeo').addClass('alert alert-success');
                            setTimeout(function () {
                                document.location = '/login';
                            }, 200);
                        }else{
                            $('#feedBackGeo').text('Houve alo de errado, contacte o suporte!!');
                            $('#feedBackGeo').addClass('alert alert-danger');
                        }
                    }
                });
            }
        });
    },

    montForm: function () {
        var  p = {'name': $('#name').val(),
                'user': $('#user').val(),
                'pass': $('#pass').val(),
                'access': $('#access').val(),
                'email': $('#email').val(),
                'cpf':  $('#cpf').val(),
                'address': $('#address').val(),
                'number': $('#number').val(),
                'comp': $('#comp').val(),
                'cep': $('#cep').val(),
                'block': $('#block').val(),
                'city': $('#city').val(),
                'tel': $('#tel').val(),
                'state' : $('#state').val(),
                'cel' : $('#cel').val()
            };
            
            return p;
    }
}

ControllerCadPersonMaster.init();