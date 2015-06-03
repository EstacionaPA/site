var Service = {
    
    get: function (path) {
        $('#createMenu').load(path); 
        $('#index').click(function(event){
            alert('teste');
        })
    },
    
    openPage: function (id, path) {
        $('' + id).href = path;
    }
    
};