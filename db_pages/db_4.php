<?php
  session_start();
  include("../src/secure.php");
  include("../src/profile.php");
  $profile_info = profile($_SESSION['id']);

  $time_start = microtime(true);
  include '../src/db_connect.php';
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sth = $bdd->query("SELECT c.country, ((SELECT s.sum_patients FROM (
        SELECT SUM(h.hosp_patients) sum_patients, ISO_CODE 
        FROM Hospitals h
        WHERE h.date='2021-01-01'
        GROUP BY h.ISO_CODE 
    ) s
    WHERE c.ISO_CODE=s.ISO_CODE)
    / c.population) 
FROM Country c");
  $time_end = microtime(true);
  $exec_time = $time_end - $time_start;
 
  $tmp_graph_array=array();
?>

<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/css_main.css">
<link rel="stylesheet" href="../css/graph.css">
<link rel="stylesheet" href="../css/gradient_animate.css">
<link rel="icon" href="../img/Rickroll.jpg" />

<body>
  <div class="main">
    <div class='window'>
      <div class='overlay'></div>
      <div class="profile">
        <span class="user-name"> <?php echo $profile_info["username"]; ?> </span>
        <span class="user-type">
          <?php 
            if ($profile_info["isEpidemiologist"]) {
              echo "Epidemiologist";
            } else {
              echo "Visiteur";
            }
          ?>
        </span>
        <br><hr>
        <span class="user-info">Vos requêtes possibles sont:</span>
          <?php 
            echo "<span class='infos-liste'>Select</span>";
            if ($profile_info["isEpidemiologist"]) {
              echo "<span class='infos-liste'>Insert</span>";
              echo "<span class='infos-liste'>Delete</span>";
              echo "<span class='infos-liste'>Update</span>";
            }
          ?>
        <a href="../src/disconnect.php" class='disconnect-btn' type="submit" value="Submit">Logout</a>
      </div>
        <div class='content'>
          <div class='title-db'>Request 4: <span class="phrase">La proportion de la population hospitalisée pour chaque pays, le 1er janvier 2021</span></div>
          <div class="hey">
            <div class="text-response">
              <?php 
                if (isset($sth)){
                  echo $sth->rowCount() . " results in ". $exec_time . " seconds";
                }
               ?>
            </div>
            <div class="request-response">
              <table>
                <?php 
                  if (isset($sth)) {
                    if ($sth->rowCount() > 0) {
                      $tmp_array=array();
                      for($i = 0; $i < $sth->columnCount(); $i++) {
                          $tmp_array[$i] = $sth->getColumnMeta($i);
                      }
                      echo "<thead><tr>";
                      echo "<th>" . "country". "</th>";
                      echo "<th>" . "proportion". "</th>";
                      echo "</tr></thead><tbody>";
                      while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        $tmp_country;
                        foreach ($row as $key => $value) {
                           echo "<td>" . $value . "</td>";
                           if ($key != "country") {
                            if (is_null($value)) {
                              array_push($tmp_graph_array, array("y" => 0, "label" => $tmp_country ));
                            }else {
                              array_push($tmp_graph_array, array("y" => $value*100, "label" => $tmp_country));
                            }
                           }else {
                            $tmp_country=$value;
                           }
                        }
                        echo "</tr>";
                      }    
                      echo "</tbody>";              
                    } 
                  }
                ?>
              </table>
            </div>

            <?php 
                $dataPoints=$tmp_graph_array;
            ?>

            <script>
              window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                  animationEnabled: true,
                  theme: "light2",
                  title:{
                    text: "Proportion de personne hospitalisé"
                  },
                  axisY: {
                    title: "Poucentage de la popilation"
                  },
                  data: [{
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                  }]
                });
                chart.render();
              }
            </script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <div class="graph-response" id="chartContainer"></div>


          </div>
      </div>
    </div>
    <div class="nav-bar">
      <a href="../db_main.php" class="nav-btn">M</a>
      <a href="db_1.php"  class="nav-btn">1</a>
      <a href="db_2.php"  class="nav-btn">2</a>
      <a href="db_3.php"  class="nav-btn">3</a>
      <a href="db_4.php"  class="nav-btn">4</a>
      <a href="db_5.php"  class="nav-btn">5</a>
      <a href="db_6.php"  class="nav-btn">6</a>
    </div>
  </div>
</body>
</html>
