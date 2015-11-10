var i=0,
    variable = 'TESTETESTETETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTETESTE';
    
var callback = function (data, i){
    document.getElementById('jq').innerHTML =i;
};

for(var i=0;i<1;i++){
var post = 
        $.post (
            'php.php',
            {teste:variable},
            function(data) {
               alert(data.length);
            } 
        );
}

