<?php
session_start();
$logedin = false;

if(isset($_SESSION['username'])){
    $logedin = true;
}else{
    $logedin = false;   
}
if(!$logedin || !isset($_GET['username'])){
    header('location:login.php');
    exit();}


    $username = htmlentities($_GET['username']);
    include 'backend/config.php';
    $sql = "DELETE FROM MENT WHERE MENTOR=? AND MENTEE = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username,$_SESSION['username']]);
   
    header('location:home.php');
        exit();   


    
