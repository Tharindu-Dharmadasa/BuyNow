<?php 

session_start();
require "connection.php";
if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $wlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $pid . "' AND 
        `user_email`='" . $email . "'");
        $wlist_num = $wlist_rs->num_rows;

        if($wlist_num == 1){

            $wlist_data = $wlist_rs->fetch_assoc();
            $list_id = $wlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='".$list_id."'");
            echo("removed");
        }else {

            Database::iud("INSERT INTO `watchlist`(`products_id`,`user_email`)VALUES ('".$pid."','".$email."')");
            echo("added");

        }

    }else {
        echo("something went wrong");
    }
}else{
    echo("Please Login First");
}
?>
