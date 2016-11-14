<?php

  function get_db_connection()
  {
    $db = mysqli_connect('localhost', '260978_3_1', 'gQZTGEbRdq8s', '260978_3_1')
      or die('Fehler beim Verbinden mit dem Datenbank-Server.');
      mysqli_set_charset($db, "utf8");
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

  function login($email, $password)
  {
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password';";
    return get_result($sql);
  }

  function register($email , $password, $confirm_password, $email, $plz, $ort, $ga){
    $sql = "INSERT INTO user (username, password, confirm_password, email, plz, ort, ga) VALUES ('$username', '$password', '$password_confirm' , '$email', "$plz", "$ort", $ga");";
		return get_result($sql);
	}



?>
