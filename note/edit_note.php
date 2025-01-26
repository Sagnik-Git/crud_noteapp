<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/notes/resource/connect.ini.php";
require_once($path);
$myID=$_POST['myID'];

//Create Connection
$conn = new mysqli($host,$user,$password,$dbname);				
//Checking Connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
  echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
}

$sql="SELECT sno,title,description FROM notes WHERE sno=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$myID);
$stmt->execute();
$stmt->bind_result($SNO,$TITLE,$DES);
$stmt->fetch();
$conn->close();

echo '<script>
$("#hiddenId_1").val("'.$myID.'");
$("#md_title").val("'.$TITLE.'");
$("#md_des").val("'.$DES.'");

</script>';
?>