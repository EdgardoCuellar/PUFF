<?php
    session_start();

    function login($username, $password){
        include 'db_connect.php';
        
        $username = htmlspecialchars($username);
        if (!empty($username) && !empty($password)) {
            $req_login = $bdd->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
            $req_login->execute(array($username));
            $user_exist = $req_login->rowCount();
            $user_info  = $req_login->fetch();
            if ($user_exist == 1) {
                $compte = $username;
                if (sha1($password) == $user_info['password']) {
                    $_SESSION['id'] = $user_info['ID'];
                    $res = "ok";
                }else{
                    $res = "Wrong password";
                }
            }else{
                $res= "User doesn't exist";
            }
        }else{
            $res = "All fields must be complete";
        }
        return $res;
    }

    if (isset($_POST['submit_login'])) {
        $res = login($_POST['username'], $_POST['password']);
        if ($res=="ok") {
            header('Location: ../db_main.php#');
        } else { 
            error_log($res);
            header('Location: ../index.php?error_msg='.$res.'#login');
        }
    }
?>
