<?php
session_start();
session_destroy();
header("Location: l.php");
exit();
?>
