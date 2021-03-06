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

				   $departamentos = '';

		           $query1 = "SELECT * FROM departamentos order by sigla asc";
		           $result1 = @pg_query($conexao, $query1);
		         
		           while($lista = @pg_fetch_array($result1))
                         $departamentos .= '<option value="'.$lista['sigla'].'">'.utf8_decode($lista['sigla']).'</option>';
                         
                   $predios = '';

		           $query2 = "SELECT * FROM predios order by nome asc";
		           $result2 = @pg_query($conexao, $query2);
		         
		           while($listaPredio = @pg_fetch_array($result2))
                         $predios .= '<option value="'.$listaPredio['codigo'].'">'.utf8_decode($listaPredio['nome']).'</option>';       	

			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Sala</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="salas" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Nova Sala"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es da Sala</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">N&uacute;mero: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="10" onkeypress="mascara(this,soNumeros)" name="numero" id="numero" title="N&uacute;mero" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Comprimento: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="7" placeholder="Metros" onkeypress="mascara(this,moeda)" name="comprimento" id="comprimento" title="Comprimento" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Largura: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="7" placeholder="Metros" onkeypress="mascara(this,moeda)" name="largura" id="largura" title="Largura" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Descri&ccedil;&atilde;o:</label>
											<div class="controls">
												<input type="text" class="span12" maxlength="80" name="descricao" id="descricao" title="Descri&ccedil;&atilde;o" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Pr&eacute;dio: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="predio" id="predio" title="Pr&eacute;dio" style="width:268px">
											    <option value="">Selecione...</option>
												'.$predios.'
											   </select>
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

		 $query1 = "SELECT * FROM salas WHERE numero = '". $id ."'";
         $result1 = @pg_query($conexao, $query1);

         $dados = @pg_fetch_assoc($result1);


         $departamentos = '';

         $query2 = "SELECT * FROM departamentos order by sigla asc";
         $result2 = @pg_query($conexao, $query2);
     
         while($lista = @pg_fetch_array($result2)){

         	   if($lista['sigla'] == $dados['sigladpto'])
                  $departamentos .= '<option selected="selected" value="'.$lista['sigla'].'">'.utf8_decode($lista['sigla']).'</option>';
         	   else
         	   	  $departamentos .= '<option value="'.$lista['sigla'].'">'.utf8_decode($lista['sigla']).'</option>';
         }
             
         $predios = '';

         $query3 = "SELECT * FROM predios order by nome asc";
         $result3 = @pg_query($conexao, $query3);
     
         while($listaPredio = @pg_fetch_array($result3)){

         	   if($listaPredio['codigo'] == $dados['codpredio'])
                  $predios .= '<option value="'.$listaPredio['codigo'].'">'.utf8_decode($listaPredio['nome']).'</option>';  
         	   else
         	   	  $predios .= '<option value="'.$listaPredio['codigo'].'">'.utf8_decode($listaPredio['nome']).'</option>';  
         }



		 echo ('<!-- Form validation -->
			            <div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Sala</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="salas" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/edicao" />
								<input type="hidden" name="id" id="id" value="'.$id.'" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
									 <li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Dados da Sala</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">N&uacute;mero: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="10" readonly="readonly" value="'.$dados['numero'].'" onkeypress="mascara(this,soNumeros)" name="numero" id="numero" title="N&uacute;mero" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Comprimento: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="7" value="'.number_format($dados['comprimento'],2,',','.').'" placeholder="Metros" onkeypress="mascara(this,moeda)" name="comprimento" id="comprimento" title="Comprimento" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Largura: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="7" value="'.number_format($dados['largura'],2,',','.').'" placeholder="Metros" onkeypress="mascara(this,moeda)" name="largura" id="largura" title="Largura" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Descri&ccedil;&atilde;o:</label>
											<div class="controls">
												<input type="text" class="span12" maxlength="80" name="descricao" value="'.utf8_decode($dados['descricao']).'" id="descricao" title="Descri&ccedil;&atilde;o" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Pr&eacute;dio: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="predio" id="predio" title="Pr&eacute;dio" style="width:268px">
												'.$predios.'
											   </select>
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
		  
		  $query1 = "SELECT salas.*, predios.nome FROM salas inner join predios on salas.codpredio = predios.codigo order by salas.numero desc";
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

			    $listagem .= '<tr id="item_'.$lista['numero'].'">
							   <td style="text-align:center">'.$lista['numero'].'</td>
							   <td style="text-align:center">'.number_format($lista['comprimento'],2,',','.').'m</td>
							   <td style="text-align:center">'.number_format($lista['largura'],2,',','.').'m</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['descricao'])).'</td>
							   <td>'.utf8_decode($lista['descricao']).'</td>
							   <td style="text-align:center">'.utf8_decode($lista['sigladpto']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nome'])).'</td>
							   <td>'.utf8_decode($lista['nome']).'</td>
							   <td>
							    <ul class="table-controls">
							    <li><a href="'.ROOT_ADMIN.'/salas/edit/'.$lista['numero'].'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
							    <li><a href="javascript:Excluir(\'salas\',\''.$lista['numero'].'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
							   </ul>
							  </td>
						     </tr>';
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de Salas</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/salas/add" class="tip" title="Nova Sala"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="10%">N&uacute;mero</th>
                                    <th style="text-align:center" width="10%">Comprimento</th>
									<th style="text-align:center" width="10%">Largura</th>
								    <th style="display:none;">Oculto</th>
                                    <th width="30%">Descri&ccedil;&atilde;o</th>
                                    <th width="10%" style="text-align:center">Depto</th>	
                                    <th style="display:none;">Oculto</th>
                                    <th width="15%">Pr&eacute;dio</th>	
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
