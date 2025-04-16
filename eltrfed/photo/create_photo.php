<?php
require $_SERVER['DOCUMENT_ROOT'] . '/include/function.php';
$maxsize = 1000000;
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$exif = exif_read_data($_FILES["fileToUpload"]);

// function exif($a){

//   if(isset($a)){
//     return $a;
//   }
//   else{
//     $b = implode($exif['DateTimeOriginal'], " ");
//     echo $b[1];
//     return $b[1];
//   }
// }

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  // echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > $maxsize) {
  // echo "Sorry, your file is too large. " . $_FILES["fileToUpload"]["size"];
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg") {
  return "Sorry, only JPG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // echo " Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  $name = uniqid() . ".jpg";
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'img/' . $name)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $sql = "INSERT INTO `photo` (`id`, `file_name`, `date`, `text`, `date_create`, `date_update`) VALUES (NULL, '" . $name . "', " . n($_POST['photo_date']) . ", " . n($_POST['photo_text']) . ", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
    if($_POST != 0){
      mysqli_query($conn, $sql);
    } 
    // echo $sql;
    header('Location: index.php');
    die();
} else {
    // echo " Sorry, there was an error uploading your file.";
  }
}
?>
