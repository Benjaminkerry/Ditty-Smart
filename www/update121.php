<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
        <?php if (login_check($mysqli) == true) : ?>

<?php
require('connector.php');
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
		

header('Location: '."index.php")
?>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="l.php">login</a>.
            </p>
        <?php endif; ?>
