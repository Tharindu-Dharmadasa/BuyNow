<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchasing History | BuyNow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body style="background-color: #ff1d58;background-image: linear-gradient(80deg,#ff1d58 0%,#fff685 100%);">

    <div class="container-fluid vh-100">
        <div class="row">
            <?php include "header.php";
            require "connection.php";

            if (isset($_SESSION["u"])) {
                $umail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "'");
                $invoice_num = $invoice_rs->num_rows;

            ?>

                <div class="col-11 my-1 col-lg-2">
                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item fw-bold"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item text-black active fw-bold" aria-current="page">Purchased History</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="col-12 text-center mb-3">
                    <span class="fs-1 text-Dark fw-bold">Purchased History</span>
                </div>

                <?php
                if ($invoice_num == 0) {
                ?>

                    <div class="col-12 bg-body text-center" style="height: 450px;">
                        <span class="fs-1 fw-bolder text-black-50 d-block" style="margin-top: 200px;">
                            You have not Purchased any product yet...
                        </span>
                    </div>

                <?php
                } else {
                ?>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-1 text-center bg-dark">
                                        <label class="form-label text-white fw-bold">#</label>
                                    </div>
                                    <div class="col-3 text-center bg-light">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 text-center bg-dark">
                                        <label class="form-label text-white fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 text-center bg-light">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 text-center bg-dark">
                                        <label class="form-label text-white fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-3 bg-light"></div>

                                </div>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <?php
                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-1 bg-dark text-center text-lg-start">
                                            <label class="form-label text-white fs-5 py-5">0000<?php echo $invoice_data["payment_id"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card mx-0 mx-lg-3 my-3" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">

                                                        <?php

                                                        $pid = $invoice_data["products_id"];
                                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id` = '" . $pid . "'");
                                                        $image_data = $image_rs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">

                                                            <?php
                                                            $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $pid . "' ");
                                                            $product_data = $product_rs->fetch_assoc();

                                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "' ");
                                                            $seller_data = $seller_rs->fetch_assoc();
                                                            ?>

                                                            <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                            <p class="card-text"><b>Seller : </b><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                                                            <p class="card-text"><b>Price : </b>Rs. <?php echo $product_data["price"]; ?> .00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 bg-dark text-center text-lg-end">
                                            <label class="form-label text-white fs-5 py-5 px-5"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 bg-white text-center text-lg-start">
                                            <label class="form-label text-black fs-5 py-5 px-5">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                                        </div>
                                        <div class="col-12 col-lg-2 bg-dark text-center text-lg-end">
                                            <label class="form-label text-white fs-5 px-4 py-5"><?php echo $invoice_data["date"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-secondary border border-1 fs-5 rounded mt-5 border-primary" onclick="addFeedback(<?php echo $invoice_data['products_id']; ?>);">
                                                        <i class="bi bi-info-circle-fill"></i>Feedback
                                                    </button>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger fs-5 rounded mt-5" onclick="deteleHistory(<?php echo $invoice_data['products_id']; ?>);">
                                                        <i class="bi bi-trash3-fill"></i>Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="offset-lg-10 col-12 col-lg-2 d-grid">
                                        <button class="btn btn-danger rounded mt-5 fs-5">
                                            <i class="bi bi-trash3-fill"></i> Delete All Records
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $fd_type_rs = Database::search("SELECT * FROM `feedback_types`");
                            $fd_type_num = $fd_type_rs->num_rows;

                            $fd_type = $fd_type_rs->fetch_assoc();

                            ?>
                            <!-- modal -->
                            <div class="modal" tabindex="-1" id="feedbackModal<?php echo $invoice_data['products_id']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-black">
                                        <div class="modal-header bg-white">
                                            <h5 class="modal-title">Add New Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label text-white fw-bold">Type</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="type" id="type1" />
                                                                    <label class="form-check-label text-success fw-bold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="type" id="type2" checked />
                                                                    <label class="form-check-label text-warning fw-bold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" name="type" id="type3" />
                                                                    <label class="form-check-label text-danger fw-bold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold text-white ">User's email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" value="<?php echo $umail; ?>" id="mail" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold text-white">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea cols="50" rows="8" class="form-control" id="feed"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-white">
                                            <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-success fw-bold" onclick="saveFeedback(<?php echo $pid; ?>);">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->

                            <!-- modal 2 -->
                            <div class="modal" tabindex="-1" id="deleteHistory<?php echo $invoice_data['products_id']; ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <div class="modal-header bg-white">
                                            <h5 class="modal-title">Do you want to delete purchased history?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">Cancel</button>
                                                        
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-outline-danger fw-bold" onclick="conformDelete(<?php echo $pid; ?>);">Delete</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal 2 -->

                            </div>
                        </div>

                <?php
                }
            }
                ?>

                <?php include "footer.php"; ?>
                    </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>