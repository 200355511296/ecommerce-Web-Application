<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | glee</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body>


    <div class="container-fluid">

        <div class="row " style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

            <?php include "header.php"; ?>


            <div class="col-12  mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                            </div>
                            <div class="col-10 text-center">
                                <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Advanced Search</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-lg-2 col-12 col-lg-8 mb-3 bg-body rounded bg-transparent">
                <div class="row">

                    <div class="offset-lg-1 col-12 ">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                            </div>
                            
                            <div class="col-12 col-lg-10">
                                <hr class="border border-3 border-primary">
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12  mb-3">

                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            include "connection.php";

                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data["cat_id"]; ?>">
                                                    <?php echo $category_data["cat_name"]; ?>
                                                </option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>





                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>
                                            <?php
                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $condition_data["condition_id"]; ?>">
                                                    <?php echo $condition_data["condition_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $clr_rs = Database::search("SELECT * FROM `color`");
                                            $clr_num = $clr_rs->num_rows;

                                            for ($x = 0; $x < $clr_num; $x++) {
                                                $clr_data = $clr_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $clr_data["clr_id"]; ?>">
                                                    <?php echo $clr_data["clr_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    
                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-fs-3  ">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>

                                    <div class="col-12 col-lg-4 mt-2 mb-1 d-grid offset-lg-4">
                                <button class="btn btnsub fw-semibold " onclick="advancedSearch(0);" style="background-color: rgb(200, 112, 0);
                                color: black ;
                                padding: 5px;
                                border: #572305;                                
                                cursor: pointer;
                                border-radius: 10px;
                                transition:     background-color 0.3s ease ;
    
                                "
                                onmouseover=" this.style.backgroundColor=' rgba(249, 142, 3, 0.774)';"
                                
                                onmouseout="this.style.backgroundColor=' rgb(209, 112, 0)'; this.style.color=' color: rgb(0, 0, 0) ';"
                                >Search</button>
                            </div>
                                    

                                   

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
            <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3 bg-transparent">
                <div class="row">
                    <div class=" col-4 mt-2 mb-2">
                        <select id="s" class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark">
                            <option value="0" >SORT BY</option>
                            <option value="1">PRICE LOW TO HIGH</option>                           
                            <option value="2">PRICE HIGH TO LOW</option>
                            
                        </select>
                    </div>
   
                    <div class=" col-3 mt-2"  onclick="advancedSearch(0);" > 
                        <button class=" search p-2">
                        <i class="bi bi-search fw-bold"></i>

                        </button>


                    </div>
                    <div class=" col-3 mt-2 offset-2" onclick="location.reload();" > 
                        <button class=" search p-2">
                        <i class="bi bi-arrow-clockwise h4 "></i>

                        </button>


                    </div>
                </div>
            </div>

           
            </div>

           

            <div class="offset-lg-1 col-12 col-lg-10 bg-transparent mb-3" id="msgSearch">
                <div class="row">
                        <div class="row text-center" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-70"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-dark fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                </div>
            </div>

            <?php include "footer.php"; ?>


        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>