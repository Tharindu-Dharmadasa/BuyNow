<!DOCTYPE html>
<html>

<head>
    <title></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

</head>

<body>

    <div class="col-12" style="background-color: black;">
        <div class="row mt-1 mb-1">

            <div class="col-4 col-lg-1">
                <div class="row">
                    <nav class="navbar">
                        <div class="container">
                            <a class="navbar-brand" href="home.php">
                                <img src="resources/logo.png" width="100" height="50" />
                            </a>
                        </div>
                    </nav>

                </div>
            </div>

            <div class="col-4 col-lg-3 align-self-start mt-2">



                <?php

                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];


                ?>


                    <div class="col-12 ">
                        <div class="row">
                            <span class="text-lg-start text-white"><b>Welcome</b> <?php echo $data["fname"]; ?> </span> |
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <span class="text-lg-start fw-bold text-white" onclick="signout();">Sign Out</span>
                        </div>
                    </div>



                <?php

                } else {

                ?>

                    <a href="index.php">Sign In or Register</a> |

                <?php

                }

                ?>

            </div>

            <div class="offset-lg-4 col-4 col-lg-3 align-self-end mt-0">
                <div class="row">

                    <div class="col-4 col-lg-5 mb-5 dropdown">
                        <button class="btn btn-close-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            User Options
                        </button>
                        <ul class="dropdown-menu bg-black">

                            <li><a class="dropdown-item text-bg-warning" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item text-bg-warning" href="myProducts.php">My Products</a></li>
                            <li><a class="dropdown-item text-bg-warning" href="watchlist.php">Watchlist</a></li>
                            <li><a class="dropdown-item text-bg-warning" href="purchasedHistory.php">purchase History</a></li>
                            <li><a class="dropdown-item text-bg-warning" href="message.php">Message</a></li>
                        </ul>
                    </div>

                    <div class="col-1 col-lg-1 ms-5 ms-lg-0 mt-1 cart-icon" onclick="window.location='cart.php';"></div>

                    <div class="col-4 offset-1 col-lg-5 mb-5 dropdown">
                        <button class="btn btn-close-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Options
                        </button>
                        <ul class="dropdown-menu bg-black">
                            <li><a class="dropdown-item text-bg-warning" href="adminSignIn.php">Admin Sign In</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>