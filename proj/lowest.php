<?php
header('Access-Control-Allow-Origin: *');

include 'functions.php';
validateSession();
$sql = "SELECT year, title FROM proj_products WHERE 1 ORDER BY year ASC LIMIT 1";
        
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$lowestPrice = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($lowestPrice);
?>