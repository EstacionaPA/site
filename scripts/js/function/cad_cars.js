var cadCars = {
    
    init: function () {
            
        cadCars.readPage();
            
    },
    
    readPage: function () {
        
        form = document.getElementById('cadCar');
        
        form.addEventListener('submit', function (event) {
            cadCars.sendValues();
            event.preventDefault();
        });
    },
    
    sendValues: function () {
        
        var user = $('#usuario').val();
        var placa = $('#placa').val();
        var marca = $('#marca').val();
        var mod = $('#modelo').val();
                
        $.post('../../php/operation/cad_cars.php',
               {user: user, placa: placa, marca: marca, mod: mod},
               function (value) {
                    cadCars.checkValue(value);
                });
    },
    
    checkValue: function (value) {
        
        if(value == 'added')
            alert('Veículo cadastrado com sucesso!');
        
        else if(value == '!user')
            alert('Usuário inválido!');
        
        else if(value == '!marca') 
            alert('Marca nao cadastrada!');
        
        else if(value == '!modelo') 
            alert('Modelo de carro nao cadastrado!');
            
        else if(value == 'placa')
            alert('Já existe um veículo cadastrato com esta placa!');
            
        else if(value == '!fields')
            alert('Preencha todos os campos!');
            
        else
            alert(value);
    }
        
            
}

cadCars.init();