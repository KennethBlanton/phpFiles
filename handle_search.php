<?php 
session_start();

define('DB_HOST', 'localhost');
define('DB_USER', 'student');
define('DB_PASSWORD', 'circus');
define('DB_NAME', 'react-backend');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$keyword = $_GET['keyword'];
$category = $_GET['category'];
$userSearch = $_GET['userSearch'];



?>