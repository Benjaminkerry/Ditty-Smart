<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
<?php
if (login_check($mysqli) == true)
echo htmlentities($_SESSION['username']); 
else
echo "Not Logged In";
?><b class="caret"></b></a>";
                    <ul class="dropdown-menu">
                        <li>
                            <a href="l.php"><i class="fa fa-fw fa-user"></i> Login</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
</li>
