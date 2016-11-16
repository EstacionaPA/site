/*
$obj['name'], $obj['user'], $obj['pass'], 
$obj['email'], $obj['cpf'], $obj['address'],  
$obj['number'], $obj['comp'], $obj['block'], 
$obj['cep'], $obj['city'], $obj['state'], 
$obj['tel'], $obj['cel'], $obj['access']);
*/

var ControllerRegister = {

    init: function () {

        var form = null,
            feedback = null;

        $('#dataSystem').hide();
        $('#dataPerson').hide();
        $('#dataGeo').hide();
        
        $('#acceptButton').click(function() {
            $('#accept').hide('specialEasing');
            $('#dataSystem').show('progress');
            $('#user').focus();
        });

        $('#nextToPerson').click(function(e) {
            e.preventDefault();

            if($('#user').val() == '' || $('#pass').val() == ''){
                $('#feedBackSystem').text('Preencha todos os campos!');
                $('#feedBackSystem').addClass('alert alert-warning');
            }else{
                $('#feedBackSystem').text('');
                $('#feedBackSystem').removeClass('alert alert-warning');
                $('#feedBackSystem').removeClass('alert alert-danger');

                form = ControllerRegister.montForm();
                
                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/checkValuesRegister',
                    data: JSON.stringify(form),
                    success: function (data) {
                        feedback = JSON.parse(data);
                        
                        if(feedback.user == 'done'){
                            $('#feedBackSystem').text('Já existe uma pessoa registrada com esse usuário!');
                            $('#feedBackSystem').addClass('alert alert-danger');
                        }else{
                            $('#dataSystem').hide('specialEasing');
                            $('#dataPerson').show('progress');
                            $('#name').focus();
                        }
                    }
                });
            }
        });

        $('#backToSystem').click(function() {
            $('#dataPerson').hide('specialEasing');
            $('#dataSystem').show('progress');
        });

        $('#nextToGeo').click(function(e) {
            e.preventDefault();

            if($('#name').val() == '' || $('#cpf').val() == '' || $('#tel').val() == ''  || 
               $('#cel').val() == '' || $('#email').val() == ''){
                    $('#feedBackPerson').text('Preencha todos os campos!');
                    $('#feedBackPerson').addClass('alert alert-warning');
            }else{
                $('#feedBackPerson').text('');
                $('#feedBackPerson').removeClass('alert alert-warning');
                $('#feedBackPerson').removeClass('alert alert-danger');

                form = ControllerRegister.montForm();
                
                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/checkValuesRegister',
                    data: JSON.stringify(form),
                    success: function (data) {
                        feedback = JSON.parse(data);
                        if(feedback.CPF == 'done'){
                            $('#feedBackPerson').text('Já existe uma pessoa registrada com esse CPF!');
                            $('#feedBackPerson').addClass('alert alert-danger');
                        }else if(feedback.email == 'done') {
                            $('#feedBackPerson').text('Já existe uma pessoa registrada com esse Email!');
                            $('#feedBackPerson').addClass('alert alert-danger');
                        }else{
                            $('#dataPerson').hide('specialEasing');
                            $('#dataGeo').show('progress');
                            $('#address').focus();
                        }
                    }
                });
            }
        });

        $('#backToPerson').click(function() {
            $('#dataGeo').hide('specialEasing');
            $('#dataPerson').show('progress');
        });

        $('#register').click(function(e) {
            e.preventDefault();

            if($('#address').val() == '' || $('#block').val() == '' || $('#number').val() == ''  || 
               $('#cep').val() == '' || $('#city').val() == '' || $('#state').val() == ''){
                    $('#feedBackGeo').text('Preencha todos os campos!');
                    $('#feedBackGeo').addClass('alert alert-warning');
            }else{
                $('#feedBackGeo').text('');
                $('#feedBackGeo').removeClass('alert alert-warning');
                $('#feedBackGeo').removeClass('alert alert-danger');
                var form = ControllerRegister.montForm();

                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/register/client/added',
                    data: JSON.stringify(form),
                    success: function (data) {
                        $('#feedBackGeo').text('Registrado com sucesso!');
                        $('#feedBackGeo').addClass('alert alert-success');

                        setTimeout(function () {
                            document.location = '/login';
                        }, 1000)
                    }
                });
            }
        });
    
    },

    montForm: function () {
          p = {'name': $('#name').val(),
                'user': $('#user').val(),
                'pass': $('#pass').val(),
                'access': 'vazio',
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

ControllerRegister.init();