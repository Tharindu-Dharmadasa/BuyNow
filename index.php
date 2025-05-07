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

    <body class="main-body">

        <div class="container-fluid vh-100 d-flex justify-content-center">
            <div class="row align-content-center">

                <!-- header -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 logo"></div>
                        <div class="col-12">
                            <p class="text-center title1 ">Welcome to BuyNow Online Store.</p>
                        </div>
                    </div>
                </div>
                <!-- header -->

                <!-- content -->
                <div class="col-12 p-5 ">
                    <div class="row">

                        <div class="col-4 offset-4 d-grid d-flex justify-content-center ">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Let's Start Shopping
                            </button>

                            <!-- Modal -->
                            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="modal-fade-transform: scale(.8)." aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">

                                        <div class="modal-body text-center ">
                                            <button class="btn btn-success " type="button" onclick="signingbtn();">Register as new user or Sign In to your account</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- content -->

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