<?

@session_start();
		
//print_r($_SESSION);
		
include('../includes/conexao.php');
include('../includes/verifica.php');
include('../includes/funcoes.php');

//print_r($_POST);

function validacao($dados){
	$dados = trim($dados);
	$dados = trim(strip_tags($dados));
	return utf8_decode($dados);

}



if(isset($_GET['opcao'])){

   //obtem nome das variaveis POST
   $getVars   = array_keys($_GET);

   //obtem valores das variaveis POST
   $getValues = array_values($_GET);

   //aplica uma funcao em todo o array
   $getValues = array_map('validacao', $getValues); 

   //juntando os arrays novamente
   $var = array_combine($getVars, $getValues);	

}else if(isset($_POST['opcao'])){

   //obtem nome das variaveis POST
   $getVars   = array_keys($_POST);

   //obtem valores das variaveis POST
   $getValues = array_values($_POST);

   //aplica uma funcao em todo o array
   $getValues = array_map('validacao', $getValues); 

   //juntando os arrays novamente
   $var = array_combine($getVars, $getValues);	
}

@session_start();


if($var['opcao'] == 'movimentacoes'){

   $query1 = "SELECT numero, descricao FROM bempatrimonial WHERE numsala = ".$var['id']." ORDER BY numero asc";
   $result1 = @pg_query($conexao, $query1);

   if(@pg_affected_rows($result1) > 0){
	  
	  $retorno = ''; 

	  while($lista = @pg_fetch_array($result1))
	        $retorno .= $lista['numero'].';'.$lista['numero'].' - '.$lista['descricao'].'@';

      echo substr($retorno,0,-1);  
   }
   
}

@pg_close($conexao); 

?>