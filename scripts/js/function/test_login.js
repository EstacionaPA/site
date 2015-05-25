var testLogin = {
    test: function () {
        document.location = '../../../php/login/valid_login.php';
    }
}


var validLoginJS = document.getElementById('html');
validLoginJS.addEventListener('menuHTML', function (event) {
    testLogin.test();
    event.preventDefault();
}, false);


