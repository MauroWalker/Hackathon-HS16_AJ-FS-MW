<?php
   session_start();
	if(!isset($_SESSION['user_ID'])){
		header("Location:index.php");
	}else{
  	$user_ID = $_SESSION['user_ID'];
	}

	require_once("system/data.php");
	require_once("system/security.php");
	
	
	$result = get_user($user_ID);
	$user = mysqli_fetch_assoc($result);
	$username = $user['username'];
	
	  $error_msg = "";
	
	
  	if(isset($_POST['add_new_trip-submit'])){
		if(!empty($_POST['Reiseziel']) && !empty($_POST['Beschreibung']) && !empty($_POST['Kosten']) && !empty($_POST['Region']) && !		empty($_POST['Dauer']) && !empty($_POST['Bildquelle']) && !empty($_POST['Ort']) && !empty($_POST['GA_benötigt']) && !empty($_POST['PLZ'])){
      $Reiseziel = filter_data($_POST['Reiseziel']);
      $Beschreibung = filter_data($_POST['Beschreibung']);
      $Kosten = filter_data($_POST['Kosten']);
      $Bildquelle = filter_data($_POST['Bildquelle']);
      $Dauer = filter_data($_POST['Dauer']);
      $PLZ = filter_data($_POST['PLZ']);
      $Ort = filter_data($_POST['Ort']);
      $GA_benötigt = filter_data($_POST['GA_benötigt']);
      $Region = filter_data($_POST['Region']);
	  $result = add_trip($Reiseziel, $Beschreibung, $Kosten, $Bildquelle, $Dauer, $PLZ, $Ort, $GA_benötigt, $Region, $username, $user_ID);  
	  header("Location: my_trips.php"); 
	  exit; 
	  
	  
	  
	  
	  
	  }else{
      $error_msg .= "Bitte füllen Sie alle Felder aus.</br>";
    }
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
  <script src="rangeSlider.js"></script>
  <link rel="stylesheet" href="rangeSlider.css">




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
      background-color: #ff0070;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #ff0070;
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
        output {
            display: block;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            width: 100%;
        }
        h5 {
	    text-align: center;
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


      <form enctype="multipart/form-data" action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="modal-header">
          <h4>Neue Reise Erfassen</h4>
        </div>
        <div class="container">

          <div class="form-group row">
            <div class="col-sm-5 col-xs-6">
              <input  type="hidden" class="form-control form-control-sm"
                      id="Reise_ID" placeholder="Reise_ID"
                      name="Reise_ID" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Reiseziel" class="col-sm-2 col-xs-4 form-control-label">Reiseziel</label>
            <div class="col-sm-4 col-xs-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Reiseziel" placeholder="Reiseziel"
                      name="Reiseziel" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Beschreibung" class="col-sm-2 form-control-label">Beschreibung</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Beschreibung" placeholder="Beschreibung"
                      name="Beschreibung" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Kosten" class="col-sm-2 form-control-label">Kosten</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Kosten" placeholder="Kosten"
                      name="Kosten" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Bildquelle" class="col-sm-2 form-control-label">Bildquelle</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Bildquelle" placeholder="Bildquelle"
                      name="Bildquelle" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Dauer" class="col-sm-2 form-control-label">Dauer</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Dauer" placeholder="Dauer"
                      name="Dauer" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="PLZ" class="col-sm-2 form-control-label">PLZ</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="PLZ" placeholder="Dauer"
                      name="PLZ" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Ort" class="col-sm-2 form-control-label">Ort</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Ort" placeholder="Ort"
                      name="Ort" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="GA_benötigt" class="col-sm-2 form-control-label">GA benötigt</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="GA_benötigt" placeholder="GA_benötigt"
                      name="GA_benötigt" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="Region" class="col-sm-2 form-control-label">Region</label>
            <div class="col-sm-4">
              <input  type="text" class="form-control form-control-sm"
                      id="Region" placeholder="Region"
                      name="Region" value="">
            </div>
          </div>

        </div>
        <div class="modal-footer">
	        <?php echo $error_msg?>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Abbrechen</button>
          <button type="submit" class="btn btn-success btn-sm" name="add_new_trip-submit">Reise speichern</button>
          
          
          
          
        </div>
      </form>
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
            <div class="col-sm-4">
              <input  type="email" class="form-control form-control-sm"
                      id="Email" placeholder="E-Mail"
                      name="email" value="<?php echo $user['email']; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="Passwort" class="col-sm-2 form-control-label">Password</label>
            <div class="col-sm-4">
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

</body>


</html>
