<?php
include('../connector.php');
echo 'Current entry zones';
echo '<br>';
$wa = $mysqli->query("SELECT pref4 FROM userpref WHERE id=1")->fetch_object()->pref4;
 if ($wa == (1.00))
 echo "Zone 1";
 elseif ($wa == (2.00))
 echo "Zone 1 & Zone 2";
 elseif ($wa == (3.00))
 echo "Zone 1 & Zone 2 & Zone 3";
 elseif ($wa == (4.00))
 echo "Zone 1 & Zone 2 & Zone 3 & Zone 4";
 elseif ($wa == (5.00))
 echo "Zone 1 & Zone 2 & Zone 3 & Zone 4 & Zone 5";
?>
