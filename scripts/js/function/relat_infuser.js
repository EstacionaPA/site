var RelatInfUserService = {
    
    init: function () {
        RelatInfUserService.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('gerarRelatorio');
        
        form.addEventListener('submit', function (event) {
            RelatInfUserService.sendValues();
            event.preventDefault();
        });
    },
    
    sendValues: function () {
        
        //Busca valores
        var name = $('#name').val();
        
        //Realiza o método POST (JQuery)
        $.ajax({
            type: 'GET',
            contentType: 'application/text',
            url: '/report/infUser/' + name,
            success: function (data) {
                RelatService.cleanTable();
                RelatInfUserService.verify(data);
            }
        })
    },
    
    
    verify: function (value){
    
        if(value == "")
            alert("Sem dados para esta pesquisa!");
        
        else if(value != "noUserDateFields")
            RelatService.gerarRelat(value, 6);//Numero de colunas
        
        else
            alert("Informe um usuario!");
    }
        
}

RelatInfUserService.init();
