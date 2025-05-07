<?php

require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | BuyNow</title>
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

            ?>

                <div class="col-12">
                    <div class="row justify-content-center align-items-center">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-11 my-1 col-lg-2 border-0 border-end border-1 border-dark">
                                    <div class="row">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item fw-bold"><a href="myProducts.php">My Products</a></li>
                                                <li class="breadcrumb-item text-black active fw-bold" aria-current="page">Add Products</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mb-5">
                            <h2 class="h2 text-success fw-bold">Add New Product</h2>
                        </div>

                        <div class="col-12 p-3 border-start border-1 border-end ">
                            <div class="row">

                                <div class="col-12 col-lg-8 offset-lg-2 p-3 ">
                                    <div class="row">

                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                        </div>

                                        <div class="col-12 col-lg-8 offset-lg-4 p-3">
                                            <div class="form-check form-check-inline mx-5">
                                                <input class="form-check-input" type="radio" id="b" name="c" checked />
                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="u" name="c" />
                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                    <div class="row">

                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold " style="font-size: 20px;">Select Product Category</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="category" onchange="load_brand();">
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
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8 offset-lg-2 p-3 border-start border-1 border-end">
                                    <div class="row">

                                        <div class="col-12 text-center">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($y = 0; $y < $brand_num; $y++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>
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
                                            <select class="form-select text-center" id="model">
                                                <option value="0">Select Model</option>

                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($z = 0; $z < $model_num; $z++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
                                                <?php
                                                }

                                                ?>

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
                                            <input type="text" class="form-control" placeholder="Enter product title here..." id="title" />
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

                                                    <select class="form-select" id="clr">
                                                        <option value="0">Select Colour</option>

                                                        <?php

                                                        $clr_rs = Database::search("SELECT * FROM `color`");
                                                        $clr_num = $clr_rs->num_rows;

                                                        for ($a = 0; $a < $clr_num; $a++) {
                                                            $clr_data = $clr_rs->fetch_assoc();

                                                        ?>

                                                            <option value="<?php echo $clr_data["id"]; ?>"><?php echo $clr_data["color"]; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="clr2" />
                                                        <label class="form-check-label" for="clr2">Silver</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="clr3" />
                                                        <label class="form-check-label" for="clr3">Graphite</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in" />
                                                    <button class="btn btn-outline-primary" type="button" id="button-addon2">+ Add</button>
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
                                                <input type="number" class="form-control" value="0" min="0" id="qty" />
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
                                                    <input type="text" class="form-control" placeholder="Your price..." id="cost" />
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
                                        <label class="form-label fw-bold" style="font-size: 20px;">Delivary Costs for Country Wide</label>
                                    </div>

                                    <div class="col-12 col-lg-8 offset-lg-2 p-3">
                                        <div class="input-group mb-2 mt-2">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" placeholder="Delivery Cost..." id="dcw" />
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
                                        <textarea cols="30" rows="15" class="form-control" placeholder="Enter description about your product...." id="desc"></textarea>
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
                                        <div class="row">
                                            <div class="col-4 ">
                                                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i0" />
                                            </div>
                                            <div class="col-4">
                                                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i1" />
                                            </div>
                                            <div class="col-4">
                                                <img src="resources/addproductimg.svg" class="img-fluid" style="width: 250px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                        <input type="file" class="d-none" id="imageuploader" multiple />
                                        <label for="imageuploader" class="col-12 btn btn-primary" onclick="addProductImage();">Upload Images</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-success" />
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                                <label class="form-label">
                                    tax+ and service charge included.
                                </label>
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                            </div>

                        </div>

                    </div>

                </div>

            <?php

            } else {
                header("Location:home.php");
            }

            ?>

            <?php include "footer.php"; ?>
        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>