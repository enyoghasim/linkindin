<?php
$logedin = null;
if(isset($_SESSION['username'])){
    $logedin = true;
}
if($logedin){
    header('location:home.php');
    exit();
            }




?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENTOR LOGIN</title>
</head>
<body>
<div id='login'>
    <div class='main'>
    <div class='loginbox'>
       
  <form action="backend/login.backend.php" method="post">

  <h1 style='color:white; text-align:center; margin-bottom:10px; text-decoration:underline;'>MENTOR LOGIN</h1>
  <a href="menteelogin.php" style='text-decoration:none;color:orange; float:right; margin-botton:10px;'>LOGIN AS MENTEE</a>
  <div class="textbox">
  <input type="text" style="margin-top:10px;width:100%;" placeholder='USERNAME' name="name">
</div>
<div class="textbox">
  <input type="password" style="width:100%;" placeholder="PASSWORD" name="password">
  </div>
  <button type="submit" value='mentor'  name='login' class='sumt'>LOGIN</button>
  <a href="signup.php" style="float:right;color:white; margin-top:10px;">SIGNUP</a>
  </form>
        </div></div>
</div>
</body>

</html>