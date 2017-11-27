<?

@session_start();

if(!isset($_SESSION["senha_gestor"])){  
   @session_destroy();
   @header("Location: ".ROOT_ADMIN."/login.php");
   echo('<script>window.location = "'.ROOT_ADMIN.'/login.php";</script>'); 
}

?>

        

       