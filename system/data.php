<?php

  function get_db_connection()
  {
    $db = mysqli_connect('localhost', '546281_2_1', 'z7bxtK0RT162', '546281_2_1')
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
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password';";
    return get_result($sql);
  }

  function register($email , $password){
    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password');";
		return get_result($sql);
	}



?>
