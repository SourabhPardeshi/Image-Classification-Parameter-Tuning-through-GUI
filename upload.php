<<<<<<< HEAD
<?php 
session_start();
$_SESSION['cur_img']=0;
function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }

   rmdir($dir);
}

if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        } 
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

  /* PHP current path */
  $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

  $targetdir = $path . $filenoext; // target directory
  $targetzip = $path . $filename; // target zip file
  $target_fir_correct = str_replace('\\', '/', $targetdir);
  /* create directory if not exists', otherwise overwrite */
  /* target directory is same as filename without extension */

  if (is_dir($targetdir))  rmdir_recursive ( $targetdir);


  mkdir($targetdir, 0777);


  /* here it is really happening */

    if(move_uploaded_file($source, $targetzip)) {
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($targetdir); // place in the directory with same name  
            $zip->close();

            unlink($targetzip);
        }
        $message = "Your .zip file was uploaded and unpacked.";
    } else {    
        $message = "There was a problem with the upload. Please try again.";
    }

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Image Classifier</title>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<center>
<div class="content">
 <!-- <?php if($message) echo "<p>$message</p>"; ?> -->
<form enctype="multipart/form-data" method="post" action="">
<label style="color:white">Choose a zip file to upload: <br> <br><input type="file" name="zip_file"  class=" btn-info" /></label>
<br /> <br> <br>
<div class="upload-btn-wrapper">

<input type="submit" name="submit" value="Upload" class="btn btn-success"/>
<br><br>
</div>
</form>
<form method="post" action="new.php?dir=<?php echo $target_fir_correct?>">
 
  <input type="submit" name="predict" value="Predict" class="btn btn-dark">
</form>

	</div></center>
</body>



=======
<?php 

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
       if ('.' === $file || '..' === $file) continue;
       if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
       else unlink("$dir/$file");
   }

   rmdir($dir);
}

if($_FILES["zip_file"]["name"]) {
    $filename = $_FILES["zip_file"]["name"];
    $source = $_FILES["zip_file"]["tmp_name"];
    $type = $_FILES["zip_file"]["type"];

    $name = explode(".", $filename);
    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach($accepted_types as $mime_type) {
        if($mime_type == $type) {
            $okay = true;
            break;
        } 
    }

    $continue = strtolower($name[1]) == 'zip' ? true : false;
    if(!$continue) {
        $message = "The file you are trying to upload is not a .zip file. Please try again.";
    }

  /* PHP current path */
  $path = dirname(__FILE__).'/';  // absolute path to the directory where zipper.php is in
  $filenoext = basename ($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
  $filenoext = basename ($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)

  $targetdir = $path . $filenoext; // target directory
  $targetzip = $path . $filename; // target zip file

  /* create directory if not exists', otherwise overwrite */
  /* target directory is same as filename without extension */

  if (is_dir($targetdir))  rmdir_recursive ( $targetdir);


  mkdir($targetdir, 0777);


  /* here it is really happening */

    if(move_uploaded_file($source, $targetzip)) {
        $zip = new ZipArchive();
        $x = $zip->open($targetzip);  // open the zip file to extract
        if ($x === true) {
            $zip->extractTo($targetdir); // place in the directory with same name  
            $zip->close();

            unlink($targetzip);
        }
        $message = "Your .zip file was uploaded and unpacked.";
    } else {    
        $message = "There was a problem with the upload. Please try again.";
    }

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Unzip a zip file to the webserver</title>
</head>

<body>
<?php if($message) echo "<p>$message</p>"; ?>
<form enctype="multipart/form-data" method="post" action="">
<label>Choose a zip file to upload: <input type="file" name="zip_file" /></label>
<br />
<input type="submit" name="submit" value="Upload" />
</form>
<form method="post" action="predict.php?dir=<?php echo $targetdir?>">
  <input type="submit" name="predict" value="predict">
</form>
</body>
>>>>>>> 5ef8503f4dc51bd6223285c2e66271348d5fefa9
</html>