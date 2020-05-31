<html>
<head>
<link rel="stylesheet" href="../main.css" type="text/css">
<title>SPEAK Moderator's Page</title>
</head>
<body>
<br>

<center>
<img src="../quote.gif" height=90 width=600>

<p>

<font size=5>Most Recent Posts</font>
</center>
<p>

<center>
<?php 
  $today = date("F j, Y  g:i a");
  echo "Currently:  $today<p>";
?>
</center>

<?php 
  $dirname = "/u09/speak/public_html/newposts/posts";

	$handle = opendir($dirname);

	while (false !== ($logfile = readdir($handle))){
    $filelist[] = "$dirname/$logfile";
  }

  end($filelist);
  $numfiles = count($filelist);

  $choiceadd = 0;

  if($numfiles == 2){
     echo "<center>";
     echo "<font size = 5>No new posts</font>";
     echo "<center>";
  }
   else{
     echo "<form method='POST' action='/cgi-bin/cgiwrap/speak/checkpost.pl' name='checkform'>";
     while($numfiles > 2){
       $logfile = current($filelist);
       $choice = sprintf("post%d", $choiceadd);

		   if($logfile == '.' || $logfile == '..')
          continue;

       if(is_dir($logfile))
          continue;

		    else{
          $fp = fopen("$logfile", "r");

          echo "<table border=0 width=600>";
            echo "<tr>";
              echo "<td>From:</td>";
              $line = chop(fgets($fp, 1024));
              if(strlen($line) == 0)
                 $line = "Anonymous";
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
              echo "<td></td>";
              echo "<td>";
                while(!feof($fp)){
                   $line = chop(fgets($fp, 1024));
                   echo "<b>$line</b><br>";
                }
              echo "</td>";
            echo "</tr>";

         echo "</table>";
         echo "<input type='radio' name='$choice' value='keep'><b>Keep</b>";
         echo "<input type='radio' name='$choice' value='lose'><b>Delete</b>";
         echo "<input type='hidden' name='file' value='$logfile'>";

         fclose($fp);
         echo "<p>";
         prev($filelist);
         $choiceadd = $choiceadd + 1;
	       }	
      $numfiles--;
     }
     closedir($handle);
     echo "<input type=submit value='Update'>";
  }
?>
<p>
<a href="http://web.utk.edu/~speak">SPEAK Home Page</a>
</div>
</body>
</html>
