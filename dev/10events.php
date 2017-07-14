<div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Event ID</th>
                                                <th>Event</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
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
                                  ?>

</tbody>
                                    </table>
                                </div>
