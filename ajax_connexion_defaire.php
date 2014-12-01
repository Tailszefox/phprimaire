<?php
require('./include/include_init.php');

// Destruction de la session
$_SESSION = array();
session_destroy();
?>
