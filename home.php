<?php include ("header.php"); ?>

<?php
  session_start();
	if(!isset($_SESSION['user_ID'])){
		header("Location:index.php");
	}else{
  	$user_id = $_SESSION['user_ID'];
	}

	require_once("system/data.php");
	require_once("system/security.php");
	
	
	$post_list = get_reisen();
?>
<!--- oberer Teil immer einfügen ganz oben --->	
	

<html lang="en">
<head>
  <title>Hackathon HS16 - Bock auf Reisen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css" />
<link href="themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
<script src="js/star-rating.js" type="text/javascript"></script>
  
  <script>
	  $("#input-id").rating({min:1, max:10, step:1, size:'xs'});
	  </script>

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



<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
    </div>

    <div class="col-sm-8 text-left">




        <!-- Beitrag -->
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
	                  1
                    <p><?php echo $post['Beschreibung']; ?></p>


                  </div>
                  <div class="panel-footer text-right">
                    

<label for="input-1" class="control-label">Reise bewerten:</label>
<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">



                    
                    
                    
                                      </div>
                </div>
              </div><!-- /col-sm-10 -->
            </form>
          </div> <!-- /Beitrag -->
<?php   } ?>








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
