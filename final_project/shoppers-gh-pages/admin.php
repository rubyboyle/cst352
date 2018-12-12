<?php
//  session_start();
//  include 'inc/dbConnection.php';
//   $dbConn = startConnection("final_project");
 include 'functions.php';
//  validateSession();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Autumn Ecommerce Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
            <style>
            form {
                display: inline-block;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
        
        <script>
        
            function confirmDelete() {
                
                //alert();
                //prompt();
                return confirm("Are you sure you want to delete this product?");
                
            }
            
            function openModal() {
                
                $('#myModal').modal("show");
            }
            
        </script>
    
  </head>
  <body>
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <!--<form action="" class="site-block-top-search">-->
              <!--  <span class="icon icon-search2"></span>-->
              <!--  <input type="text" class="form-control border-0" placeholder="Search">-->
              <!--</form>-->
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">Autumnal</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li><a href="adminIndex.php"><span class="icon icon-person"></span></a></li> 
                  <li>
                    <!--<a href="cart.html" class="site-cart">-->
                    <!--  <span class="icon icon-shopping_cart"></span>-->
                    <!--  <span class="count">2</span>-->
                    <!--</a>-->
                  </li> 
                  <!--<li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>-->
                </ul>
              </div> 
            </div>

          </div>
        </div>
      </div> 
        <nav class="site-navigation text-right text-md-left" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="index.php">Home</a></li>
            <li><a href="search.php">Search</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <body>
        
        <h1 style="text-align: center;"> Administrator of Autumnal</h1>
        
         <h3 style="text-align: center;">Welcome <?= $_SESSION['adminFullName'] ?> </h3>

          <form action="addProduct.php">
              <input type="submit" value="Add New Product" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;">
          </form>
          <form action="db_reports.php">
              <input type="submit" value="Generate Reports" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;">
          </form>
         <form action="logout.php">
              <input type="submit" value="Logout" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;">
          </form>

           <br><br>
        
        <?= displayAllProducts() ?>
        
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Product Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe name="productModal" width="450" height="250"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
    </body>
</html>