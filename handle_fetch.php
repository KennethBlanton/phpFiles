<?php 
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
// if($_SESSION['loggedIn']) {
define('DB_HOST', 'localhost');
define('DB_USER', 'student');
define('DB_PASSWORD', 'circus');
define('DB_NAME', 'react-backend');

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(true !== isset($_GET['type'])) {
	die(json_encode('bad call use type='));
}
if(true !==isset($_GET['query'])) {
	$_GET['query'] = 0;
}
if(true !==isset($_GET['id'])) {
	$_GET['id'] = 0;
}
if(true !==isset($_GET['comment'])) {
	$_GET['comment'] = 0;
}
if(true !==isset($_GET['score'])) {
	$_GET['score'] = 0;
}
if(true !==isset($_GET['author'])) {
	$_GET['author'] = 0;
}
if(true !==isset($_POST['type'])) {
	$_POST['type'] = 0;
}
if(true !==isset($_POST['table'])) {
	$_POST['table'] = 0;
}
if(true !==isset($_POST['id'])) {
	$_POST['id'] = 0;
}
if(true !==isset($_POST['author'])) {
	$_POST['author'] = 0;
}
if(true !==isset($_POST['comment'])) {
	$_POST['comment'] = 0;
}
if(true !==isset($_POST['score'])) {
	$_POST['score'] = 0;
}
$type = $_GET['type'];

if("$type" == "productDetail") { 
   $query = $_GET['query'];
   $result = mysqli_query($link,  "SELECT * FROM images2017
      INNER JOIN comments2017 ON images2017.id = comments2017.photo_id WHERE images2017.id='$query'");
     $row=mysqli_fetch_assoc($result);
	echo json_encode($row);
   
}
if($_GET['type'] == 'categorySelect') {
     $query = $_GET['query'];
	 $json1 = array();
     $result = mysqli_query($link, "SELECT title,imagelink,thumblink,username,score,date,id FROM images2017 WHERE category='$query'");
	 while( $row =mysqli_fetch_assoc($result)) {
   		array_push($json1, $row);
	 };
	 echo json_encode($json1);
}
if($_GET['type'] == 'gallery') {
	$json1 = array();
     $result = mysqli_query($link, "SELECT id,imagelink,thumblink,title,score,date FROM images2017");
	   while( $row =mysqli_fetch_assoc($result)) {
   		array_push($json1, $row);
	 }
	 echo json_encode($json1);
}
if($_GET['type'] == 'categoryPage') {
	  $json1 = array();
      $result = mysqli_query($link, "SELECT * FROM images2017 group by category");
	   while( $row =mysqli_fetch_assoc($result)) {
   		array_push($json1, $row);
	 }
	 echo json_encode($json1);
}
if($_POST['type']='newComment') {
     $id = $_POST['id'];
     $author = $_POST['author'];
     $comment = $_POST['comment'];
	 $dateNow = date('Y-m-d H:i:s');
   
    $result = mysqli_query($link, "INSERT INTO comments2017 (author, comment, photo_id, date) VALUE 
    ('$author', '$comment','$id', '$dateNow')");

}
if($_POST['type']== 'upvote') {
    $table = $_POST['table'];
    $score = $_POST['score'];
    $id = $_POST['id'];
    $result = mysqli_query($link, "UPDATE $table SET score='$score' WHERE id=$id");

}
if($_POST['type'] == 'downvote') {
  $table = $_POST['table'];
    $score = $_POST['score'];
    $id = $_POST['id'];
    $result = mysqli_query($link, "UPDATE $table SET score='$score' WHERE id=$id");

}
// }
?>