var calender = {
    
    init: function () {
        calender.readPage();
    },
    
    readPage: function () {
        
        var imput = $("input");
        
        imput.addEventListener(function (event) {
                                    $('input').wijinputdate({
                                        showTrigger: true
                                    });
                                    event.preventDefault();
                                        
                                });
    }
}

calender.init();