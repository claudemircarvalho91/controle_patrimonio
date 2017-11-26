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
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Pr&eacute;dio</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="predios" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Novo Pr&eacute;dio"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es do Pr&eacute;dio</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Nome: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="50" name="nome" id="nome" title="Nome" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">CEP: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="8" onkeypress="mascara(this,soNumeros)" name="cep" id="cep" title="CEP" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Logradouro: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="60" name="logradouro" id="logradouro" title="Logradouro" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">N&uacute;mero: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="10" name="numero" id="numero" title="N&uacute;mero" />
											</div>
										</div>
				  
									
										<div class="control-group">
											<label class="control-label">Complemento:</label>
											<div class="controls">
												<input type="text" value="" class="span12" maxlength="60" name="complemento" id="complemento" title="Complemento" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Bairro: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="40" name="bairro" id="bairro" title="Bairro" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Cidade: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="50" name="cidade" id="cidade" title="Cidade" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">UF: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="uf" id="uf" title="UF" style="width:68px">
											    <option value="">Selecione...</option>
												<option value="AC">AC</option>
												<option value="AL">AL</option>
												<option value="AM">AM</option>
												<option value="AP">AP</option>
												<option value="BA">BA</option>
												<option value="CE">CE</option>
												<option value="DF">DF</option>
												<option value="ES">ES</option>
												<option value="GO">GO</option>
												<option value="MA">MA</option>
												<option value="MG">MG</option>
												<option value="MS">MS</option>
												<option value="MT">MT</option>
												<option value="PA">PA</option>
												<option value="PB">PB</option>
												<option value="PE">PE</option>
												<option value="PI">PI</option>
												<option value="PR">PR</option>
												<option value="RJ">RJ</option>
												<option value="RN">RN</option>
												<option value="RS">RS</option>
												<option value="RO">RO</option>
												<option value="RR">RR</option>
												<option value="SC">SC</option>
												<option value="SE">SE</option>
												<option value="SP">SP</option>
												<option value="TO">TO</option>
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

		 $query1 = "SELECT * FROM predios WHERE codigo = '". $id ."'";
         $result1 = @pg_query($conexao, $query1);

         $dados = @pg_fetch_assoc($result1);

		 echo ('<!-- Form validation -->
			            <div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Pr&eacute;dio</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="predios" /> 
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
												<input type="text" class="span12 required" maxlength="50" value="'.utf8_decode($dados['nome']).'" name="nome" id="nome" title="Nome" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">CEP: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="8" value="'.utf8_decode($dados['cep']).'" onkeypress="mascara(this,soNumeros)" name="cep" id="cep" title="CEP" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Logradouro: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="60" value="'.utf8_decode($dados['logradouro']).'" name="logradouro" id="logradouro" title="Logradouro" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">N&uacute;mero: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" maxlength="10" value="'.utf8_decode($dados['numero']).'" name="numero" id="numero" title="N&uacute;mero" />
											</div>
										</div>
				  
									
										<div class="control-group">
											<label class="control-label">Complemento:</label>
											<div class="controls">
												<input type="text" class="span12" value="'.utf8_decode($dados['complemento']).'" maxlength="60" name="complemento" id="complemento" title="Complemento" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Bairro: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required"  value="'.utf8_decode($dados['bairro']).'"maxlength="40" name="bairro" id="bairro" title="Bairro" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Cidade: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" value="'.utf8_decode($dados['cidade']).'" maxlength="50" name="cidade" id="cidade" title="Cidade" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">UF: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="uf" id="uf" title="UF" style="width:68px">
												<option value="AC" '.($dados['uf'] == 'AC' ? 'selected="selected"' : '').'>AC</option>
												<option value="AL" '.($dados['uf'] == 'AL' ? 'selected="selected"' : '').'>AL</option>
												<option value="AM" '.($dados['uf'] == 'AM' ? 'selected="selected"' : '').'>AM</option>
												<option value="AP" '.($dados['uf'] == 'AP' ? 'selected="selected"' : '').'>AP</option>
												<option value="BA" '.($dados['uf'] == 'BA' ? 'selected="selected"' : '').'>BA</option>
												<option value="CE" '.($dados['uf'] == 'CE' ? 'selected="selected"' : '').'>CE</option>
												<option value="DF" '.($dados['uf'] == 'DF' ? 'selected="selected"' : '').'>DF</option>
												<option value="ES" '.($dados['uf'] == 'ES' ? 'selected="selected"' : '').'>ES</option>
												<option value="GO" '.($dados['uf'] == 'GO' ? 'selected="selected"' : '').'>GO</option>
												<option value="MA" '.($dados['uf'] == 'MA' ? 'selected="selected"' : '').'>MA</option>
												<option value="MG" '.($dados['uf'] == 'MG' ? 'selected="selected"' : '').'>MG</option>
												<option value="MS" '.($dados['uf'] == 'MS' ? 'selected="selected"' : '').'>MS</option>
												<option value="MT" '.($dados['uf'] == 'MT' ? 'selected="selected"' : '').'>MT</option>
												<option value="PA" '.($dados['uf'] == 'PA' ? 'selected="selected"' : '').'>PA</option>
												<option value="PB" '.($dados['uf'] == 'PB' ? 'selected="selected"' : '').'>PB</option>
												<option value="PE" '.($dados['uf'] == 'PE' ? 'selected="selected"' : '').'>PE</option>
												<option value="PI" '.($dados['uf'] == 'PI' ? 'selected="selected"' : '').'>PI</option>
												<option value="PR" '.($dados['uf'] == 'PR' ? 'selected="selected"' : '').'>PR</option>
												<option value="RJ" '.($dados['uf'] == 'RJ' ? 'selected="selected"' : '').'>RJ</option>
												<option value="RN" '.($dados['uf'] == 'RN' ? 'selected="selected"' : '').'>RN</option>
												<option value="RS" '.($dados['uf'] == 'RS' ? 'selected="selected"' : '').'>RS</option>
												<option value="RO" '.($dados['uf'] == 'RO' ? 'selected="selected"' : '').'>RO</option>
												<option value="RR" '.($dados['uf'] == 'RR' ? 'selected="selected"' : '').'>RR</option>
												<option value="SC" '.($dados['uf'] == 'SC' ? 'selected="selected"' : '').'>SC</option>
												<option value="SE" '.($dados['uf'] == 'SE' ? 'selected="selected"' : '').'>SE</option>
												<option value="SP" '.($dados['uf'] == 'SP' ? 'selected="selected"' : '').'>SP</option>
												<option value="TO" '.($dados['uf'] == 'TO' ? 'selected="selected"' : '').'>TO</option>
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
		  
		  $query1 = "SELECT * FROM predios order by codigo desc";
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

			    $listagem .= '<tr id="item_'.$lista['codigo'].'">
							   <td style="text-align:center">'.$lista['codigo'].'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nome'])).'</td>
							   <td>'.utf8_decode($lista['nome']).'</td>
							   <td style="text-align:center">'.utf8_decode($lista['cep']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['logradouro'])).'</td>
							   <td>'.utf8_decode($lista['logradouro']).'. '.($lista['numero'] != '' ? 'N&ordm; '.$lista['numero'] : '').'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['bairro'])).'</td>
							   <td>'.utf8_decode($lista['bairro']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['cidade'])).'</td>
							   <td>'.utf8_decode($lista['cidade']).' / '.$lista['uf'].'</td>
							   <td>
							    <ul class="table-controls">
							    <li><a href="'.ROOT_ADMIN.'/predios/edit/'.$lista['codigo'].'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
							    <li><a href="javascript:Excluir(\'predios\',\''.$lista['codigo'].'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
							   </ul>
							  </td>
						     </tr>';
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de Pr&eacute;dios</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/predios/add" class="tip" title="Novo Pr&eacute;dio"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="6%">C&oacute;digo</th>
                                    <th style="display:none;">Oculto</th>
                                    <th width="15%">Pr&eacute;dio</th>
									<th style="text-align:center" width="10%">CEP</th>
									<th style="display:none;">Oculto</th>
                                    <th width="15%">Logradouro</th>	
                                    <th style="display:none;">Oculto</th>
                                    <th width="15%">Bairro</th>	
                                    <th style="display:none;">Oculto</th>
                                    <th width="15%">Cidade</th>	
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
