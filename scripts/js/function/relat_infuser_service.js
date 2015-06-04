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
        $.post('../../php/operation/relat_inf_user.php',
            //Envia informações
            {name: name},
            //Retorno do PHP
            function(value){
                RelatInfUserService.cleanTable();
                RelatInfUserService.verify(value);
            });
    },
    
    gerarRelat: function (value) {
        
        //Busca no HTML o id
        var table = $('#relat');
        var l=0;
        var r=0;
        var colMax = 6;
        
        //seta um novo array
        var relat = new Array();
        
        //Retira os ";" da string retornada do PHP
        relat = value.split(';');
        
        //Nos testes, o valor da soma da existencia das celulas deu um a mais. Correção com -1
        var linMax = ((relat.length-1)/colMax);
        for(l; l<linMax; l++){
            
            //cria uma nova tag em html
            var tr = document.createElement('tr');
            
            //gera um nome de classe para inserir os dados
            tr.className = "relat_list" + l;
            
            //Coloca na tabela
            table.append(tr);
            
            for(r; r<colMax; r++){
                var td = document.createElement('td');

                //percorrendo o array e colocando as informações
                td.innerHTML = relat[r];
                $('.relat_list' + l).append(td);
            }
            
            //Para pegar o restante das informações no array (1-6 / 7-12 / etc)
            colMax = colMax + 6;
        }
        
    },
    
    verify: function (value){
    
        if(value == "")
            alert("Sem dados para esta pesquisa!");
        
        else if(value != "noUserDateFields")
            RelatInfUserService.gerarRelat(value);
        
        else
            alert("Informe um usuario!");
    },
    
    cleanTable: function () {
        
        var l = 0;
        
        //Se o relatório já estiver sido gerado
        //Percorrendo as linhas das tabelas
        while($('.relat_list' + l).length){
            $('.relat_list' + l).remove();
            l++;
        }
    }
}

RelatInfUserService.init();
