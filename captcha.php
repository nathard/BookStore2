<?php
session_start();
//imagecreate -- Create a new palette based image
$img = imagecreate(50, 22);
//displaying the random text on the captcha image
$black = imagecolorallocate($img, 0, 0, 0);
$random = rand(100, 10000);
$number = $black . $random;
$_SESSION['captcha'] = ($random);

$white = imagecolorallocate($img, 255, 255, 255);
imagestring($img, 10, 8, 3, $random, $white);
header ("Content-type: image/png");
imagepng($img);
?>