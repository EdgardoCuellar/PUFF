<?php
  session_start();
  include("../src/secure.php");
  include("../src/profile.php");
  $profile_info = profile($_SESSION['id']);

  $time_start = microtime(true);
  include '../src/db_connect.php';
  if (isset($_POST["country_name"]) && $_POST["country_name"] != "nothing") {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_POST["country_name"]=="all") {
    $sth = $bdd->query("SELECT A.ISO_CODE, B.`date`, (B.hosp_patients - A.hosp_patients) AS delta_patients
  FROM Hospitals A INNER JOIN Hospitals B ON B.`date` = (A.`date` + 1)");
    } else {
    $sth = $bdd->query("SELECT A.ISO_CODE, B.`date`, (B.hosp_patients - A.hosp_patients) AS delta_patients FROM Hospitals A INNER JOIN Hospitals B ON B.`date` = (A.`date` + 1) WHERE A.ISO_CODE='" . $_POST["country_name"] . "' AND B.ISO_CODE='" . $_POST["country_name"] . "'");
    }
  }
  $time_end = microtime(true);
  $exec_time = $time_end - $time_start;
  $tmp_graph_array=array();
?>

<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/css_main.css">
<link rel="stylesheet" href="../css/gradient_animate.css">
<?php 
  if (isset($_POST["country_name"]) && $_POST["country_name"] != "nothing" && $_POST["country_name"] != "all"){
    echo "<link rel='stylesheet' href='../css/graph.css'>";
  }
 ?>
<link rel="icon" href="../img/Rickroll.jpg" />

<script>
  function change(){
      document.getElementById("select_form").submit();
  }
</script>

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
          <div class='title-db'>Request 5: <span class="phrase">Calculez l’évolution, pour chaque jour et chaque pays, du nombre de patients hospitalisés</span></div>
          <div class="hey" style="height: 450px;">
            <span class="choice-select">Country - <?php if (isset($_POST["country_name"])){echo $_POST["country_name"];} ?></span>
            <form action="#" method="post" accept-charset="utf-8" id="select_form"> 
              <select id="country_select" onchange="change()" name="country_name">
                  <option value="nothing">-Select country-</option>
                  <option value="all">All countries</option>
                  <?php 
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sth_crountries = $bdd->query("SELECT c.country, c.ISO_CODE FROM Country c");
                    foreach ($sth_crountries as $key => $value) {
                      echo "<option value='" . $value["ISO_CODE"] . "'>" . $value["country"] . "</option>";
                    }
                   ?>
              </select>
            </form>
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
                      foreach($tmp_array as $key=>$value) {
                          foreach($value as $k=>$v) {
                              if($k=="name") {
                                echo "<th>" . $v . "</th>";
                              }
                          }
                      }
                      echo "</tr></thead><tbody>";
                      $i_pos=0;
                      while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($row as $key => $value) {
                           echo "<td>" . $value . "</td>";
                        }                  
                        if (isset($_POST["country_name"]) && $_POST["country_name"] != "nothing" && $_POST["country_name"] != "all") {
                          array_push($tmp_graph_array, array("x" => $i_pos, "y" => $row["delta_patients"]));
                        }
                        $i_pos+=1;
                        echo "</tr>";
                      }    
                      echo "</tbody>";              
                    } 
                  }
                ?>
              </table>
            </div>
            <?php 
              if (isset($_POST["country_name"]) && $_POST["country_name"] != "nothing") {
                $dataPoints = $tmp_graph_array; 
              }         
            ?>
            <script>
              window.onload = function () {
               
              var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                animationEnabled: true,
                zoomEnabled: true,
                title: {
                  text: "Evolution du nombre de patient hospitalisé"
                },
                data: [{
                  type: "area",     
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
