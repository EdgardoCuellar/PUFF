<?php

  	function profile($id){
		include 'db_connect.php';
	    if (isset($id)) {
	        $req_login = $bdd->prepare('SELECT * FROM User WHERE ID = ? LIMIT 1');
	        $req_login->execute(array($id));
	        $user_info  = $req_login->fetch();
	    }else{
	        $user_info = "Error";
	    }
	    return $user_info;
	}
?>
