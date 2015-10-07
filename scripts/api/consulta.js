<<<<<<< HEAD
        $(document).ready(function() {

            function consultarcep() {
                
                $("#cidade").val("");
                $("#estado").val("");
            }
            
            $("#cep").blur(function() {

                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {

                    var validarcep = /^[0-9]{8}$/;

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

                    consultarcep();
                }
            });
=======
        $(document).ready(function() {

            function consultarcep() {
                
                $("#cidade").val("");
                $("#estado").val("");
            }
            
            $("#cep").blur(function() {

                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {

                    var validarcep = /^[0-9]{8}$/;

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

                    consultarcep();
                }
            });
>>>>>>> 54cf57a1f94b7504385ac6f985b7c8520081ace5
        });