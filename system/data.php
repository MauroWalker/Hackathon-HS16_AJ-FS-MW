<?php

	function get_db_connection()
	{
    $db = mysqli_connect('localhost', '260978_3_1', 'gQZTGEbRdq8s', '260978_3_1')
      or die('Fehler beim Verbinden mit dem Datenbank-Server.');
  		mysqli_query($db, "SET NAMES 'utf8'");
		return $db;
	}

  function get_result($sql)
  {
    $db = get_db_connection();
    // echo $sql;
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
  }
?>

<?php
	/* *********************************************************
	/* Login index.php
	/* ****************************************************** */

	function login($username , $password){
		$sql = "SELECT * FROM Users WHERE username = '".$username."' AND password = '".$password."';";
		return get_result($sql);
	}
<<<<<<< HEAD
	?>

=======
>>>>>>> f7483a5ff7261cf6911508a5191a1717042df105

	function register($username , $password, $email, $plz, $ort){
    $sql = "INSERT INTO Users (username, password, email, plz, ort) VALUES ('$username', '$password', '$email', '$plz', '$ort');";
		return get_result($sql);
	}
<<<<<<< HEAD

	?>

	<?php
=======
>>>>>>> f7483a5ff7261cf6911508a5191a1717042df105
	/* *********************************************************
	/* home.php
	/* ****************************************************** */

	function get_reisen(){
    $sql = "SELECT * FROM Reisen";
		return get_result($sql);
	}

<<<<<<< HEAD
	function reise_like(){
	    $sql = "INSERT INTO Reisen (Likes, Geliked_Von) VALUES ('+1', '$username');";
	    echo "hallo";
		return get_result($sql);
=======
	function write_comment($users_comment, $users_name, $reise_id){
		$query = "INSERT INTO Kommentare (Kommentar, Name, reise_id) VALUES ('$users_comment', '$users_name', $reise_id);";
	  return get_result($query);
>>>>>>> f7483a5ff7261cf6911508a5191a1717042df105
	}
//	function comment($posttext, $owner, $image){
//    $sql = "INSERT INTO Kommentare (Kommentar, Zeit) VALUES ('$posttext', '$owner');";
//		return get_result($sql);
//	}

	/* *********************************************************
	/* Einstellungen
	/* ****************************************************** */

	function get_user($user_ID){
    $sql = "SELECT * FROM Users WHERE user_ID = $user_ID;";
		return get_result($sql);
	}

  function update_user($user_ID, $email, $password, $confirm_password, $username){
  	$sql_ok = false;
  	$sql = "UPDATE Users SET ";
  	if($email != ""){
  		$sql .= "email = '$email', ";
  		$sql_ok = true;
    }
    if($password != "" && $password == $confirm_password) {
      $sql .= "password = '$password', ";
  		$sql_ok = true;
    }
    if($username != ""){
      $sql .= "username = '$username', ";
  		$sql_ok = true;
    }
    // Das Komma an der vorletzten Position des $sql-Strings durch ein Leerzeichen ersetzen
    $sql = substr_replace($sql, ' ', -2, 1);

    // $sql-String vervollständigen
    $sql .= " WHERE user_ID = $user_ID ;";

  	if($sql_ok){
  	  return get_result($sql);
  	}else{
  		return false;
  	}
  }


	function get_meine_reisen($user_ID){
    $sql = "SELECT * FROM Reisen r, Users u WHERE r.user_ID = '$user_ID' ORDER BY r.Likes;";
		return get_result($sql);
	}


?>
