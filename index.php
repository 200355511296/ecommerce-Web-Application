<?php
include "connection.php";
?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GLEE</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="favicon.ico" />

</head>

<body class="main-body">

    <div class="container-fluid  ">

        <div class="row ">

            <!-- logo -->
            <div class="col-12 col-lg-3  ">

                <div class="row">
                    <div class="col-12 logo "></div>
                    <div class="col-12">
                        <p class="text-center title">Hi, Welcome to Glee</p>
                    </div>
                </div>
            </div>
            <!-- logo -->



            <!-- content -->

            <div class="col-12 p-3">
                <div class="row">

                    <div class="col-6 d-none d-lg-block pic"></div>

                    <!-- signupbox -->

                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-4">

                            <div class="col-12">
                                <p class="letter1">Create New Account</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv">

                                <div class="alert alert-danger" role="alert" id="msg">

                                </div>

                            </div>

                            <div class="col-12">
                                
                                <label class="form-label h5" for="fname">First Name</label>
                                <input type="text" class="form-control" placeholder="ex:- Mike" id="fname" />
                            </div>

                            <div class="col-12">
                                <label class="form-label h5" for="lname">Last Name</label>
                                <input type="text" class="form-control" placeholder="ex:- Lewis" id="lname" />
                            </div>

                            <div class="col-12">
                                <label class="form-label h5" for="email">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- mike@gmail.com" id="email" />
                            </div>

                            <div class="col-12">
                                <label class="form-label h5" for="password">Password</label>
                                <input type="password" class="form-control" placeholder="ex:- **********" id="password" />
                            </div>

                            <div class="col-6">
                                <label class="form-label h5" for="mobile">Mobile</label>
                                <input type="text" class="form-control" placeholder="ex:- 0743562208" id="mobile" />
                            </div>



                         


                            <div class="col-6">
                                <label class="form-label h5">Gender</label>
                                <div class="row">
                                    <div class="form-check form-check-inline col-4">
                                        <input class="form-check-input" type="radio" name="s" id="m"  />
                                        <label class="form-check-label" for="m">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline col-4">
                                    <input class="form-check-input" type="radio" name="s" id="f" />

                                        <label class="form-check-label" for="f">Female</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class=" btnSub  " onclick="signUp();">
                                    <p class="h5">Sign Up</p>
                                </button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-light btnMain " onclick="changeView();">
                                    <p class="h5">Already have an account?</p>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- signupbox -->



                    <!-- signinbox -->

                    <div class="col-12 col-lg-6 d-none" id="signInBox">

                        <div class="row g-4">

                            <div class="col-12">
                                <p class="letter1">Sign In</p>
                            </div>

                            <div class="col-12 d-none" id="msgdiv1">

                                <div class="alert alert-danger" role="alert" id="msg1">

                                </div>
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
                                <label class="form-label h5">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label h5">Password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme" />
                                    <label class="form-check-label h5">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-dark h5 fogetPw" onclick=" forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btnSub" onclick="signIn();">
                                    <p class="h5">Sign In</p>
                                </button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-light btnMain " onclick="changeView();">
                                    <p class="h5">New to Glee? Join Now</p>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- signinbox -->

                </div>
            </div>

            <!-- content -->

            <!--moal-->
            <div class="modal" tabindex="-1" id="fpModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class=" row g-3">

                                <div class=" col-6">
                                    <label class=" form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np">
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();">Show</button>
                                    </div>
                                </div>

                                <div class=" col-6">
                                    <label class=" form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp">
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>


                                <div class=" col-12">
                                    <label class=" form-label">Verification Code</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="vcode">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btnMain" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--moal-->

            <div style="height: 100px;">

            </div>

            <!-- footer -->
            <div class="col-12  d-none d-lg-block">
                <p class="text-center">&copy; 2022 Glee.lk || All Rights Reserved</p>
            </div>
            <!-- footer -->

        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>