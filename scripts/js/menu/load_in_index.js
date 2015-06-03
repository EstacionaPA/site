var geraMenuIndex = {
    
    init: function () {
        Service.get('html/menu/main_menu.html');
        Service.openPage('#index', 'index.html'); 
        
        
    },
    
    monitorar: function () {
        $('index').href = "index.html";    
    }
};

geraMenuIndex.init();