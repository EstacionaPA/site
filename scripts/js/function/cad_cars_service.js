var cadCarsService = {

    sendValues: function (form) {
        
        var car = {
            'user' : form.usuario.value,
            'placa' : form.placaCarro.value,
            'marca' : form.marca.value,
            'modelo' : form.modelo.value
        };
        
        $.ajax({
            type: 'POST',
            contentType: 'application/json',
            url: '/register/cars/added',
            data: JSON.stringify(car),
            success: function (data) {
                cadCarsService.checkValue(data);
            }
        });
    },
    
    checkValue: function (value) {
  
        if(value == 'done'){
            alert('Veículo cadastrado com sucesso!');
            document.location = '/register/cars';
        }
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
    },
    
    findValuesMark: function () {
        
        $.post('../../php/operation/cad_cars_values_option.php',
               {request: 'mark'},
               function (stringMark) {
                    cadCarsService.createList(stringMark, 'marca', '');
                    cadCarsService.writeFieldMarkOk();
                }
        );
        
    },
    
    findValuesModel: function (markName) {
        
        $.post('../../php/operation/cad_cars_values_option.php',
               {request: 'model', markName: markName},
               function (stringModel) {
                    cadCarsService.createList(stringModel, 'modelo', 'option');
                    cadCarsService.writeFieldModelOk();
                }
        );
    },
               
    createList: function (string, idSelect, classNameOption){
        
        var array = new Array(),
            lin = 0,
            option;

        array = string.split(';');

        for(lin=0; lin<array.length; lin++){
            
            if(array[lin] != "") {
                option = cadCarsService.createOption();
                option.textContent = array[lin];
                option.value = array[lin];
                option.className = classNameOption;

                cadCarsService.appendOption(option, idSelect);
            }
        }
        
    },
    
    createOption: function () {
        return document.createElement('option');
    },
    
    appendOption: function (option, idSelect) {
        
        select = document.getElementById(idSelect);
        select.appendChild(option);
    
    },
    
    cleanListOption: function () {
        
        while($('.option').length)
              $('.option').remove();
    },
    
    writeFieldMarkOk: function () {
        option = document.getElementById('optionMark');
        option.textContent = '(INFORME UMA)';
    },
    
    writeFieldModelLoading: function () {
        option = document.getElementById('optionModel');
        option.textContent = '(CARREGANDO...)';
    },
    
    writeFieldModelOk: function () {
        option = document.getElementById('optionModel');
        option.textContent = '(INFORME UM)';
    },
    
    writeFieldMarkInitial: function () {
        option = document.getElementById('optionModel');
        option.textContent = '(ESCOLHA UMA MARCA PRIMEIRO)';
    }
}
