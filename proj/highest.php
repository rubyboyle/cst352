<?php
include 'functions.php';
validateSession();
$sql = "SELECT year, title FROM proj_products WHERE 1 ORDER BY year DESC LIMIT 1";
        
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$highestPrice = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($highestPrice);
?>