<?php  /* Starts the session */
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
header('Location: ' . $_SERVER["HTTP_REFERER"] );

//header("location:Home.php");
exit;
?>
