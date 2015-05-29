var gerarRelatorio = {
    
    init: function () {
        gerarRelatorio.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('gerarRelatorio');
        
        form.addEventListener('submit', function (event) {
            gerarRelatorio.sendValues();
            event.preventDefault();
        });
    },
    
    sendValues: function () {
        
        //Busca valores
        var name = $('#name').val();
        
        //Realiza o método POST (JQuery)
        $.post('../../php/operation/relat_inf_user.php',
            //Envia informações
            {name: name},
               
            //Retorno do PHP
            function(value){
                var verify = gerarRelatorio.verify(value);
                
                if(verify == "gerarRelat")
                    gerarRelatorio.gerarRelat(value);
            });
    },
    
    gerarRelat: function (value) {
        
        //Busca no HTML o id
        var tr = $('#relat');
        var i=0;
        //seta um novo array
        var relat = new Array();
        
        //Se caso o relatório já estiver sido gero, apagar
        if(document.getElementById('relat_list')){
            for(i; i< 6; i++)
                $('#relat_list').remove();
        }
        
        //Retira os ";" do dado retornado e transforma em um array
        relat = value.split(';');
        
        for(i=0; i<6; i++){
            
            //cria uma nova tag em html
            var td = document.createElement('td');
            
            //percorrendo o array e colocando as informações
            td.innerHTML = relat[i];
            
            //gera um nome de ID
            td.id = 'relat_list';
            
            
            tr.append(td);
        }
        
    },
    
    verify: function (value){
    
        if(value == "noData")
            alert("Sem dados para esta pesquisa!");
        
        else if(value != "noUserDateFields"){
            return "gerarRelat";
        }
        
        else
            alert("Preencha todos os campos!");
    }
}

gerarRelatorio.init(); 