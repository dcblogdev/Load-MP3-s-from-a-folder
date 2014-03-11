<?php ob_start();?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MP3 Test</title>
  <link rel="stylesheet" href="css/styles.css">

</head>
<body>

<?php
   //set folder to read from
   $dirname = "music/";

   //read files in folder
   $files = scandir($dirname);
   //ignore hidden files
   $ignore = Array(".", "..");

   //loop through all files
   foreach($files as $curfile){

       //if not in ignore list create a link
       if(!in_array($curfile, $ignore)) {
           echo "<li><a href='?file=".$curfile."'>$curfile</a></li>\n ";
       }
   }  



   //if file selected
   if(isset($_GET['file'])){

    //get selected file
    $file = $_GET['file'];

    //player pass in the path to the file
    echo '<object type="application/x-shockwave-flash" data="dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
    <param name="movie" value="dewplayer.swf" />
    <param name="flashvars" value="mp3='.$dirname.$file.'" />
    <param name="wmode" value="transparent" />
    </object>';

    //create donload link
    echo '<a href="?download='.$file.'">Download</a>';

   }  

  //if download link pressed then download the file.
  if(isset($_GET['download'])){

       $file = $dirname.$_GET['download'];
       header ("Content-type: octet/stream");
       header ("Content-disposition: attachment; filename=".$file.";");
       header("Content-Length: ".filesize($file));
       readfile($file);
       exit; 
  }

?>
</body>
</html> 
<?php ob_flush(); ?>