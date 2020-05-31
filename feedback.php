<HTML>
<HEAD>
<link rel="stylesheet" href="main.css" type="text/css">
</HEAD>
<BODY>
<br>
<img src="quote.gif" height=90 width=600>
<div style="width: 600px;">
<p>

<center>
<font size=5>Feedback</font>
</center>

<?php
   $today = date("F j, Y  g:i a");

   echo "<center>";
   echo "Currently: $today<p>";
   echo "</center>";
 
   $logfile = "./logtest";
   $fp = fopen("$logfile", "a");
   fwrite($fp, "hi\n");
   fclose($fp);
   system("mv $logfile logtest2");
?>
<p>
We would love to hear from you!!  Comments, suggestions, questions, announcements, even (and especially) evironmental tips would be appreciated.  Your submissions will be posted to the page!!<br>
<p>

</div>
</body>
</html>
