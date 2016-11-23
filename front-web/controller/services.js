var ControllerServices = {

    init: function () {

        if($('#parksConsult').length){
            ControllerServices.fillTable();
        }else{
            ControllerServices.consultVacancy();
        }
    },

    fillTable: function () {
        $('#feedBack').text('Consultando estacionamentos...');
        $('#feedBack').addClass('alert alert-info');

        var get = $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: '/getParks',
            success: function (listParks) {
                $('#feedBack').text('');
                $('#feedBack').removeClass('alert alert-info');
                var list = JSON.parse(listParks);
                for(var i = 0; i<list.length; i++){
                    var tr = document.createElement('tr'),
                        temp = '';
                    for(var l = 0; l < 10; l++){
                        var td = document.createElement('td');
                        if(l > 5 && l != 8){
                            temp = temp + list[i][l];
                        }
                        else if(l == 8){
                            $(td).text(temp + list[i][l]);
                            $(tr).append(td);
                        } 
                        else{
                            $(td).text(list[i][l]);
                            $(tr).append(td);
                        }
                    }
                    $('#parksConsult').append(tr);
                }
            }
        })

    },

    consultVacancy: function () {

        $('#date').mask('99/99/9999');
        $('#legenda').hide();
        $('#consult').click(function (e) {
            $('.vacanciesValues').remove();
            e.preventDefault();

            if($('#h_init').val() == '' || $('#h_end').val() == '' || $('#date').val() == ''){
                $('#feedBack').text('Preencha / informe todos os campos!');
                $('#feedBack').addClass('alert alert-warning');
            }else{
                $('#feedBack').removeClass('alert alert-warning');
                $('#feedBack').removeClass('alert alert-info');
                $('#feedBack').removeClass('alert alert-danger');
                $('#feedBack').removeClass('alert alert-success');
                $('#feedBack').text('Consultando...');
                $('#feedBack').addClass('alert alert-info');

                var consult = {'hora_reserva': $('#h_init').val(),
                               'hora_fim' : $('#h_end').val(),
                               'data' : $('#date').val()}
        
                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/vacancies/consult',
                    data: JSON.stringify(consult),
                    success: function (list) {
                        $('#feedBack').removeClass('alert alert-info');
                        if(list == 'empty'){
                            $('#feedBack').text('Todos os estacionamentos estão vazios. Registre uma vaga!');
                            $('#feedBack').addClass('alert alert-success');
                        }else if(list == '!validDate'){
                            $('#feedBack').text('A data informada é inválida!');
                            $('#feedBack').addClass('alert alert-danger');
                        }else if(list == '!validObject'){
                            $('#feedBack').text('Os dados informados estão inválidos. Verifique e tente novamente!');
                            $('#feedBack').addClass('alert alert-danger');
                        }else if(list == '!validHour'){
                            $('#feedBack').text('A hora informada é inválida!');
                            $('#feedBack').addClass('alert alert-danger');
                        }else{
                            $('#feedBack').text('');
                            $('#feedBack').removeClass('alert alert-info');
                            $('#legenda').show('progressive');
                            var list = JSON.parse(list);
                            for(var i = 0; i<list.length; i++){
                                var tr = document.createElement('tr'),
                                temp = '';
                                for(var l = 0; l < 10; l++){
                                    var td = document.createElement('td');
                                    $(td).text(list[i][l]);
                                    td.className = 'vacanciesValues';
                                    $(tr).append(td);
                                }
                                $('#vacancies').append(tr);
                            }
                        }
                    }
                })
            }
        });
    }
}

ControllerServices.init();