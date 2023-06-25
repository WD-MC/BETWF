<?php

	#déclarer la session
	session_start();
	session_destroy();
	header("Location:../app_Administrator/signin.php");

?>