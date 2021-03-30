<?php
    session_start();

    function register($first_name, $last_name, $username, $password, $address, $isEpidemiologist, $center, $phone){
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=Puff', 'root', '');
        
        $username   = htmlspecialchars($username);
        $password   = sha1($password);
        $last_name  = htmlspecialchars($last_name);
        $first_name = htmlspecialchars($first_name);
        $address    = htmlspecialchars($address);
        $center     = htmlspecialchars($center);
        $phone      = htmlspecialchars($phone);
        
        if (isset($username) && isset($password) && isset($last_name) && isset($first_name) && isset($address)) {
            $req_username = $bdd->prepare('SELECT * FROM User WHERE username = ? LIMIT 1');
            $req_username->execute(array($username));
            $user_exist = $req_username->rowCount();
            if ($user_exist == 0) {
                $req_register = $bdd->prepare("INSERT INTO User(last_name, first_name, username, password, address, isEpidemiologist) VALUES(?, ?, ?, ?, ?, ?)");
                $status = $req_register->execute(array($last_name, $first_name, $username, $password, $address, isset($isEpidemiologist)));
                if(!empty($isEpidemiologist)){
                    if (isset($center) && isset($phone)) {
                        # Get id of user created
                        $req_id_user = $bdd->prepare("SELECT ID FROM User WHERE username = ?");
                        $req_id_user->execute(array($username));
                        $id = $req_id_user->fetch();
                        error_log("ID:", $id);
                        # Insert the epidemiologist in db
                        $req_register_epi = $bdd->prepare("INSERT INTO Epidemiologist(ID_USER, phone, centre) VALUES(?, ?, ?)");
                        $status_epi = $req_register_epi->execute(array($id[0], $center, $phone));
                        if ($status_epi) error_log("Epidemiologiste ajouté");
                    }else{
                        $res = "All fields must me complete for epidemiologist";
                    }
                }
                if ($status){ # l'insertion à fonctionné
                    $res = "Ok t'es inscrit";
                }
            }else{
                $res= "Username already exist";
            }
        }else{
            $res = "All fields must be complete";
        }
        return $res;
    }

    if (isset($_POST['submit_register'])) {
        $res = register($_POST["firstname"], $_POST["name"], $_POST["username"], $_POST["password"], $_POST["address"], $_POST["isEpidemiologist"], $_POST["center"], $_POST["phone"]);
        header('Location: ../db_main.php?');
    }
?>