<?php
unset($_SESSION['ses_login']);
unset($_SESSION['user_level']);
header("location:index.php");
?>