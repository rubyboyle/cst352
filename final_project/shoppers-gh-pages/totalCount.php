<?php
include 'functions.php';
validateSession();
$sql = "SELECT COUNT(movId) as count from proj_products";
        
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$count = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($count);
?>