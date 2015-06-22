//Relatório placa X carro
var RelatPxCControl = {
    
    init: function () {
        RelatPxCControl.readPage();
    },
    
    readPage: function () { 
        var form = document.querySelector('form');
        RelatPxCService.doRead(form);
    },
}

RelatPxCControl.init();