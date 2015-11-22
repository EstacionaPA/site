var RelatPxCService = {
    
    
    doRead: function (form) {
        
        form.addEventListener('submit', function (event) {
            RelatPxCService.sendValues(form.placa.value);
            event.preventDefault();
        });
    },
    
    sendValues: function (board) {
        
        //Realiza o método POST (JQuery)
        $.ajax({
            type: 'GET',
            contentType: 'application/text',
            url: '/report/carXboard/' + board,
            success: function (data) {
                RelatService.cleanTable();
                RelatPxCService.verify(data);
            }
        })
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
