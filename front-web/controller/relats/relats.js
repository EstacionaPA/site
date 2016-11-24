var ControllerRelatorios = {

    init: function () {

        if($('#relatBoardXCar').length)
            ControllerRelatorios.relatBoardXCar();
        else
            ControllerRelatorios.relatInfUser();

    },

    relatInfUser: function () {
        ControllerRelatorios.getUsers();
        $('#user').change(function () {
            $('#feedBack').show();
            $('#feedBack').text('Realizando a consulta...');
            $('#feedBack').addClass('alert alert-info');
            $.ajax({
                type: 'GET',
                contentType: 'application/text',
                url: '/report/infUser/' + $('#user').val(),
                success: function (list) {
                    $('.values').remove();
                    $('#feedBack').hide('progress');
                    ControllerRelatorios.fillTable(JSON.parse(list),'relatInfUser');
                    $('#feedBack').text('');
                    $('#feedBack').removeClass('alert alert-info');
                }
            })

        })
    },

    relatBoardXCar: function () {
        ControllerRelatorios.getBoards();
        $('#boards').change(function () {
      
            
            $('#feedBack').show();
            $('#feedBack').text('Realizando a consulta...');
            $('#feedBack').addClass('alert alert-info');
            $.ajax({
                type: 'GET',
                contentType: 'application/text',
                url: '/report/carXboard/' + $('#boards').val(),
                success: function (list){
                    list = JSON.parse(list);
                    $('.values').remove();
                    $('#feedBack').hide('progress');
                    if(list == ''){
                        $('#feedBack').text('Houve um erro grave. Por favor, contate o suporte!');
                        $('#feedBack').removeClass('alert alert-danger');
                    }else {
                        ControllerRelatorios.fillTable(list, 'relatBoardXCar');
                    }
                    $('#feedBack').text('');
                    $('#feedBack').removeClass('alert alert-info');
                    
                }
                
            }) 
        })
    },

    getUsers: function () {
    var get = $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: '/admin.getUsers',
            success: function (list){
                $('#loadUser').text('INFORME UM USUÁRIO!');
                ControllerRelatorios.createList(JSON.parse(list), 'user');
            }
        });
    },

    getBoards: function () {
    var get = $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: '/admin.getboards',
            success: function (list){
                $('#loadBoard').text('INFORME UMA PLACA!');
                ControllerRelatorios.createList(JSON.parse(list), 'boards');
            }
        });
    },

    createList: function (list, type) {
        for(var i=0; i<list.length; i++){
            option = document.createElement('option');
            if(type == 'user') {
                $(option).text(list[i].nome);
                $(option).val(list[i].usuario);
            }else{
                $(option).text(list[i].placa);
                $(option).val(list[i].placa);
            }
            
            $('#' + type).append(option);
        }
    },

    fillTable: function (list, type) {
        for(var i = 0; i<list.length; i++){
            var tr = document.createElement('tr'),
                max = 0;

            if(type == 'relatBoardXCar')
                max = 4;
            else
                max = 6;
            
            for(var l = 0; l < max; l++){
                var td = document.createElement('td');
                if(list[i][l] == null)
                    $(td).text('Sem cadastro de carro');
                else
                    $(td).text(list[i][l]);

                tr.className = 'values';
                $(tr).append(td);
            }
            $('#' + type).append(tr);
        }
    }

}
ControllerRelatorios.init();