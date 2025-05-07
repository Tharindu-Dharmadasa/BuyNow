<?php 

require "connection.php";

if(isset($_GET["id"])){

    $dcid = $_GET["id"];

    $deletecategory_rs = Database::search("SELECT * FROM `category` WHERE `id`='".$dcid."'");
    $deletecategory_num = $deletecategory_rs->num_rows;

    $deletecategory_data = $deletecategory_rs->fetch_assoc();

    if ($deletecategory_num == 0){
        echo("Something went wrong. Please try again later.");
    }else{
        Database::iud("DELETE FROM `category` WHERE `id`='".$dcid."'");

        echo("success");
    }
}else{
    echo("Please select a product");
}

?>