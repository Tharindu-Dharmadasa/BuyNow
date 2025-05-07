<?php

require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $deleteHistory_rs = Database::search("SELECT * FROM `invoice` WHERE `payment_id`='".$pid."'");
    $deleteHistory_data = $deleteHistory_rs->fetch_assoc();

    $user = $deleteHistory_data["user_email"];
    $product = $deleteHistory_data["products_id"];

    Database::iud("DELETE FROM `invoice` WHERE `payment_id`='".$pid."'");

    echo("success");
}else{
    echo("Something went wrong");
}

?>