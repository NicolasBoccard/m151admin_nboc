<?php
session_start();
$_SESSION['connecte'] = FALSE;
header('Location: index.php');
?>