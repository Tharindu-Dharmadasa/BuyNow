<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `products` WHERE `id` = '" . $pid . "'");
    $product_num = $product_rs->num_rows;

    $product_data = $product_rs->fetch_assoc();

    if ($product_num == 0) {
        echo ("Something went wrong. Please try again later.");
    } else {

        Database::iud("INSERT INTO `recent`(`products_id`,`user_email`) VALUES ('" . $product_data["id"] . "','" . $product_data["user_email"] . "'); ");
        Database::iud("DELETE FROM `products` WHERE `id`='" . $pid . "'");

        echo ("Success");
    }
} else {
    echo ("Please add any product or try again later.");
}
