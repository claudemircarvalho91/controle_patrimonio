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
			    <!-- /action tabs -->


		    	<?

				if($acao == 'add'){

				   $salas = '';

		           $query2 = "SELECT * FROM salas where sigladpto = '".$_SESSION['depto_gestor']."' order by numero asc";
		           $result2 = @pg_query($conexao, $query2);
		         
		           while($listaSalas = @pg_fetch_array($result2))
                         $salas .= '<option value="'.$listaSalas['numero'].'">'.utf8_decode($listaSalas['descricao'].' ('.$listaSalas['sigladpto'].')').'</option>';       	

			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Baixa de Bem Patrimonial</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="baixa" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Nova Baixa"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es da Baixa</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Data: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 datepicker required" value="'.date("d/m/Y").'" name="data" id="data" title="Data" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Motivo: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="500" name="motivo" id="motivo" title="Motivo" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Tipo: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="tipo" id="tipo" title="Tipo" style="width:268px">
											    <option value="">Selecione...</option>
												<option value="D">Doa&ccedil;&atilde;o</option>
												<option value="E">Extravio/Perda</option>
												<option value="I">Inutiliza&ccedil;&atilde;o</option>
												<option value="V">Venda</option>
												<option value="O">Outros</option>
											   </select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Sala: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="salaOrigem" id="salaOrigem" title="Sala de Origem" style="width:268px">
											  <option value="">- Selecione -</option>
											  '.$salas.'  
											 </select>
											</div>
										</div>

										<div class="control-group">
										 <label class="control-label">Bem Patrimonial: <span class="text-error">*</span></label>
										  <div class="controls">
										   <select class="select required" name="bemPatrimonial" id="bemPatrimonial" title="Bem Patrimonial" style="width:268px">
										    <option value="">Selecione...</option>
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

	  			   $query0 = utf8_encode("SELECT baixabempatrimonial.*, bempatrimonial.descricao as objeto, bempatrimonial.numsala, usuarios.nome 
	  			   	                      FROM baixabempatrimonial 
	  			   	                      inner join bempatrimonial on baixabempatrimonial.numero = bempatrimonial.numero
	  			   	                      inner join usuarios on baixabempatrimonial.idusuario = usuarios.id
	  			   	                      WHERE baixabempatrimonial.numero = ". $id ."");
		           $result0 = @pg_query($conexao, $query0);
		           $dados = @pg_fetch_assoc($result0);	
  
                         
                   $salasOrigem = '';

      
		           $query2 = "SELECT * FROM salas order by numero asc";
		           $result2 = @pg_query($conexao, $query2);
		         
		           while($listaSalasOri = @pg_fetch_array($result2)){

		           	     if($listaSalasOri['numero'] == $dados['numsala'])
                         	$salasOrigem = '<input type="text" class="span4 required" value="'.utf8_decode($listaSalasOri['descricao'].' ('.$listaSalasOri['sigladpto'].')').'" readonly="readonly" />';
                       
		           }

			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Baixa de Bem Patrimonial</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="baixa" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/edicao" />
								<input type="hidden" name="id" id="id" value="'.$id.'" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es da Baixa</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Data: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 datepicker required" value="'.formatData($dados['data']).'" name="data" id="data" title="Data" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Motivo: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" value="'.utf8_decode($dados['motivo']).'" maxlength="200" name="motivo" id="motivo" title="Motivo" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Tipo: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="tipo" id="tipo" title="Tipo" style="width:268px">
											    <option value="D" '.($dados['tipo'] == 'D' ? 'selected="selected"' : '').'>Doa&ccedil;&atilde;o</option>
												<option value="E" '.($dados['tipo'] == 'E' ? 'selected="selected"' : '').'>Extravio/Perda</option>
												<option value="I" '.($dados['tipo'] == 'I' ? 'selected="selected"' : '').'>Inutiliza&ccedil;&atilde;o</option>
												<option value="V" '.($dados['tipo'] == 'V' ? 'selected="selected"' : '').'>Venda</option>
												<option value="O" '.($dados['tipo'] == 'O' ? 'selected="selected"' : '').'>Outros</option>
											   </select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Sala: <span class="text-error">*</span></label>
											<div class="controls">
											 '.$salasOrigem.'
											</div>
										</div>

										<div class="control-group">
										 <label class="control-label">Bem Patrimonial: <span class="text-error">*</span></label>
										  <div class="controls">
										   <input type="text" class="span4 required" value="'.utf8_decode($dados['objeto']).'" readonly="readonly" />
									      </div>
										</div>

										<div class="control-group">
											<label class="control-label">Usu&aacute;rio: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 required" value="'.utf8_decode($dados['nome']).'" readonly="readonly" />
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

		  $query1 = "SELECT baixabempatrimonial.*, bempatrimonial.descricao as objeto, bempatrimonial.numsala, usuarios.nome 
	  			   	                      FROM baixabempatrimonial 
	  			   	                      inner join bempatrimonial on baixabempatrimonial.numero = bempatrimonial.numero
	  			   	                      inner join usuarios on baixabempatrimonial.idusuario = usuarios.id
		             order by baixabempatrimonial.numero asc";  
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

		  		$listagem .= '<tr id="item_'.$lista['numero'].'">
							   <td style="text-align:center">'.$lista['numero'].'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['motivo'])).'</td>
							   <td>'.utf8_decode($lista['motivo']).'</td>
							   <td style="text-align:center">'.formatData($lista['data']).'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nome'])).'</td>
							   <td style="text-align:center">'.utf8_decode($lista['nome']).'</td>
							   <td style="text-align:center">'.$lista['numsala'].'</td>
							   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['objeto'])).'</td>
							   <td>'.$lista['numero'].' - '.utf8_decode($lista['objeto']).'</td>
							   <td style="text-align:center">'.$lista['tipo'].'</td>
							   <td>
							    <ul class="table-controls">
							    <li><a href="'.ROOT_ADMIN.'/baixa/edit/'.$lista['numero'].'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
							    <li><a href="javascript:Excluir(\'baixa\',\''.$lista['numero'].'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
							   </ul>
							  </td>
						     </tr>';
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de baixas de Bens Patrimoniais</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/baixa/add" class="tip" title="Nova Baixa"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="8%">N&uacute;mero</th>
									<th style="display:none;">Oculto</th>
                                    <th width="12%">Motivo</th>
                                    <th style="text-align:center" width="8%">Data</th>
                                    <th style="display:none;">Oculto</th>
									<th style="text-align:center" width="12%">Usu&aacute;rio</th>
									<th style="text-align:center" width="10%">Sala</th>
									<th style="display:none;">Oculto</th>
                                    <th width="15%">Bem Patrimonial</th>
                                    <th style="text-align:center" width="10%">Tipo</th>	
									<th width="10%">A&ccedil;&otilde;es</th>
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

    <script>
	
		$('#salaOrigem').change(function() {
	  
			  if($('#salaOrigem').val() != ''){
				  
				  var path = '<?=ROOT?>';
			
				  var opcao = 'movimentacoes';
				  
				  var acao = 'consulta';
			
				  var elemento = $('#salaOrigem').val();
			
				  var enviar = 'opcao='+opcao+'&id='+elemento;
				  
				  $.ajax({
					type: "GET",
					url: path+"/operacoes/"+acao+".php",
					data: enviar,
					contentType: "application/json; charset=utf-8",
					dataType: "text",
					success: function OnPopulateControl(response){
			
						if(response.length > 0) {
						   
						   //alert(response);
						   
						   lista = response.split('@');
						   
						   $('#bemPatrimonial').empty();
						   $('#bemPatrimonial').append('<option value="">Selecione...</option>');
						   
						   for(var i = 0; i < lista.length; i++){
							   
							   dados = lista[i].split(';');
							   
							   $('#bemPatrimonial').append('<option value="'+dados[0]+'">'+dados[1]+'</option>');
						   }
						   
						}else{
						   $('#bemPatrimonial').empty();	
						   $("#bemPatrimonial").append('<option selected="selected" value="">N\u00e3o h\u00e1 Bem Patrimonial para Sala selecionada.<option>');
						}
		
					},
					
					error: function (){
						alert('Erro: Houve alguma instabilidade no servidor.');
					}
					
			   });
			   
			}//if
			   
		});

	</script>

</body>
</html>
