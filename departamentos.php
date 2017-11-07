<?

include('includes/conexao.php');
include('includes/verifica.php');

if($_SESSION['tipo_gestor'] == 'F' || $_SESSION['tipo_gestor'] == 'D'){
   @header("Location: ".ROOT_ADMIN."/inicio/permissao");
   echo('<script>window.location = "'.ROOT_ADMIN.'/inicio/permissao";</script>'); 	
}

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
			    <!-- /action tabs -->
		    	<?

				if($acao == 'add'){
			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Departamento</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="departamentos" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Novo Departamento"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es do Departamento</h6></div></div>
									<div class="well row-fluid">

										<div class="control-group">
											<label class="control-label">Sigla Depto: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" value="" class="span4 required" maxlength="5" name="sigla" id="sigla" title="Sigla do Departamento" />
											</div>
										</div>
		
										<div class="control-group">
											<label class="control-label">Nome: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="30" name="nome" id="nome" title="Nome" />
											</div>
										</div>
										
										<div class="form-actions align-right">
										 <div id="status" class="status"></div>
										 <div id="error" class="erro"></div>
										 <button type="submit" class="btn btn-info">Cadastrar</button>
										 <button type="reset" class="btn">&nbsp;&nbsp;&nbsp;Limpar&nbsp;&nbsp;&nbsp;</button>
									    </div>

		
									</div>
		
								</div>
								<!-- /form validation -->
		
							</fieldset>
						</form>
						<!-- /form validation -->');
	   
	  
	  }else if($acao == 'edit'){

		 $query1 = utf8_encode("SELECT * FROM departamentos WHERE sigla = '". $id ."'");
         $result1 = @pg_query($conexao, $query1);

         $dados = @pg_fetch_assoc($result1);

		 echo ('<!-- Form validation -->
			            <div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Departamento</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="departamentos" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/edicao" />
								<input type="hidden" name="id" id="id" value="'.$id.'" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
									 <li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es do Departamento</h6></div></div>
									<div class="well row-fluid">

										<div class="control-group">
											<label class="control-label">Sigla Depto: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" value="'.utf8_decode($dados['sigla']).'" class="span4 required" maxlength="5" name="sigla" id="sigla" title="Sigla do Departamento" />
											</div>
										</div>
		
										<div class="control-group">
											<label class="control-label">Nome: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="50" name="nome" id="nome" title="Nome" value="'.utf8_decode($dados['nome']).'" />
											</div>
										</div>
										
										
										
										<div class="form-actions align-right">
										 <div id="status" class="status"></div>
										 <div id="error" class="erro"></div>
										 <button type="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;Alterar&nbsp;&nbsp;&nbsp;</button>
										 <button type="reset" class="btn">&nbsp;&nbsp;&nbsp;Limpar&nbsp;&nbsp;&nbsp;</button>
									    </div>

		
									</div>
		
								</div>
								<!-- /form validation -->
		
							</fieldset>
						</form>
						<!-- /form validation -->');
	
	     
	   
	  
	  }else{
		  
		  $query1 = "SELECT * FROM departamentos order by sigla desc";
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

		  		$listagem .= '<tr id="item_'.utf8_decode($lista['sigla']).'">
							   <td style="text-align:center">'.utf8_decode($lista['sigla']).'</td>
							   <td>'.utf8_decode($lista['nome']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nome'])).'</td>
							   <td>
							    <ul class="table-controls">
							    <li><a href="'.ROOT_ADMIN.'/departamentos/edit/'.utf8_decode($lista['sigla']).'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
							    <li><a href="javascript:Excluir(\'departamentos\',\''.utf8_decode($lista['sigla']).'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
							   </ul>
							  </td>
						     </tr>';
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de Departamentos</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/departamentos/add" class="tip" title="Novo Departamento"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="10%">Sigla</th>
                                    <th width="75%">Nome</th>
                                    <th style="display:none;">Oculto</th>
                                    <th width="15%">A&ccedil;&otilde;es</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listagem.'
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /default datatable -->'); 
		   
	   }
	
	
	?>
	
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
