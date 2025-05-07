<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | BuyNow</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bpptstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="icon" href="resources/logo.png" />

</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <?php

            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_image` ON
            user.email = profile_image.user_email INNER JOIN `user_has_city` ON
            user.email = user_has_city.user_email INNER JOIN `city` ON
            user_has_city.city_id = city.id INNER JOIN `district` ON
            city.district_id = district.id INNER JOIN `province` ON
            district.province_id = province.id INNER JOIN `gender` ON
            gender.id = user.gender_id WHERE `email`='" . $email . "'");

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
            gender.id = user.gender_id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_city` INNER JOIN `city` ON
            user_has_city.city_id INNER JOIN `district` ON
            city.district_id=district.id INNER JOIN `province` ON
            district.province_id=province.id WHERE `user_email`='" . $email . "'");

                $data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();


            ?>

                <div class="col-12 bg-danger p-4">
                    <div class="row">

                        <div class="col-11 col-lg-2 border-0 border-end border-1 border-dark">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item fw-bold"><a href="home.php">Home</a></li>
                                    <li class="breadcrumb-item text-black active fw-bold" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="col-12 bg-body rounded rounded-5 mt-4 mb-4 ">
                            <div class="row g-2 mt-2 mb-2">


                                <div class="col-md-3 col-lg-9 border-end">
                                    <div class="d-flex flex-column align-items-center text-center text-center p-3 py-5" id="displayProfile">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>


                                        <?php

                                        if (empty($image_data["img_path"])) {

                                        ?>

                                            <img src="resources/new_user.svg" class="rounded-circle mt-4 " style="width: 150px;" id="viewImg" />

                                        <?php

                                        } else {

                                        ?>

                                            <img src="<?php echo $image_data["img_path"]; ?>" class="rounded mt-4 " style="width: 150px;" id="viewImg" />
                                        <?php

                                        }

                                        ?>

                                        <span class="fw-bold"><?php echo $data["fname"]." ".$data["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $data["email"]; ?></span>

                                        <input type="file" class="d-none" id="profileimg" accept="image/*" />
                                        <label for="profileimg" class="btn btn-primary mt-4" onclick="changeImage();">Update Profile Image</label>

                                        &nbsp;

                                        <div class="row mt-4">

                                            <div class="col-6 p-2">
                                                <label class="form-label fw-bolder">First Name</label>
                                                <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label fw-bolder">Last Name</label>
                                                <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname" />
                                            </div>

                                            &nbsp;

                                            <div class="col-10 offset-1 p-2">
                                                <label class="form-label fw-bolder">Mobile</label>
                                                <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                                            </div>

                                            &nbsp;

                                            <div class="col-10 offset-1 p-2">
                                                <label class="form-label fw-bolder">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $data["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            &nbsp;

                                            <div class="col-10 offset-1 p-2">
                                                <label class="form-label fw-bolder">Email</label>
                                                <input type="email" class="form-control" value="<?php echo $data["email"]; ?>" readonly id="email" />
                                            </div>

                                            &nbsp;

                                            <div class="col-10 offset-1 p-2">
                                                <label class="form-label fw-bolder">Registered Date</label>
                                                <input type="date_time_set" class="form-control" value="<?php echo $data["registered_date"]; ?>" readonly />
                                            </div>

                                            &nbsp;

                                            <?php

                                            if (!empty($address_data["line1"])) {

                                            ?>

                                                <div class="col-10 offset-1 p-2">
                                                    <label class="form-label fw-bolder">Address Line 01</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" id="line1" />
                                                </div>

                                                &nbsp;

                                            <?php

                                            } else {

                                            ?>

                                                <div class="col-10 offset-1 p-2">
                                                    <label class="form-label fw-bolder">Address Line 1</label>
                                                    <input type="text" class="form-control " id="line1" />
                                                </div>

                                                &nbsp;

                                            <?php

                                            }

                                            if (!empty($address_data["line2"])) {

                                            ?>
                                                <div class="col-10 offset-1 p-2">
                                                    <label class="form-label fw-bolder">Address Line 2</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" id="line2" />
                                                </div>

                                                &nbsp;
                                            <?php

                                            } else {
                                            ?>
                                                <div class="col-10 offset-1 p-2">
                                                    <label class="form-label fw-bolder">Address Line 2</label>
                                                    <input type="text" class="form-control" id="line2" />
                                                </div>

                                                &nbsp;
                                            <?php

                                            }

                                            ?>



                                            <?php

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>

                                            </br>

                                            <div class="col-6 p-2">
                                                <label class="form-label fw-bolder">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();

                                                    ?>
                                                        // <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                                if (!empty($address_data["province_id"])) {

                                                                                                                    if ($province_data["id"] == $address_data["province_id"]) {

                                                                                                                ?>selected<?php
                                                                                                                    }
                                                                                                                }

                                                                                                                        ?>><?php echo $province_data["name"]; ?></option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6 p-2">
                                                <label class="form-label fw-bolder">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                                if (!empty($address_data["district_id"])) {

                                                                                                                    if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                ?>selected<?php
                                                                                                                        }
                                                                                                                    }

                                                                                                                            ?>><?php echo $district_data["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6 p-2">
                                                <label class="form-label fw-bolder">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $city_rs = Database::search("SELECT * FROM `city`");
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();

                                                    ?>
                                                    <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                            if (!empty($address_data["city_id"])) {

                                                                                                                if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                            ?>selected<?php
                                                                                                                    }
                                                                                                                }

                                                                                                                        ?>><?php echo $city_data["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>

                                            <?php

                                            if(!empty($data["postal code"])){
                                            ?>

                                            <div class="col-6 p-2">
                                                <label class="form-label fw-bolder">Postal-Code</label>
                                                <input type="text" class="form-control" value="<?php echo $data["postal_code"]; ?>" id="pcode" />
                                            </div>

                                            &nbsp;

                                            <?php

                                            }else{

                                            ?>

                                            <div class="col-6">
                                            <label class="form-label fw-bolder">Postal-Code</label>
                                            <input type="text" class="form-control" id="pcode" />
                                        </div>

                                            <?php
                                            }
                                            ?>

                                            <div class="col-6 offset-3 p-2">
                                                <label class="form-label fw-bolder">Gender</label>
                                                <input type="text" class="form-control text-center" readonly value="<?php echo $data["gender_name"]; ?>" />
                                            </div>

                                            &nbsp;

                                            <div class="col-8 offset-2 d-grid mt-3 mb-3 p-3">
                                                <button class="btn btn-outline-primary" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                            &nbsp;

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-3 text-center border-start">
                                    <div class="row">
                                        <span class="mt-5 fw-bold text-black-50">Display ads</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {
                header("Location:http://localhost/buynow/home.php");
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>