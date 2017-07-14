<?php
$wa = $mysqli->query("SELECT modeset FROM mode WHERE id=1")->fetch_object()->modeset;
 if ($wa == (1.00))
{
echo '<form action="update122.php" method="post">';
echo '<select name="item">';
echo '<option value="0">Off</option>';
echo '</select>';
echo ' <button type="submit" name="submit" value="0" class="btn btn-default">Disarm</button>'; 
}
else
{
echo '<form action="update121.php" method="post">';
echo '<select name="item">';
echo '<option value="0">Off</option>';
echo '<option value="1">Front Door</option>';
echo '</select>';
echo '<select name="item1">';
echo '<option value="0">Off</option>';
echo '<option value="1">Kitchen</option>';
echo '</select>';
echo '</select>';
echo '<select name="item2">';
echo '<option value="0">Off</option>';
echo '<option value="1">Living Room</option>';
echo '</select>';
echo '</select>';
echo '<select name="item3">';
echo '<option value="0">Off</option>';
echo '<option value="1">Bedroom</option>';
echo '</select>';
echo '</select>';
echo '<select name="item4">';
echo '<option value="0">Off</option>';
echo '<option value="1">ManCave</option>';
echo '</select>';
echo ' <button type="submit" name="submit" value="Go!" class="btn btn-default">Part!</button>';
echo '</form>';
} 
?>
