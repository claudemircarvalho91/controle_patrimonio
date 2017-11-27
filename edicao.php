<?

include('../includes/conexao.php');
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

if($var['opcao'] == 'usuarios'){
   
  if($var['senha'] != '')
     $senha = ", senha = '".md5($var['senha'])."'";
  else
     $senha = '';

  $query = utf8_encode("update usuarios set login = '".$var['login']."', nome = '".$var['nome']."' ".$senha." , email = '".$var['email']."', tipo = '".$var['tipo']."', sigladpto = '".$var['sigla']."' where id = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Usuário alterado com sucesso');
}

if($var['opcao'] == 'departamentos'){
  
  //altera dados do departamento 
  $query1 = utf8_encode("update departamentos set sigla = '".$var['sigla']."', nome = '".$var['nome']."' where sigla = '".$var['id']."'");
  $result1 = @pg_query($conexao, $query1);

  //altera a sigla nos usuarios
  $query2 = utf8_encode("update usuarios set sigladpto = '".$var['sigla']."' where sigladpto = '".$var['id']."'");
  $result2 = @pg_query($conexao, $query2);

  //altera a sigla nas salas
  $query3 = utf8_encode("update salas set sigladpto = '".$var['sigla']."' where sigladpto = '".$var['id']."'");
  $result3 = @pg_query($conexao, $query3);


  if(@pg_affected_rows($result1) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Departamento alterado com sucesso');
}

if($var['opcao'] == 'categorias'){
   
  $query = utf8_encode("update categorias set nome = '".$var['nome']."', descricao = '".$var['descricao']."', vidautil = '".$var['vidautil']."' where codigo = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Categoria alterada com sucesso');
}

if($var['opcao'] == 'predios'){
   
  $query = utf8_encode("update predios set nome = '".$var['nome']."', cep = ".$var['cep'].", logradouro = '".$var['logradouro']."', numero = '".$var['numero']."', complemento = '".$var['complemento']."', bairro = '".$var['bairro']."', cidade = '".$var['cidade']."', uf = '".$var['uf']."' where codigo = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Prédio alterada com sucesso');
}

if($var['opcao'] == 'salas'){
   
  $query = utf8_encode("update salas set comprimento = '".Moeda($var['comprimento'])."', largura = '".Moeda($var['largura'])."', descricao = '".$var['descricao']."', codpredio = '".$var['predio']."', sigladpto = '".$var['sigla']."' where numero = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Sala alterada com sucesso');
}

if($var['opcao'] == 'bens'){
   
  $query = utf8_encode("update bempatrimonial set descricao = '".$var['descricao']."', datacompra = '".Dataformat($var['datacompra'])."', prazogarantia = '".$var['prazogarantia']."', nrnotafiscal = '".$var['nrnotafiscal']."', fornecedor = '".$var['fornecedor']."', valor = '".Moeda($var['valor'])."', codcategoria = ".$var['categoria'].", numsala = ".$var['sala']." where numero = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Bem Patrimonial alterado com sucesso');
}

if($var['opcao'] == 'movimentacoes'){

  $query1 = utf8_encode("update mbp set datasolicitacao = '".Dataformat($var['datasolicitacao'])."', motivo = '".$var['motivo']."', dataconfirmacao = '".date('Y-m-d')."', horaconfirmacao = '".date('H:i:s')."', idsolicitante = '".$var['solicitante']."', idautorizador = '".$var['autorizador']."', numerobem = ".$var['bemPatrimonial'].", numsalaorigem = ".$var['salaOrigem'].", numsaladestino = ".$var['salaDestino']." where numero = ".$var['id']."");
  $result1 = @pg_query($conexao, $query1);

  if(@pg_affected_rows($result1) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else{
     
     //altera a localizacao do bem cadastrado
     $query2 = utf8_encode("update bempatrimonial set numsala = ".$var['salaDestino']." where numero = ".$var['bemPatrimonial']."");
     $result2 = @pg_query($conexao, $query2);

     Resposta('ok@Movimentação alterada com sucesso');

  }
     
}

if($var['opcao'] == 'baixa'){

  $query = utf8_encode("update baixabempatrimonial set data = '".Dataformat($var['data'])."', motivo = '".$var['motivo']."', tipo = '".$var['tipo']."' where numero = ".$var['id']."");

  $result = @pg_query($conexao, $query);

  if(@pg_affected_rows($result) == 0)
     Resposta(die('erro@Instrução inválida: '.@pg_last_error($conexao)));
  else
     Resposta('ok@Baixa alterada com sucesso');
}

@pg_close($conexao); 

?>
