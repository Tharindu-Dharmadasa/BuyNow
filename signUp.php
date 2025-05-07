<?php

require "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resources/logo.png" />
</head>

<body style="height: 100%;" class="main-body">

    <div class="container-fluid vh-100 d-flex justify-content-center ">
        <div class="row align-content-center ">

            <div class="col-12">
                <div class="row">
                    <div class="logo"></div>
                </div>
            </div>


            <!-- content -->

            <div class="col-8 offset-2 p-5 border border-3 shadow rounded rounded-5 border-black mb-5" style="background-color: white;">
                <div class="row">

                    <div class="col-8 offset-2" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12 offset-4">
                                <p class="title2">Create New Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg">

                                    </i>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="font-weight: bold;">First Name</label>
                                <input type="text" class="form-control " placeholder="Enter your first name..." id="f" />
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="font-weight: bold;">Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter your last name..." id="l" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-weight: bold;">Email</label>
                                <input type="email" class="form-control" placeholder="Enter your email..." id="e" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-weight: bold;">Password</label>
                                <input type="password" class="form-control" placeholder="Enter your password..." id="p" />
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="font-weight: bold;">Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter your mobile number..." id="m" />
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="font-weight: bold;">Gender</label>
                                <select class="form-select" id="g">
                                    <option value="0">Select Gender</option>
                                    <?php

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-3 d-grid">
                                <button class="btn btn-outline-success" onclick="signUp(); ">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-3 d-grid">
                                <button class="btn btn-outline-dark" onclick="changeView();">Already have an account? Sign In</button>
                            </div>
                        </div>
                    </d iv>
                                    
                    <div class="col-8 offset-2 d-none" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2">Sign In</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label class="form-label" style="font-weight: bold;">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Your email..." value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" style="font-weight: bold;">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Your password..." value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-outline-warning" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid">
                                <button class="btn btn-outline-danger" onclick="changeView();">New user? Join Now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- content -->

            <!-- modal -->

            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npw" />
                                        <button class="btn btn-outline-secondary" type="button" id="npwb" onclick="showPassword();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnpw" />
                                        <button class="btn btn-outline-secondary" type="button" id="rnpwb" onclick="showPassword2();"><i id="e1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->

            <!-- footer -->

            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2023 BuyNow.lk || All Rights Reserved</p>
            </div>

            <!-- footer -->

        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>