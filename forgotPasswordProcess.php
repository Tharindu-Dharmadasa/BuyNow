<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["email"])){

    $email = $_GET["email"];

    if(empty($email)){
        echo ("Please enter your email.");

    }else{
    

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");

    $num = $rs->num_rows;

    if($num == 1){
        $code = uniqid();

        Database::iud("UPDATE `user` SET `verification_code`='".$code."' WHERE
        `email`='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tharindubandara0927@gmail.com';
        $mail->Password = 'clccxuwkbeecjwcu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('tharindubandara0927@gmail.com', 'Reset Password');
        $mail->addReplyTo('tharindubandara0927@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'BuyNow Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:red">Your Verification Code is '.$code.'</h1>';
        $mail->Body = $bodyContent;

        if(!$mail->send()){
            echo "Verification code sending failed";
        }else{
            echo "success";
        }

    }else {
        echo("Email not found.");
    }

}

    }else{
        echo("Invalid Email address.");
    }


?>