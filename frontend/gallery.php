<?php
include("config.php");
include("header.php");

?>

<head>
  <title>Labs</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
$folder_path = '../Backend/images/uploaded/';


$num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);

$folder = opendir($folder_path);

if($num_files > 0)
{
 while(false !== ($file = readdir($folder)))
 {
  $file_path = $folder_path.$file;
  $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
  if($extension=='jpg' || $extension =='png' || $extension == 'gif' || $extension == 'bmp')
  {
   ?>
            <a href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>"  height="250" /></a>
            <?php
  }
 }
}
else
{
 echo "the folder was empty !";
}
closedir($folder);
?>

  <?php include("footer.php"); ?>
</body>