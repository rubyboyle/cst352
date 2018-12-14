<?php
    // session_start();
    
    // include 'inc/dbConnection.php';
    // $dbConn = startConnection("ottermart");
    include 'functions.php';
    // validateSession();
    // echo($GET['productBrand']);
    // echo($GET['productName']);
    // echo($GET['price']);
    // echo($GET['movId']);
    // echo($GET['productName']);
    
    if (isset($_GET['updateProduct'])){  //user has submitted update form
    global $dbConn;
          echo ($GET['productBrand']);
    
        $productName = $_GET['productName'];
        $description = $_GET['description'];
        $price =  $_GET['price'];
        $catId =  $_GET['catId'];
        $productImage = $_GET['productImage'];
    //   $productId = $_GET['movId'];
    $productBrand = $_GET['productBrand'];
        
        $sql = "UPDATE proj_products
                SET title = :title,
                   actors = :actors,
                   director =:director,
                   year = :year,
                   genreId = :genreId,
                   image = :image
                 WHERE movId = " . $_GET['productId'];
                
        $np = array();
        $np[":title"] = $productName;
        $np[":actors"] = $description;
        $np[":image"] = $productImage;
        $np[":year"] = $price;
        $np[":genreId"] = $catId;
        //  $np[":movId"] = $productId;
        $np[":director"] = $productBrand;
        // print_r($_GET);
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($np);
        echo "Product updated!";
             
    }
    

    if (isset($_GET['productId'])) {
    
      $productInfo = getProductInfo($_GET['productId']);    
      
    //   print_r($productId);
        
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

        <div class='container'>
            <div class='text-left'>
                <a href="admin.php">Admin Home</a>
                <h1> Updating a Product </h1>
                
                <br>
                
                <form>
                <input type="hidden" name="productId" value="<?=$productInfo['movId']?>">
                   Product name: <br> <input type="text" name="productName" value="<?=$productInfo['title']?>"><br>
                   Brand: <br> <input type="text" name="productBrand" value="<?=$productInfo['director']?>"><br>
                   Description: <br> <textarea name="description" cols="50" rows="4"> <?=$productInfo['actors']?> </textarea><br>
                   Price: <br> <input type="text" name="price" value="<?=$productInfo['year']?>"><br>
                   Category: <br>
                   <select name="catId">
                      <option value="">Select One</option>
                      <?php
                      
                      $categories = getCategories();
                      
                      foreach ($categories as $category) {
                          
                          echo "<option  "; 
                          echo  ($category['movId']==$productInfo['genreId'])?"selected":"";
                          echo " value='".$category['movId']."'>" . $category['genreId'] . "</option>";
                          
                      }
                      
                      ?>
                   </select> <br /> <br>
                   Set Image URL: <br> <input type="text" name="productImage" value="<?=$productInfo['image']?>"><br><br>
                   <input type="hidden" name="productId" value="<?php echo $_GET['productId']?>">                 
                   <input type="submit" name="updateProduct" value="Update Product" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;">
                                                                            
                </form>
            </div>
        </div>
        
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </body>
</html>