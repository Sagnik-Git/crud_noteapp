<?php
require('resource/connect.ini.php');
$USERNAME=$_POST['usr_name'];
$USERPASSWORD=$_POST['usr_password'];
$USERVPASSWORD=$_POST['usr_v_password'];
$EMAIL=$_POST['e_mail'];
$USERLEVEL=1;

if(strlen($USERNAME)>0 && strlen($USERPASSWORD)>0 && strlen($EMAIL)>0 && $USERPASSWORD==$USERVPASSWORD)
{
	// echo $USERNAME.'<br>'.$USERPASSWORD.'<br>'.$USERVPASSWORD;
	$conn = new mysqli($host,$user,$password,$dbname);				
        //Checking Connection
        if ($conn->connect_error) 
        {
          die("Connection failed: " . $conn->connect_error);
          echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
        }

		$sql_select = "SELECT `username` FROM `tbl_user_details` WHERE username='{$USERNAME}' OR email='{$EMAIL}' ";
		$result = mysqli_query($conn, $sql_select);
		if (mysqli_num_rows($result) > 0) {
			echo '<script>alert("Username/email is already in use.");';
		}
		// else{
		// $sql_select2 = "SELECT `email` FROM `tbl_user_details` WHERE email='{$EMAIL}' ";
		// $result2 = mysqli_query($conn, $sql_select2);
		// if (mysqli_num_rows($result2) > 0) {
		// 	echo '<script>alert("Email is already in use.");';}
			 else {
	$sql="INSERT INTO tbl_user_details(username,email,userpassword,userlevel)VALUES(?, ?, ?, ?);";
	$stmt=$conn->prepare($sql);	
	$stmt->bind_param("sssi",$USERNAME,$EMAIL,$USERPASSWORD,$USERLEVEL);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	echo '<script>alert("Your account has been created. Please log in.");';
	}
	
}
else
{
	echo '<script>alert("Please fill the form correctly.");';
}

?>