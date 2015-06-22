var cadCarsControl = {
    
    init: function () {
        cadCarsService.findValuesMark();
        cadCarsContol.readPage();   
    },
    
    readPage: function () {
        
        form = document.querySelector('form');
        
        form.addEventListener('submit', function (event) {
            cadCarsService.sendValues(form);
            event.preventDefault();
        });
        
        $('#marca').change(function () {
            
            if(form.marca.value == 'nothing') {
                cadCarsService.cleanListOption();
                cadCarsService.writeFieldMarkInitial();
                return;
            }
            cadCarsService.writeFieldModelLoading();
            cadCarsService.cleanListOption();
            cadCarsService.findValuesModel(form.marca.value);
        });
    }
};

cadCarsContol.init();
    
