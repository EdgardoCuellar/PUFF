<?php
  session_start();
  include("../src/secure.php");
  include("../src/profile.php");
  $profile_info = profile($_SESSION['id']);

?>

<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/css_main.css">
<link rel="stylesheet" href="../css/gradient_animate.css">

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
        <button class='disconnect-btn' type="submit" value="Submit">Logout</button>
      </div>
        <div class='content'>
          <div class='title-db'>Request 1</div>
          <div class="hey">
            <div class="text-response">500 results in 0.25 sec</div>
            <div class="request-response">
              <table>
                <thead>
                  <tr>
                    <th>iso-code</th>
                    <th>continent</th>
                    <th>region</th>
                    <th>country</th>
                    <th>hdi</th>
                    <th>population</th>
                    <th>area_sq_ml</th>
                    <th>climate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>AFG</td>
                    <td>Asia</td>
                    <td>ASIA (EX. NEAR EAST)</td>
                    <td>Afghanistan</td>
                    <td>0.498</td>
                    <td>31056997</td>
                    <td>647500</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>AFG</td>
                    <td>Asia</td>
                    <td>ASIA (EX. NEAR EAST)</td>
                    <td>Afghanistan</td>
                    <td>0.498</td>
                    <td>31056997</td>
                    <td>647500</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <td>AFG</td>
                    <td>Asia</td>
                    <td>ASIA (EX. NEAR EAST)</td>
                    <td>Afghanistan</td>
                    <td>0.498</td>
                    <td>31056997</td>
                    <td>647500</td>
                    <td>1</td>
                  </tr>
                </tbody>
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