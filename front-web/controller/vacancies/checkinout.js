var ControllerCheckInOut = {

    init: function () {

        if($('#checkin').length)
            ControllerCheckInOut.getCheckIn();
        else
            ControllerCheckInOut.getCheckOut();
    },

    getCheckIn: function () {
        var post = $.ajax({
                    type: 'GET',
                    contentType: 'application/json',
                    url: '/func.getcheckin',
                    success: function (list) {
                        if(list != 'null')
                            ControllerCheckInOut.fillTable(JSON.parse(list), 'checkin');
                        else{
                            $('#feedBack').text('Não há vagas para realizar Check-In!');
                            $('#feedBack').addClass('alert alert-info');
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
                        if(list != 'null')
                            ControllerCheckInOut.fillTable(JSON.parse(list), 'checkout');
                        else{
                            $('#feedBack').text('Não há vagas para realizar Check-Out!');
                            $('#feedBack').addClass('alert alert-info');
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
                $(td).text(list[i][l]);
                $(tr).append(td);
            }
            $('#' + type).append(tr);
        }
    }
}

ControllerCheckInOut.init();