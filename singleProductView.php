<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT products.id,products.price,products.qty,products.description,products.title,
    products.added_datetime,products.delivery_fee_countrywide,products.brand_has_model_id,
    products.category_id,products.color_id,products.condition_id,products.status_id,products.user_email,
    model.name AS mname,brand.name AS bname FROM `products` INNER JOIN `brand_has_model` ON
    brand_has_model.id=products.brand_has_model_id INNER JOIN `brand` ON brand.id=brand_has_model.brand_id INNER JOIN
    `model` ON model.id=brand_has_model.model_id WHERE products.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>


        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | BuyNow</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resources/logo.png" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 singleProduct" style="background-color: #ff1d58;background-image: linear-gradient(80deg,#ff1d58 0%,#fff685 100%);">
                        <div class="row">

                                <div class="row mt-4">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                        </ol>
                                    </nav>
                                </div>

                                <div class="col-12" style="padding: 10px;">
                                    <div class="row">

                                        <div class="row border-top border-dark">
                                            <div class="col-12 my-2">
                                                <span class="fs-4 text-success fw-bold"><?php echo $product_data["title"] ?></span>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-2 order-2 order-lg-3">
                                            <ul>
                                                <?php

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $pid . "'");
                                                $image_num = $image_rs->num_rows;
                                                $img = array();

                                                if ($image_num != 0) {

                                                    for ($x = 0; $x < $image_num; $x++) {
                                                        $image_data = $image_rs->fetch_assoc();
                                                        $img[$x] = $image_data["code"];
                                                ?>

                                                        <li class="d-flex flex-row justify-content-center align-items-center mb-1">
                                                            <img src="<?php echo $img["$x"]; ?>" style="height: 200px;" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>)" />
                                                        </li>
                                                    <?php

                                                    }
                                                } else {

                                                    ?>

                                                    <li class="d-flex flex-row justify-content-center align-items-center border border-1 
                                                    border-secondary mb-1">
                                                        <img src="resources/images/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                    <li class="d-flex flex-row justify-content-center align-items-center border border-1 
                                                    border-secondary mb-1">
                                                        <img src="resources/images/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                    <li class="d-flex flex-row justify-content-center align-items-center border border-1 
                                                    border-secondary mb-1">
                                                        <img src="resources/images/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>

                                                <?php

                                                }

                                                ?>

                                            </ul>
                                        </div>

                                        <div class="col-6 offset-3 order-2 order-lg-2 d-none d-lg-block">
                                            <div class="row">
                                                <div class="col-12 align-items-center justify-content-center border border-1 border-secondary">
                                                    <div class="main-img" id="main_img"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-12 order-3">
                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row border-bottom border-dark">
                                                        <div class="col-12 col-lg-6 offset-lg-4 mt-2 my-2">
                                                            <span class="badge">
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>
                                                                <i class="bi bi-star-fill text-warning fs-5"></i>

                                                                &nbsp;&nbsp;

                                                                <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews & Ratings</label>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <p class="col-12 offset-lg-4 mt-3">
                                                        <a class="btn btn-outline-warning fw-bold text-center" style="height: 50px;" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Price & Other Details</a>
                                                        <button class="btn btn-outline-danger fw-bold" style="height: 50px;" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Warrenty & Policy Details</button>
                                                        <button class="btn btn-outline-success fw-bold" style="height: 50px;" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">Seller's Name</button>
                                                        <button class="btn btn-outline-primary fw-bold" style="height: 50px;" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" aria-expanded="false" aria-controls="multiCollapseExample4">Discounts</button>

                                                    </p>

                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                                <div class="card card-body bg-warning border-2">
                                                                    <?php

                                                                    $price = $product_data["price"];
                                                                    $adding_price = ($price / 100) * 5;
                                                                    $new_price = $price + $adding_price;
                                                                    $difference = $new_price - $price;
                                                                    $percentage = ($difference / $price) * 100;

                                                                    ?>

                                                                    <div class="row">
                                                                        <div class="col-12 my-2">
                                                                            <span class="fs-4 fw-bold text-dark">Rs. <?php echo $price; ?> .00</span>
                                                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                            <span class="fs-4 fw-bold text-danger text-decoration-line-through">Rs. <?php echo $new_price; ?> .00</span>
                                                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                            <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $difference; ?> .00 (<?php echo $percentage; ?>%)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                                <div class="card card-body bg-danger border-2">
                                                                    <div class="col-12 my-2">
                                                                        <span class="fs-5 text-dark"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                                        <span class="fs-5 text-dark"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                                        <span class="fs-5 text-dark"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                                                <div class="card card-body bg-success border-2">
                                                                    <div class="row ">
                                                                        <?php


                                                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");

                                                                        $user_data = $user_rs->fetch_assoc();

                                                                        ?>

                                                                        <div class="row ">
                                                                            <div class="col-12 my-2">
                                                                                <div class="row g-2">
                                                                                    <div class="col-12 col-lg-6 border border-1 border-white text-center">
                                                                                        <span class="fs-5 text-dark"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-12 col-lg-6 border border-1 border-white text-center">
                                                                                        <span class="fs-5 text-dark"><b>Sold : </b>5 Items</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mt-1">
                                                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                                                <div class="card card-body bg-primary border-2">

                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-secondary rounded">
                                                                                    <div class="row">
                                                                                        <div class="col-3 col-lg-2 border-end border-2 border-secondary">
                                                                                            <img src="resources/pricetag.png" />
                                                                                        </div>
                                                                                        <div class="col-9 col-lg-10">
                                                                                            <span class="fs-5 text-dark fw-bold">
                                                                                                Stand a chance to get 5% discount by using VISA or MASTER
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <div class="row g-2">

                                                                <div class="float-left mt-1 position-relative product-qty">
                                                                    <div class="col-6 offset-3">
                                                                        <span>Quantity : </span>
                                                                        <input type="text" class="border-0  rounded p-1 fs-5 fw-bold text-start" id="qty_input" style="outline: none;width: 200px;" pattern="[0-9]" value="1" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                        <div class="position-absolute qty-buttons">
                                                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                    qty-inc">
                                                                                <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                            </div>
                                                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                    qty-dec">
                                                                                <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-12 mt-5">
                                                                                <div class="row p-2">
                                                                                    <div class="col-4 d-grid">
                                                                                        <button class="btn btn-success" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                                    </div>
                                                                                    <div class="col-4 d-grid">
                                                                                        <button class="btn btn-primary">Add To Cart</button>
                                                                                    </div>
                                                                                    <div class="col-4 d-grid">
                                                                                        <button class="btn btn-secondary">
                                                                                            <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            &nbsp;
                            &nbsp;

                            <div class="col-12 ">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $c_rs = Database::search("SELECT * FROM `category`");
                            $c_num = $c_rs->num_rows;

                            for ($y = 0; $y < $c_num; $y++) {
                                $cdata = $c_rs->fetch_assoc();

                                $products_rs = Database::search("SELECT * FROM `products` WHERE `category_id`='" . $cdata["id"] . "' AND
                                `status_id`='1' ORDER BY `added_datetime` ASC LIMIT 3 OFFSET 0");
                                $products_num = $products_rs->num_rows;

                                for ($z = 0; $z < $products_num; $z++) {
                                    $products_data = $products_rs->fetch_assoc();


                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $product_data["id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                            ?>

                                    <div class="card col-6 col-lg-2 offset-lg-1 mt-2 mb-2" style="width: 18rem;">

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $products_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        ?>
                                        <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                        <div class="card-body ms-0 m-0 text-center">
                                            <h5 class="card-title fs-6 fw-bold"><?php echo $products_data["title"]; ?> <span class="badge bg-info">New</span></h5>
                                            <span class="card-text text-primary">Rs.<?php echo $products_data["price"] ?>.00</span> <br />

                                            <?php

                                            if ($product_data["qty"] > 0) {

                                            ?>
                                                <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                <span class="card-text text-success fw-bold"><?php echo $products_data["qty"]; ?> Items Available</span> <br /><br />
                                                <a href='<?php echo "singleProductView.php?id=" . $products_data["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $products_data['id']; ?>);">Add to Cart</button>

                                            <?php

                                            } else {

                                            ?>

                                                <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                <span class="card-text text-success fw-bold">00 Items Available</span> <br /><br />
                                                <button class="col-12 btn btn-success">Buy Now</button>
                                                <button class="col-12 btn btn-danger mt-2">Add to Cart</button>

                                            <?php
                                            }

                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `products_id`='" . $products_data["id"] . "' AND 
                                            `user_email`='" . $_SESSION["u"]["email"] . "'");
                                            $watchlist_num = $watchlist_rs->num_rows;

                                            if ($watchlist_num == 1) {

                                            ?>

                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $products_data["id"]; ?>'></i>
                                                </button>
                                            <?php

                                            } else {

                                            ?>

                                                <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $products_data["id"]; ?>'></i>
                                                </button>

                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

                            <?php
                            }
                            ?>

                            <div class="col-9 ">
                                <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark border-end">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <?php
                            
                            $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `feedback_types` 
                            ON feedback.feedback_types_id = feedback_types.id WHERE `products_id` = '".$pid."'");
                            $feedback_num = $feedback_rs->num_rows;

                            $feedback_data = $feedback_rs->fetch_assoc();
                            
                            ?>

                            <div class="col-3">
                                <div class="row me-0 mt-4 mb-3 ">
                                    <div class="col-12 d-flex align-content-end justify-content-end">

                                        <button class="btn btn-outline-dark fs-4 fw-bold" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                            Feedback
                                        </button>

                                        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Product Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>

                                            <?php
                                            
                                            if($feedback_num > 0 ){
                                            
                                            ?>
                                            <div class="offcanvas-body">
                                                <div>
                                                    <div class="col-12">
                                                        <div class="row border border-1 border-dark rounded me-0 overflow-scroll" style="height: 300px;">
                                                            <div class="col-12 mt-1 mb-1 mx-1">
                                                                <div class="col-10 mt-1 mb-1 ms-0">
                                                                    <span class="fw-bold"><?php echo $user_data["fname"]; ?></span>
                                                                </div>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <span class="badge bg-success"><?php echo $feedback_data["type"]; ?></span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <hr />
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="text-center fw-bold text-black-50"><?php echo $feedback_data["feedback"]; ?></p>
                                                                </div>
                                                                <div class="offset-6 col-6 text-end">
                                                                    <label class="form-label fs-6"><?php echo $feedback_data["date"]; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <?php
                                            
                                            }else{
                                            
                                            ?>

<div class="offcanvas-body">
                                                <div>
                                                    <div class="col-12">
                                                        <div class="row border border-1 border-dark rounded me-0 overflow-scroll" style="height: 300px;">
                                                            <div class="col-12 mt-1 mb-1 mx-1">
                                                                <div class="col-10 mt-1 mb-1 ms-0">
                                                                    <span class="fw-bold"><?php echo $user_data["fname"]; ?></span>
                                                                </div>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <span class="badge bg-success">Positive</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <hr />
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="text-center fw-bold text-black-50">Good Product !!!</p>
                                                                </div>
                                                                <div class="offset-6 col-6 text-end">
                                                                    <label class="form-label fs-6">2023.04.01</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-9">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label fs-4 fw-bold">Brand : </label>
                                            </div>
                                            <div class="col-8">
                                                <label class="form-label text-warning fs-4 fw-bolder"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="form-label fs-4 fw-bold">Model : </label>
                                            </div>
                                            <div class="col-8">
                                                <label class="form-label text-warning fs-4 fw-bolder"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Product Description : </label>
                                            </div>
                                            <div>
                                                <textarea cols="60" rows="10" class="form-control" readonly>
                                                    <?php echo $product_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the Incovenience");
    }
} else {
    echo ("Something went wrong");
}

?>