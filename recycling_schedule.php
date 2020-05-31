<?
include "script/xmlfunctions.php";
$schedule = GetXMLTree("xml/recycling_schedule.xml");
// print_r($schedule);
?>
<html>
<head>
<link rel="stylesheet" href="main.css" type="text/css">
  <title>Recycling Schedule</title>
</head>
<body>
<br> 
<img src="quote.gif" height="90" width="600">
<? foreach ($schedule as $location) { ?>
 <table cellspacing="4" border="1">
  <caption><h1><?= $location["NAME"] ?></h1></caption>
 <? if (is_array($location)) foreach ($location as $key => $week) { ?>
  <? if ($key == "BEGINNING") { ?><tr><th colspan="5">Week beginning <?= date("F j, Y", strtotime($week["BEGINNING"])) ?></th></tr><? } ?>
   <? if (is_array($week)) foreach ($week as $date => $day) { ?>
    <tr>
     <th><?= date("D j M y", strtotime($week["BEGINNING"]) + 86400 * $date) ?></th>
	 <? if (is_array($day)) foreach ($day as $key => $hour) { if (is_numeric($key)) { ?>
     <td><?= $hour["BEGINNING"] . "pm" ?></td>
     <td><?= $day["HOUR"] ?></td>
	 <? } } ?>
    </tr>
   <? } ?>
 <? } ?>
 </table>
<? } ?>
</body>
</html>