<?php
   session_start();
	if(!isset($_SESSION['user_ID'])){
		header("Location:index.php");
	}else{
  	$user_ID = $_SESSION['user_ID'];
	}

	require_once("system/data.php");
	require_once("system/security.php");

if(isset($_POST['comment-submit'])){
  $users_comment = $_POST['comment'];
  $users_name = $_POST['name'];
  $reise_id = $_POST['articleid'];

  // $users_comment = mysql_real_escape_string($users_comment);
  // $users_name = mysql_real_escape_string($users_name);

  write_comment($users_comment, $users_name, $reise_id);


}


	$post_list = get_reisen();
	
/* Profileinstellungen */

	// Abfrage der Userdaten
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
    	
/* Profileinstellungen */	
	
	
?>
<!--- oberer Teil immer einfügen ganz oben --->

<!--- Kommentieren --->


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

	
	<div>

<div>
    <h5>Minimale Reisedistanz</h5>
    <input type="range" value="0" max="450" step="10" data-rangeSlider>
    <output>km</output>
    <input type="submit" name="range-submit" id="range-submit" tabindex="4" class="form-control btn btn-login" value="Reisevorschläge aktualisieren"> 
</div>

<br>
<br>

<script>
    (function () {

        var selector = '[data-rangeSlider]',
                elements = document.querySelectorAll(selector);

        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value,
                    output = element.parentNode.getElementsByTagName('output')[0];
            output.innerHTML = value + " km";
        }

        for (var i = elements.length - 1; i >= 0; i--) {
            valueOutput(elements[i]);
        }

        Array.prototype.slice.call(document.querySelectorAll('input[type="range"]')).forEach(function (el) {
            el.addEventListener('input', function (e) {
                valueOutput(e.target);
            }, false);
        });


        // Example functionality to demonstrate disabled functionality
        var toggleBtnDisable = document.querySelector('#js-example-disabled button[data-behaviour="toggle"]');
        toggleBtnDisable.addEventListener('click', function (e) {
            var inputRange = toggleBtnDisable.parentNode.querySelector('input[type="range"]');
            console.log(inputRange);
            if (inputRange.disabled) {
                inputRange.disabled = false;
            }
            else {
                inputRange.disabled = true;
            }
            inputRange.rangeSlider.update();
        }, false);

        // Example functionality to demonstrate programmatic value changes
        var changeValBtn = document.querySelector('#js-example-change-value button');
        changeValBtn.addEventListener('click', function (e) {
            var inputRange = changeValBtn.parentNode.querySelector('input[type="range"]'),
                    value = changeValBtn.parentNode.querySelector('input[type="number"]').value;

            inputRange.value = value;
            inputRange.dispatchEvent(new Event('change'));
        }, false);

        // Example functionality to demonstrate programmatic buffer set
        var stBufferBtn = document.querySelector('#js-example-buffer-set button');
        stBufferBtn.addEventListener('click', function (e) {
            var inputRange = stBufferBtn.parentNode.querySelector('input[type="range"]'),
                    value = stBufferBtn.parentNode.querySelector('input[type="number"]').value;

            inputRange.rangeSlider.update({buffer: value});
        }, false);

        // Example functionality to demonstrate destroy functionality
        var destroyBtn = document.querySelector('#js-example-destroy button[data-behaviour="destroy"]');
        destroyBtn.addEventListener('click', function (e) {
            var inputRange = destroyBtn.parentNode.querySelector('input[type="range"]');
            console.log(inputRange);
            inputRange.rangeSlider.destroy();
        }, false);

        var initBtn = document.querySelector('#js-example-destroy button[data-behaviour="initialize"]');

        initBtn.addEventListener('click', function (e) {
            var inputRange = initBtn.parentNode.querySelector('input[type="range"]');
            rangeSlider.create(inputRange, {});
        }, false);

        //update range
        var updateBtn1 = document.querySelector('#js-example-update-range button');
        updateBtn1.addEventListener('click', function (e) {
            var inputRange = updateBtn1.parentNode.querySelector('input[type="range"]');
            inputRange.rangeSlider.update({min: 0, max: 20, step: 0.5, value: 1.5, buffer: 70});
        }, false);


        var toggleBtn = document.querySelector('#js-example-hidden button[data-behaviour="toggle"]');
        toggleBtn.addEventListener('click', function (e) {
            var container = e.target.previousElementSibling;
            if (container.style.cssText.match(/display[\s:]{1,3}none/)) {
                container.style.cssText = '';
            } else {
                container.style.cssText = 'display: none;';
            }
        }, false);

        // Basic rangeSlider initialization
        rangeSlider.create(elements, {

            // Callback function
            onInit: function () {
            },

            // Callback function
            onSlideStart: function (value, percent, position) {
                console.info('onSlideStart', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            },

            // Callback function
            onSlide: function (value, percent, position) {
                console.log('onSlide', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            },

            // Callback function
            onSlideEnd: function (value, percent, position) {
                console.warn('onSlideEnd', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);
            }
        });

    })();
</script>


	
	</div>
	
	
	
	


        <!-- Beitrag -->
        <?php   while($post = mysqli_fetch_assoc($post_list)) { ?>
          <div class="row">

            <form enctype="multipart/form-data" class="form-inline" method="post" action="<?PHP echo $_SERVER['PHP_SELF'] ?>">
              <div class="col-xs-10">
                <div class="panel panel-default p42panel">
                  <div class="panel-heading">

                    <span class="panel-title"><b><?php echo $post['Reiseziel']; ?></b></span>
                  Reise ID: <?php echo $post['Reise_ID']; ?>, Erfasst von: <?php echo $post['Verfasser']; ?></div>
                  <div class="panel-body">
	                  <?php if($post['Bildquelle'] != NULL){  ?>
                    <img src="reisen_img/<?php echo $post['Bildquelle']; ?>" alt="postimage" class="img-responsive">
<?php } ?>
					<br></br>
	                <b>Beschreibung:</b>
                    <p><?php echo $post['Beschreibung']; ?></p>
					<b>Dauer:</b>
					<p><?php echo $post['Dauer']; ?></p>
					<b>Kosten:</b>
					<p><?php echo $post['Kosten']; ?></p>
					<b>PLZ/Ort:</b>
					<p><?php echo $post['PLZ']; ?>/<?php echo $post['Ort']; ?></p>
					<b>GA Benötigt:</b>
					<p><?php echo $post['GA_benötigt']; ?></p>	
					<b>Region:</b>
					<p><?php echo $post['Region']; ?></p>
					<b>Kategorie:</b>
					<p><?php echo $post['Kategorie']; ?></p>						
					
					
									
                  </div>
                  <div class="panel-footer text-right">
                    

<form action="reise_like">
<button type="submit" name="reise_like" id="reise_like" class="btn btn-default" aria-label="Left Align">
<span class="glyphicon glyphicon-thumbs-up" href="" aria-hidden="true"></span>
</button>
</form>




<br>Anzahl Likes: <?php echo $post['Likes']; ?>
                    
                    
                    
                                      </div>
                </div>
              </div><!-- /col-sm-10 -->
            </form>
              <div class="col-xs-10">
                <form method='post'>
                  <label for="name">Name:</label>
                    <input type='text' name='name' id='name' value="hier muss ein Name stehen"/><br />

                  <label for="comment">Kommentar:</label>
                    <textarea name='comment' class="form-control" rows="5" id='comment'></textarea><br />

                  <input type='hidden' name='articleid' id='articleid' value='<?php echo $post['Reise_ID']; ?>' />

                  <input type='submit' name="comment-submit" value='Submit' />
                </form>              </div>
          </div> <!-- /Beitrag -->
<?php   } ?>


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

</body>


</html>