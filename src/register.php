<?php
    session_start();
    
    function register($first_name, $last_name, $username, $password, $address, $isEpidemiologist, $center, $phone){
        include 'db_connect.php';
        
        if (!empty($username) && !empty($password) && !empty($last_name) && !empty($first_name) && !empty($address)) {
            
            $is_a_epidemiologist = 0;
            if ($isEpidemiologist == "Y"){
                if (!empty($center) && !empty($phone)) {
                    $is_a_epidemiologist = 1;
                    $center     = htmlspecialchars($center);
                    $phone      = htmlspecialchars($phone);
                }else{
                    return "All fields must me complete for epidemiologist";
                }
            }    
            
            $first_name = htmlspecialchars($first_name);
            $last_name  = htmlspecialchars($last_name);
            $username   = htmlspecialchars($username);
            $password   = sha1($password);
            $address    = htmlspecialchars($address);
            
            $req_username = $bdd->prepare('SELECT DISTINCT * FROM User WHERE username = ?');
            $req_username->execute(array($username));
            $user_exist = $req_username->rowCount();
            
            if ($user_exist == 0) {
                $status = $bdd->exec("INSERT INTO User(last_name, first_name, username, password, address, isEpidemiologist) VALUES('".$last_name."', '".$first_name."', '".$username."', '".$password."', '".$address."', " . $is_a_epidemiologist . ")");
                if ($status) {
                    $res = "ok";
                    # Get id of user created
                    $req_id_user = $bdd->prepare("SELECT ID FROM User WHERE username = ?");
                    $req_id_user->execute(array($username));
                    $id = $req_id_user->fetch();
                    $_SESSION['id'] = intval($id[0]);
                    error_log("la requete a fonctionné");
                    if($is_a_epidemiologist){
                        # Insert the epidemiologist in db
                        $req_register_epi = $bdd->prepare("INSERT INTO Epidemiologist(ID_USER, phone, centre) VALUES(?, ?, ?)");
                        $status_epi = $req_register_epi->execute(array($id[0], $center, $phone));
                        if ($status_epi) error_log("Epidemiologiste ajouté");
                        if ($status){ # l'insertion à fonctionné
                            $res = "ok";
                        }
                        error_log($res);
                    }
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
        if ($res=="ok") {
            header('Location: ../db_main.php');
        } else { 
            error_log($res);
            header('Location: ../index.php?error_msg='.$res.'#register');
        }
    }

    ?>