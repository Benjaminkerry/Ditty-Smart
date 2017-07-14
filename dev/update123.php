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

		

header('Location: '."settings.php")
?>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="l.php">login</a>.
            </p>
        <?php endif; ?>
