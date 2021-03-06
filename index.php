<!DOCTYPE html>
<html>
<title>PUFF DB</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/css_login.css">
<link rel="stylesheet" href="css/gradient_animate.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
<link rel="icon" href="img/Rickroll.jpg" />

<script>
  function displayCheck() {
    var checkBox = document.getElementById("myCheck");
    if (checkBox.checked == true){
        document.getElementById("options1").style.opacity = 1;
        document.getElementById("options2").style.opacity = 1;
      } else {
        document.getElementById("options1").style.opacity = 0.4;
        document.getElementById("options2").style.opacity = 0.4;
      }
    }
</script>

<body>
  <div class="register-div" id="register">
    <div class='-line'></div>
        <div class='window'>
          <div class='overlay'></div>
          <div class='content'>
            <div class='welcome'>CoviDB</div>
            <div class='input-fields'>
              <form action="src/register.php" method="post" accept-charset="utf-8">
                <input type='text' placeholder='Last name' class='input-line full-width' name="name" autocomplete="off"></input>
                <input type='text' placeholder='First name' class='input-line full-width' name="firstname" autocomplete="off"></input>
                <input type='text' placeholder='Username' class='input-line full-width' name="username" autocomplete="off"></input>
                <input type='text' placeholder='Address' class='input-line full-width' name="address" autocomplete="off"></input>
                <input type='password' placeholder='Password' class='input-line full-width' name="password" autocomplete="off"></input>
                <label class="container"><span class="checkspan">Epidémiologiste</span>
                  <input type="checkbox" name="isEpidemiologist" value="Y" id="myCheck" onclick="displayCheck()">
                  <span class="checkmark"></span>
                </label>
                <input type='text' placeholder='Center' class='input-line full-width' id="options1" name="center" autocomplete="off"></input>
                <input type='text' placeholder='Phone' class='input-line full-width' id="options2" name="phone" autocomplete="off"></input>
                <div><button class='register-btn full-width' type="submit" name="submit_register" value="Submit">Register</button></div>
              </form>
            </div>
          <span class='error-txt'><?php 
            if  (isset($_GET["error_msg"])) {
              echo $_GET["error_msg"]; 
            }
          ?></span>
      </div>
    </div>
    <div><a href="#login" class="goto">↓ Go to login ↓</a></div>
  </div>
  <div class="login-div" id="login">
    <div><a href="#register" class="goto">↑ Go to register ↑</a></div>
    <div class='-line'></div>
        <div class='window'>
          <div class='overlay'></div>
          <div class='content'>
            <div class='welcome'>CoviDB</div>
            <div class='input-fields'>
              <form action="src/login.php" method="post" accept-charset="utf-8">
                <input type='text' placeholder='Username' class='input-line full-width' name="username"></input>
                <input type='password' placeholder='Password' class='input-line full-width' name="password"></input>
                <div><button class='register-btn full-width' type="submit" name="submit_login" value="Submit">login</button></div>
              </form>
            </div>
          <span class='error-txt'><?php 
            if (isset($_GET["error_msg"])) {
              echo $_GET["error_msg"]; 
            }
          ?></span>
      </div>
    </div>
  </div>
</body>
</html>
