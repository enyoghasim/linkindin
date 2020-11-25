<?php
session_start();
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
    <title>MENTOR SIGNUP</title>
</head>
<body>
<div id='login'>
    <div class='main'>
    <div class='loginbox'>
       
  <form action="backend/signup.backend.php" method="post">

  <h1 style='color:white; text-align:center; margin-bottom:10px; text-decoration:underline;'>MENTOR SIGNUP</h1>
  <a href="menteesignup.php" style='text-decoration:none;color:orange; float:right; margin-botton:10px;'>SIGNUP AS MENTEE</a>
  <div class="textbox">
  <input  type="text" style="margin-top:10px;width:100%;" placeholder='FIRSTNAME' name="name">
</div>
<div class="textbox">
  <input  type="text" style="margin-top:10px;width:100%;" placeholder='LASTNAME' name="name2">
</div>
  <div class="textbox">
  <input type="text" style="margin-top:10px;width:100%;" placeholder='USERNAME' name="username">
</div>
<div class="textbox">
  <input type="password" style="width:100%;" placeholder="PASSWORD" name="password">
  </div>
  <div class="textbox">
  <input type="password" style="width:100%;" placeholder="REPEAT PASSWORD" name="password2">
  </div>
  <div class="textbox">
<input name='check' value='make' checked type="checkbox"> <span style='color:white'>GENERATE AVATAR</span>
          </div>
          <br>

  <button type="submit" style=" align:center" name='signup' value='mentor'  class='sumt'>SIGNUP</button>
  <a href="login.php" style="float:right;color:white; margin-top:10px;">LOGIN</a>
  </form>
        </div></div>
</div>
</body>

</html>