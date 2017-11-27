<?
		
		@session_start();
		
		//print_r($_SESSION);
		
		include('includes/conexao.php');
		include('includes/verifica.php');
		include('includes/funcoes.php');
		
		@header('Content-Type: text/html; charset=ISO-8859-1');
		

        $pagina_atual = (isset($_GET['pg'])) ? $_GET['pg'] : 'inicio';
		
		if(substr_count($pagina_atual, '/') > 0){
            $pagina_atual  = explode('/', $pagina_atual);
			
			//imprime as variaveis
			//print_r($pagina_atual);
			
			if(isset($pagina_atual[1]))
			   $acao = $pagina_atual[1];
			else
			   $acao = '';
			   
			if(isset($pagina_atual[2]))
			   $id = $pagina_atual[2]; 
			else
			   $id = ''; 
			   
			if(isset($pagina_atual[3]))
			   $pag_paginacao = $pagina_atual[3]; 
			else
			   $pag_paginacao = '';    
			

			if(file_exists($pagina_atual[0].'.php'))
			   $pagina = $pagina_atual[0];
			else
			   $pagina = 'erro';   	
			
			$acao          = RemoveCaracteres($acao);
			$id            = RemoveCaracteres($id);
			$pag_paginacao = RemoveCaracteres($pag_paginacao);
	
        }else{

            if(file_exists($pagina_atual.'.php'))
			   $pagina = $pagina_atual;
			else
			   $pagina = 'erro';   	

			$acao          = '';
			$id            = '';
			$pag_paginacao = '';
        }
       
?>

<? require("{$pagina}.php");?>     
