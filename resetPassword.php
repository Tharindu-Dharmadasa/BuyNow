<?php

require "connection.php";

$email = $_POST["e"];
$npw = $_POST["n"];
$rnpw = $_POST["r"];
$vcode = $_POST["v"];

if(empty($email)){
    echo("Missing Email address");
}else if(empty($npw)){
    echo("Please insert a New Password");
}else if(strlen($npw)<5 || strlen($npw)>20){
    echo("Invalid Password");
}else if(empty($rnpw)){
    echo("Please Re-type your New Password");
}else if($npw != $rnpw){
    echo("Password does not matched");
}else if(empty($vcode)){
    echo("Please enter your Verification Code");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND 
    `verification_code`='".$vcode."'");
    $num = $rs->num_rows;

    if($num == 1){

        Database::iud("UPDATE `user` SET `password`='".$npw."' WHERE `email`='".$email."' ");
        echo("success");
    }else{
        echo("Invalid Email or Verification Code");
    }
}

?>