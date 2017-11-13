<?
@session_start(); 
@session_destroy(); 
@header("Location: login.php"); 
echo('<script>window.location = "login.php";</script>');
?>
