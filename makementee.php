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
    $sql = "SELECT * FROM MENT WHERE MENTOR=? AND MENTEE = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['username'],$username]);
    $count = $stmt->rowcount();
    if($count > 0){
        header('location:home.php');
        exit();   
    }else{
        $sql = 'INSERT INTO MENT (MENTOR,MENTEE)VALUES(?,?)';
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute([$_SESSION['username'],$username])){
           header('location:home.php');
        exit(); 
        }
       
        
    }

    
