 <?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/notes/resource/connect.ini.php";
require_once($path);

//COLLECTING VARIABLES
$TITLE=$_POST['md_title'];
$DES=$_POST['md_des'];
$HID=$_POST['hiddenId_1'];
$USERNAME=$_SESSION['username'];
$TSTAMP=date('Y-m-d H:i:s');

//echo $TITLE.'<br>'.$DES.'<br>'.$HID;

$conn = new mysqli($host,$user,$password,$dbname);				
        //Checking Connection
        if ($conn->connect_error) 
        {
          die("Connection failed: " . $conn->connect_error);
          echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
        }
		if($HID==0)
			{
				$alert="New Data Entered Successfully";
				$sql="INSERT INTO notes(title,description,tstamp,user_name)VALUES(?, ?, ?, ?)";
			}
			else{
				$alert="Data Successfully Edited";
				$sql="UPDATE notes SET title=?, description=?, tstamp=?, user_name=? WHERE sno=?";
			}
		$stmt=$conn->prepare($sql);
		if($HID==0)
		{
			$stmt->bind_param('ssss',$TITLE,$DES,$TSTAMP,$USERNAME);
		}
		else{

			$stmt->bind_param('ssssi',$TITLE,$DES,$TSTAMP,$USERNAME,$HID);
		}
		$stmt->execute();		
		$stmt->close();
		$conn->close();    
		echo '<script>alert("'.$alert.'");</script>';
?>