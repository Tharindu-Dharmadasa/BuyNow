<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel | BuyNow</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resources/logo.png" />
    </head>

    <body style="background-color: #FF3632;">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="row">
                        <div class="col-6 offset-3">
                            <div class="row g-1">

                                <div id="mySidenav" class="sidenav">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                    <div class="col-6 offset-3">
                                        <div class="row">

                                            <div class="col-12 mt-5">
                                                <h4 class="text-white fs-5"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                                                <hr class="border border-1 border-white" />
                                            </div>
                                            <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="horizontal">
                                                <nav class="nav flex-column">
                                                    <a class="nav-link text-center fs-5" aria-current="page" href="#">Dashboard</a>
                                                    <a class="nav-link fs-5" href="manageUsers.php">Manage Users</a>
                                                    <a class="nav-link fs-5" href="manageProducts.php">Manage Products</a>
                                                    <a class="nav-link fs-6 text-danger" href="home.php">Back to User Home Page</a>
                                                </nav>
                                            </div>
                                            <div class="col-12 mt-5">
                                                <hr class="border border-1 border-white" />
                                                <h4 class="text-white fw-bold fs-5">Selling History</h4>
                                                <hr class="border border-1 border-white" />
                                            </div>
                                            <div class="col-12 mt-3 d-grid">
                                                <a href="sellingHistory.php" class="btn btn-outline-primary mt-2 fw-bold fs-5" onclick="findSellings();">Click Here.</a>
                                                <hr class="border border-1 border-white" />
                                                <hr class="border border-1 border-white" />
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 bg-dark ">
                            <div class="row">
                                <div class="col-12 col-lg-4 offset-3 text-end my-3">
                                    <label class="form-label fs-5 fw-bold text-white">Total Active Time</label>
                                </div>
                                <div class="col-12 col-lg-5 text-end my-3">
                                    <?php

                                    $start_date = new DateTime("2022-09-27 00:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);

                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>
                                    <label class="form-label fs-5 fw-bold text-warning">
                                        <?php

                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="text-dark fw-bold mb-1 bg-dark p-2 mx-1">
                            <h2 class="fw-bold text-white">Dashboard <span class="fs-5 text-secondary">Control Panel</span></h2>
                            <div class="col-2 text-end ">
                                <div class="col-12 pt-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="adminPanel.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            &nbsp;
                            <!-- Use any element to open the sidenav -->
                            <span style="font-size:20px;cursor:pointer; color: white;" onclick="openNav()">&#9776;</span>

                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-3 px-3 py-2 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-dark text-white text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 px-1 fw-bold">Daily Earnings</span>
                                            <br />
                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $f = $f + $invoice_data["qty"]; //total qty

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate date from time
                                                $pdate = $splitDate[0]; //sold date

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                                $pyear = $splitMonth[0]; //year
                                                $pmonth = $splitMonth[1]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>
                                            <span class="fs-5 px-1">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 py-2 px-3 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-black text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold px-1">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5 px-1">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 px-3 py-2 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold px-1">Today Sellings</span>
                                            <br />
                                            <span class="fs-5 px-1"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 py-2 px-3 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 px-1 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5 px-1"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 px-3 py-2 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold px-1">Total Sellings</span>
                                            <br />
                                            <span class="fs-5 px-1"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-3 px-3 py-2 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-start rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 px-1 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5 px-1"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Item</label>
                                </div>
                                <?php

                                $freq_rs = Database::search("SELECT `products_id`,COUNT(`products_id`) AS `value_occurence` 
                                FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `products_id` ORDER BY 
                                `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;
                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `products` WHERE `id`='" . $freq_data["products_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `products_id`='" . $freq_data["products_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `products_id`='" . $freq_data["products_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="resources/images/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">-----</span><br />
                                        <span class="fs-6">--- items</span><br />
                                        <span class="fs-6">Rs. ----- .00</span>
                                    </div>
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <?php
                                if ($freq_num > 0) {

                                    $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE 
                                `user_email`='" . $product_data["user_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $profile_data["img_path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $user_data1["fname"] . " " . $user_data1["lname"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["mobile"]; ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="resources/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">----- -----</span><br />
                                        <span class="fs-6">-----</span><br />
                                        <span class="fs-6">----------</span>
                                    </div>
                                <?php
                                }


                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are Not a valid user");
}

?>