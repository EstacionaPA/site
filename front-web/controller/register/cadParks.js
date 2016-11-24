var ControllerCadParks = {

    init: function () {
        ControllerCadParks.getUsers();
        
        $('#register').click(function (e) {
            e.preventDefault();

            if($('#userResp').val() == 'nothing' || $('#h_init').val() == '' ||  
               $('#h_end').val() == '' || $('#qtdVagas').val() == '' || $('#end').val() == '' ||  
               $('#num').val() == '' ||  $('#bairro').val() == '' || $('#nome').val() == ''){
                   $('#feedBack').text('Preencha/Informe todos os campos!');
                   $('#feedBack').addClass('alert alert-warning');
            }else{
                $('#feedBack').removeClass('alert alert-warning');
                $('#feedBack').removeClass('alert alert-success');
                $('#feedBack').removeClass('alert alert-danger');
                
                var park = {'nome': $('#nome').val(),
                            'user': $('#userResp').val(),
                            'h_init': $('#h_init').val(),
                            'h_end': $('#h_end').val(),
                            'end': $('#end').val(),
                            'num': $('#num').val(),
                            'bairro': $('#bairro').val(),
                            'vagas': $('#qtdVagas').val()};

                var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/master.registerparks/added',
                    data: JSON.stringify(park),
                    success: function (feedBack) {
                        if(feedBack == 'success'){
                            $('#feedBack').text('Cadastro realizdo com sucesso!');
                            $('#feedBack').addClass('alert alert-success');
                        }else{
                            $('#feedBack').text(feedBack);
                            $('#feedBack').addClass('alert alert-danger');
                        }
                    }
                })
            }
        });
    },

    getUsers: function (){
        
        var option;

        var get = $.ajax({
            type: 'GET',
            contentType: 'application/json',
            url: '/getUsers',
            success: function (list){
                $('#loadUser').text('INFORME UM USUÁRIO!');
                ControllerCadParks.createList(JSON.parse(list));
            }
        });
    },

    createList: function (list) {
        for(var i=0; i<list.length; i++){
            option = document.createElement('option');
            $(option).text(list[i].nome);
            $(option).val(list[i].usuario);
            $('#userResp').append(option);
        }
    }

}

ControllerCadParks.init();