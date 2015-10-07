var putNameMenuService = {
    
    path: function () {
        return toRootFolder.path;
    },
    
    name: function (path) {
        
        $.post(path + 'php/login/name_user.php',
               function (name) {
                    putNameMenuService.extractFirstName(name);
                }
        );
    },
    
    extractFirstName: function (name) {
        
        if(name != 'Realizar login'){
            var indexOfSpace = name.indexOf(' ');
            var firstName;
            
            if(indexOfSpace>0){
                //Validação para caso o nome do usuario nao tiver espaço
                firstName = name.substring(0, indexOfSpace); 
                putNameMenuService.putName(firstName);
            }
            
            else
                putNameMenuService.putName(name);
        }
        
        else
            putNameMenuService.putName(name);
    },
    
    putName: function (firstName) {
        document.getElementById('nameMenu').innerHTML = firstName;
    }
    
}

                            
        