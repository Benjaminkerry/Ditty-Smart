<!DOCTYPE html>
<html lang="en">
<?php
$_GET['aid'];
$_GET['error'];
$pageid = $_GET['aid'];
$errorstatus = $_GET['error'];
$title = "Alarm Dashboard";
$eventsid = 1;
$usersettings = 1;

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if ($errorstatus == (1))
{
	$title = "Wrong details. Try again!";
}else{
	$title = "Alarm Dashboard";
}

if (login_check($mysqli) == true)
{
	$userlog = 1;
        $username = htmlentities($_SESSION['username']);
}else{
	$userlog = 0;
        $username = "Not Logged In";
}

function logout() {
include_once 'functions.php';
sec_session_start();
$_SESSION = array();
$params = session_get_cookie_params(); 
setcookie(session_name(),
	        '', time() - 42000,
		        $params["path"],
			        $params["domain"],
				        $params["secure"],
					        $params["httponly"]);

session_destroy();
header('Location: '."?aid=home");
}

function userlogin() {
	echo '               <title>Secure Login: Log In</title>
		        <link rel="stylesheet" href="styles/main.css" />
			        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>
        <body>';
        if (isset($_GET['error'])) {
		            echo '<p class="error">Error Logging In!</p>';
			            }
	        
	       echo '<form action="includes/process_login.php" method="post" name="login_form">
		                   Email: <input type="text" name="email" />
				               Password: <input type="password"
					                                    name="password"
									                                 id="password"/>
													             <input type="button"
														                        value="Login"
																	                   onclick="formhash(this.form, this.form.password);" />
																			           </form>';

        if (login_check($mysqli) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';

            echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
        } else {
                }
               echo '</div>
                    </div>';
exit();
}

function events500(){
	global $eventsid;
	$eventsid=2;
}

function update(){
	global $userlog;
	if ($userlog == (0)){
		exit();
	}else{
		require('connector.php');
		$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
		if(isset($_POST['submit'])){
			$colo = $_POST['item'];  // Storing Selected Value In Variable
		}
		if ($colo == 1)
		{
			        echo "On <br>";
				        $statement = $mysqli->prepare("UPDATE mode SET panel=? WHERE id=1");
				        //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
				        $statement->bind_param('i', $colo);
				                $statement->execute();
				
				                        }
				                                else
				                                {
				                                        echo "Off <br>";
				                                                $statement = $mysqli->prepare("UPDATE mode SET panel=? WHERE id=1");
				                                                        $statement->bind_param('i', $colo);
				                                                                $statement->execute();
				
				                                                                }
				                                                                echo $wx;
				                                                                header('Location: '."?aid=home");
	}
}	

function omit(){
	global $userlog;
	if ($userlog == (0)){
		exit();
	}else{
if(isset($_POST['submit'])){
$colo = $_POST['item'];  // Storing Selected Value In Variable
$colo1 = $_POST['item1'];
$colo2 = $_POST['item2'];
$colo3 = $_POST['item3'];
$colo4 = $_POST['item4'];
$colo5 = "1";
$colo6 = $_POST['item5'];
$colo7 = $_POST['item6'];
$colo8 = $_POST['item7'];

}
        $statement = $mysqli->prepare("UPDATE pir SET pir1=? WHERE id=4");
                $statement1 = $mysqli->prepare("UPDATE pir SET pir2=? WHERE id=4");
                $statement2 = $mysqli->prepare("UPDATE pir SET pir3=? WHERE id=4");
                $statement3 = $mysqli->prepare("UPDATE pir SET pir4=? WHERE id=4");
                $statement4 = $mysqli->prepare("UPDATE pir SET pir5=? WHERE id=4");
                $statement5 = $mysqli->prepare("UPDATE mode SET modeset=? WHERE id=1");
                $statement6 = $mysqli->prepare("UPDATE pir SET pir6=? WHERE id=4");
                $statement7 = $mysqli->prepare("UPDATE pir SET pir7=? WHERE id=4");
                $statement8 = $mysqli->prepare("UPDATE pir SET pir8=? WHERE id=4");

      //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
        $statement->bind_param('i', $colo);
                $statement1->bind_param('i', $colo1);
                $statement2->bind_param('i', $colo2);
                $statement3->bind_param('i', $colo3);
                $statement4->bind_param('i', $colo4);
                $statement5->bind_param('i', $colo5);
                $statement6->bind_param('i', $colo6);
                $statement7->bind_param('i', $colo7);
                $statement8->bind_param('i', $colo8);
        $statement->execute();
                $statement1->execute();
                $statement2->execute();
                $statement3->execute();
                $statement4->execute();
                $statement5->execute();
                $statement6->execute();
                $statement7->execute();
                $statement8->execute();


header('Location: '."index.php?aid=home");
	}
}

