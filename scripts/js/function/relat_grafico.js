var RelatGraficoService = {
    
    init: function () {
        RelatGraficoService.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('gerarGrafico');
        
        form.addEventListener('submit', function (event) {
            RelatGraficoService.sendValues();
            event.preventDefault();
        });
    },
    
    sendValues: function () {
        
        
        //Realiza o método POST (JQuery)
        $.post('../../php/operation/relat_inf_user.php',
            //Envia informações
            {name: name},
            //Retorno do PHP
            function(value){
                RelatService.cleanTable();
                RelatGraficoService.verify(value);
            });
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

RelatGraficoService.init();
