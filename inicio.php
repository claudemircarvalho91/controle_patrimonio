<?

include('includes/conexao.php');
include('includes/verifica.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?=$titulo_global?></title>

<? include('includes/scripts.php'); ?>


</head>

<body>

	<? include('includes/topo.php'); ?>


	<!-- Content container -->
	<div id="container">

		<!-- Sidebar -->
		<div id="sidebar">

			<div class="sidebar-tabs">
		        <ul class="tabs-nav two-items">
		            <li><a href="#general" title=""><i class="icon-reorder"></i></a></li>
		            <li><a href="#stuff" title=""><i class="icon-cogs"></i></a></li>
		        </ul>

		        <div id="general">
                 <? include('includes/lateral.php'); ?>
                </div>

		        <div id="stuff">
                 <? include('includes/lateral_config.php'); ?>
		        </div>

		    </div>
		</div>
		<!-- /sidebar -->

		<!-- Content -->
		<div id="content">

			<!-- Content wrapper -->
		    <div class="wrapper">

			    <!-- Breadcrumbs line -->
			    <div class="crumbs">
		         <? include('includes/nav_topo.php'); ?>   
			    </div>
			    <!-- /breadcrumbs line -->

			    <!-- Page header -->
			    <div class="page-header">
			     <? include('includes/cabecalho.php'); ?>	
			    </div>
			    <!-- /page header -->

			    <!-- Action tabs -->
			    <div class="actions-wrapper">
				    <div class="actions">
                     <? include('includes/atalhos.php'); ?>
				    </div>
				</div>

		  <div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-home"></i>In&iacute;cio</h5>
	                                               
               
		   		<? if($acao == 'permissao') echo('<h2 style="text-align:center; color:#900">Seu usu&aacute;rio n&atilde;o possui permiss&atilde;o para acesso a tela solicitada!</h2>'); ?>
	
	
		    </div>
		    <!-- /content wrapper -->

		</div>
		<!-- /content -->

	</div>
	<!-- /content container -->
    
	<!-- Footer -->
	<div id="footer">
	 <? include('includes/rodape.php'); ?>
	</div>
	<!-- /footer -->

    <script type="text/javascript" src="<?=ROOT_ADMIN?>/js/validacao.js"></script>


</body>
</html>
