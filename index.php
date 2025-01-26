<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>NOTES</title>
<link rel="stylesheet" href="css/w3_4_0_4.css">
<link rel="stylesheet" href="css/w3-theme-blue-grey.css">
<script src="https://kit.fontawesome.com/64731da9ae.js" crossorigin="anonymous"></script>
</head>
    <body>    	
        <div class="w3-display-container" style="height:800px;width:100%;">
        	<form class="w3-container w3-card-4 w3-display-middle w3-theme-l4 w3-round-large" method="post" action="checkLogin.php">
            	<div class="w3-container"><img class="w3-image w3-margin-top w3-margin-bottom w3-round-large w3-border w3-border-blue-gray" src="img/n.png" style="width:420px;height:140px;"></div>
               
                <div class="w3-container w3-border w3-border-blue-gray w3-margin-bottom w3-round-large">
                    
                    <p>
                        <label>User Name</label>
                        <input type="text" class="w3-input w3-border" name="username" placeholder="User Name" />
                    </p>
                    <p>
                        <label>Password</label>
                        <input type="password" class="w3-input w3-border" name="password" placeholder="Password" />
                    </p>        
                    <p class="w3-center"><button type="submit" class="w3-button w3-theme-d4 w3-ripple" id="login" name="Login"><i class="fas fa-sign-in-alt"></i></button></p>      			
                </div>	
                <div class="w3-container">
                	<p class="w3-left" style="font-size:10px">
                    @copyright<br>
                    Created & Designed by SagnikC
                    </p>
					<p class="w3-right" style="font-size:12px"><a href="create_user.php"><b>Create User</b></a></p>
                </div>    
    		</form>
            <footer>
                    <?php
                        if(isset($_SESSION['ses_login']))
                        {
							
                            if($_SESSION['ses_login']==151)
                            {
                                header('location:create_note.php');          
                            }
                            if($_SESSION['ses_login']==152)
                            {
                                echo '<div class="w3-panel w3-red w3-border"><h6 id="alert"> Please eneter the correct login credentials </h6></div>';          
                            }                           
                        }
                    ?>
                </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
		$(document).ready(function(e) {
            var ifConnected = window.navigator.onLine;
			if (ifConnected) {	
			$('#login').prop('disabled', false)		 
			} else {
			$('#login').prop('disabled', true)		
			  alert('NOTES v0.1 needs stable internet connection. Please connect to Internet to proceed');
			}
        });
		
		</script>      
    </body>
</html>
