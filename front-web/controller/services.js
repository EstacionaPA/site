var ControllerServices = {

    init: function () {

        $('#h_init').mask('99:99');
        $('#h_end').mask('99:99');
        $('#date').mask('AA9999');

        if($('#parksConsult').length){
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
                            console.log(l + ' ');
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

        }

        $('#consult').click(function (e) {
            e.preventDefault();

            if($('#h_init').val() == '' || $('#h_end').val() == '' || $('#date').val() == ''){
                $('#feedBack').text('Preencha todos os campos!');
                $('#feedBack').addClass('alert alert-warning');
            }else{
                $('#feedBack').text('Consultando...');
                $('#feedBack').addClass('alert alert-info');

                var consult = {'h_reserva': $('#h_init').val() + ':00',
                               'h_fim' : $('#h_end').val() + ':00',
                               'data' : $('#date').val()}
                
                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/vacancies/consult',
                    data: JSON.stringify(consult),
                    success: function (list) {
                        if(list == 'empty'){
                            $('#feedBack').text('Todos os estacionamentos estão vazios. Registre uma vaga!');
                            $('#feedBack').addClass('alert alert-success');
                        }else if(data == '!validDate'){
                            $('#feedBack').text('A data informada é inválida!');
                            $('#feedBack').addClass('alert alert-info');
                        }else if(data == '!validHour'){
                            $('#feedBack').text('A hora informada é inválida!');
                            $('#feedBack').addClass('alert alert-info');
                        }else{
                            
                        }
                    }
                })
            }
        });
    }
}

ControllerServices.init();