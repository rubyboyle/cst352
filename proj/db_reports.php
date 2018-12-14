
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
  
    <body style="text-align:center;">
        <h1> Administrator Reports </h1>
        
        <br>Highest Price:<br>
        <input id="findHighestPrice" type="button" name="find Highest Price" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;" value="Find Highest Price"><br>
        <div style="color:black;" id="displayHighestPrice"></div>
        
        <br>Lowest Price:<br>
        <input id="findLowestPrice" type="button" name="find Lowest Price" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;" value="Find Lowest Price"><br>
        <div style="color:black;" id="displayLowestPrice"></div>
        
        
        <br>Number of Products in Database:<br>
        <input id="findDBCount" type="button" name="find DB Count" style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;" value="Find DB Count"><br>
        <div style="color:black;" id="displayDBCount"></div>
       <br><br><br>
        <a href='admin.php' style="background-color: #7971ea; 
                                                                            border: none; color: white;
                                                                            padding: 10px 25px;
                                                                            text-align: center;
                                                                            text-decoration: none;
                                                                            display: inline-block;
                                                                            font-size: 16px;
                                                                            border-radius: 4px;" >Admin Page</a>
    </body>
</html>

<script>
$("document").ready(function() {

    $("#findLowestPrice").click(function() {
                    $.ajax({
                        url: "lowest.php",
                        datatype: "json",
                        success: function(data, status) {
                         
                            var obj = JSON.parse(data); // parse our json data into javascript values
                            $("#displayLowestPrice").html(obj.title + " is $" + obj.year);
                        
                        }
                    }); //ajax
    }); 
    
    $("#findHighestPrice").click(function() {
                    $.ajax({
                        url: "highest.php",
                        datatype: "json",
                        success: function(data, status) {
                         
                            var obj = JSON.parse(data); // parse our json data into javascript values
                            $("#displayHighestPrice").html(obj.title + " is $" + obj.year);
                        
                        }
                    }); //ajax
    });
    
    $("#findDBCount").click(function() {
                    $.ajax({
                        url: "totalCount.php",
                        datatype: "json",
                        success: function(data, status) {
                         
                            var obj = JSON.parse(data); // parse our json data into javascript values
                            $("#displayDBCount").html(obj.count);
                        
                        }
                    }); //ajax
    }); 
}); // doc ready
</script>