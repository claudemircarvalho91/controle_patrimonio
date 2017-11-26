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

				   $solicitantes = '';

		           $query1 = "SELECT id, nome FROM usuarios order by nome asc";
		           $result1 = @pg_query($conexao, $query1);
		         
		           while($lista = @pg_fetch_array($result1))
                         $solicitantes .= '<option value="'.$lista['id'].'">'.utf8_decode($lista['nome']).'</option>';
                         
                   $salas = '';

		           $query2 = "SELECT * FROM salas where sigladpto = '".$_SESSION['depto_gestor']."' order by numero asc";
		           $result2 = @pg_query($conexao, $query2);
		         
		           while($listaSalas = @pg_fetch_array($result2))
                         $salas .= '<option value="'.$listaSalas['numero'].'">'.utf8_decode($listaSalas['descricao'].' ('.$listaSalas['sigladpto'].')').'</option>';       	

			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Cadastro de Movimenta&ccedil;&atilde;o de Bem Patrimonial</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="movimentacoes" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/cadastro" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.location.reload(true);" class="tip" title="Nova Movimenta&ccedil;&atilde;o"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es da Movimenta&ccedil;&atilde;o</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Data da Solicita&ccedil;&atilde;o: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 datepicker required" name="datasolicitacao" id="datasolicitacao" title="Data da Solicita&ccedil;&atilde;o" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Motivo: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" maxlength="200" name="motivo" id="motivo" title="Motivo" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Solicitante: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="solicitante" id="solicitante" title="Solicitante" style="width:268px">
											    <option value="">Selecione...</option>
												'.$solicitantes.'
											   </select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Sala de Origem: <span class="text-error">*</span></label>
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

										<div class="control-group">
											<label class="control-label">Sala de Destino: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="salaDestino" id="salaDestino" title="Sala de Destino" style="width:268px">
											  <option value="">- Selecione -</option>
											  '.$salas.'  
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

	  			   $query0 = utf8_encode("SELECT mbp.*, bempatrimonial.descricao as objeto 
	  			   	                      FROM mbp 
	  			   	                      inner join bempatrimonial on mbp.numerobem = bempatrimonial.numero
	  			   	                      WHERE mbp.numero = ". $id ."");
		           $result0 = @pg_query($conexao, $query0);
		           $dados = @pg_fetch_assoc($result0);	




		 		   $solicitantes = '';

		           $query1 = "SELECT id, nome FROM usuarios order by nome asc";
		           $result1 = @pg_query($conexao, $query1);
		         
		           while($lista = @pg_fetch_array($result1)){
                         
                         if($lista['id'] == $dados['idsolicitante'])
                         	$solicitantes .= '<option selected="selected" value="'.$lista['id'].'">'.utf8_decode($lista['nome']).'</option>';
                         else
                         	$solicitantes .= '<option value="'.$lista['id'].'">'.utf8_decode($lista['nome']).'</option>';

		           }
                         
                         
                   $salasOrigem = '';

                   //se for o chefe de patrimonio, busca todas as salas 
                   if($_SESSION['tipo_gestor'] == 'P')
		              $query2 = "SELECT * FROM salas order by numero asc";
		           else
		           	  $query2 = "SELECT * FROM salas where sigladpto = '".$_SESSION['depto_gestor']."' order by numero asc";

		           $result2 = @pg_query($conexao, $query2);
		         
		           while($listaSalasOri = @pg_fetch_array($result2)){

		           	     if($listaSalasOri['numero'] == $dados['numsalaorigem'])
                         	$salasOrigem .= '<option selected="selected" value="'.$listaSalasOri['numero'].'">'.utf8_decode($listaSalasOri['descricao'].' ('.$listaSalasOri['sigladpto'].')').'</option>';
                         else
                         	$salasOrigem .= '<option value="'.$listaSalasOri['numero'].'">'.utf8_decode($listaSalasOri['descricao'].' ('.$listaSalasOri['sigladpto'].')').'</option>';

		           }

		           $salasDestino = '';

		           //se for o chefe de patrimonio, busca todas as salas 
                   if($_SESSION['tipo_gestor'] == 'P')
		              $query3 = "SELECT * FROM salas order by numero asc";
		           else
		           	  $query3 = "SELECT * FROM salas where sigladpto = '".$_SESSION['depto_gestor']."' order by numero asc";

		           $result3 = @pg_query($conexao, $query3);
		         
		           while($listaSalasDes = @pg_fetch_array($result3)){

		           	     if($listaSalasDes['numero'] == $dados['numsaladestino'])
                         	$salasDestino .= '<option selected="selected" value="'.$listaSalasDes['numero'].'">'.utf8_decode($listaSalasDes['descricao'].' ('.$listaSalasDes['sigladpto'].')').'</option>';
                         else
                         	$salasDestino .= '<option value="'.$listaSalasDes['numero'].'">'.utf8_decode($listaSalasDes['descricao'].' ('.$listaSalasDes['sigladpto'].')').'</option>';

		           }


		           $autorizadores = '<option value="">Selecione...</option>';

		           //busca todos os chefes do departamento relacionado a sala de origem do bem patrimonial
		           $query4 = "SELECT id, nome, sigladpto, tipo FROM usuarios where tipo <> 'F' order by nome asc";
		           $result4 = @pg_query($conexao, $query4);
		         
		           while($lista2 = @pg_fetch_array($result4)){
                         
                         $query5 = "SELECT sigladpto FROM salas where numero = ".$dados['numsalaorigem']."";
		                 $result5 = @pg_query($conexao, $query5);
		           		 
		           		 $verifica = @pg_fetch_assoc($result5);	

		           		 //se for chefe de depto tem q verificar se está relacionado a sala de origem
		           		 if($lista2['tipo'] == 'D'){
                            
                            if($verifica['sigladpto'] == $lista2['sigladpto']){

                               if($lista2['id'] == $dados['idautorizador'])
	                         	  $autorizadores .= '<option selected="selected" value="'.$lista2['id'].'">'.utf8_decode($lista2['nome']).' ('.$lista2['tipo'].')</option>';
	                           else
	                         	  $autorizadores .= '<option value="'.$lista2['id'].'">'.utf8_decode($lista2['nome']).' ('.$lista2['tipo'].')</option>';	

                            }

                         //chefe de patrimonio, não precisa verificar se a sala está relacionada ao departamento   
		           		 }else{

                             if($lista2['id'] == $dados['idautorizador'])
	                         	$autorizadores .= '<option selected="selected" value="'.$lista2['id'].'">'.utf8_decode($lista2['nome']).' ('.$lista2['tipo'].')</option>';
	                         else
	                         	$autorizadores .= '<option value="'.$lista2['id'].'">'.utf8_decode($lista2['nome']).' ('.$lista2['tipo'].')</option>';
		           		 }
		           		 
		           }


                                	

			
				   echo ('<!-- Form validation -->
						<div class="space30"></div>
						<h5 class="widget-name"><i class="icon-ok"></i>Altera&ccedil;&atilde;o de Movimenta&ccedil;&atilde;o de Bem Patrimonial</h5>
		
						<form id="form" class="form-horizontal" action="#">
							<fieldset>
							
								<input type="hidden" name="opcao" id="opcao" value="movimentacoes" /> 
								<input type="hidden" name="acao" id="acao" value="operacoes/edicao" />
								<input type="hidden" name="id" id="id" value="'.$id.'" />
		
								<!-- Form validation -->
								<div class="widget">
								
								    <ul class="toolbar">
										<li><a href="javascript:window.history.back();" class="tip" title="Voltar"><i class="icon-chevron-left"></i><span>Voltar</span></a></li>
									</ul>
									<br />
								
									<div class="navbar"><div class="navbar-inner"><h6>Informa&ccedil;&otilde;es da Movimenta&ccedil;&atilde;o</h6></div></div>
									<div class="well row-fluid">
		
										<div class="control-group">
											<label class="control-label">Data da Solicita&ccedil;&atilde;o: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span4 datepicker required" value="'.formatData($dados['datasolicitacao']).'" name="datasolicitacao" id="datasolicitacao" title="Data da Solicita&ccedil;&atilde;o" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Motivo: <span class="text-error">*</span></label>
											<div class="controls">
												<input type="text" class="span12 required" value="'.utf8_decode($dados['motivo']).'" maxlength="200" name="motivo" id="motivo" title="Motivo" />
											</div>
										</div>


										<div class="control-group">
											<label class="control-label">Solicitante: <span class="text-error">*</span></label>
											<div class="controls">
												<select class="select required" name="solicitante" id="solicitante" title="Solicitante" style="width:268px">
											    <option value="">Selecione...</option>
												'.$solicitantes.'
											   </select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Sala de Origem: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="salaOrigem" id="salaOrigem" title="Sala de Origem" style="width:268px">
											  '.$salasOrigem.'  
											 </select>
											</div>
										</div>

										<div class="control-group">
										 <label class="control-label">Bem Patrimonial: <span class="text-error">*</span></label>
										  <div class="controls">
										   <select class="select required" name="bemPatrimonial" id="bemPatrimonial" title="Bem Patrimonial" style="width:268px">
										    <option value="'.$dados['numerobem'].'">'.utf8_decode($dados['objeto']).'</option>
										   </select>
									      </div>
										</div>

										<div class="control-group">
											<label class="control-label">Sala de Destino: <span class="text-error">*</span></label>
											<div class="controls">
											 <select class="select required" name="salaDestino" id="salaDestino" title="Sala de Destino" style="width:268px">
											  '.$salasDestino.'  
											 </select>
											</div>
										</div>
                                        <div class="control-group" '.($_SESSION['tipo_gestor'] != 'F' ? '' : 'style="display:none;"').'>
										 <label class="control-label">Autorizado por: <span class="text-error">*</span></label>
										 <div class="controls">
										  <select class="select required" name="autorizador" id="autorizador" title="Autorizado por" style="width:268px">
										    '.$autorizadores.'  
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
	
	     
	   
	  
	  }else{

		  $query1 = "SELECT mbp.*, bempatrimonial.descricao as objeto, usuarios.nome as solicitante from mbp
		             inner join bempatrimonial on mbp.numerobem = bempatrimonial.numero
		             inner join usuarios on mbp.idsolicitante = usuarios.id
		             order by mbp.numero asc";  
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){

		  		if($lista['idautorizador'] == '')
		  		   $situacao = 'Pendente';
		  		else{

		  		   $query2 = "select nome from usuarios where id = ".$lista['idautorizador']."";
		  		   $result2 = @pg_query($conexao, $query2);

		  		   $autorizada = @pg_fetch_assoc($result2);

		  		   $situacao = 'Autorizada por<br>'.$autorizada['nome'].'<br>'.formatData($lista['dataconfirmacao']).' - '.substr($lista['horaconfirmacao'],0,5);   	
		  		}

		  		//se for o chefe de patrimonio lista todas
                if($_SESSION['tipo_gestor'] == 'P')
		  		   $query3 = "select descricao from salas where numero = '".$lista['numsalaorigem']."'";
		  		else
		  		   $query3 = "select descricao from salas where numero = '".$lista['numsalaorigem']."' and sigladpto = '".$_SESSION['depto_gestor']."'";	

		  		$result3 = @pg_query($conexao, $query3); 

		  		$origem = @pg_fetch_assoc($result3);

		  		//se for o chefe de patrimonio lista todas
		  		if($_SESSION['tipo_gestor'] == 'P')
			   	   $query4 = "select descricao from salas where numero = '".$lista['numsaladestino']."'";
		  		else
		  		   $query4 = "select descricao from salas where numero = '".$lista['numsaladestino']."' and sigladpto = '".$_SESSION['depto_gestor']."'";
		  		   	
		  		$result4 = @pg_query($conexao, $query4); 

		  		$destino = @pg_fetch_assoc($result4);



		  		if(@pg_affected_rows($result3) > 0 && @pg_affected_rows($result4) > 0){

				    $listagem .= '<tr id="item_'.$lista['numero'].'">
								   <td style="text-align:center">'.$lista['numero'].'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['motivo'])).'</td>
								   <td>'.utf8_decode($lista['motivo']).'</td>
								   <td style="text-align:center">'.formatData($lista['datasolicitacao']).'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['solicitante'])).'</td>
								   <td style="text-align:center">'.utf8_decode($lista['solicitante']).'</td>
								   <td style="text-align:center">'.$lista['numsalaorigem'].'</td>
								   <td style="text-align:center">'.$lista['numsaladestino'].'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['objeto'])).'</td>
								   <td>'.utf8_decode($lista['objeto']).'</td>
								   <td style="text-align:center">'.$situacao.'</td>
								   <td>
								    <ul class="table-controls">
								    <li><a href="'.ROOT_ADMIN.'/movimentacoes/edit/'.$lista['numero'].'" class="btn tip" title="Editar"><i class="icon-pencil"></i></a> </li>
								    <li><a href="javascript:Excluir(\'movimentacoes\',\''.$lista['numero'].'\');" class="btn tip" title="Excluir"><i class="icon-trash"></i></a></li>
								   </ul>
								  </td>
							     </tr>';
			    }
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Lista de Movimenta&ccedil;&atilde;o de Bens Patrimoniais</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="'.ROOT_ADMIN.'/movimentacoes/add" class="tip" title="Nova Movimenta&ccedil;&atilde;o"><i class="icon-plus"></i><span>Cadastrar</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="8%">N&uacute;mero</th>
									<th style="display:none;">Oculto</th>
                                    <th width="12%">Motivo</th>
                                    <th style="text-align:center" width="8%">Data<br>Solicita&ccedil;&atilde;o</th>
                                    <th style="display:none;">Oculto</th>
									<th style="text-align:center" width="12%">Solicitante</th>
									<th style="text-align:center" width="10%">Sala Origem</th>
									<th style="text-align:center" width="10%">Sala Destino</th>
									<th style="display:none;">Oculto</th>
                                    <th width="15%">Bem Patrimonial</th>
                                    <th style="text-align:center" width="10%">Situa&ccedil;&atilde;o</th>	
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
