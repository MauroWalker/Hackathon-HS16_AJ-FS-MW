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

	function get_username($user_id){
    $sql = "SELECT username FROM Users WHERE user_ID = '".$user_id."'";
		// echo $sql;
		return get_result($sql);
	}

	function write_comment($users_comment, $users_name, $reise_id){
		$query = "INSERT INTO Kommentare (Kommentar, user_ID, Reise_ID) VALUES ('$users_comment', '$users_name', $reise_id);";
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

?>
