var gerarRelatorio = {
    
    init: function () {
        gerarRelatorio.readPage();
    },
    
    readPage: function () {
        
        var form = document.getElementById('gerarRelatorio');
        
        form.addEventListener('submit', function (event) {
            gerarRelatorio.cleanTable();
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

               
            //Retorno do PHP
            function(value){
                var verify = gerarRelatorio.verify(value);
                
                if(verify == "gerarRelat")
                    gerarRelatorio.gerarRelat(value);
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
    

        if(value == "")

        if(value == "noData")

            alert("Sem dados para esta pesquisa!");
        
        else if(value != "noUserDateFields"){
            return "gerarRelat";
        }
        
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

            alert("Preencha todos os campos!");

    }
}

gerarRelatorio.init(); 