<?php
$logedin = null; 
if(isset($_SESSION['username'])){
    $logedin = true;
}
include 'backend/functions.php';
checkLogedIn($logedin);


?>