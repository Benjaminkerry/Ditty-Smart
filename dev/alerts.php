                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>

<?php
require('connector.php');
$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
$wa = $mysqli->query("SELECT modeset FROM mode WHERE id=1")->fetch_object()->modeset;
 if ($wa == (1.00))
{
echo '<a href="#">Alarm <span class="label label-warning">PartArm</span></a>';
}
else
{ 
if ($wx == (1.00))
echo '<a href="#">Alarm <span class="label label-danger">Armed</span></a>';
else
echo '<a href="#">Alarm <span class="label label-success">Disabled</span></a>';
}
?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="tables.php">View All</a>
                        </li>
                    </ul>
                </li>
