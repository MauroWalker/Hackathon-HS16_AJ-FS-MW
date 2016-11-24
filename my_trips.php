
<?php
  session_start();
	if(!isset($_SESSION['user_ID'])){
		header("Location:index.php");
	}else{
  	$user_ID = $_SESSION['user_ID'];
	}

	require_once("system/data.php");
	require_once("system/security.php");

  if(isset($_POST['delete_reise'])){
    $delete_reise = $_POST['delete_reise'];
    delete_reise($delete_reise);
  }

  $post_list = get_meine_reisen($user_ID);

  $result = get_user($user_ID);
	$user = mysqli_fetch_assoc($result);

  if(isset($_POST['update-submit'])){
    $email = filter_data($_POST['email']);
    $password = filter_data($_POST['password']);
    $confirm_password = filter_data($_POST['confirm_password']);
    $username = filter_data($_POST['username']);
    $plz = filter_data($_POST['ort']);
    $ort = filter_data($_POST['plz']);

    $result = update_user($user_ID, $email, $password, $confirm_password, $username, $plz, $ort);
  }

?>

<html lang="en">
<head>
  <title>Hackathon HS16 - Bock auf Reisen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
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
      background-color: #a0c1db;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #a0c1db;
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
  <?php include ("header.php"); ?>


<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <br>Eingeloggt als: </br>

      <b>
      <?php
      echo $user['username'];
      ?>
      </b><br>
      PLZ:
      <?php
      echo $user['plz'];
      ?>
    </div>

    <div class="col-sm-8 text-left">


      <?php   while($post = mysqli_fetch_assoc($post_list)) { ?>
        <div class="row">

          <form enctype="multipart/form-data" class="form-inline" method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>">
            <div class="col-xs-10">
              <div class="panel panel-default p42panel">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo $post['Reiseziel']; ?></h3>
                </div>
                <div class="panel-body">
                  <?php if($post['Bildquelle'] != NULL){  ?>
                    <img src="reisen_img/<?php echo $post['Bildquelle']; ?>" alt="postimage" class="img-responsive">
                  <?php } ?>
                  <p><?php echo $post['Beschreibung']; ?></p>
                  <input type="button" value="Reise ändern" onclick="window.location.href='change_reise.php?Reise_ID=<?php echo $post['Reise_ID']; ?>';">
                  <button type="submit" class="" name="delete_reise" value="<?php echo $post['Reise_ID']; ?>">
                    <span aria-hidden="true">Reise Löschen</span>
                  </button>

                </div>
              </div>
            </div>
          </form>
          </div>

        <?php } ?>



    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <img src="bfh.gif" class="img-responsive" alt="">
      </div>
      <div class="well">
        <img src="htw.jpg" class="img-responsive" alt="">
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Profileinstellungen der UserID#<?PHP echo $user_ID?></h4>
          </div>
          <div class="modal-body">

            <div class="form-group row">
              <label for="Username" class="col-sm-2 col-xs-12 form-control-label">Username</label>
              <div class="col-sm-5 col-xs-6">
                <input  type="text" class="form-control form-control-sm"
                        id="username" placeholder="Username"
                        name="username" value="<?php echo $user['username']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="Email" class="col-sm-2 form-control-label">E-Mail</label>
              <div class="col-sm-10">
                <input  type="email" class="form-control form-control-sm"
                        id="Email" placeholder="E-Mail"
                        name="email" value="<?php echo $user['email']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="Passwort" class="col-sm-2 form-control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control form-control-sm" id="Passwort" placeholder="Passwort" name="password">
              </div>
            </div>
            <div class="form-group row">
              <label for="Passwort_Conf" class="col-sm-2 form-control-label">Passwort bestätigen</label>
              <div class="col-sm-10">
                <input type="password" class="form-control form-control-sm" id="Passwort_Conf" placeholder="Passwort" name="confirm_password">
              </div>
            </div>


                    <div class="form-group row">
              <label for="Passwort_Conf" class="col-sm-2 form-control-label">PLZ</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="plz1" placeholder="PLZ" name="plz" value="<?php echo $user['plz']; ?>">
              </div>
            </div>
          </div>

                    <div class="form-group row">
              <label for="Passwort_Conf" class="col-sm-2 form-control-label">Ort</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="ort1" placeholder="Ort" name="ort" value="<?php echo $user['ort']; ?>"
              </div>
            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Abbrechen</button>
            <button type="submit" class="btn btn-success btn-sm" name="update-submit">Änderungen speichern</button>
          </div>
        </form>
  </div>
      </div>
    </div>
  </div>
  <!-- Modal -->



</div>

<?php include ("footer.php"); ?>

</html>
