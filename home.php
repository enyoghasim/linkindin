<?php
session_start();
$logedin = null;
if(isset($_SESSION['username'])){
    $logedin = true;
}
if(!$logedin){
    header('location:login.php');
    exit();
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/style.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>HOME</title>
</head>
<body>
    <nav class='nav'>

    <div class="links">
  <div class="logo"><?php echo strtoupper($_SESSION['type'])?>&nbsp<span style='color:white;font-weight:bolder;'>+</span></div>    
    <ul class='ok '>
        <li><a href="home.php" style='color:green;'>HOME</a></li>
    <li><a href="<?php if ($_SESSION['type'] === 'mentee') {echo 'm';  }?>profile.php">PROFILE</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
</ul>
    <div  class="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    </div>
   
    </nav>
</body>
<br>
  <div class="center" >
  <?php if ($_SESSION['type'] === 'mentee') { 
      include 'backend/config.php';
      $sql = $conn->query('SELECT * FROM mentors ');
while ($row = $sql->fetch(PDO::FETCH_OBJ)){
  $top = 'SELECT * FROM ment WHERE mentor = ? AND mentee = ?';
  $stmt2=$conn->prepare($top);
  $stmt2->execute([$row->Username,$_SESSION['username']]);
  $count2 = $stmt2->rowcount();
  if ($count2 > 0){
    $btn = '<a href="unmakementor.php?username='.$row->Username.'">UNMAKE MENTOR</a>';
  }else{
    $btn = '<a href="makementor.php?username='.$row->Username.'">MAKE MENTOR</a>';
  }
   echo  "<div style='' class='contain'>
    <div class='head'>
    <img style='border-radius:50%'  src='".substr($row->Avatar,3)."' alt='IMAGE'>
    <a href='profile.php?username=".$row->Username."'>
    <h3 '>".$row->Firstname."&nbsp".$row->Lastname."</h3></a>
    @".$row->Username."
    </div>
    <button>".$btn."</button>
    </div><br><br>"
    ;
}
  }else{
    include 'backend/config.php';
    $sql = $conn->query('SELECT * FROM mentees ');
while ($row = $sql->fetch(PDO::FETCH_OBJ)){
  $top = 'SELECT * FROM ment WHERE mentor = ? AND mentee = ?';
  $stmt2=$conn->prepare($top);
  $stmt2->execute([$_SESSION['username'],$row->username]);
  $count2 = $stmt2->rowcount();
  if ($count2 > 0){
    $btn = '<a href="unmakementee.php?username='.$row->username.'">UNMAKE MENTEE</a>';
  }else{
    $btn = '<a href="makementee.php?username='.$row->username.'">MAKE MENTEE</a>';
  }
   echo  "<div style='' class='contain'>
    <div class='head'>
    <img style='border-radius:50%'  src='".substr($row->avatar,3)."' alt='IMAGE'>
    <a href='mprofile.php?username=".$row->username."'>
    <h3 '>".$row->firstname."&nbsp".$row->lastname."</h3></a>
    @".$row->username."
    </div>
    <button>".$btn."</button>
    </div><br><br>"
    ;
}
}
  ?>
  </div>




<script type='text/javascript' src='js.js'></script>  
</html>

