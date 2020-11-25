<?php
$username = null;
$pwd = null;

if(isset($_POST['login']) && $_POST['login'] === 'mentor' ){

$username = $_POST['name'];
$pwd = $_POST['password'];
if(empty($username) || empty($pwd)){
    header('location:../login.php?error=empty&username='.$username);
    exit();

}else{
    include 'config.php';
    $name = htmlentities($name);
    $sql = 'SELECT * FROM mentors WHERE USERNAME = ? OR id = ? LIMIT 1';
$stmt = $conn->prepare($sql);
if($stmt->execute([$username,$username])){
   $count = $stmt->rowcount();
   if($count > 0){
      
$stm = $stmt->fetch(PDO::FETCH_OBJ);
$pwddb = $stm->Password;

if(!password_verify($pwd,$pwddb)){
    header('location:../login.php?error=wrongpwd&username='.$username);
    exit();
}else{
session_start();
           $_SESSION['username'] = $stm->Username;
            $_SESSION['firstname'] = $stm->Firstname;
            $_SESSION['lastname'] = $stm->Lastname;
            $_SESSION['image'] = $stm->Avatar;
            $_SESSION['id'] = $stm->id;
            $_SESSION['type'] = 'mentor';
            header('location:../home.php');    
}

   } else{
    header('location:../login.php?error=wrongnum&username='.$username);   
    exit();}
}else{exit('sqlerror');}



}
}elseif(isset($_POST['login']) && $_POST['login'] === 'mentee' ){

    $username = $_POST['name'];
    $pwd = $_POST['password'];
    if(empty($username) || empty($pwd)){
        header('location:../menteelogin.php?error=empty&username='.$username);
        exit();
    
    }else{
        include 'config.php';
        $name = htmlentities($name);
        $sql = 'SELECT * FROM mentees WHERE USERNAME = ? OR id = ? LIMIT 1';
    $stmt = $conn->prepare($sql);
    if($stmt->execute([$username,$username])){
       $count = $stmt->rowcount();
       if($count > 0){
          
    $stm = $stmt->fetch(PDO::FETCH_OBJ);
    $pwddb = $stm->password;
    
    if(!password_verify($pwd,$pwddb)){
        header('location:../menteelogin.php?error=wrongpwd&username='.$username);
        exit();
    }else{
    session_start();
               $_SESSION['username'] = $stm->username;
                $_SESSION['firstname'] = $stm->firstname;
                $_SESSION['lastname'] = $stm->lastname;
                $_SESSION['image'] = $stm->avatar;
                $_SESSION['id'] = $stm->id;
                $_SESSION['type'] = 'mentee';
                header('location:../home.php');    
    }
    
       } else{
        header('location:../menteelogin.php?error=wrongnum&username='.$username);   
        exit();}
    }else{exit('sqlerror');}
    
    
    
    }

}else{
    header('location:../login.php');
}