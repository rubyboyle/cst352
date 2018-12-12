<?php
  // session_start();
    // include 'inc/dbConnection.php';
    include 'functions.php';
    // $dbConn = startConnection("final_project");
    
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if(isset($_POST['itemName'])) {
        //Storing the POST values into an array for later use
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['price'] = $_POST['itemPrice'];//year
        $newItem['brand'] = $_POST['itemBrand'];//director
        $newItem['size'] = $_POST['itemSize'];//actor
        $newItem['rating'] = $_POST['itemRating'];
        $newItem['image'] = $_POST['itemImage'];
        $newItem['id'] = $_POST['itemId'];
        
        //Checking to see if this is already in our cart
        //We use &$item to pass by reference
        foreach($_SESSION['cart'] as &$item) {
            if ($newItem['id'] == $item['id']) {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if ($found != true) {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }
?> 
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Autumn Ecommerce Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> -->
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="styles/styles.css" type="text/css" />
        
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
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
 
 <form style="text-align: center;">
   
            Search: <input type="text" name="movieName" placeholder="Search by product, brand, or description" style="width: 300px" />
            
            
            <br><br>
            Genre:
                <select name="genre">
                    <option value=""> Select one </option>
                    <?=displayGenres()?>
                </select>
            <br><br>
            Search By:
            <br>
            Price <input type="radio" name="searchBy" value="yearOrder">
            Name  <input type="radio" name="searchBy" value="nameOrder">
            Rating  <input type="radio" name="searchBy" value="ratingOrder">
            <br><br>
            Order By:
            <br>
            Ascending <input type="radio" name="orderBy" value="ac">
            Descending <input type="radio" name="orderBy" value="dc">
            <br><br>
            <input type="submit" name="searchForm" value="Search" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;"/>
        </form>
        <br>
        <hr>
        
        <?= filterMovies() ?>
        
        <br /><br />