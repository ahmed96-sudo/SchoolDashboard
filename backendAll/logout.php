<?php
session_start();
if (!isset($_SESSION['username'])){
	
	header('Location: ../index.php');
	}


?>
<?php

session_destroy();
session_unset();
header('Location: ../index.php');

?>