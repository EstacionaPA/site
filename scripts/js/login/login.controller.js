var ControllerLogin = {
    
    init: function () {
        ControllerLogin.controll();
    },
    
    controll: function () {
        
        var 
        form = document.getElementById('logar'),
        user = "",
        pass = "",

            callB_openPage = function () {
                ServiceLogin.openPage();  
            },
            
            callB_rprt = function (result) {
                callB_openPage();
                ServiceLogin.report(result);
            },
            
            callB_send = function(user, pass) {
                ServiceLogin.sendValues(user, pass, callB_rprt);
            },
        
            callB_get = function() {
                user = ServiceLogin.getUSer();
                pass = ServiceLogin.getPass();
                callB_send(user, pass);
            };
        
        ServiceLogin.addListener(form, callB_get);
    }
}

ControllerLogin.init();
