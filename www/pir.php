<?php
require('connector.php');
$wx = $mysqli->query("SELECT pir1 FROM pir WHERE id=3")->fetch_object()->pir1;
$wa = $mysqli->query("SELECT pir2 FROM pir WHERE id=3")->fetch_object()->pir2;
$wb = $mysqli->query("SELECT pir3 FROM pir WHERE id=3")->fetch_object()->pir3;
$wc = $mysqli->query("SELECT pir4 FROM pir WHERE id=3")->fetch_object()->pir4;
$wd = $mysqli->query("SELECT pir5 FROM pir WHERE id=3")->fetch_object()->pir5;
$we = $mysqli->query("SELECT pir6 FROM pir WHERE id=3")->fetch_object()->pir6;
$wf = $mysqli->query("SELECT pir7 FROM pir WHERE id=3")->fetch_object()->pir7;
$wg = $mysqli->query("SELECT pir8 FROM pir WHERE id=3")->fetch_object()->pir8;
 if ($wx == (1.00))
 $pa = "pir-1.png";
else
 $pa = "pir-0.png";
 if ($wa == (1.00))
 $pb = "pir-1.png";
else
 $pb = "pir-0.png";
 if ($wb == (1.00))
 $pc = "pir-1.png";
else
 $pc = "pir-0.png";
 if ($wc == (1.00))
 $pd = "pir-1.png";
else
 $pd = "pir-0.png";
 if ($wd == (1.00))
 $pe = "pir-1.png";
else
 $pe = "pir-0.png";
if ($we == (1.00))
 $pf = "pir-1.png";
else
 $pf = "pir-0.png";
if ($wf == (1.00))
 $pg = "pir-1.png";
else
 $pg = "pir-0.png";
if ($wg == (1.00))
 $ph = "pir-1.png";
else
 $ph = "pir-0.png";
echo "<html>";
echo "<title>PIR Test</title>";
echo "<body>";
echo "Front Door";
echo "<img src=$pa>";
echo "Kitchen";
echo "<img src=$pb>";
echo "Living Room";
echo "<img src=$pc>";
echo "Bedroom";
echo "<img src=$pd>";
echo "ManCave";
echo "<img src=$pe>";
echo "UP HALL";
echo "<img src=$pf>";
//echo "Zone7";
//echo "<img src=$pg>";
//echo "Zone8";
//echo "<img src=$ph>";
//echo "</body>";
//echo "</html>";
?>
