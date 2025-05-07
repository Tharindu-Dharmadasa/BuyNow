<?php

require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | BuyNow</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body style="background-color: #ff1d58;background-image: linear-gradient(80deg,#ff1d58 0%,#fff685 100%);">

    <div class="container-fluid">
        <div class="row gy-3">
            <?php include "header.php";

            if (isset($_SESSION["u"])) {

                if (isset($_SESSION["p"])) {

                    $product = $_SESSION["p"];

            ?>

                    <div class="col-12">
                        <div class="row justify-content-center align-items-center">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-11 my-1 col-lg-2 border-0 border-end border-1 border-dark">
                                        <div class="row">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb">
                                                    <li class="breadcrumb-item fw-bold"><a href="home.php">Home</a></li>
                                                    <li class="breadcrumb-item text-black active fw-bold" aria-current="page">Update Products</li>
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center mb-5">
                                <h2 class="h2 text-success fw-bold">Update Your Product</h2>
                            </div>

                            <div class="col-12 p-3 border-start border-1 border-end ">
                                <div class="row">

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3 ">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                            </div>

                                            <?php
                                            if ($product["condition_id"] == 1) {
                                            ?>
                                                <div class="col-12 col-lg-8 offset-lg-4 p-3">
                                                    <div class="form-check form-check-inline mx-5">
                                                        <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                        <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                        <label class="form-check-label fw-bold" for="u">Used</label>
                                                    </div>
                                                </div>

                                            <?php
                                            } else {
                                            ?>

                                                <div class="col-12 col-lg-8 offset-lg-4 p-3">
                                                    <div class="form-check form-check-inline mx-5">
                                                        <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                                        <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="u" name="c" checked disabled />
                                                        <label class="form-check-label fw-bold" for="u">Used</label>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold " style="font-size: 20px;">Select Product Category</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>

                                                    <?php

                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product["category_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();

                                                    ?>

                                                    <option><?php echo $category_data["name"]; ?></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>

                                                    <?php

                                                    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN
                                                    (SELECT `brand_id` FROM `brand_has_model` WHERE `id` = '" . $product["brand_has_model_id"] . "')");
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $brand_data["name"]; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                            </div>

                                            <div class="col-12">
                                                <select class="form-select text-center" disabled>

                                                    <?php

                                                    $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN
                                                    (SELECT `model_id` FROM `brand_has_model` WHERE `model_id` = '" . $product["brand_has_model_id"] . "')");

                                                    $model_data = $model_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $model_data["name"]; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                        <div class="row">

                                            <div class="col-12 text-center">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Add a Title to your Product
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" class="form-control text-center" id="t" placeholder="Enter product title here..." value="<?php echo $product["title"] ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="row">

                                            <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                    </div>
                                                    <div class="col-12">

                                                        <select class="form-select text-center" disabled>

                                                            <?php

                                                            $clr_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $product["color_id"] . "'");
                                                            $clr_data = $clr_rs->fetch_assoc();

                                                            ?>

                                                            <option><?php echo $clr_data["color"]; ?></option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" disabled />
                                                            <label class="form-check-label">Silver</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" disabled />
                                                            <label class="form-check-label">Graphite</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mt-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Add new Colour" disabled />
                                                        <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>+ Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4 offset-lg-4 p-3 ">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                </div>
                                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                    <div class="input-group mt-2 mb-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" value="<?php echo $product["price"]; ?>" placeholder="Your price..." disabled />
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                        <div class="col-2 pm pm2"></div>
                                                        <div class="col-2 pm pm3"></div>
                                                        <div class="col-2 pm pm4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Delivery Costs for Country Wide</label>
                                        </div>

                                        <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                            <div class="input-group mb-2 mt-2">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" value="<?php echo $product["delivery_fee_countrywide"]; ?>" placeholder="Delivery Cost..." id="dccw" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2 p-3 ">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="30" rows="15" class="form-control" id="d" placeholder="Enter description about your product....">
                                                <?php echo $product["description"]; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Add Product Image</label>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6">

                                            <?php

                                            $img = array();
                                            $img[0] = "resources/addproductimg.svg";
                                            $img[1] = "resources/addproductimg.svg";
                                            $img[2] = "resources/addproductimg.svg";

                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $product["id"] . "'");
                                            $images_num = $images_rs->num_rows;

                                            for ($x = 0; $x < $images_num; $x++) {
                                                $images_data = $images_rs->fetch_assoc();
                                                $img[$x] = $images_data["code"];
                                            }

                                            ?>
                                            
                                            <div class="row">
                                                <div class="col-4 ">
                                                    <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" id="i0" />
                                                </div>
                                                <div class="col-4">
                                                    <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" id="i1" />
                                                </div>
                                                <div class="col-4">
                                                    <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" id="i2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-success" />
                                </div>

                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php

                } else {
                ?>
                    <script>
                        alert("Please select a product to Update.");
                        window.location = "myProducts.php";
                    </script>
                <?php
                }
            } else {

                ?>
                <script>
                    alert("You have to sign in for access this feature.");
                    window.location = "home.php";
                </script>
            <?php

            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>