<?php
  session_start();
  include("src/secure.php");
  $profile_info = profile($_SESSION['id']);

?>

<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/css_main.css">
<link rel="stylesheet" href="css/gradient_animate.css">

<body>
  <div class="main">
    <div class='window'>
      <div class='overlay'></div>
      <div class="profile">
        <span class="user-name"> <?php echo $profile_info["username"]; ?> </span>
        <span class="user-type">Epidemiologiste</span>
        <br><hr>
        <span class="user-info">Les requettes possibles sont:</span>
          <span class="infos-liste">Select</span>
          <span class="infos-liste">Insert</span>
          <span class="infos-liste">Delete</span>
          <span class="infos-liste">Update</span>
        <button class='disconnect-btn' type="submit" value="Submit">Logout</button>
      </div>
        <div class='content'>
          <div class='title-db'>Main</div>
          <div class='input-fields'>
            <form action="hehe" method="post" accept-charset="utf-8">
              <input type='text' placeholder='Request' class='input-line' name="username"></input>
              <INPUT type="image" src="img/send.png" value="" class="btn-send" ></INPUT>
            </form>
          </div>
          <div class="hey">
            <div class="text-response">500 results in 0.25 sec</div>
            <div class="request-response">
              <table>
                <thead>
                  <tr>
                    <th>ISO</th>
                    <th>Pays</th>
                    <th>Climat</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                  <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    <div class="nav-bar">
      <a href="db_main.html" class="nav-btn">M</a>
      <a href="db_pages/db_1.html"  class="nav-btn">1</a>
      <a href="db_pages/db_2.html"  class="nav-btn">2</a>
      <a href="db_pages/db_3.html"  class="nav-btn">3</a>
      <a href="db_pages/db_4.html"  class="nav-btn">4</a>
      <a href="db_pages/db_5.html"  class="nav-btn">5</a>
      <a href="db_pages/db_6.html"  class="nav-btn">6</a>
    </div>
  </div>
</body>
</html>
