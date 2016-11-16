var ControllerLogin = {

    init: function () {

        var login = null;

        $('#submit').click(function (e) {
            e.preventDefault();
            if($('#user').val() == '' || $('#pass').val() == ''){
                $('#feedBack').addClass('alert alert-warning');
                $('#feedBack').text('Preencha todos os campos');
            }else{
                $('#feedBack').removeClass('alert alert-warning');
                $('#feedBack').text('');

                login = {'user': $('#user').val(),
                         'pass': $('#pass').val()};

                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/login/valid',
                    data: JSON.stringify(login),
                    success: function (feedback) {
                        //var feedback = JSON.parse(data);
                        
                        if(feedback == 'done'){
                            $('#feedBack').addClass('alert alert-success');
                            $('#feedBack').text('Login realizado com sucesso!');

                            setTimeout(function () {
                                document.location = '/login';
                            }, 1000);

                        }else if(feedback == 'inactive'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('Seu usuário foi inativado!');
                        }else if(feedback == '!user!pass'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('Usuário e/ou senha estão inválidos!');
                        }
                    }
                });
                
            }
        });
    }

}

ControllerLogin.init();