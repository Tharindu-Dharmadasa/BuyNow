<?php

require "connection.php";

$txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$colour = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `products`";
$status = 0;

if ($sort == 0) {

    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%'";
        $status = 1;
    }

    if ($status == 0 && $category != 0) {
        $query .= " WHERE `category_id` = '" . $category . "'";
        $status = 1;
    } else if ($status != 0 && $category != 0) {
        $query .= " AND `category_id`='" . $category . "'";
    }

    $pid = 0;

    if ($brand != 0 && $model == 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= " WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand == 0 && $model != 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='" . $model . "'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= "WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($brand != 0 && $model != 0) {
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='" . $brand . "'
        AND `model_id`='".$model."'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for ($x = 0; $x < $brand_has_model_num; $x++) {
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if ($status == 0) {
            $query .= "WHERE `brand_has_model_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= "AND `brand_has_model_id`='" . $pid . "'";
        }
    }

    if ($status == 0 && $condition != 0) {
        $query .= "WHERE `condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($status != 0 && $condition != 0) {
        $query .= "AND `condition_id`='" . $condition . "'";
    }

    if ($colour != 0 && $status == 0) {
        $query .= "WHERE `color_id`='" . $colour . "'";
        $status = 1;
    } else if ($colour != 0 && $status != 0) {
        $query .= "AND `color_id`='" . $colour . "'";
    }

    if(!empty($price_from) && empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` >= '".$price_from."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` >= '".$price_from."'";
        }
    }else if(empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` <= '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` <= '".$price_to."'";
        }
    }else if(!empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` BETWEEN '".$price_from."' AND '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` BETWEEN '".$price_from."' AND '".$price_to."'";
        }
    }

}else if($sort == 1){
    if(!empty($txt)){
        $query .= " WHERE `title` LIKE '%".$txt."%' ORDER BY `price` DESC";
        $status = 1;
    }
}else if($sort == 2){
    if(!empty($txt)){
        $query .= " WHERE `title` LIKE '%".$txt."%' ORDER BY `price` ASC";
        $status = 1;
    }
}else if($sort == 3){
    if(!empty($txt)){
        $query .= " WHERE `title` LIKE '%".$txt."%' ORDER BY `qty` DESC";
        $status = 1;
    }
}else if($sort == 4){
    if(!empty($txt)){
        $query .= " WHERE `title` LIKE '%".$txt."%' ORDER BY `qty` ASC";
        $status = 1;
    }
}


if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {
?>

    <div class="card mb-3 mt-3 col-12 col-lg-6">
        <div class="row">

            <div class="col-md-4 mt-4">

                <?php

                $product_img_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $results_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

                ?>

                <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" />
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title fw-bold"><?php echo $results_data["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold"><?php echo $results_data["price"]; ?></span>
                    <br />
                    <span class="card-text text-success fw-bold fs"><?php echo $results_data["qty"]; ?> Items Left</span>

                    <div class="row">
                        <div class="col-12">

                            <div class="row g-1">
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="singleProductView.php" class="btn btn-success fs">Buy Now</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="" class="btn btn-danger fs">Add Cart</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
}

?>



<div class="offset-2 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>