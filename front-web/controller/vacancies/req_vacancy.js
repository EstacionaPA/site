var ControllerRequestVacancy = {

    init: function () {
        
        ControllerRequestVacancy.getUser();
        ControllerRequestVacancy.getParks();
        $('#h_init').mask('99');
        $('#h_end').mask('99');
        $('#date').mask('99/99/9999');

        $('#request').click(function (e) {
            e.preventDefault();
            if($('#user').val() == 'nothing' || $('#idCar').val() == 'nothing' || 
                $('#idEst').val() == 'nothing' ||  $('#vacancy').val() == '' || 
                $('#h_init').val() == '' || $('#h_end').val() == '' || $('#date').val() == '') {
                    $('#feedBack').text('Preencha todos os campos!');
                    $('#feedBack').addClass('alert alert-warning');
            }else{
                $('#feedBack').removeClass('alert alert-warning');
                $('#feedBack').removeClass('alert alert-success');
                $('#feedBack').removeClass('alert alert-danger');
                $('#feedBack').text('Enviando e analisando pedido...');
                $('#feedBack').addClass('alert alert-info');

                var request = {'id_carro': $('#idCar').val(),
                               'id_estac': $('#idEst').val(),
                               'vaga': $('#vacancy').val(),
                               'hora_reserva': $('#h_init').val() + ':00:00',
                               'hora_fim': $('#h_end').val() + ':00:00',
                               'data': $('#date').val(),
                               'usuario': $('#user').val()};

                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/vacancies/request',
                    data: JSON.stringify(request),
                    success: function (feedBack) {
                        $('#feedBack').removeClass('alert alert-info');
                        if(feedBack =='done'){
                            $('#feedBack').addClass('alert alert-success');
                            $('#feedBack').text('Sua vaga foi reservada com sucesso!!');
                        }else if(feedBack =='!validHourFunc'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('O horario está fora do horario de funcionamento do estacionamento!');
                        }else if(feedBack =='!validObject'){
                            $('#feedBack').addClass('alert alert-danger');
                            $('#feedBack').text('Há campos sem preenchimento!!');
                        }else if(feedBack =='!validDate'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('A data informada é inválida!');
                        }else if(feedBack =='!validIdCar'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('O carro selecionado é inválido!');
                        }else if(feedBack =='!validVacancy'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('A vaga informada é inválida ou maior do que a quantidade suportada!');
                        }else if(feedBack =='!validHourBetween' || feedBack =='!validHourInitEnd'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('Horario informado está entre um horario já reservado!');
                        }else if(feedBack =='!validHourEnd'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('O horario de término está entre um horario já reservado!');
                        }else if(feedBack =='!validHourInit'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('O horario de início está entre um horario já reservado!');
                        }else if(feedBack =='!validHourRequest'){
                            $('#feedBack').addClass('alert alert-warning');
                            $('#feedBack').text('A hora de início é maior que a do fim!');
                        }
                    }

                })
            }
        });
    },

    getCars: function (user) {

        var JSONuser = {'user': user};

        var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/getCars',
                    data: JSON.stringify(JSONuser),
                    success: function (list) {
                        ControllerRequestVacancy.createList(JSON.parse(list), 'idCar');
                        $('#loadCar').text('SELECIONE UM CARRO!');
                    }
        });
    },

    getParks: function () {
        var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/getParks',
                    success: function (list) {
                        ControllerRequestVacancy.createList(JSON.parse(list), 'idEst');
                        $('#loadEst').text('SELECIONE UM ESTACIONAMENTO!');
                    }
        });
    },

    getUser: function () {
        var get = $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: '/getuser.login',
                    success: function (list) {
                        var list = JSON.parse(list);
                        ControllerRequestVacancy.getCars(list[0].usuario);
                        ControllerRequestVacancy.createList(list, 'user');
                        $('#loadUser').text('SELECIONE UM USUÁRIO!');
                    }
        });
    },

    createList: function (list, type) {
        for(var i=0; i<list.length; i++){
            option = document.createElement('option');

            if(type == 'user') {
                $(option).val(list[i].usuario);
                $(option).text(list[i].nome);
            }

            else if(type == 'idEst') {
                $(option).val(list[i].id);
                $(option).text(list[i].estacionamento);
            }

            else if(type == 'idCar') {
                $(option).val(list[i].id_carro);
                $(option).text('Placa: ' + list[i].placa + ' - Mod.: ' + list[i].modelo);
            }

            $('#' + type).append(option);
        }
    }
}

ControllerRequestVacancy.init();