<?php require "connection.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | BuyNow</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body class="main-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php" ?>

            <div class="col-12 bg-danger mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mt-3 mb-2  logo" style="height: 80px; width: 100px;"></div>
                            </div>
                            <div class="col-10 text-center">
                                <p class="fs-1 text-black fw-bolder mt-3 pt-2">Advanced Search</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item fw-bold"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item text-black active fw-bold" aria-current="page">Advance Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 bg-danger rounded-5 p-5 mb-2">
                <div class="row">

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type Keyword to search..." id="t" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-3 border-primary" />
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-2">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class=" col-12 col-lg-4 mb-2">
                                        <select class="form-select" id="c4">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-2">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;

                                            for ($x = 0; $x < $model_num; $x++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="offset-lg-2 col-12 col-lg-4 mb-2">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>
                                            <?php

                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class=" col-12 col-lg-4 mb-2">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php

                                            $colour_rs = Database::search("SELECT * FROM `color`");
                                            $colour_num = $colour_rs->num_rows;

                                            for ($x = 0; $x < $colour_num; $x++) {
                                                $colour_data = $colour_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["color"]; ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>

                                    <hr class="mt-2 mb-2" />

                                    <div class="col-12 col-lg-4 offset-lg-4 bg-body rounded mb-2">
                                        <div class="row">
                                            <select class="form-select border border-start-0 border-top-0 border-end-0 border-2 border-primary shadow-none" id="s">
                                                <option value="0">SORT BY</option>
                                                <option value="1">PRICE HIGH TO LOW</option>
                                                <option value="2">PRICE LOW TO HIGH</option>
                                                <option value="3">QUANTITY HIGH TO LOW</option>
                                                <option value="4">QUANTITY LOW TO HIGH</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="offset-lg-2 col-12 col-lg-8 bg-body border border-5 rounded mb-2">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php" ?>

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>