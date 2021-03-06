<?php
  session_start();
  if(isset($_SESSION['id'])) unset($_SESSION['user_ID']);
  session_destroy();

  require_once('system/data.php');
  require_once('system/security.php');

  $error = false;
  $error_msg = "";
  $success = false;
  $success_msg = "";


  if(isset($_POST['login-submit'])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
      $username = filter_data($_POST['username']);
      $password = filter_data($_POST['password']);

      $result = login($username,$password);

  		$row_count = mysqli_num_rows($result);
      if( $row_count == 1){
        session_start();
        $username = mysqli_fetch_assoc($result);
        $_SESSION['user_ID'] = $username['user_ID'];
        header("Location:home.php");
      }else{
        // Fehlermeldungen werden erst später angezeigt
        $error = true;
        $error_msg .= "Leider konnte wir Ihre E-Mailadresse oder Ihr Passwort nicht finden.</br>";
      }
    }else{
      $error = true;
      $error_msg .= "Bitte füllen Sie beide Felder aus.</br>";
    }
  }

  if(isset($_POST['register-submit'])){
    if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']) && !empty($_POST['plz']) && !empty($_POST['ort'])){
        $username = filter_data($_POST['username']);
        $password = filter_data($_POST['password']);
        $password_confirm = filter_data($_POST['password_confirm']);
        $email = filter_data($_POST['email']);
        $plz = filter_data($_POST['plz']);
        $ort = filter_data($_POST['ort']);

      if($password == $password_confirm){
        // register liefert bei erfolgreichem Eintrag in die DB den Wert TRUE zurück, andernfalls FALSE
        $result = register($username, $password, $email, $plz, $ort);
        if($result){
          $success = true;
          $success_msg = "Sie haben erfolgreich registriert.</br>
          Bitte loggen Sie sich jetzt ein.</br>";
        }else{
          $error = true;
          $error_msg .= "Es gibt ein Problem mit der Datenbankverbindung.</br>";
        }
      }else{
        $error = true;
        $error_msg .= "Die Passwörter stimmen nicht überein.</br>";
      }
    }else{
      $error = true;
      $error_msg .= "Bitte füllen Sie alle Felder aus.</br>";
    }
  }




?>

<!DOCTYPE html>

<html lang="en">
<head>
    <title>Hackathon HS16 - Bock auf Reisen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript">
</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript">
</script>
    <style type="text/css">
/* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">Bock auf Reisen</a>
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row content">
            <!--- Login Formular =-->

            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">Login</a>
                            </div>

                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">Registrieren</a>
                            </div>
                        </div>
                        <hr>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="index.php" method="post" role="form" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Passwort">
                                    </div>

                                    <div class="form-group text-center">
                                        <input type="checkbox" tabindex="3" class="" name="remember" id="remember"> <label for="remember">Eingeloggt bleiben</label>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="" tabindex="5" class="forgot-password">Passwort vergessen?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form id="register-form" action="index.php" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Passwort">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password_confirm" id="password_confirm" tabindex="2" class="form-control" placeholder="Passwort bestätigen">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email-Addresse" value="">
                                    </div>

                                        <div class="form-group">
                                            <input type="text" name="plz" id="plz" tabindex="2" class="form-control" placeholder="PLZ">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="ort" id="ort" tabindex="2" class="form-control" placeholder="Ort">
                                        </div>



                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrieren" action="register">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><script type="text/javascript">
$(function() {

                $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
                });
                $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
                });

                });
            </script> <!--- Login Formular =-->

            <?php
    // Gibt es einen Erfolg zu vermelden?
    if($success == true){
  ?>
      <div class="alert alert-success" role="alert"><?php echo $success_msg; ?></div>
  <?php
    }   // schliessen von if($success == true)
    // Gibt es einen Fehler?
    if($error == true){
  ?>
      <div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
  <?php
    }   // schliessen von if($success == true)
  ?>



        </div>
    </div>


    <?php include ("footer.php"); ?>
</body>
</html>
