var ControllerCheckInOut = {

    init: function () {

        $('#feedBack').text('Realizando a consulta');
        $('#feedBack').addClass('alert alert-warning');

        if($('#checkin').length){
            
            ControllerCheckInOut.getCheckIn();
        }
        else{
            ControllerCheckInOut.getCheckOut();
        }
    },

    getCheckIn: function () {
        var post = $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: '/func.getcheckin',
                    success: function (list) {
                        if(list != 'null'){
                            $('#feedBack').text('');
                            $('#feedBack').removeClass('alert alert-warning');
                            ControllerCheckInOut.fillTable(JSON.parse(list), 'checkin');
                        }else{
                            $('#feedBack').text('Não há vagas para realizar Check-In!');
                            $('#feedBack').addClass('alert alert-info');
                        }
                    }
        });
    },

    setCheckIn: function (idReserv, idRow) {
        var reserv = {'idReserv': idReserv};
        
        var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/func/setcheckin',
                    data: JSON.stringify(reserv),
                    success: function (feedBack) {
                        if(feedBack == 'done'){
                            $('#' + idRow).hide('progress');
                        }
                        else{
                            alert(feedBack);
                        }
                    }
        });
        
    },

    getCheckOut: function () {

        var post = $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: '/func.getcheckout',
                    success: function (list) {
                        if(list != 'null'){
                            $('#feedBack').text('');
                            $('#feedBack').removeClass('alert alert-warning');
                            ControllerCheckInOut.fillTable(JSON.parse(list), 'checkout');
                        }else{
                            $('#feedBack').text('Não há vagas para realizar Check-Out!');
                            $('#feedBack').addClass('alert alert-info');
                        }
                    }
        });

    },

    setCheckOut: function (idReserv, idRow) {
        var reserv = {'idReserv': idReserv};
        
        var post = $.ajax({
                    type: 'POST',
                    contentType: 'application/json',
                    url: '/func/setcheckout',
                    data: JSON.stringify(reserv),
                    success: function (feedBack) {
                        if(feedBack == 'done'){
                            $('#' + idRow).hide('progress');
                        }
                        else{
                            alert(feedBack);
                        }
                    }
        });
    },

    fillTable: function (list, type) {
        for(var i = 0; i<list.length; i++){
            var tr = document.createElement('tr'),
            temp = '';
            for(var l = 0; l < 9; l++){
                var td = document.createElement('td');
                if(l == 8){
                    var button = document.createElement('button'),
                        idReserv = list[i].id_reserva,
                        idRow = i + '-' + l;
                    button.id = idReserv;
                    tr.id = idRow;
                    button.className = 'btn btn-success';
                    $(button).text('SIM')
                    $(td).append(button);
                    $(tr).append(td);
                    $('#' + type).append(tr);
                    $('#' + idRow).attr('idRow', idRow);
                    if(type == 'checkin'){
                        $('#' + idRow).click(function (e) {
                            ControllerCheckInOut.setCheckIn(e.target.id, $(this).attr('idRow'));
                        }) 
                    }else{
                        $('#' + idRow).click(function (e) {
                            ControllerCheckInOut.setCheckOut(e.target.id, $(this).attr('idRow'));
                        }) 
                    }
                }else if(l != 8 && l > 0){
                    $(td).text(list[i][l]);
                    $(tr).append(td);
                    $('#' + type).append(tr);
                }
            }
            
        }
    }
}

ControllerCheckInOut.init();