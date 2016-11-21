var ControllerServices = {

    init: function () {

        $('#h_init').mask('99:99');
        $('#h_end').mask('99:99');
        $('#date').mask('AA9999');

        if($('#consultParks').length){
            alert('');
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