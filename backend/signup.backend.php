<?php

$name = null;
$name2 = null;
$username = null;
$pwd = null;
$pwd2 = null;
$avatar = null;
if(isset($_POST['signup']) && $_POST['signup'] === 'mentor' ){

    if(isset($_POST['check']) ){
        $avatar = true; 
             }else{
                $avatar = false;
             }
            

    $name = $_POST['name'];
	$name2 = $_POST['name2'];
	$username = $_POST['username'];
    $pwd = $_POST['password'];
    $pwd2 = $_POST['password2'];

if(empty($name) || empty($name2) || empty($username) || empty($pwd) || empty($pwd2)){
    header('location:../signup.php?error=empty&name='.$name.'&name2='.$name2.'&username='.$username);
    exit();
}elseif(!preg_match('/^[a-zA-Z0-9]*$/',$name) || !preg_match('/^[a-zA-Z0-9]*$/',$name2)){
    header('location:../signup.php?error=failedname&name='.$name.'&name2='.$name2.'&username='.$username);
    exit();
}elseif(!preg_match('/^[a-zA-Z0-9\._-]*$/',$username) ){
    header('location:../signup.php?error=failedusername&name='.$name.'&name2='.$name2);
    exit();
}elseif($pwd !== $pwd2){
    header('location:../signup.php?error=failedpwd&name='.$name.'&name2='.$name2);
    exit();
}else{
 include 'config.php';
 
 $sql = 'SELECT * FROM mentors WHERE username = ? or id = ? limit  1';
    $stmt =$conn->prepare($sql);
    if(!$stmt->execute([$username,$username])){
		header('location:../signup.php?error=sqlerror');
		
	}else
    $count = $stmt->rowcount();
    if($count > 0){
        header('location:../signup.php?error=nametaken&name='.$name.'&name2='.$name2);	
	}else{
        $pwd = password_hash($pwd,PASSWORD_DEFAULT);
		$username = htmlentities(trim($username));
		$name = htmlentities($name);
        $name2 = htmlentities($name2);
        if($avatar){
            include 'functions.php';
         $avatarLink =   makeAvatar(strtoupper($name[0]));
         $sql = 'INSERT INTO mentors(FIRSTNAME,LASTNAME,USERNAME,PASSWORD,AVATAR)VALUES(?,?,?,?,?)';
         $stmt = $conn->prepare($sql);
         if($stmt->execute([$name,$name2,$username,$pwd,$avatarLink])){
            $query = 'SELECT id FROM mentors WHERE USERNAME = ? LIMIT 1';
            $stmt = $conn->prepare($query);
            $stmt->execute([$username]);
            $stm = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $stm->ID;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $name;
            $_SESSION['lastname'] = $name2;
            $_SESSION['image'] = $avatarLink;
            $_SESSION['id'] = $id;
            $_SESSION['type'] = 'mentor';
            header('location:../home.php');
         }else{
            header('location:../signup.php?error=sqlerror');  
         }

        }else{

           
            $sql = 'INSERT INTO mentors(FIRSTNAME,LASTNAME,USERNAME,PASSWORD)VALUES(?,?,?,?)';
            $stmt = $conn->prepare($sql);
            if($stmt->execute([$name,$name2,$username,$pwd])){
                $query = 'SELECT id FROM mentors WHERE USERNAME = ? LIMIT 1';
            $stmt = $conn->prepare($query);
            $stmt->execute([$username]);
            $stm = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $stm->ID;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $name;
            $_SESSION['lastname'] = $name2;
            $_SESSION['image'] = $avatarLink;
            $_SESSION['id'] = $id;
            $_SESSION['type'] = 'mentor';
             header('location:../home.php');
            }else{
                header('location:../signup.php?error=sqlerror');    
            }


            
        }

      
    }
    
}




    
	


}elseif(isset($_POST['signup']) && $_POST['signup'] === 'mentee' ){

    
    if(isset($_POST['check']) ){
        $avatar = true; 
             }else{
                $avatar = false;
             }
            

    $name = $_POST['name'];
	$name2 = $_POST['name2'];
	$username = $_POST['username'];
    $pwd = $_POST['password'];
    $pwd2 = $_POST['password2'];

if(empty($name) || empty($name2) || empty($username) || empty($pwd) || empty($pwd2)){
    header('location:../menteesignup.php?error=empty&name='.$name.'&name2='.$name2.'&username='.$username);
    exit();
}elseif(!preg_match('/^[a-zA-Z0-9]*$/',$name) || !preg_match('/^[a-zA-Z0-9]*$/',$name2)){
    header('location:../menteesignup.php?error=failedname&name='.$name.'&name2='.$name2.'&username='.$username);
    exit();
}elseif(!preg_match('/^[a-zA-Z0-9\._-]*$/',$username) ){
    header('location:../menteesignup.php?error=failedusername&name='.$name.'&name2='.$name2);
    exit();
}elseif($pwd !== $pwd2){
    header('location:../menteesignup.php?error=failedpwd&name='.$name.'&name2='.$name2);
    exit();
}else{
 include 'config.php';
 
 $sql = 'SELECT * FROM mentees WHERE username = ? or id = ? limit  1';
    $stmt =$conn->prepare($sql);
    if(!$stmt->execute([$username,$username])){
		header('location:../menteesignup.php?error=sqlerror');
		
	}else
    $count = $stmt->rowcount();
    if($count > 0){
        header('location:../menteesignup.php?error=nametaken&name='.$name.'&name2='.$name2);	
	}else{
        $pwd = password_hash($pwd,PASSWORD_DEFAULT);
		$username = htmlentities(trim($username));
		$name = htmlentities($name);
        $name2 = htmlentities($name2);
        if($avatar){
            include 'functions.php';
         $avatarLink =   makeAvatar(strtoupper($name[0]));
         $sql = 'INSERT INTO mentees(FIRSTNAME,LASTNAME,USERNAME,PASSWORD,AVATAR)VALUES(?,?,?,?,?)';
         $stmt = $conn->prepare($sql);
         if($stmt->execute([$name,$name2,$username,$pwd,$avatarLink])){
            $query = 'SELECT id FROM mentees WHERE USERNAME = ? LIMIT 1';
            $stmt = $conn->prepare($query);
            $stmt->execute([$username]);
            $stm = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $stm->ID;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $name;
            $_SESSION['lastname'] = $name2;
            $_SESSION['image'] = $avatarLink;
            $_SESSION['id'] = $id;
            $_SESSION['type'] = 'mentee';
            header('location:../home.php');
         }else{
            header('location:../menteesignup.php?error=sqlerror');  
         }

        }else{

           
            $sql = 'INSERT INTO mentees(FIRSTNAME,LASTNAME,USERNAME,PASSWORD)VALUES(?,?,?,?)';
            $stmt = $conn->prepare($sql);
            if($stmt->execute([$name,$name2,$username,$pwd])){
                $query = 'SELECT id FROM mentees WHERE USERNAME = ? LIMIT 1';
            $stmt = $conn->prepare($query);
            $stmt->execute([$username]);
            $stm = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $stm->ID;
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $name;
            $_SESSION['lastname'] = $name2;
            
            $_SESSION['id'] = $id;
            $_SESSION['type'] = 'mentee';
             header('location:../home.php');
            }else{
                header('location:../menteesignup.php?error=sqlerror');    
            }


            
        }

      
    }
    
}




    
	



}else{
    header('location:../login.php');
}





?>