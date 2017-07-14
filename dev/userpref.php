<?php
echo '<form action="update123.php" method="post">';
echo 'Exit Time: ';
echo '<input type="number" name="item"';
echo 'min="10" max="180" step="1" value="30">';
echo ' Entry Time: ';
echo '<input type="number" name="item1"';
echo 'min="10" max="180" step="1" value="30">';
echo " Alarm cutout: ";
echo '<input type="number" name="item2"';
echo 'min="10" max="60" step="1" value="60">';
echo ' <button type="submit" name="submit" value="Go!" class="btn btn-default">Save</button>';
echo '</form>';

