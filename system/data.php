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

	function register($username , $password, $email, $plz, $ort){
    $sql = "INSERT INTO Users (username, password, email, plz, ort) VALUES ('$username', '$password', '$email', '$plz', '$ort');";
		return get_result($sql);
	}
	/* *********************************************************
	/* home.php
	/* ****************************************************** */

	function get_reisen(){
    $sql = "SELECT * FROM Reisen";
		return get_result($sql);
	}

	
	function get_custom_reisen($plz_min, $plz_max){		 	
    $sql = "SELECT * FROM Reisen WHERE PLZ BETWEEN '".$plz_min."' AND '".$plz_max."'";
		return get_result($sql);
	}


	function get_username($user_id){
    $sql = "SELECT username FROM Users WHERE user_ID = '".$user_id."'";
		return get_result($sql);
	}

	function write_comment($users_comment, $users_name, $comment_username, $reise_id){
		$query = "INSERT INTO Kommentare (Kommentar, user_ID, username, Reise_ID) VALUES ('$users_comment', '$users_name', '$comment_username', '$reise_id');";
	  return get_result($query);

	}

	function get_comment(){
		$sql = "SELECT * FROM Kommentare";
		return get_result($sql);
	}

	function get_comment_reise($reise_id){
		$sql = "SELECT Kommentar FROM Kommentare WHERE reise_ID = '".$reise_id."'";
		return get_result($sql);
	}

	function get_comment_username($reise_id){
		$sql = "SELECT username FROM Kommentare WHERE reise_ID = '".$reise_id."'";
		return get_result($sql);
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
		$sql = "SELECT * FROM Reisen r LEFT JOIN Users u USING(user_ID) WHERE r.user_ID = '$user_ID' ORDER BY r.Likes;";
		return get_result($sql);
	}

	function delete_reise($Reise_ID){
		$sql = "DELETE FROM Reisen WHERE Reise_ID = '$Reise_ID'";;
		return get_result($sql);

	}


	function change_reise($Reise_ID, $Reiseziel, $Beschreibung, $Kosten, $Bildquelle, $Dauer, $PLZ, $Ort, $GA_benötigt, $Region){
  	$sql_ok = false;
  	$sql = "UPDATE Reisen SET ";
    if($Reiseziel != ""){
      $sql .= "Reiseziel = '$Reiseziel', ";
  		$sql_ok = true;
    }
		if($Beschreibung != ""){
			$sql .= "Beschreibung = '$Beschreibung', ";
			$sql_ok = true;
		}
		if($Kosten != ""){
			$sql .= "Kosten = '$Kosten', ";
			$sql_ok = true;
		}
		if($Bildquelle != ""){
			$sql .= "Bildquelle = '$Bildquelle', ";
			$sql_ok = true;
		}
		if($Dauer != ""){
			$sql .= "Dauer = '$Dauer', ";
			$sql_ok = true;
		}
		if($PLZ != ""){
			$sql .= "PLZ = '$PLZ', ";
			$sql_ok = true;
		}
		if($Ort != ""){
			$sql .= "Ort = '$Ort', ";
			$sql_ok = true;
		}
		if($GA_benötigt != ""){
			$sql .= "GA_benötigt = '$GA_benötigt', ";
			$sql_ok = true;
		}
		if($Region != ""){
			$sql .= "Region = '$Region', ";
			$sql_ok = true;
		}
    // Das Komma an der vorletzten Position des $sql-Strings durch ein Leerzeichen ersetzen
    $sql = substr_replace($sql, ' ', -2, 1);

    // $sql-String vervollständigen
    $sql .= " WHERE Reise_ID = $Reise_ID;";

  	if($sql_ok){
  	  return get_result($sql);
  	}else{
  		return false;
  	}
  }

?>
