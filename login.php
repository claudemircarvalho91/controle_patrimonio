<? 
@session_start(); 
@session_destroy(); 
?>

<? include('includes/conexao.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?=$titulo_global?> | Sistema de Administra&ccedil;&atilde;o</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?

if($_SERVER["REMOTE_ADDR"] == '127.0.0.1'){

   echo('<link href="'.ROOT_ADMIN.'/css/font_local.css" rel="stylesheet" type="text/css">
         <script type="text/javascript" src="'.ROOT_ADMIN.'/js/files/jquery.min-1.7.2.js"></script>
         <script type="text/javascript" src="'.ROOT_ADMIN.'/js/files/jquery-ui-1.9.2.min.js"></script>');

}else{

  echo('<link href=\'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700\' rel=\'stylesheet\' type=\'text/css\'>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>');
}

?>
