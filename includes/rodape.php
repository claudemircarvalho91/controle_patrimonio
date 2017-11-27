<div class="copyrights">&copy; <?=strtolower(str_replace('-','',$titulo_global))?></div>
<ul class="footer-links">
 <li><a href="mailto:claudemir.91@outlook.com?subject=Erro Sistema [<?=$titulo_global?>]"><i class="icon-screenshot"></i>Informar Erro</a></li>
</ul>




<div id="busca">
 <form id="form_busca" class="form-horizontal" action="#">
  <fieldset>
  <!-- Form validation -->
 
 <div class="widget" style="padding:0; margin:0;">
  <div class="navbar"><div class="navbar-inner"><h6>Filtrar Cliente</h6></div></div>
  
  <div class="well row-fluid">
  	 
    <div>
	 <div class="control-group">
	  <label class="control-label" style="color:#666">Sexo:</label>
	  <div class="controls">
	   <select class="select" name="sexo_busca" id="sexo_busca" title="Sexo">
		<option value="">Selecione...</option>
		<option value="FEMININO">Feminino</option>
		<option value="MASCULINO">Masculino</option>
		</select>
	  </div>
	 </div>
	 <div class="control-group">
	  <label class="control-label" style="color:#666">Idade:</label>
	  <div class="controls">
	   <select class="select" name="idade_busca" id="idade_busca" title="Idade">
		<option value="">Selecione...</option>
		<option value="0-17">Menor de 18</option>
		<option value="18-25">Entre 18 a 25</option>
		<option value="26-30">Entre 26 a 30</option>
		<option value="31-39">Entre 31 a 39</option>
		<option value="40-50">Entre 40 a 50</option>
		<option value="51-100">Acima de 50</option>
		</select>
	  </div>
	 </div>

	 </div>
	 <div class="control-group">
	  <label class="control-label" style="color:#666">Bairro:</label>
	  <div class="controls">
	   <input type="text" class="span12" name="bairro_busca" id="bairro_busca" title="bairro">
	  </div>
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
	  var elemento5 = '@@';
	  
	  if($('#sexo_busca').val() != '' || $('#idade_busca').val() != '' || $('#escolaridade_busca').val() != '' || $('#ocupacao_busca').val() != '' || $('#bairro_busca').val() != ''){

	  	 if($('#sexo_busca').val() != '')
	  	    elemento1 = '@@sexo='+$('#sexo_busca').val();
	  	 if($('#idade_busca').val() != '')
	  	    elemento2 = '@@idade='+$('#idade_busca').val();
	  	 if($('#escolaridade_busca').val() != '')
	  	    elemento3 = '@@grau='+$('#escolaridade_busca').val();
	  	 if($('#ocupacao_busca').val() != '')
	  	    elemento4 = '@@ocupacao='+$('#ocupacao_busca').val();
	  	 if($('#bairro_busca').val() != '')
	  	    elemento5 = '@@bairro='+$('#bairro_busca').val();

		 window.location.href = path+'/clientes/filtro/'+elemento1+''+elemento2+''+elemento3+''+elemento4+''+elemento5;
	   
	  }else{
		    $('#error').text('Selecione ao menos 1 campo para filtrar'); 
		    $('#error').hide().fadeIn(1000); 
	  }
  
	});

</script>