<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | BuyNow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body class="main-body">

    <div class="container-fluid vh-100">
        <div class="row">

            <?php include "header.php" ?>

            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12 transbox">

                        <div class="col-12 ">
                            <div class="row">

                                <div class="col-12 mt-2 d-flex justify-content-center logo" style="height: 50px;"></div>
                                <div class="col-12 col-lg-5 offset-lg-2 mt-3">
                                    <input type="text" class="form-control" style="border-radius: 20px; background-color: white;" placeholder="Search any product..." id="basic_search_txt" />
                                </div>
                                <div class="col-12 col-lg-2 mt-3 mb-3 d-grid">
                                    <button class="btn btn-dark" onclick="basicSearch(0);">Search</button>
                                </div>
                                <div class="col-12 col-lg-1 mt-3">
                                    <a href="advanceSearch.php" class="link-dark text-decoration-none fw-bold">Advanced Search</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="doubleval mt-3 mb-3" />

            <div class="col-12" id="basic_search_result">
                <div class="row">

                    <!-- carousel -->
                    <div id="carouselExampleFade" class="carousel slide carousel-fade">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/image1.jpg" class="d-none d-lg-block disply-img">
                                <div class="carousel-caption d-none d-md-block disply-caption">
                                    <h5 class="disply-title">Welcome to Buy Now</h5>
                                    <p class="disply-txt">Just Click and Buy Anything You Want.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/image2.jpg" class="d-block disply-img">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- carousel -->

                    <hr class="mt-3 mb-3" />

                    <?php

                    require "connection.php";

                    $category_rs = Database::search("SELECT * FROM `category`");
                    $category_num = $category_rs->num_rows;
                    for ($x = 0; $x < $category_num; $x++) {

                        $category = $category_rs->fetch_assoc();

                    ?>

                        <!-- category name -->

                        <div class="col-12 mt-3 md-3 d-flex bg-light justify-content-center">
                            <a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $category["name"]; ?></a> &nbsp;&nbsp;
                        </div>

                        <!-- category name -->

                        <hr class="doubleval mt-3 mb-3" />

                        <!-- products -->

                        <div class="col-12 mb-3">
                            <div class="row border rounded">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-2">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `products` WHERE `category_id` = '" . $category["id"] . "'
                                        AND `status_id` = '1' ORDER BY `added_datetime` DESC LIMIT 3 OFFSET 0");
                                        $product_num = $product_rs->num_rows;

                                        for ($y = 0; $y < $product_num; $y++) {
                                            $product = $product_rs->fetch_assoc();

                                        ?>

                                            <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                                <?php

                                                $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id` = '" . $product["id"] . "'");
                                                $image = $image_rs->fetch_assoc();

                                                ?>

                                                <img src="<?php echo $image["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fs-6 fw-bold"><?php echo $product["title"]; ?> <span class="badge bg-info">New Arrival</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $product["price"]; ?> .00</span> <br />

                                                    <?php
                                                    if ($product["qty"] > 0) {
                                                    ?>
                                                        <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                        <span class="card-text text-success fw-bold"><?php echo $product["qty"]; ?> Items Available</span> <br /><br />
                                                        <a href='<?php echo "singleProductView.php?id=" . $product["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                                                        <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $product['id']; ?>);">Add to Cart</button>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                        <span class="card-text text-success fw-bold">00 Items Available</span> <br /><br />
                                                        <button class="col-12 btn btn-success">Buy Now</button>
                                                        <button class="col-12 btn btn-danger mt-2">Add to Cart</button>

                                                    <?php
                                                    }
                                                    ?>

                                                    <button class="col-12 btn btn-outline-light mt-2 border border-info" onclick='addToWatchlist(<?php echo $product["id"]; ?>);'>
                                                        <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $product["id"]; ?>'></i>
                                                    </button>

                                                </div>
                                            </div>

                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>

                                <div class="col-12 mt-3 md-3 text-end">
                                    <a href="myProducts.php" class="text-decoration-none link-dark fs-6">See All &nbsp; &rarr; </a>
                                </div>

                            </div>
                        </div>
                        <!-- products -->

                    <?php

                    }

                    ?>

                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>

    </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>