<?php
require('resource/connect.ini.php');

if(isset($_SESSION['ses_login']))
{
    if($_SESSION['ses_login']!=151)
    {
       header('location:index.php');
    }
    else
    {
      $arr=array();
	    //echo $_SESSION['username'];
	    $USERNAME=$_SESSION['username'];
       //Create Connection
       $conn = new mysqli($host,$user,$password,$dbname);				
       //Checking Connection
       if ($conn->connect_error) 
       {
         die("Connection failed: " . $conn->connect_error);
         echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
       }       
        
        $sql="SELECT sno,title,description,tstamp FROM notes WHERE user_name=? ORDER BY sno desc";
        $stmt=$conn->prepare($sql);
		$stmt->bind_param('s',$USERNAME);
        $stmt->execute();
        $stmt->bind_result($SNO,$TITLE,$DES,$TSTAMP);
		
        $rCounter=0;
        while($stmt->fetch())
        {            
            $arr[$rCounter]=array('sno'=>$SNO,'title'=>$TITLE,'des'=>$DES,'tstamp'=>$TSTAMP);
            $rCounter++;
        }
		$stmt->close();
		$conn->close();
        /*echo '<pre>';        
        print_r($arr);*/    
    }
}
else
{
    header('location:index.php');
}
//echo $_SESSION['ses_login'].'<br>';
?>
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
		<!---- NAVIGATION BAR --->
			<div class="w3-padding w3-bar w3-black">
				<span class="w3-bar-item w3-button" id="nav_new"><i class="fa fa-plus-square-o w3-large" aria-hidden="true"> New Record</i></span>
			 	 <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out w3-large" aria-hidden="true"> Logout</i></a>
			  <!--<a href="#" class="w3-bar-item w3-button">Link 1</a>
			  <a href="#" class="w3-bar-item w3-button">Link 2</a>
			  <a href="#" class="w3-bar-item w3-button">Link 3</a>-->
			</div>
		<!----- DATA GRID TABLE ---->
        <div class="w3-container w3-center w3-margin w3-border" style="height:700px;overflow-y:scroll;">
            <header><h3>N-NOTES DATA GRID</h3></header>
			  <input class="w3-input w3-border w3-padding w3-margin-bottom w3-margin-top" type="text" placeholder="Search for titles.." id="myInput" onkeyup="myFunction()">
            <table class="w3-table-all w3-margin-bottom" id="myTable">
                <thead>
                    <tr class="w3-black">
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>CREATED ON</th>
                        <th class="w3-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr as $list) { ?>
                    <tr>
                        <td><?php echo $list['title']; ?></td>
                        <td><?php echo $list['des']; ?></td>
                        <td><?php echo $list['tstamp']; ?></td>
                        <td class="w3-center">
                            <button type="button" class="w3-button w3-black myEdit" id="<?php echo $list['sno'];?>"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                            &nbsp&nbsp
                            <button type="button" class="w3-button w3-black myDelete" id="<?php echo $list['sno'];?>"><i class="fa fa-trash-o w3-large" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <footer><div class="w3-container" id="alert"></div></footer>
        </div>
		<!-----Modal Div---->
		<div id="id01" class="w3-modal">
			<div class="w3-modal-content w3-card-4">
			  <header class="w3-container w3-black"> 
				<span class="w3-button w3-display-topright" id="md_close">&times;</span>
				<h2 id="md_header">EDIT FORM</h2>
			  </header>
			  <div class="w3-container">
				<form id=md_form>
					<div class="w3-section">
						<label>Title</label>
						<input type="tex" class="w3-input w3-border w3-border-blue" name="md_title" id="md_title" />
					</div>
					<div class="w3-section">
						<label>Description</label>
						<textarea class="w3-input w3-border w3-border-blue" name="md_des" id="md_des"></textarea>
						<input type="hidden" name="hiddenId_1" id="hiddenId_1" value="0"/>
					</div>
					<div class="w3-section">
						<button type="button" class="w3-button w3-right" id="md_edit" name="md_edit"><i class="fa fa-pencil-square-o w3-xxlarge" aria-hidden="true"></i></button>
					</div>				
				</form>
			  </div>
				
			  <footer class="w3-container w3-black">
				<p><h5>created by: SagnikC</h5></p>
			  </footer>
			</div>
		  </div>
		
		
		
		<!------------------>
        <script type="text/javascript" src="js/jquery.min.v3.1.1.js"></script>
        <script>
            //DATA GRID DELETE BUTTON CODE
            $('.myDelete').click(function()
            {
				var myID=this.id;
                if(confirm("Are you sure you want to delete this?")){
				//Ajax code
								$.ajax({
									url: "note/delete_note.php",
									type: "POST",
									data: {myID: myID},
									success: function(html)
									{

									   $('#alert').html(html);
									   location.reload();				
									}
								});
								}
								else{
								//Cancelled 	
									return false;
								}
				});
            
            
			//DATA GRID EDIT BUTTON CODE
            $('.myEdit').click(function()
            {			
                var myID=this.id; 
				
                $.ajax({
                    url: "note/edit_note.php",
                    type: "POST",
                    data: {myID: myID},
                    success: function(html)
                    {
                       
                       $('#alert').html(html);
                      
                        
                    }
                });
				document.getElementById('id01').style.display='block';
            });
			
			
			//MODAL EDIT BUTTON CODE
			$("#md_edit").click(function()
			{
				$("#md_header").html('EDIT FORM');		
				var myform = document.getElementById("md_form");
				var fd = new FormData(myform); 
				$.ajax({
                    url: "note/create_note_action.php",
                    type: "POST",
                    data:  fd,
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data){
                    //alert(data);
                    $('#alert').html(data);
                    //location.reload();
                    
                    
                    },
                        error: function(){} 	        
                    });         
			});
			
			//MODAL CLOSE BUTTON CODE
			$("#md_close").click(function()
								{
				document.getElementById('id01').style.display='none';
				location.reload();
			});
			
			
			//NEW RECORD NAVIGATION BUTTON
			$("#nav_new").click(function()
			{
				
				$("#md_header").html('NEW DATA');
				document.getElementById('id01').style.display='block';
				
			});
			
			//TABLE FILTER CODE
			function myFunction() {
			  var input, filter, table, tr, td, i;
			  input = document.getElementById("myInput");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("myTable");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					tr[i].style.display = "none";
				  }
				}
			  }
			}
			
			
			
        </script>
        
    </body>
</html>
