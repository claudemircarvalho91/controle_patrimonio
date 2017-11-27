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
<!--[if IE 8]><link href="css/ie8.css" rel="stylesheet" type="text/css" /><![endif]-->
<!--[if IE 9]><link href="css/ie9.css" rel="stylesheet" type="text/css" /><![endif]-->


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

<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/plugins/forms/jquery.uniform.min.js"></script>

<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/files/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="js/files/functions.js"></script>-->
<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/plugins/ui/jquery.bootbox.min.js"></script>
<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/plugins/forms/jquery.inputmask.js"></script>


<script type="text/javascript" src="<?=ROOT_ADMIN?>/js/files/login.js"></script>

</head>

<body class="no-background">

	<!-- Fixed top -->
	<div id="top">
		<div class="fixed">
			<a href="<?=ROOT_ADMIN?>/login.php" title="" class="logo"><img src="<?=ROOT_ADMIN?>/img/logo.png" alt="" /></a>
		</div>
	</div>
	<!-- /fixed top -->


    <!-- Login block -->
    <div class="login">
        <div class="navbar">
            <div class="navbar-inner">
                <h6><i class="icon-user"></i>&Aacute;rea Restrita</h6>
                <div class="nav pull-right">
                    <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="mailto:contato@novalogo.com.br?subject=Esqueci minha senha [<?=$titulo_global?>]"><i class="icon-refresh"></i>Esqueci Minha Senha</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="well">
            <form id="form_login" action="#" class="row-fluid">
             <input type="hidden" name="path" id="path" value="<?=ROOT_ADMIN?>" />
             <input type="hidden" name="acao" id="acao" value="includes/login" />
                <div class="control-group">
                    <label class="control-label">Login</label>
                    <div class="controls"><input class="span12 required" type="text" title="Login" id="login" name="login" placeholder="Login" /></div>
                </div>
                
                <div class="control-group">
                    <label class="control-label">Senha:</label>
                    <div class="controls"><input class="span12 required" type="password" title="Senha" id="senha" name="senha" placeholder="Senha" /></div>
                </div>
                
                <div class="control-group">
                 <div class="linha_capctha">
                  <div class"space2"></div>
                  <label for="codigo" class="captcha">Digite o c&oacute;digo de seguran&ccedil;a</label>
                  <img class="capctha" src="<?=ROOT_ADMIN?>/includes/captcha.php" alt="" />
                  <input type="text" id="codigo" name="codigo" title="C&oacute;digo de Seguran&ccedil;a" maxlength="5" class="text_menor required" />
                 </div>
                </div>

                <div class="login-btn"><input type="submit" value="Entrar" id="entrar" class="btn btn-danger btn-block" /></div>
            </form>
        </div>
    </div>
    <!-- /login block -->

    
    <!-- Footer -->
	<div id="footer">
	 <? include('includes/rodape.php'); ?>
	</div>
	<!-- /footer -->


   <script type="text/javascript" src="<?=ROOT_ADMIN?>/js/validacao.js"></script>

</body>
</html>
