<html>
<head>
<link rel="stylesheet" href="main.css" type="text/css">
</head>
<body>
<br>
<img src="quote.gif" height=90 width=600>

<div style="width: 600px;">
<p>

<center>
<font size=5>Recycle Bin</font>
</center>
<p>
Here is our/your forum.  Look here for the most up-to-date information on 
anything and everything that is environmental.  If you would like to make a post,
<a href="feedback.html" target="Frame1">click here!</a><br>
<i>Note:  Because of moderation, posts will not appear immediately</i><br>
<p>

<?php 
  $today = date("F j, Y  g:i a");

  echo "<center>";
  echo "It is currently:  $today<p>";
  echo "</center>";

  $dirname = "/u09/speak/public_html/log";

	$handle = opendir($dirname);

	while (false !== ($logfile = readdir($handle))){
    $filelist[] = "$dirname/$logfile";
  }

  end($filelist);
  $numfiles = count($filelist);

  while($numfiles > 2){
    $logfile = current($filelist);

		if($logfile == '.' || $logfile == '..')
       continue;

    if(is_dir($logfile))
       continue;

		 else{
       $fp = fopen("$logfile", "w");

       echo "<table border=0 width=600>";
         echo "<tr>";
           echo "<td width=70>From:</td>";
           if(strlen($line) == 0)
              $line = "Anonymous";
           $line = chop(fgets($fp, 1024));
           echo "<td><b>$line</b></td>";
         echo "</tr>";

         echo "<tr>";
           echo "<td>With:</td>";
           $line = chop(fgets($fp, 1024));
           if(strlen($line) == 0)
              $line = "N/A";
           echo "<td><b>$line</b></td>";
         echo "</tr>";

         echo "<tr>";
           echo "<td>At:</td>";
           $line = chop(fgets($fp, 1024));
           if(strlen($line) == 0)
              $line = "N/A";
           echo "<td><b>$line</b></td>";
         echo "</tr>";

         echo "<tr>";
           echo "<td>Time:</td>";
           $line = chop(fgets($fp, 1024));
           echo "<td><b>$line</b></td>";
         echo "</tr>";

         echo "<tr>";
           echo "<td>&nbsp;</td>";
           echo "<td>";
             while(!feof($fp)){
                $line = chop(fgets($fp, 1024));
                echo "<b>$line</b><br>";
             }
           echo "</td>";
         echo "</tr>";

      echo "</table>";
      fclose($fp);
      echo "<br><hr>";
      prev($filelist);
	    }	
   $numfiles--;
  }
  closedir($handle);
?>

</div>
</body>
</html>