function settings(){
	global $usersettings, $eventsid;
	$usersettings = 2;
	$eventsid = 3;

}

function alarmsettings(){
	global $userlog;
	if ($userlog == (0)){
		exit();
	}else{
	require('connector.php');
	if(isset($_POST['submit'])){
		$colo = $_POST['item'];  // Storing Selected Value In Variable
		$colo1 = $_POST['item1'];
		$colo2 = $_POST['item2'];
	}
	                $statement = $mysqli->prepare("UPDATE userpref SET pref1=? WHERE id=1");
	                $statement1 = $mysqli->prepare("UPDATE userpref SET pref2=? WHERE id=1");
			                $statement2 = $mysqli->prepare("UPDATE userpref SET pref3=? WHERE id=1");

			      //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
			                $statement->bind_param('i', $colo);
			                                $statement1->bind_param('i', $colo1);
			                                                $statement2->bind_param('i', $colo2);
			                                                                $statement->execute();
			                                                                                $statement1->execute();
			                                                                                                $statement2->execute();
header('Location: '."?aid=settings");
		                                                                                                

}
}

function zonesettings(){
	global $userlog;
	if ($userlog ==(0)){
		exit();
	}else{
		require('connector.php');
		if(isset($_POST['submit'])){
			$colo = $_POST['item'];  // Storing Selected Value In Variable
		}
		                $statement = $mysqli->prepare("UPDATE userpref SET pref4=? WHERE id=1");

		      //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
		                $statement->bind_param('i', $colo);
		                                $statement->execute();
	header('Location: '."?aid=settings");
	}
}

switch ($pageid):

        case "logout":
        logout();
        break;

	case "login":
		userlogin();
		break;
	case "home":
		continue;
		break;

	case "last500":
		events500();
		break;

	case "update":
		update();
		break;

	case "settings":
		settings();
		break;

	case "alarmsettings":
		alarmsettings();
		break;

	case "zonesettings":
		zonesettings();
		break;

	case "nest":
		nest();
		break;
endswitch;

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DityV0.3 - Beta</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?aid=home">Alarm Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="https://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                        
<?php
require('connector.php');
$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
$wa = $mysqli->query("SELECT modeset FROM mode WHERE id=1")->fetch_object()->modeset;
 if ($wa == (1.00))
 echo '<a href="#">Alarm <span class="label label-warning">PartArm</span></a>';
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
                            <a href="?aid=last500">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
<?php
if ($userlog == (1))
echo $username;
else
echo $username;
?><b class="caret"></b></a>";
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?aid=login"><i class="fa fa-fw fa-user"></i> Login</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="index.php?aid=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                         </li>
                </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="?aid=home"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                    <li>
                        <a href="?aid=last500"><i class="fa fa-fw fa-table"></i> Events</a>
                    </li>
                    <li>
                        <a href="?aid=settings"><i class="fa fa-fw fa-file"></i> Settings</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
<?php   
echo $title; echo "<small>Alarm Overview</small>";
?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>
<?php
require('connector.php');
$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
$wa = $mysqli->query("SELECT modeset FROM mode WHERE id=1")->fetch_object()->modeset;
 if ($wa == (1.00))
 echo "The Alarm is currently: PartArmed";
else
{
 if ($wx == (1.00))
 $pa = "On";
else
 $pa = "Off";
echo "The Alarm is currently: ";
echo $pa;
}
echo $pageid;
?>

                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Zones</h3>
                            <html>
                             </div>
<div id="pirs"><!-- score data here --></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$("#pirs").load("pir.php");
var $pirs = $("#pirs");
setInterval(function () {
    $pirs.load("pir.php");
}, 1000);
</script>
                     
                     </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>
