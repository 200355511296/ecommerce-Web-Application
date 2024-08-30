<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin SignUp | Glee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);"  class="  min-vh-100" >

    <div class="container-fluid " >

        <!-- logo -->


        <div class="row">
            <div class="col-12 logo"></div>
            <div class="col-12">
                <p class=" text-center title">Hi, Welcome to eShop Admins.</p>
            </div>
        </div>

        <!-- logo -->


        <div class="row ">

            <div class="col-12 p-5 ">

                <div class="row">                    

                    <div class="col-12 col-lg-6 offset-lg-3 d-block">

                        <div class="row g-3 shadow p-5 bg-trnsparent">
                            <div class="col-12">
                                <p class="title02 h2">Sign In to your Account.</p>
                            </div>
                            <div class="col-12 mt-4 mb-4">
                                <label class="form-label fw-bold h5">Email</label>
                                <input type="email" class="form-control" placeholder="ex : john@gmail.com" id="e" />
                            </div>
                            <div class="col-6 col-lg-6 d-grid mt-4 mb-4 ">
                                <button class="btnSub" onclick="adminVerification();">Send Verification Code</button>
                            </div>
                            <div class="col-6 col-lg-6 d-grid mt-4 mb-4 ">
                                <button class="btnMain" onclick="window.location='home.php'">Back </button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>

            </div>

            <!--  -->

            <div class="col-12 fixed-bottom text-center">
                <p>&copy; 2022 eShop.lk | All Rights Reserved</p>
            </div>

        </div>

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>

</html>