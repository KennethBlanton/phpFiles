<?php
session_start();
if($_SESSION['loggedIn']) {
echo $_SESSION['username'];
$final_width_of_image = 100;
$path_to_image_directory = 'build/php/user_uploads/';
$path_to_thumbs_directory ='http://circuslabs.net/~michele.james/build/php/thumbnails/';
define('DB_HOST', 'localhost');
define('DB_USER', 'student');
define('DB_PASSWORD', 'circus');
define('DB_NAME', 'react-backend');
// echo $_FILES['image']['name'];
//$file = $_POST["image"];
$title = $_POST["name"];
$description = $_POST["description"];
$category = $_POST["category"];
$dateNow = date('Y-m-d H:i:s');
$postUsername = $_SESSION['username'];
$checkbox = $_POST["safeCheckbox"];

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$thumbtarget =  __DIR__ . "/thumbnails/" . $_FILES["image"]["name"];
$imagetarget =  __DIR__ . "/user_uploads/" . $_FILES["image"]["name"];
mysqli_query($link, "INSERT INTO images2017 (title, description, imagelink,thumblink, username, date, category) VALUE
    ('$title', '$description', '$imagetarget','$thumbtarget','$postUsername' , '$dateNow', '$category')");
if(isset($_FILES['image'])) {
     
    if(preg_match('/[.](jpg)|(gif)|(png)$/', $_FILES['image']['name'])) {
         
        $filename = $_FILES['image']['name'];
        $source = $_FILES['image']['tmp_name'];   
        move_uploaded_file($source, $imagetarget);
         
        // move_uploaded_file($source, $target);  

    };
};
function createThumbnail($filename,$thumbtarget) {
     $final_width_of_image = 100;
     
    if(preg_match('/[.](jpg)$/', $filename)) {
        $im = imagecreatefromjpeg( __DIR__ . "/user_uploads/" . $filename);
		// print_r($im);
    } else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif(__DIR__ . "/user_uploads/" . $filename);
		// print_r($im);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng(__DIR__ . "/user_uploads/" . $filename);
		print_r($im);
    }
     
    $ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));
     
    $nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
    
    imagejpeg($nm, __DIR__ . "/thumbnails/" . $filename);
	$source = $_FILES['image']['tmp_name']; 
	echo $source;  
	move_uploaded_file($source, $thumbtarget); 
	// print_r(move_uploaded_file($source, $thumbtarget);
}

createThumbnail($_FILES['image']['name'], __DIR__ . "/thumbnails/" . $_FILES["image"]["name"]);  

// $from = $_FILES["image"]["tmp_name"];
// $to = __DIR__ . "/user_uploads/" . $_FILES["image"]["name"];
// $toThumb = __DIR__ . "/thumbnails/" . $_FILES["image"]["name"];
// 
// if (empty($title) || empty($description) || empty($category)){
	// die ("Please fill out all input fields.<br><a href='register.html'>Go back</a>");
// }
// 
// 
// if (isset($checkbox)) {
	// echo "It's a beautiful day";
// 
// 
// 
// 
	// if(preg_match('/[.](jpg)$/', $_FILES["image"]["name"])) {
      // $im = imagecreatefromjpeg($toThumb);
       // echo "jpg";
   // } else if (preg_match('/[.](gif)$/', $_FILES["image"]["name"])) {
       // $im = imagecreatefromgif($toThumb);
       // echo "gif";
   // } else if (preg_match('/[.](png)$/', $_FILES["image"]["name"])) {
       // $im = imagecreatefrompng($toThumb);
// 
       // // print_r($im);
       // echo "png";
   // }
// 
// } else {
	// die ( "Yo better check that damn checkbox");
// }
// 
// //echo $to;
// move_uploaded_file($from, $to);
// move_uploaded_file($im, $toThumb); //filename and destination
//print_r($_FILES);





	

}
?>


