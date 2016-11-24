
<?php
  session_start();
	if(!isset($_SESSION['user_ID'])){
		header("Location:index.php");
	}else{
  	$user_ID = $_SESSION['user_ID'];
	}

	require_once("system/data.php");
	require_once("system/security.php");

  /* Reise ändern */

    $Reise_ID = $_GET['Reise_ID'];

  	if(isset($_POST['update-submit'])){
      $Reiseziel = filter_data($_POST['Reiseziel']);
      $Beschreibung = filter_data($_POST['Beschreibung']);
      $Kosten = filter_data($_POST['Kosten']);
      $Bildquelle = filter_data($_POST['Bildquelle']);
      $Dauer = filter_data($_POST['Dauer']);
      $PLZ = filter_data($_POST['PLZ']);
      $Ort = filter_data($_POST['Ort']);
      $GA_benötigt = filter_data($_POST['GA_benötigt']);
      $Region = filter_data($_POST['Region']);

      $result = change_reise($Reise_ID, $Reiseziel, $Beschreibung, $Kosten, $Bildquelle, $Dauer, $PLZ, $Ort, $GA_benötigt, $Region);
    }

  // Abfrage der Reisedaten
  $result = get_reise($Reise_ID);
  $reise = mysqli_fetch_assoc($result);
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
  <?php include ("header.php"); ?>


<div class="container-fluid text-center">
  <div class="row content">

    <div class="col-sm-2 sidenav hidden-xs">
    </div>

    <div class="col-sm-8 text-left">
      <div class="form-group" id="change_reise">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form enctype="multipart/form-data" method="post">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Reiseeinstellungen der ReiseID#<?PHP echo $reise['Reise_ID']; ?></h4>
              </div>
              <div class="modal-body">

                <div class="form-group row">
                  <label for="Reiseziel" class="col-sm-2 col-xs-12 form-control-label">Reiseziel</label>
                  <div class="col-sm-5 col-xs-6">
                    <input  type="text" class="form-control form-control-sm"
                            id="Reiseziel" placeholder="Reiseziel"
                            name="Reiseziel" value="<?php echo $reise['Reiseziel']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Beschreibung" class="col-sm-2 form-control-label">Beschreibung</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Beschreibung" placeholder="Beschreibung"
                            name="Beschreibung" value="<?php echo $reise['Beschreibung']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Kosten" class="col-sm-2 form-control-label">Kosten</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Kosten" placeholder="Kosten"
                            name="Kosten" value="<?php echo $reise['Kosten']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Bildquelle" class="col-sm-2 form-control-label">Bildquelle</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Bildquelle" placeholder="Bildquelle"
                            name="Bildquelle" value="<?php echo $reise['Bildquelle']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Dauer" class="col-sm-2 form-control-label">Dauer</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Dauer" placeholder="Dauer"
                            name="Dauer" value="<?php echo $reise['Dauer']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="PLZ" class="col-sm-2 form-control-label">PLZ</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="PLZ" placeholder="Dauer"
                            name="PLZ" value="<?php echo $reise['PLZ']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Ort" class="col-sm-2 form-control-label">Ort</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Ort" placeholder="Ort"
                            name="Ort" value="<?php echo $reise['Ort']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="GA_benötigt" class="col-sm-2 form-control-label">GA benötigt</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="GA_benötigt" placeholder="GA_benötigt"
                            name="GA_benötigt" value="<?php echo $reise['GA_benötigt']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="Region" class="col-sm-2 form-control-label">Region</label>
                  <div class="col-sm-10">
                    <input  type="text" class="form-control form-control-sm"
                            id="Region" placeholder="Region"
                            name="Region" value="<?php echo $reise['Region']; ?>">
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <a href="my_trips.php" class="btn btn-danger btn-sm" role="button">Abbrechen</a>
                <button type="submit" class="btn btn-success btn-sm" name="update-submit">Änderungen speichern</button>
              </div>
            </form>
            </div>
          </div>
      </div>
    </div>

    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Ads</p>
      </div>
      <div class="well">
        <p>Ads</p>
      </div>
    </div>
  </div>

</div>


<?php include ("footer.php"); ?>

</html>
