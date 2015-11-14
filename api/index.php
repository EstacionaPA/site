<?php
require 'vendor/autoload.php';

//chamada do framework slim
$app = new \Slim\Slim();

// http://estacionapa/api/
$app->get('/', function() use ( $app ) {
    echo "Bem Vindo ao Web Site Estaciona PA";
});

// http://estacionapa.com/api/clients
// get all clients
$app->get('/clients', function() use ( $app ) {
    $clients = getClients();
    $app->response()->header('Content-Type','application/json');
    echo json_encode($clients);
});

// http://estacionapa.com/api/clients
// get a client by id
$app->get('/clients/:id', function($id) use ( $app ) {

    $index = array_search($id, array_column($clients, 'id'));

    if($index > -1) {
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($clients[$index]);
    }
    else {
        $app->response()->setStatus(204);
    }
});

$app->post('/clients', function() use ( $app ) {
    $clientsJson = $app->request()->getBody();
    $clients = json_decode($clientsJson);
    if ($clients) {
        echo "{$clients->description} added";
    }
    else {
        $app->response()->setStatus(400);
        echo "Malformat JSON";
    }
});
function getClients()
{
    $app->get('/clientes', function () {

        # Variável que irá ser o retorno (pacote JSON)...
        $retorno = array();

        # Abrir conexão com banco de dados...
        $conexao = new MySQL("localhost", "root", "", "estacionapa");

        # Validar se houve conexão...
        if (!$conexao) {
            echo "Não foi possível se conectar ao banco de dados";
            exit;
        }

        # Selecionar todos os cadastros da tabela 'cliente'...
        $registros = $conexao->query("select * from pessoas");

        # Transformando resultset em array, caso ache registros...
        if ($registros->num_rows > 0) {
            while ($cliente = $registros->fetch_array(MYSQL_BOTH)) {
                $registro = array(
                    "id" => $cliente["id"],
                    "nome" => $cliente["nome"],
                );
                $retorno[] = $registro;
            }
        }

        # Encerrar conexão...
        $conexao->close();

        # Retornando o pacote (JSON)...
        $retorno = json_encode($retorno);
        echo $retorno;

    });

}
$app->run();
?>