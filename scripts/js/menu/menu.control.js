var putNameMenuControl = {
    
    init: function () {
        putNameMenuControl.callPath();
    },
    
    callPath: function () {
        var path = putNameMenuService.path();
        putNameMenuControl.callName(path);
    },
    
    callName: function (path) {
        putNameMenuService.name(path);
    }
    
}

putNameMenuControl.init();