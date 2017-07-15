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
}
                $statement = $mysqli->prepare("UPDATE userpref SET pref4=? WHERE id=1");
                 
      //bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
                $statement->bind_param('i', $colo);
                $statement->execute();

		

header('Location: '."settings.php")
?>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="l.php">login</a>.
            </p>
        <?php endif; ?>
