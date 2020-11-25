<?php 
session_start();
if (isset($_GET['username']) && $_GET['username'] == $_SESSION['username']  ):
?>
<?php
$username = htmlentities($_GET['username']);
include 'backend/config.php';
$sql =  "SELECT * FROM MENTORS WHERE USERNAME = ? LIMIT 1"; 
$stmt = $conn->prepare($sql);
if($stmt->execute([$username])): 
$stm = $stmt->fetch(PDO::FETCH_OBJ);
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="assets/style.css">
    <title><?php echo $stm->Username; ?></title>
</head>
<body >
<nav class='nav'>
<div class="links">
  <div class="logo"><?php echo strtoupper($_SESSION['type'])?>&nbsp<span style='color:white;font-weight:bolder;'>+</span></div>    
    <ul class='ok '>
        <li><a href="home.php" >HOME</a></li>
    <li><a href="<?php if ($_SESSION['type'] === 'mentee') {echo 'm';  }?>profile.php" style="color:green;">PROFILE</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
</ul>
    <div  class="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
    </div>
  </nav>
  <br>
  <div class="center" >
   
  
    <img width="150px" height="150px" src="<?php
echo substr($stm->Avatar,3)?>

" alt="profile image">
<strong style='font-weight:bolder;font-size:35px;'><?php echo $stm->Firstname.'&nbsp' ;echo $stm->Lastname;  ?></strong>
<strong style='font-weight:bolder;font-size:30px;'>@<?php echo $stm->Username;?></strong>
<br>
<div>
    <p>
   <?php echo $stm->Bio; ?>
    </p>
    </div>
    <br>
<p>HAS <?php 
    $sql = 'SELECT * FROM MENT WHERE MENTOR = ? ';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $count=$stmt->rowcount();
    echo $count;
    ?> MENTEES</p><?php if ($count > 0){echo '<a href="browse.php?username='.$stm->Username.'">VIEW</a>'; } ?><br>
<a href="profile.php?edit=true"> EDIT PROFILE</a>
</div>
   
    <script type='text/javascript' src='js.js'></script>  
</body>
</html>
<?php endif;  ?>
<?php  if(!$stmt->execute([$username])): ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>error</title>
</head>
<body>
    <h1>ERROR GETTING USER TRY AGAIN</h1>
</body>
</html>
<?php endif;  ?>


<?php  endif; ?>

    <?php 
if (!isset($_GET['username']) &&  isset($_SESSION['username']) ):
    ?>
    <?php
    $username = htmlentities($_SESSION['username']);
    include 'backend/config.php';
    $sql =  "SELECT * FROM MENTORS WHERE USERNAME = ? LIMIT 1"; 
    $stmt = $conn->prepare($sql);
    if($stmt->execute([$username])): 
    $stm = $stmt->fetch(PDO::FETCH_OBJ);
    ?>
        
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="assets/style.css">
        <title><?php echo $stm->Username; ?></title>
    </head>
    <body >
    <nav class='nav'>
    <div class="links">
      <div class="logo"><?php echo strtoupper($_SESSION['type'])?>&nbsp<span style='color:white;font-weight:bolder;'>+</span></div>    
        <ul class='ok '>
            <li><a href="home.php" >HOME</a></li>
        <li><a href="<?php if ($_SESSION['type'] === 'mentee') {echo 'm';  }?>profile.php" style="color:green;">PROFILE</a></li>
            <li<a href="logout.php">LOGOUT</a></li>
    </ul>
        <div  class="burger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        </div>
      </nav>
      <br>
      <div class="center" >
       
      
        <img width="150px" height="150px" src="<?php
    echo substr($stm->Avatar,3)?>
    
    " alt="profile image">
    <strong style='font-weight:bolder;font-size:35px;'><?php echo $stm->Firstname.'&nbsp' ;echo $stm->Lastname;  ?></strong>
    <strong style='font-weight:bolder;font-size:30px;'>@<?php echo $stm->Username;?></strong>
    <br>
    <div>
    <p>
   <?php echo $stm->Bio; ?>
    </p>
    </div>
    <br>
    <p>HAS <?php 
    $sql = 'SELECT * FROM MENT WHERE MENTOR = ? ';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $count=$stmt->rowcount();
    echo $count;
    ?> MENTEES</p><?php if ($count > 0){echo '<a href="browse.php?username='.$stm->Username.'">VIEW</a>'; } ?>
    <br><a href="profile.php?edit=true"> EDIT PROFILE</a>
    </div>
       
        <script type='text/javascript' src='js.js'></script>  
    </body>
    </html>
    <?php endif;  ?>
    <?php  if(!$stmt->execute([$username])): ?>
    
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>error</title>
    </head>
    <body>
        <h1>ERROR GETTING USER TRY AGAIN</h1>
    </body>
    </html>
    <?php endif;  ?>
    
    
    <?php  endif; ?>



    <?php 
if (isset($_GET['username']) &&  !isset($_SESSION['username']) || isset($_GET['username']) && $_SESSION['username'] !== $_GET['username']):
    ?>
    <?php
    $username = htmlentities($_GET['username']);
    include 'backend/config.php';
    $sql =  "SELECT * FROM MENTORS WHERE USERNAME = ? LIMIT 1"; 
     
    $stmt = $conn->prepare($sql);
    if($stmt->execute([$username])): 
        $count = $stmt->rowcount();
        if ($count === 0){
            echo '
            <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>error</title>
    </head>
    <body>
        <h1>404 USER NOT FOUND</h1>
    </body>
    </html>
            ';
            exit();
        }
    $stm = $stmt->fetch(PDO::FETCH_OBJ);
    ?>
        
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="assets/style.css">
        <title><?php echo $stm->Username; ?></title>
    </head>
    <body >
    <nav class='nav'>
    <div class="links">
      <div class="logo"><?php echo strtoupper($_SESSION['type'])?>&nbsp<span style='color:white;font-weight:bolder;'>+</span></div>    
        <ul class="ok ">
            <li><a href="home.php" >HOME</a></li>
        <li><a href="<?php if ($_SESSION['type'] === 'mentee') {echo 'm';  }?>profile.php" style="color:green;">PROFILE</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
    </ul>
        <div  class="burger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        </div>
      </nav>
      <br>
      <div class="center" >
       
      
        <img width="150px" height="150px" src="<?php
    echo substr($stm->Avatar,3)?>
    
    " alt="profile image">
    <strong style='font-weight:bolder;font-size:35px;'><?php echo $stm->Firstname.'&nbsp' ;echo $stm->Lastname;  ?></strong>
    <strong style='font-weight:bolder;font-size:30px;'>@<?php echo $stm->Username;?></strong>
    <br>
    <div>
    <p>
   <?php echo $stm->Bio; ?>
    </p>
    </div>
    <br>
    <p>HAS <?php 
    $sql = 'SELECT * FROM MENT WHERE MENTOR = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $count=$stmt->rowcount();
    echo $count;
    ?> MENTEES</p><?php if ($count > 0){echo '<a href="browse.php?username='.$stm->Username.'">VIEW</a>'; } ?>
 
    </div>
       
        <script type='text/javascript' src='js.js'></script>  
    </body>
    </html>
    <?php endif;  ?>
    <?php  if(!$stmt->execute([$username])): ?>
    
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>error</title>
    </head>
    <body>
        <h1>ERROR GETTING USER TRY AGAIN</h1>
    </body>
    </html>
    <?php endif;  ?>
    
    
    <?php  endif; ?>