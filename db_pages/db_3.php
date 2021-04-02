<?php
  session_start();
  include("../src/secure.php");
  include("../src/profile.php");
  $profile_info = profile($_SESSION['id']);

  $time_start = microtime(true);
  include '../src/db_connect.php';
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sth = $bdd->query("SELECT v.name, p.ISO_CODE 
FROM Vaccines v 
LEFT JOIN Producers p
ON p.vaccine = v.ID;");
  $time_end = microtime(true);
  $exec_time = $time_end - $time_start;
?>

<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/css_main.css">
<link rel="stylesheet" href="../css/gradient_animate.css"
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
          <div class='title-db'>Request 3</div>
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
                      $tmp_array = array();
                      $current_vaccine;
                      $i = 0;
                      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($rows as $row) {
                        foreach ($row as $key => $value) {
                          if ($current_vaccine != $value && $i % 2 == 0) {
                            if ($i != 0) echo '</ul>';
                            $current_vaccine = $value;
                            echo '<b>' . $value . '</b>';
                            echo "<ul>";
                          }else{
                            if ($value != $current_vaccine) echo '<li>' . $value . '</li>';
                          }
                          $i += 1;
                        }
                      }
                    }
                  }
                ?>
              </table>
            </div>
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
