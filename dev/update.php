<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
?>
        <?php if (login_check($mysqli) == true) : ?>

<?php
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
header('Location: '."index.php")
?>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="l.php">login</a>.
            </p>
        <?php endif; ?>

