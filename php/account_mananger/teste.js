
var pessoa = document.querySelector('form');

var teste = {'pessoa': [{'name': pessoa.nome.value,
                         'user': pessoa.usuario.value,
                         'pass': pessoa.senha.value,
                         'access': pessoa.acesso.value,
                         'email': pessoa.email.value,
                         'cpf':  pessoa.cpf.value,
                         'address': pessoa.endereco.value,
                         'number': pessoa.numero.value,
                         'comp': pessoa.complemento.value,
                         'block': pessoa.bairro.value,
                         'city': pessoa.cidade.value,
                         'tel': pessoa.telefone.value}]};

var json = JSON.stringify(teste.pessoa[0]);

var post = $.post('teste.php', {teste:json}, function (data) {
    alert(data);
});

