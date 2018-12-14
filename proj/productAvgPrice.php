<?php
     header('Access-Control-Allow-Origin: *');
    
    include 'functions.php';
    // validateSession();
    $sql = "SELECT AVG(price) year FROM proj_product;";
            
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $avgPrice = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($avgPrice);
?>