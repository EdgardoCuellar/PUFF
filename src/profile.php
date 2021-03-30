<?php

  	function profile($id){
	    $bdd = new PDO('mysql:host=127.0.0.1;dbname=Puff', 'root', '');
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
