<?php
require ('ul.php');

if (login_check($mysqli) == true)
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
                                           
                                  include('../connector.php');
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
else
{
echo "NO";
}
