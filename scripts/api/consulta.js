$(document).ready(function() {


    function consultarcep() {

        $("#cidade").val("");
        $("#estado").val("");
    }

    $("#cep").blur(function() {


        var cep = $(this).val().replace(/\D/g, '');


        if (cep != "") {


            var validarcep = /^[0-9]{8}$/;


            //Valida o formato do CEP.
            if(validarcep.test(cep)) {


                $("#cidade").val("...")
                $("#estado").val("...")



                //Consulta ao webservice
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {


                    if (!("erro" in dados)) {
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);
                    } //end if.
                    else {
                        consultarcep();
                        alert("CEP não localizado, por favor verifique.");
                    }
                });
            } //end if.
            else {
                consultarcep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            consultarcep();
        }
    });
});
