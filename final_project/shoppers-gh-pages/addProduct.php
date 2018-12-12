<?php
// session_start();

// include 'inc/dbConnection.php';
// $dbConn = startConnection("final_project");
include 'functions.php';
// validateSession();

if (isset($_GET['addProduct'])) { //checks whether the form was submitted
        global $dbConn;
        $productName = $_GET['productName'];
        $description = $_GET['description'];
        $price =  $_GET['price'];
        $catId =  $_GET['catId'];
        $productImage = $_GET['productImage'];
        $productBrand = $_GET['productBrand'];
    
    
    $sql = "INSERT INTO proj_products (title, director, actors, image, year, genreId) 
            VALUES (:title, :director, :actors, :image, :year, :genreId);";
            
    $np = array();
        $np[":title"] = $productName;
        $np[":actors"] = $description;
        $np[":year"] = $price;
        $np[":genreId"] = $catId;
        $np[":image"] = $productImage;
        $np[":director"] = $productBrand;
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    echo "New Product was added!";
    
}

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
        
        <h1 style="text-align:center;"> Adding New Product </h1>
        
        <form style="text-align:center;">
           Product name: <input type="text" name="productName"><br>
           Brand: <input type="text" name="productBrand"><br>
           Description: <textarea name="description" cols="50" rows="4"></textarea><br>
           Price: <input type="text" name="price"><br>
           Category: 
           <select name="catId">
              <option value="">Select One</option>
              <?php
              
              $categories = getCategories();
              
              foreach ($categories as $category) {
                  
                  echo "<option value='".$category['genreId']."'>" . $category['genreId'] . "</option>";
                  
              }
              
              ?>
           </select> <br />
           Set Image Url: <input type="text" name="productImage"><br>
           <input type="hidden" name="addProduct" value="<?php echo $_GET['addProduct']?>"> 
           <input type="submit" name="addProduct" value="Add Product">
        </form>

    </body>
</html>