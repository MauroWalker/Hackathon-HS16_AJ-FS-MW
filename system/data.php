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



?>
