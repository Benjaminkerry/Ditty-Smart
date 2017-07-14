<div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Exit Time</th>
                                                <th>Entry Time</th>
                                                <th>Alarm Cutout</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                  include('../connector.php');
                                  $sql = "SELECT pref1, pref2, pref3 FROM userpref";
                                  $results = mysqli_query($mysqli,$sql);
                                  while($rowitem = mysqli_fetch_array($results)) {
                                  echo "<tr>";
                                  echo "<td>" . $rowitem['pref1'] . "</td>";
                                  echo "<td>" . $rowitem['pref2'] . "</td>";
                                  echo "<td>" . $rowitem['pref3'] . "</td>";
                                  echo "</tr>";
                                                                  }
                                  ?>

</tbody>
                                    </table>
                                </div>
