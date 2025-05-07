<?php

require "connection.php";

if (isset($_GET["id"])){

    $pid = $_GET["id"];

    $pid_rs = Database::search("SELECT * FROM `products` WHERE `id`='".$pid."'");
    $pid_num = $pid_rs->num_rows;

    if($pid_num == 1){

        $pid_data = $pid_rs->fetch_assoc();

        if ($pid_data["status_id"] == 1){
            Database::iud("UPDATE `products` SET `status_id`='2' WHERE `id`='".$pid."'");
            echo ("blocked");
        }else if ($pid_data["status_id"] == 2){
            Database::iud("UPDATE `products` SET `status_id`='1' WHERE `id`='".$pid."'");
            echo ("unblocked");
        }

    }else {
        echo ("Cannot find the user. Please try again later.");
    }

}else{
    echo("Something went wrong.");
}

?>