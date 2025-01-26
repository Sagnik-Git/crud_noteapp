<?php
include('resource/connect.ini.php');
if(isset($_POST['Login']))
{
    //Create Connection
    $conn = new mysqli($host,$user,$password,$dbname);				
    //Checking Connection
    if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
      echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
    
    $sql="SELECT username,userpassword,userlevel FROM tbl_user_details WHERE username=? AND userpassword=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('ss',$_POST['username'],$_POST['password']);
    $stmt->execute();
    $stmt->bind_result($USERNAME,$USERPASSWORD,$USERLEVEL);
    $stmt->store_result();
    $row_count=$stmt->num_rows;
    $stmt->fetch();
    $stmt->close();
    $conn->close();    
    
    //echo 'Row Count:'.$row_count;
    
    if($row_count==1)
    {
        $_SESSION['ses_login']=151;
        $_SESSION['user_level']=$USERLEVEL;
		$_SESSION['username']=$USERNAME;
        header('location:create_note.php');
       
    }
    else
    {
        $_SESSION['ses_login']=152;
        header('location:index.php');
        
    }
    
    echo $_SESSION['ses_login'];
}
?>
