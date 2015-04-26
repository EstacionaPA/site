<?php

setcookie('loginIn', '', time() - 3600, '/');
unset($_COOKIE['loginIn']);

echo "<script> document.location = '../index.html' </script>";

?>