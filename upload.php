
<?php
//name of the folder and path
$target_dir = "uploads/";
// is used to construct the full path and filename of the target location where the uploaded file will be stored on the server
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// target_file=uploads/bmp.bmp or target_file=uploads/BIRTHDAY IMAGE.jpg
//echo("target_file=$target_file <br>");

//flag
$uploadOk = 1;

//is used to extract and store the file extension of the target file
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//imageFileType=bmp imageFileType=jpg
 //echo("imageFileType=$imageFileType <br>");

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //used to check whether the uploaded file is an image and gather information about that image.
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size This part of the code accesses the "size" attribute of the $_FILES superglobal array. It contains the size (in bytes) of the uploaded file
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}



?>