<?php 
session_start();
unset($_SESSION['log']);
unset($_SESSION['user']);
session_destroy();
header('Location: '.SITEURL.'/akun?w=logout');	
?>