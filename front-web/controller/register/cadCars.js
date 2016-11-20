var ControllerCadCars = {

    init: function (){

        $('#register').click(function(e) {
            e.preventDefault();
            
            if($('#user').val() == 'nothing' || $('#board').val() == '' || 
               $('#mark').val() == 'nothing' || $('#model').val() == ''){
                   $('#feedBack').text('Informe todos os campos!');
                   $('#feedBack').addClass('alert alert-warning')
               }
        });
        
    }
}

ControllerCadCars.init();