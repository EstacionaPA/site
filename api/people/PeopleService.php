<?php
class PeopleService {
    
    public static function listPeople() {
        $db = ConnectionFactory::getDB();
        
        $people = array();
        foreach($db->pessoas() as $pessoas) {
           $people[] = array (
               'id' => $pessoas['id'],
               'nome' => $pessoas['nome'],
               'usuario' => $pessoas['usuario'],
               'senha' => $pessoas['senha'],
               'email' => $pessoas['email'],
               'cpf' => $pessoas['cpf'],
               'endereco' => $pessoas['endereco'],
               'numero' => $pessoas['numero'],
               'complemento' => $pessoas['complemento'],
               'bairro' => $pessoas['bairro'],
               'cep' => $pessoas['cep'],
               'cidade' => $pessoas['cidade'],
               'estado' => $pessoas['estado'],
               'telefone' => $pessoas['telefone'],
               'celular' => $pessoas['celular'],
               'acesso' => $pessoas['acesso'],
           ); 
        }
        
        return $people;
    }
    
    public static function getById($id) {
        $db = ConnectionFactory::getDB();
        return $db->pessoas[$id];
    }
    
    public static function add($newPeople) {
        $db = ConnectionFactory::getDB();
        $pessoas = $db->pessoas->insert($newPeople);
        return $pessoas;
    }
    
    public static function update($updatedPeople) {
        $db = ConnectionFactory::getDB();
        $pessoas = $db->pessoas[$updatedPeople['id']];
        
        if($pessoas) {
            $pessoas['id'] = $updatedPeople['id'];
            $pessoas['nome'] = $updatedPeople['nome'];
            $pessoas['usuario'] = $updatedPeople['usuario'];
            $pessoas['senha'] = $updatedPeople['senha'];
            $pessoas['email'] = $updatedPeople['email'];
            $pessoas['cpf'] = $updatedPeople['cpf'];
            $pessoas['endereco'] = $updatedPeople['endereco'];
            $pessoas['numero'] = $updatedPeople['numero'];
            $pessoas['complemento'] = $updatedPeople['complemento'];
            $pessoas['bairro'] = $updatedPeople['bairro'];
            $pessoas['cep'] = $updatedPeople['cep'];
            $pessoas['cidade'] = $updatedPeople['cidade'];
            $pessoas['estado'] = $updatedPeople['estado'];
            $pessoas['telefone'] = $updatedPeople['telefone'];
            $pessoas['celular'] = $updatedPeople['celular'];
            $pessoas['acesso'] = $updatedPeople['acesso'];
            
            $pessoas->update();
            return true;
        }
        
        return false;
    }
    
    public static function delete($id) {
        $db = ConnectionFactory::getDB();
        $pessoas = $db->pessoas[$id];
        if($pessoas) {
            $pessoas->delete();
            return true;
        }
        return false;
    }
}
?>