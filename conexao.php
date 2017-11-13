<?

$titulo_global = 'Sistema de Controle de Patrim&ocirc;nio';

@date_default_timezone_set('America/Sao_Paulo');

if($_SERVER['REMOTE_ADDR'] != '127.0.0.1' && $_SERVER['REMOTE_ADDR'] != '::1'){

	@define('ROOT','http://localhost:8080/patrimonio');
   @define('ROOT_ADMIN','http://localhost:8080/patrimonio');
   
      $server_db  =  'localhost';
      $usuario_db =  'postgres';
      $senha_db   =  'root';
      $banco_db   =  'patrimonio';
  
   
}else{
	
   @define('ROOT','http://localhost:8080/patrimonio');
   @define('ROOT_ADMIN','http://localhost:8080/patrimonio');
   
      $server_db  =  'localhost';
      $usuario_db =  'queops';
      $senha_db   =  'piramide';
      $banco_db   =  'patrimonio';

}

$conexao = @pg_connect ("host=".$server_db." dbname=".$banco_db." port=5432 user=".$usuario_db." password=".$senha_db."");

if(!$conexao){
   print "<p class=\"status\"><font class=\"status\">Não foi possível estabelecer uma conexão com o banco de dados.</p>";
}

?>