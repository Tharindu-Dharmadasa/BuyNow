<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | BuyNow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body class="mt-2" style="background-color: #f3ca5c;">

    <div class="container-fluid">
        <div class="row">

            <?php

            include "header.php";

            require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i>print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-filetype-pdf"></i>Export as PDF</button>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-primary text-decoration-underline text-center">
                                    <h1 class="fw-bold text-primary text-bg-warning">BuyNow Invoice</h2>
                                </div>
                                &nbsp;
                                <div class="col-12 fw-bold text-start mx-2">
                                    <span class="fs-5"><i class="bi bi-house-fill"></i> Temple Road, Nuwara Eliya, Sri Lanka</span><br />
                                    <span class="fs-5"><i class="bi bi-telephone-fill"></i> +94112 5461123</span><br />
                                    <span class="fs-5"><i class="bi bi-at"></i> BuyNow@gmail.com</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_city` WHERE `user_email`='" . $umail . "'");
                                    $address_data = $address_rs->fetch_assoc();
                                    ?>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>
                                <?php
                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>
                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE 0<?php echo $invoice_data["payment_id"]; ?></h1>
                                    <span class="fw-bold">Date & Time of Invoice : </span><br />
                                    <span><?php echo $invoice_data["date"]; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">

                                <thead>
                                    <tr class="border border-1 border-secondary">
                                        <th class="bg-primary">#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;">
                                        <td class="bg-primary text-white fs-3"><?php echo $invoice_data["payment_id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-primary text-decoration-underline p-2"><?php echo $oid; ?></span><br />
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $invoice_data["products_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $price = $product_data["price"];
                                            $qty = $invoice_data["qty"];
                                            $new_price = $price * $qty;

                                            ?>
                                            <span class="fw-bold text-primary fs-4 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-bold fs-5 text-end p-4 bg-secondary text-white">Rs. <?php echo $product_data["price"]; ?>.00</td>
                                        <td class="fw-bold fs-5 text-end bg-light p-4"><?php echo $invoice_data["qty"]; ?></td>
                                        <td class="fw-bold fs-5 text-end pt-4 bg-secondary text-white">Rs. <?php echo $new_price; ?>.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;

                                    $delivery = $product_data["delivery_fee_countrywide"];

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;

                                    ?>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold">SUBTOTAL</td>
                                        <td class="text-end">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary">Delivery fee</td>
                                        <td class="text-end border-primary">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-end fw-bold border-primary text-primary">GRAND TOTAL</td>
                                        <td class="text-end border-primary text-primary">Rs. <?php echo $t; ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px;">
                            <span class="fs-1 fw-bold text-success">Thank You !</span>
                            <br/>
                            &nbsp;
                            <a class="fw-bold fs-5" href="home.php">Would You Like Purchase Something Else?</a>

                        </div>


                        <div class="col-12 border-start  border-5 border-danger mt-3 mb-3 rounded" style="background-color: #e7f2ff;">
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fw-bold fs-5">NOTICE : </label><br />
                                    <label class="form-label fs-6">Purchased items can return before 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and its valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
                </div>

            <?php
            }

            ?>


            <?php include "footer.php"; ?>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>