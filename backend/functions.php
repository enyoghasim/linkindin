<?php
function checkLogedIn($login){

    if($logedin){
        header('location:home.php');
        exit();
    }else {
        header('location:login.php');
        exit();
    }


}

function makeAvatar($string){


  
    $imageFilePath = "../images/".time() . ".png";

   
    $avatar = imagecreatetruecolor(60,60);
   $r = mt_rand(0,255);
$g = mt_rand(0,255);
$b = mt_rand(0,255);
    $bg_color = imagecolorallocate($avatar, $r, $g, $b);

    imagefill($avatar,0,0,$bg_color);
    $avatar_text_color = imagecolorallocate($avatar, 225, 225, 225);

    $font = imageloadfont('../font/ok.gdf');
    imagestring($avatar, $font, 10, 10, $string, $avatar_text_color);

    imagepng($avatar, $imageFilePath);
  
    imagedestroy($avatar);
   
    return $imageFilePath;



}


?>