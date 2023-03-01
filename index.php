<?php
session_start();
//if username is in cache -> user is logged
if (isset($_SESSION['username'])) 
{
    header('location: user/index.php');
}
//username doesnt exists or is null so user goes to guest gui
else
{ 
    header('location: guest/index.php');
}
?>