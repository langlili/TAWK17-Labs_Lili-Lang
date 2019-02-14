<?php
include('config.php');
include('header.php');

session_start();
if(!isset($_SESSION['username'])) {
    header("location: login.php");
  }

//The main/functional part of this code is the if isset and the move_uploaded_file
//It means if the form is submitted (if it's set) then move that file to a certain destination
?>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
if (isset($_FILES['upload'])){ //FILES is a superglobal within php. going to be manipulating the files we upload
  $allowedextensions = array ('jpg', 'jpeg', 'gif', 'png');
  //Checking what kind of file it is (get the extension out of the upload)
  //The file name is in the FILES variable, taken from the upload.
  //To get the extension we need to get the position of the dot and say to give the stuff after the dot
  //We make the string lowercase, return part of the string, at this string position
  //substr requires you to define the start of (the part) of the string.
  //We use strrpos to help us define this start (find the position of the dot in this string), +1 is go one more step to the right so we exclude the dot
  $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') +1 ));

  echo "Your file extension is: ".$extension;


  $error = array ();
  //If "the extension of the file is in the allowed extensions array" condition returns false
  if(in_array($extension, $allowedextensions) === false){ //in_array(needle, haystack) 
     $error[] = 'Oops. The file you tried to upload is not an image.';
  }

    // Checking if the file does not exced 10mb size
  if($_FILES['upload'] ['size'] > 10000000){
    $error[] = 'The file is to big. Files cannot exced 10mb.';

  }
  //if there is no error we want to do the upload
  if (empty($error)){

    //move this file to this destination
    //tmp_name = temporary name (the name is just there until you finish the upload)
    //The destination specifies the right/final name
    move_uploaded_file($_FILES['upload']['tmp_name'], "images/uploaded/{$_FILES['upload']['name']}");

  }
  //If no errors, upload file, if errors, do nothing (for now). 
  //Instead of else statement we echo errors down below (nested php in html), before the form, in another if-else
  //If no errors, show uploaded pic, if errors show why not uploaded
}

?>
<html>
    <head>
        <title>Security - Upload</title>
           </head>

           <body>
             <?php

             if(isset($error)){ //meaning that we have this array 

               if(empty($error)){
                 //Makes it possible to see the file just after the user uploaded it
                 echo '<a href="images/uploaded/' . $_FILES['upload']['name'] . '">This is your file';
                 echo '<a href="../Backend/gallery.php">Back to Gallery';

               }
               else{
                 foreach($error as $err){ //Lists errors one by one
                   echo $err;
                   echo '</br>';
                 }
               }

             }



              ?>
               <div>
                   <form action="" method="POST" enctype="multipart/form-data"> 
                       <input type="file" name="upload" /></br>
                       <input  type="submit" value="submit" />
                   </form>
               </div>
           </body>

             <?php include('footer.php'); ?>


</html>
