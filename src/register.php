<?php
session_start();
function register($first_name, $last_name, $username, $password, $isEpidemiologist, $address){
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=Puff', 'puff-user', 'salade2fruit');
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    if (isset($username) && isset($password)) {
        $req_login = $bdd->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
        $req_login->execute(array($username));
        $user_exist = $req_login->rowCount();
        $user_info  = $req_login->fetch();
        if ($user_exist == 1) {
            $compte = $username;
            if (sha1($password) == $user_info['password']) {
                $_SESSION['id'] = $user_info['ID'];
                $res = "Ok t'es co";
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

?>