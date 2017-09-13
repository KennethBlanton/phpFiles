<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'student');
define('DB_PASSWORD', 'circus');
define('DB_NAME', 'react-backend');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(type == productDetail) {
   mysqli_query($link, "SELECT title,description,imagelink,username,score,date FROM images2017 WHERE id='$query'");
}
if(type == categorySelect) {
     mysqli_query($link, "SELECT title,imagelink,username,score,date FROM images2017 WHERE category='$query'");
}
if(type == gallery) {
     mysqli_query($link, "SELECT imagelink,title,score,date FROM images2017 WHERE id='$query'");
}
if(type == category) {
     mysqli_query($link, "SELECT DISTINCT category FROM images2017");
}

?>