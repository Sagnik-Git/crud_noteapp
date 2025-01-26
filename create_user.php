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
	
		
		<form class="w3-container w3-card-4 w3-display-middle w3-theme-l4 w3-round-large" id="user_form" method="POST">
			<h2 class="w3-margin-top w3-margin-bottom w3-center">CREATE USER</h2>
			<div class="w3-section w3-margin">
				<label>User Name</label>	
				<input type="text" class="w3-input w3-border w3-border-blue" name="usr_name" id="usr_name" />
			</div>
			<div class="w3-section w3-margin">
				<label>E-mail</label>	
				<input type="email" class="w3-input w3-border w3-border-blue" name="e_mail" id="e_mail" />
			</div>	
			<div class="w3-section w3-margin">
				<label>Password</label>
				<input type="password" class="w3-input w3-border w3-border-blue" name="usr_password" id="usr_password" />
			</div>
			<div class="w3-section w3-margin">
				<label>Verify Password</label>
				<input type="password" class="w3-input w3-border w3-border-blue" name="usr_v_password" id="usr_v_password" />
			</div>
			<div class="w3-section  w3-margin">
				<button class="w3-button w3-right" name="usr_regis" id="usr_regis"><i class="fa fa-pencil-square-o w3-xxlarge" aria-hidden="true"></i></button>
				<a href="index.php" class="w3-button w3-left"><i class="fa fa-home w3-xxlarge" aria-hidden="true"></i></a>
			</div>			
		</form>	
	
	<footer><div class="w3-container"  id="ct_user"></div></footer>	
	
	
	</div>
	<!------Sripts--->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$("#usr_regis").click(function()
							 {
			var myform = document.getElementById("user_form");
			var fd = new FormData(myform);
			$.ajax({
                    url: "create_user_action.php",
                    type: "POST",
                    data:  fd,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                    //alert(data);
                    $('#ct_user').html(data);
                    //location.reload();               
                    
                    },
                        error: function(){} 	        
                    });         
		});
	</script>
</body>
</html>