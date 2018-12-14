<?php
// session_start();

// include 'inc/dbConnection.php';
// $dbConn = startConnection("final_project");
include 'functions.php';
validateSession();

if (isset($_GET['productId'])) {

  $productInfo = getProductInfo($_GET['productId']);    
//   print_r($productInfo);
    
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
        <div class='container'>
            <div class='text-center'>
                
                 <h3><?=$productInfo['title']?></h3>
                 <?=$productInfo['actors']?><br>
                 <img src='<?=$productInfo['image']?>' height='75'/>
            </div>
        </div>
 
</body>
</html>