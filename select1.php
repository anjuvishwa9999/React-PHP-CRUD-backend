<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
include 'connect.php';

$objDb= new Dbconnect;
$conn= $objDb->connect();

$sql="SELECT * FROM demo";
$stmt=$conn->prepare($sql);
$stmt->execute();
$login_student=$stmt->fetchAll(PDO :: FETCH_ASSOC);
echo json_encode($login_student);


?>