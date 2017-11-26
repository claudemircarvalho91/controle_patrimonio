<?

include('includes/conexao.php');
include('includes/verifica.php');

if($_SESSION['tipo_gestor'] == 'F'){
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

				   $departamentos = '';

		           $query1 = "SELECT * FROM departamentos order by sigla asc";
		           $result1 = @pg_query($conexao, $query1);
		         
		           while($lista = @pg_fetch_array($result1))
                         $departamentos .= '<option value="'.$lista['sigla'].'">'.$lista['sigla'].'</option>'; 
			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Usu&aacute;rio</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="usuarios" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Novo Usu&aacute;rio"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es do Usu&aacute;rio</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Nome: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="50" name="nome" id="nome" title="Nome" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Login: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="20" name="login" id="login" title="Login" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Senha: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="password" class="span4 required" maxlength="8" name="senha" id="senha" title="Senha" />
											</div>
										</div>
				  
									
										<div class="control-group">
											<label class="control-label">Email: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" value="" class="span12 required" maxlength="80" name="email" id="email" title="Email" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Departamento: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="sigla" id="sigla" title="Departamento" style="width:268px">
											  <option value="">- Selecione -</option>
											  '.$departamentos.'  
											 </select>
											</div>
										</div>
		
										<div class="control-group">
											<label class="control-label">Tipo: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="tipo" id="tipo" title="Tipo" style="width:268px">
											    <option value="">Selecione...</option>
											    <option value="F">Funcion&aacute;rio</option>
											    <option value="D">Chefe de Departamento</option>
											    <option value="P">Chefe de Patrim&ocirc;nio</option>
											   </select>
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

		 $query1 = "SELECT * FROM usuarios WHERE id = '". $id ."'";
         $result1 = @pg_query($conexao, $query1);

         $dados = @pg_fetch_assoc($result1);

         $departamentos = '';

         $query2 = "SELECT * FROM departamentos order by sigla asc";
         $result2 = @pg_query($conexao, $query2);
         
         while($lista = @pg_fetch_array($result2)){

         	   if($lista['sigla'] == $dados['sigladpto'])
         	   	  $departamentos .= '<option selected="selected" value="'.$lista['sigla'].'">'.$lista['sigla'].'</option>'; 
               else
               	  $departamentos .= '<option value="'.$lista['sigla'].'">'.$lista['sigla'].'</option>'; 
         }


		 echo ('<!-- Form validation -->
			            <div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Usu&aacute;rio</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="usuarios" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/edicao" />
								<input type="hidden" name="id" id="id" value="'.$id.'" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
									 <li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Dados Pessoais</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Nome: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="50" name="nome" id="nome" title="Nome" value="'.utf8_decode($dados['nome']).'" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Login: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" name="login" maxlength="20" id="login" title="Login" value="'.utf8_decode($dados['login']).'" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Senha:</label>
											<div class="controls">
												<input type="password" class="span4" name="senha" maxlength="8" id="senha" title="Senha" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Email: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="80" name="email" id="email" title="Email" value="'.utf8_decode($dados['email']).'" />
											</div>
										</div>
		
										<div class="control-group">
											<label class="control-label">Departamento: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="sigla" id="sigla" title="Departamento" style="width:268px">
											  '.$departamentos.'  
											 </select>
											</div>
										</div>
		
										<div class="control-group">
											<label class="control-label">Tipo: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="tipo" id="tipo" title="Tipo" style="width:268px">
											    <option value="F" '.($dados['tipo'] == 'F' ? 'selected="selected"' : '').'>Funcion&aacute;rio</option>
											    <option value="D" '.($dados['tipo'] == 'D' ? 'selected="selected"' : '').'>Chefe de Departamento</option>
											    <option value="P" '.($dados['tipo'] == 'P' ? 'selected="selected"' : '').'>Chefe de Patrim&ocirc;nio</option>
											   </select>
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
		  
		  $query1 = "SELECT * FROM usuarios order by id desc";
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

		  		if($lista['tipo'] == 'P')
		  		   $tipo = 'Chefe de Patrim&oacute;nio';
			  	else if($lista['tipo'] == 'D')
		  		   $tipo = 'Chefe de Depto';
		  		else
		  		   $tipo = 'Funcion&aacute;rio';
		  		   	
			    $listagem .= '<tr id="item_'.$lista['id'].'">
							   <td style="text-align:center">'.$lista['id'].'</td>
							   <td>'.utf8_decode($lista['nome']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nome'])).'</td>
							   <td style="text-align:center">'.utf8_decode($lista['login']).'</td>
							   <td>'.utf8_decode($lista['email']).'</td>
							   <td style="text-align:center">'.$tipo.'</td>
							   <td style="text-align:center">'.utf8_decode($lista['sigladpto']).'</td>
							   <td>
							    <ul class="table-controls">
							    <li><a href="'.ROOT_ADMIN.'/usuarios/edit/'.$lista['id'].'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
							    <li><a href="javascript:Excluir(\'usuarios\',\''.$lista['id'].'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
							   </ul>
							  </td>
						     </tr>';
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de Usu&aacute;rios</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/usuarios/add" class="tip" title="Novo Usu&aacute;rio"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="6%">C&oacute;digo</th>
                                    <th width="20%">Nome</th>
                                    <th style="display:none;">Oculto</th>
                                    <th style="text-align:center" width="15%">Login</th>
									<th width="20%">Email</th>
									<th style="text-align:center" width="15%">Tipo</th>
									<th style="text-align:center" width="9%">Depto</th>
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
