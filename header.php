<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="col-12 footer">

        <div class="row ">

            <div class=" col-9 col-lg-3  align-self-start mt-2">

                <?php
                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];
                ?>
                    <span class="text-lg-start text-ligh"><b class=" text-light px-2">Hi,</b><b class=" text-light ml-3"><?php echo $data["fname"]; ?></b></span>
                    <span class="text-lg-start fw-bold signout text-light px-2" onclick="signout();">| Signout |</span>
                <?php

                } else {

                ?>
                    <a href="index.php" class="text-decoration-none fw-bold text-danger">Sign In or Register <b class=" text-light">|</b></a>
                <?php
                }

                ?>

                <span class="text-lg-start fw-bold text-decoration-none text-warning"> Help and Contact</span>



            </div>

            <div class="col-3 col-lg-3 offset-lg-6">

                <div class="p-2 list-inline-item  row">

                    <div class=" col-3 offset-lg-6 align-items-end">

                        <a href="home.php" class="form-floating text-white ">
                            <i class="bi bi-shop-window" style="font-size: 20px; margin-left:50px ;"></i>
                        </a>

                    </div>

                    <div class=" col-3 align-items-start d-none d-xl-block d-xxl-none">
                        <p class=" text-light d-none d-sm-block d-md-block" style="font-size: 10px; margin-top:10px">Back to shop</p>

                    </div>



                </div>

            </div>

        </div>

        <div class="col-12 col-lg-9 offset-lg-3 align-self-end" style="text-align: center;">

            <div class="row">



                <!--<div class="col-12 col-lg-6 dropdown">
                        <button class="btn btn-outline-warning dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            I WANT TO GO
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                            <li><a class="dropdown-item" href="addProduct.php">My Products</a></li>
                            <li><a class="dropdown-item" href="#">Watchlist</a></li>
                            <li><a class="dropdown-item" href="#">Purchase History</a></li>
                            <li><a class="dropdown-item" href="#">Messages</a></li>
                            <li><a class="dropdown-item" href="#">Contact Admin</a></li>
                        </ul>
                </div>-->

                <div class="col-12 col-lg-10  mx-auto ">

                    <div class="text-sm-center text-md-start">

                        <div class="list-unstyled list-list-unstyled list-inline">

                            <div class="grid gap-5">



                                <div class="p-2 list-inline-item text-center">
                                    <a href="userProfile.php" class="form-floating text-white ">
                                        <i class="bi bi-person-circle" style="font-size: 30px;"></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block">My Profile</p>

                                </div>
                                
                                <div class="p-2 list-inline-item text-center">
                                    <a href="cart.php" class="form-floating text-white ">
                                        <i class=" bi-cart4" style="font-size: 30px;"></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block">Cart</p>

                                </div>

                                <div class="p-2 list-inline-item text-center">
                                    <a href="watchlist.php" class="form-floating text-white ">
                                        <i class="bi bi-clock-history" style="font-size: 30px;"></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block">Watchlist</p>

                                </div>

                                <div class="p-2 list-inline-item text-center">
                                    <a href="purchasingHistory.php" class="form-floating text-white ">
                                        <i class="bi bi-hourglass-split" style="font-size: 30px;"></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block">Purchase History</p>

                                </div>

                                <div class="p-2 list-inline-item text-center">
                                    <a href="messages.php" class="form-floating text-white ">
                                        <i class="bi bi-chat-square-text-fill" style="font-size: 30px;"></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block">Messages</p>

                                </div>

                                <div class="p-2 list-inline-item text-center " onclick="adminSignUp();">
                                    <a class="form-floating text-white ">
                                        <i class="bi bi-person-lines-fill" style="font-size: 30px; cursor: pointer;" ></i>
                                    </a>
                                    <p class=" text-light d-none d-sm-block d-md-block"> Admin loging</p>

                                </div>
                                
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></div>

                <!-- msg modal -->
                <div class="modal" tabindex="-1" id="contactAdmin">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Contact Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body overflow-scroll">
                                <!-- received -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-8 rounded bg-success">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-11-9 00:00:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- received -->
                                <!-- sent -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="offset-4 col-8 rounded bg-primary">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4">Hello there!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-11-9 00:00:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sent -->
                            </div>
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="msgtxt" />
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->

            </div>
        </div>


    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="script.js"></script>
</body>

</html>