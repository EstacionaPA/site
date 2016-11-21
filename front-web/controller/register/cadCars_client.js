var ControllerCadCars = {

    init: function (){

        ControllerCadCars.getUsers();
        ControllerCadCars.getMarks();
        $('#board').mask('AAA9999');


        $('#register').click(function(e) {
            e.preventDefault();
            
            if($('#user').val() == 'nothing' || $('#board').val() == '' || 
               $('#mark').val() == 'nothing' || $('#model').val() == ''){
                   $('#feedBack').text('Informe todos os campos!');
                   $('#feedBack').addClass('alert alert-warning')
            }else{

                var car = {
                    'user' : $('#user').val(),
                    'placa' : $('#board').val(),
                    'idMarca' : $('#mark').val(),
                    'idModelo' : $('#model').val()
                };

                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/register/cars/added',
                    data: JSON.stringify(car),
                    success: function (data) {
                        
                        $('#feedBack').removeClass('lert alert-warning');

                        if(data == 'done'){
                            $('#feedBack').text('Cadastrado com sucesso!');
                            $('#feedBack').addClass('alert alert-success')
                        }
                        else if(data == 'placa'){
                            $('#feedBack').text('Ja existe um carro cadastrado com esta placa!');
                            $('#feedBack').addClass('alert alert-warning')
                        }
                    }
                })

            }
        });

        $('#mark').change(function () {
            var mark = {'idMarca':$('#mark').val()};
            $('#loadModel').text('CARREGANDO..');
            var post = $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: '/getModels',
                data: JSON.stringify(mark),
                success: function (list) {
                    $('#loadModel').text('SELECIONE UM MODELO!');
                    $('.modelValue').remove();
                    ControllerCadCars.createList(JSON.parse(list), 'model');
                }
            })
        });
    },

    getUsers: function (){
        
        var option;

        var get = $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: '/getuser.login',
            success: function (list){
                $('#loadUser').text('INFORME UM USUÁRIO!');
                ControllerCadCars.createList(JSON.parse(list), 'user');
            }
        });
    },

    getMarks: function () {

        var get = $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: '/getMarks',
            success: function (list){
                $('#loadMark').text('SELECIONE UMA MARCA!');
                ControllerCadCars.createList(JSON.parse(list), 'mark');
            }
        });
    },

    createList: function (list, type) {
        for(var i=0; i<list.length; i++){
            option = document.createElement('option');
            $(option).text(list[i].nome);

            if(type == 'user') {$(option).val(list[i].usuario);}
            else $(option).val(list[i].id);

            if(type == 'model') $(option).addClass('modelValue');

            $('#' + type).append(option);
        }
    }
}

ControllerCadCars.init();