<?php
if ($userlog == (1))
{
	if ($usersettings == (1))
	{
$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
 if ($wx == (1.00))
echo "Unset Alarm";
else
echo "Set Alarm";
echo '
</h3>
                            </div>
                            <div class="panel-body">
                               
';
$wa = $mysqli->query("SELECT modeset FROM mode WHERE id=1")->fetch_object()->modeset;
 if ($wa == (1.00))
{
echo '<style type="text/css">#divId'; {
echo 'display:none;';
echo 'HELLO</style>';
 }
}
else
{
if ($wx == (1.00))
{
echo '<form action="?aid=update" method="post">';
echo '<select name="item">';
echo '<option value="0">Off</option>';
echo '<option value="1">On</option>';
echo "</select>";
echo ' <button type="submit" name="submit" value="Go!" class="btn btn-default">Go!</button>';
echo '</form>';
}
else
{
echo '<form action="?aid=update" method="post">';
echo '<select name="item">';
echo '<option value="1">On</option>';
echo '<option value="0">Off</option>';
echo "</select>";
echo ' <button type="submit" name="submit" value="Go!" class="btn btn-default">FullArm</button>';
echo '</form>';
}
}
$wx = $mysqli->query("SELECT panel FROM mode WHERE id=1")->fetch_object()->panel;
 if ($wx == (1.00))
{
echo '<style type="text/css">#divId'; {
echo 'display:none;';
echo 'HELLO</style>';
 }
}
else
{
include('omit.php');
}
	}else{
echo '<form action="?aid=alarmsettings" method="post">
	Exit Time:
	<input type="number" name="item"
	min="10" max="180" step="1" value="10">
	Entry Time:
	<input type="number" name="item1"
	min="10" max="180" step="1" value="10">
	Alarm cutout:
	<input type="number" name="item2"
	min="10" max="300" step="1" value="180">
	<button type="submit" name="submit" value="Go!" class="btn btn-default">Save</button>
	</form>';
echo'<br>
	Please select the Zones that should include the entry delay!
	<form action="?aid=zonesettings" method="post">
	<select name="item">
	<option value="1">Zone1</option>
	<option value="2">Zone1-2</option>
	<option value="3">Zone1-3</option>
	<option value="4">Zone1-4</option>
	<option value="5">Zone1-5</option>
	</select>
	<button type="submit" name="submit" value="Go!" class="btn btn-default">Save</button>
	</form>';


	}
}else{
	echo "Sorry you need to login to change settings";
}
?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i>Events</h3>
                            </div>
                                <?php
if ($userlog == (1))
{
	if ($eventsid == (1))
	{
echo '<div class="panel-body">';
                                echo '<div class="table-responsive">';
                                    echo '<table class="table table-bordered table-hover table-striped">';
                                       echo '<thead>';
                                            echo '<tr>';
                                               echo '<th>Event ID</th>';
                                             echo   '<th>Event</th>';
                                              echo  '<th>Date</th>';
                                            echo '</tr>';
                                      echo  '</thead>';
                                        echo '<tbody>';
                                           
                                  include('connector.php');
                                  $sql = "SELECT id, date, sensor , time  FROM events ORDER BY id DESC LIMIT 10";
                                  $results = mysqli_query($mysqli,$sql);
                                  while($rowitem = mysqli_fetch_array($results)) {
                                  echo "<tr>";
                                  echo "<td>" . $rowitem['id'] . "</td>";
                                  echo "<td>" . $rowitem['sensor'] . "</td>";
                                  echo "<td>" . $rowitem['time'] . "</td>";
                                  echo "</tr>";
                                                                  }
                                  

echo '</tbody>';
                                echo '</table>';
				  echo  '</div>'; 
	}
if ($eventsid == (2))
{
	echo '<div class="panel-body">';
	                                echo '<div class="table-responsive">';
	                                    echo '<table class="table table-bordered table-hover table-striped">';
	                                       echo '<thead>';
	                                            echo '<tr>';
	                                               echo '<th>Event ID</th>';
	                                             echo   '<th>Event</th>';
	                                              echo  '<th>Date</th>';
	                                            echo '</tr>';
	                                      echo  '</thead>';
	                                        echo '<tbody>';

                                  include('connector.php');
                                  $sql = "SELECT id, date, sensor , time  FROM events ORDER BY id DESC LIMIT 500";
                                  $results = mysqli_query($mysqli,$sql);
                                  while($rowitem = mysqli_fetch_array($results)) {
                                  echo "<tr>";
                                  echo "<td>" . $rowitem['id'] . "</td>";
                                  echo "<td>" . $rowitem['sensor'] . "</td>";
                                  echo "<td>" . $rowitem['time'] . "</td>";
                                  echo "</tr>";
}
}
if ($eventsid == (3))
{
	echo '<div class="panel-body">';
	                                        echo '<div class="table-responsive">';
	                                            echo '<table class="table table-bordered table-hover table-striped">';
	                                               echo '<thead>';
	                                                    echo '<tr>';
	                                                       echo '<th>Exit Time</th>';
	                                                     echo   '<th>Entry Time</th>';
	                                                      echo  '<th>Alarm Cutout</th>';
	                                                    echo '</tr>';
	                                              echo  '</thead>';
	                                                echo '<tbody>';

                                  include('connector.php');
                                  $sql = "SELECT pref1, pref2, pref3 FROM userpref";
                                  $results = mysqli_query($mysqli,$sql);
                                  while($rowitem = mysqli_fetch_array($results)) {
                                  echo "<tr>";
                                  echo "<td>" . $rowitem['pref1'] . "</td>";
                                  echo "<td>" . $rowitem['pref2'] . "</td>";
                                  echo "<td>" . $rowitem['pref3'] . "</td>";
                                  echo "</tr>";



				  }
}
}else{
	echo "Sorry these details are only readable by authorized users";
}
?>
                                    <div class="text-right">
                                    <a href="?aid=last500">View Last 500 events <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
