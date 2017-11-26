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

				
	  	if($acao == ''){
	  

		  $query1 = "SELECT salas.numero as numerosala, salas.descricao as sala, salas.sigladpto, 
		  				    predios.nome as nomepredio
		  		     FROM salas
		  				    inner join predios on salas.codpredio = predios.codigo";  
          $result1 = @pg_query($conexao, $query1);
		   
		  $listagem = ''; 
		   
		  while($lista = @pg_fetch_array($result1)){
		  		
		  		$query2 = "SELECT bempatrimonial.numero as numbem, bempatrimonial.descricao as descricaobem, bempatrimonial.situacao as situacaobem, 
		  		                  categorias.nome as categoria, categorias.vidautil 
                           FROM bempatrimonial 
                           inner join categorias on bempatrimonial.codcategoria = categorias.codigo
                           WHERE bempatrimonial.numsala = '".$lista['numerosala']."'";
		  		   	
		  		$result2 = @pg_query($conexao, $query2); 
		  		$objeto = @pg_fetch_assoc($result2);

		  		if(@pg_affected_rows($result2) > 0){

			  		$listagem .= '<tr id="item_'.$objeto['numbem'].'">
								   <td style="text-align:center">'.$objeto['numbem'].'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($objeto['descricaobem'])).'</td>
								   <td>'.utf8_decode($objeto['descricaobem']).'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($objeto['categoria'])).'</td>
								   <td>'.utf8_decode($objeto['categoria']).'</td>
								   <td style="text-align:center">'.utf8_decode($objeto['vidautil']).' ano(s)</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nomepredio'])).'</td>
								   <td style="text-align:center">'.utf8_decode($lista['nomepredio']).'</td>
								   <td style="text-align:center">'.utf8_decode($lista['sigladpto']).'</td>
								   <td style="text-align:center">'.$lista['numerosala'].' - '.utf8_decode($lista['sala']).'</td>
								   <td style="text-align:center">'.utf8_decode($objeto['situacaobem']).'</td>
							     </tr>';
				}			     
			
		  } 
		   
		  echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Invent&aacute;rio</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="#busca" class="popup tip" title="Filtrar"><i class="icon-filter"></i><span>Filtrar</span></a></li>
                        <li><a href="'.ROOT.'/exportar.php" target="_blank" class="tip" title="Exportar PDF"><i class="icon-print"></i><span>Exportar PDF</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="8%">N&uacute;m. do Bem</th>
									<th style="display:none;">Oculto</th>
                                    <th width="20%">Bem Patrimonial</th>
                                    <th style="display:none;">Oculto</th>
									<th width="12%">Categoria</th>
									<th style="text-align:center" width="10%">Vida &uacute;til</th>
									<th style="display:none;">Oculto</th>
									<th style="text-align:center" width="10%">Pr&eacute;dio</th>
									<th style="text-align:center" width="10%">Depto</th>
									<th style="text-align:center" width="10%">Sala</th>
                                    <th style="text-align:center" width="10%">Situa&ccedil;&atilde;o</th>	
                                </tr>
                            </thead>
                            <tbody>
                                '.$listagem.'
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /default datatable -->'); 
		   
	   
		}else if($acao == 'filtro'){


			$params = explode('@@',$id);

		    $sql1 = '';
		    $sql2 = '';
		    $get = '?data=export';

		    if(strpos($id, 'predio=') !== false){
          	   $filtroPredio = str_replace('predio=','',$params[1]);
          	   $get .= "&predio=".$filtroPredio;
          	   $sql1 .= "AND salas.codpredio = ".$filtroPredio."";
            }

            if(strpos($id, 'departamento=') !== false){
          	   $filtroDepto = str_replace('departamento=','',$params[2]);
          	   $get .= "&depto=".$filtroDepto;
          	   $sql1 .= "AND salas.sigladpto = '".$filtroDepto."'";  
            }

            if(strpos($id, 'sala=') !== false){
          	   $filtroSala = str_replace('sala=','',$params[3]);
          	   $get .= "&sala=".$filtroSala;
          	   $sql1 .= "AND salas.numero = ".$filtroSala."";
            }

            if(strpos($id, 'categoria=') !== false){
          	   $filtroCategoria = str_replace('categoria=','',$params[4]);
          	   $get .= "&categoria=".$filtroCategoria;
          	   $sql2 .= "AND bempatrimonial.codcategoria = '".$filtroCategoria."'";
            }


            $query1 = "SELECT salas.numero as numerosala, salas.descricao as sala, salas.sigladpto, 
		  				      predios.nome as nomepredio
		  		       FROM salas
		  				    inner join predios on salas.codpredio = predios.codigo
		  			   WHERE salas.numero > 0 ".$sql1."";  
            $result1 = @pg_query($conexao, $query1);
		   
		    $listagem = ''; 
		   
		    while($lista = @pg_fetch_array($result1)){
		  		
		  		  $query2 = "SELECT bempatrimonial.numero as numbem, bempatrimonial.descricao as descricaobem, bempatrimonial.situacao as situacaobem, 
		  		                    categorias.nome as categoria, categorias.vidautil 
                             FROM bempatrimonial 
                             inner join categorias on bempatrimonial.codcategoria = categorias.codigo
                             WHERE bempatrimonial.numsala = '".$lista['numerosala']."' ".$sql2."";
		  		   	
		  		  $result2 = @pg_query($conexao, $query2); 
		  		  $objeto = @pg_fetch_assoc($result2);

		  		  if(@pg_affected_rows($result2) > 0){

			  		$listagem .= '<tr id="item_'.$objeto['numbem'].'">
								   <td style="text-align:center">'.$objeto['numbem'].'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($objeto['descricaobem'])).'</td>
								   <td>'.utf8_decode($objeto['descricaobem']).'</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($objeto['categoria'])).'</td>
								   <td>'.utf8_decode($objeto['categoria']).'</td>
								   <td style="text-align:center">'.utf8_decode($objeto['vidautil']).' ano(s)</td>
								   <td style="display:none;">'.RemoveAcentuacao(utf8_decode($lista['nomepredio'])).'</td>
								   <td style="text-align:center">'.utf8_decode($lista['nomepredio']).'</td>
								   <td style="text-align:center">'.utf8_decode($lista['sigladpto']).'</td>
								   <td style="text-align:center">'.$lista['numerosala'].' - '.utf8_decode($lista['sala']).'</td>
								   <td style="text-align:center">'.utf8_decode($objeto['situacaobem']).'</td>
							     </tr>';
				}			     
			
		   } 
		   
		   echo ('<div class="space30"></div>
			    <h5 class="widget-name"><i class="icon-columns"></i>Invent&aacute;rio</h5>
	                                               
                <!-- Default datatable -->
                <div class="widget">

                    <ul class="toolbar">
                        <li><a href="#busca" class="popup tip" title="Filtrar"><i class="icon-filter"></i><span>Filtrar</span></a></li>
                        <li><a href="'.ROOT.'/exportar.php'.$get.'" target="_blank" class="tip" title="Exportar PDF"><i class="icon-print"></i><span>Exportar PDF</span></a></li>
                    </ul>
					<br />

                    <div class="table-overflow">
                        <table class="table table-striped table-bordered data-table2" id="data-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center" width="8%">N&uacute;m. do Bem</th>
									<th style="display:none;">Oculto</th>
                                    <th width="20%">Bem Patrimonial</th>
                                    <th style="display:none;">Oculto</th>
									<th width="12%">Categoria</th>
									<th style="text-align:center" width="10%">Vida &uacute;til</th>
									<th style="display:none;">Oculto</th>
									<th style="text-align:center" width="10%">Pr&eacute;dio</th>
									<th style="text-align:center" width="10%">Depto</th>
									<th style="text-align:center" width="10%">Sala</th>
                                    <th style="text-align:center" width="10%">Situa&ccedil;&atilde;o</th>	
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
    
    
    <?

    $query3 = "SELECT codigo as codpredio, nome as nomepredio FROM predios order by nomepredio asc";  
    $result3 = @pg_query($conexao, $query3);
		   
	$predios = ''; 
		   
	while($listaPredios = @pg_fetch_array($result3))
		  $predios .= '<option value="'.$listaPredios['codpredio'].'">'.utf8_decode($listaPredios['nomepredio']).'</option>';


    $query4 = "SELECT sigla FROM departamentos order by sigla asc";  
    $result4 = @pg_query($conexao, $query4);
		   
	$departamentos = ''; 
		   
	while($listaDeptos = @pg_fetch_array($result4))
		  $departamentos .= '<option value="'.$listaDeptos['sigla'].'">'.utf8_decode($listaDeptos['sigla']).'</option>';

    
    $query5 = "SELECT numero, descricao, sigladpto FROM salas order by numero asc";  
    $result5 = @pg_query($conexao, $query5);
		   
	$salas = ''; 
		   
	while($listaSalas = @pg_fetch_array($result5))
		  $salas .= '<option value="'.$listaSalas['numero'].'">'.$listaSalas['numero'].' - '.utf8_decode($listaSalas['descricao']).' ('.$listaSalas['sigladpto'].')</option>';


    $query6 = "SELECT codigo, nome FROM categorias order by descricao asc";  
    $result6 = @pg_query($conexao, $query6);
		   
	$categorias = ''; 
		   
	while($listaCategorias = @pg_fetch_array($result6))
		  $categorias .= '<option value="'.$listaCategorias['codigo'].'">'.utf8_decode($listaCategorias['nome']).'</option>';


    ?>
  

	<div id="busca">
	 <form id="form_busca" class="form-horizontal" action="#">
	  <fieldset>
	  <!-- Form validation -->
	 
	 <div class="widget" style="padding:0; margin:0;">
	  <div class="navbar"><div class="navbar-inner"><h6>Filtrar Invent&aacute;rio</h6></div></div>
	  
	  <div class="well row-fluid">
	  	 
	    <div>
		 <div class="control-group">
		  <label class="control-label" style="color:#666">Pr&eacute;dio:</label>
		  <div class="controls">
		   <select class="select" style="width:350px" name="predio" id="predio" title="Pr&eacute;dio">
			<option value="">Selecione...</option>
			<?=$predios?>
			</select>
		  </div>
		 </div>
		 <div class="control-group">
		  <label class="control-label" style="color:#666">Departamento:</label>
		  <div class="controls">
		   <select class="select" style="width:350px" name="departamento" id="departamento" title="Departamento">
		   	<option value="">Selecione...</option>
			<?=$departamentos?>
		   </select>
		  </div>
		 </div>
		 <div class="control-group">
		  <label class="control-label" style="color:#666">Sala:</label>
		  <div class="controls">
		   <select class="select" style="width:350px" name="sala" id="sala" title="sala">
			<option value="">Selecione...</option>
			<?=$salas?>
			</select>
		  </div>
		 </div>
		 <div class="control-group">
		  <label class="control-label" style="color:#666">Categoria:</label>
		  <div class="controls">
		   <select class="select" style="width:350px" name="categoria" id="categoria" title="Categoria">
			<option value="">Selecione...</option>
			<?=$categorias?>
			</select>
		  </div>

		</div>

		
		<div class="form-actions align-right">
			<div id="status" class="status"></div>
			<div id="error" class="erro"></div>
			<button type="button" id="buscar" class="btn btn-info">&nbsp;&nbsp;&nbsp;Filtrar&nbsp;&nbsp;&nbsp;</button>
		</div>

	  </div><!-- well row-fluid -->
	 </div><!-- widget -->

	</fieldset>
	</form>
	</div>

	<script>
	
	$('#buscar').click(function() {

	  $('#error').hide();
	  $('#error').text('');
	  
	  $('#status').hide();
	  $('#status').text('');
	  
	  var path = '<?=ROOT?>';

	  var elemento1 = '@@';
	  var elemento2 = '@@';
	  var elemento3 = '@@';
	  var elemento4 = '@@';
	  
	  if($('#predio').val() != '' || $('#departamento').val() != '' || $('#sala').val() != '' || $('#categoria').val() != ''){

	  	 if($('#predio').val() != '')
	  	    elemento1 = '@@predio='+$('#predio').val();
	  	 if($('#departamento').val() != '')
	  	    elemento2 = '@@departamento='+$('#departamento').val();
	  	 if($('#sala').val() != '')
	  	    elemento3 = '@@sala='+$('#sala').val();
	  	 if($('#categoria').val() != '')
	  	    elemento4 = '@@categoria='+$('#categoria').val();

		 window.location.href = path+'/inventario/filtro/'+elemento1+''+elemento2+''+elemento3+''+elemento4;
	   
	  }else{
		    $('#error').text('Selecione ao menos 1 campo para filtrar'); 
		    $('#error').hide().fadeIn(1000); 
	  }
  
	});

	</script>
	

</body>
</html>
