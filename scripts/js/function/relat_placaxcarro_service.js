var RelatPxCService = {
    
    
    doRead: function (form) {
        
        form.addEventListener('submit', function (event) {
            RelatPxCService.sendValues(form.placa.value);
            event.preventDefault();
        });
    },
    
    sendValues: function (board) {
        
        //Realiza o método POST (JQuery)
        $.post('../../php/operation/relat_boardxcar.php',
            //Envia informações
            {board: board},
            //Retorno do PHP
            function(value){
                RelatService.cleanTable();
                RelatPxCService.verify(value);
            });
    },
    
    verify: function (value){
    
        if(value == "")
            alert("Sem dados para esta pesquisa!");
        
        else if(value != "noUserDateFields")
            RelatService.gerarRelat(value, 4);//Numero de colunas para o relatorio
        
        else
            alert("Informe um usuario!");
    },
    
}
