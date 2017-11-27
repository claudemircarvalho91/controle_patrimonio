<?

function Resposta($texto){
	echo $texto;
}

function ExisteElemento($tabela, $parametro1, $valor1, $parametro2, $valor2){
	
	include('conexao.php');

	$SQL = "select * from ".$tabela." where ".$parametro1." = '".$valor1."'";
    
	if($parametro2 != '')
	   $SQL .= " and ".$parametro2." = '".$valor2."'";

	$result = @pg_query($conexao, $SQL);

    return @pg_num_rows($result);
}

function parseInt($string) {
//	return intval($string);
	if(@preg_match('/(\d+)/', $string, $array)) {
		return $array[1];
	} else {
		return 0;
	}
}

function RemoveCaracteres($string){
	
	$string = str_replace('<','',$string);
	$string = str_replace('>','',$string);
	$string = str_replace('{','',$string);
	$string = str_replace('}','',$string);
	$string = str_replace('$','',$string);
	$string = str_replace('|','',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace("--",'',$string);
	$string = str_replace("&",'',$string);

    return $string;
}

//converte registro do mysql do formato datetime para timestamp
function Datetime_to_Timestamp($str) {

   list($date, $time) = explode(' ', $str);
   list($year, $month, $day) = explode('-', $date);
   list($hour, $minute, $second) = explode(':', $time);

   $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

   return $timestamp;
}

function Segundos_to_Minutos($tempo){

    //obtem os segundos
    $segundos = $tempo % 60;
	//obtem os minutos
    $minutos = ($tempo - $segundos) / 60;
	
	if($segundos < 10)
	   $segundos = '0'.$segundos;

    return '0'.$minutos.':'.$segundos;

}

function ImprimeTitulo($palavra){

  $palavra = str_replace('á','Á',$palavra);
  $palavra = str_replace('&aacute;','&Aacute;',$palavra);
  $palavra = str_replace('à','À',$palavra);
  $palavra = str_replace('&agrave;','&Agrave;',$palavra);
  $palavra = str_replace('â','Â',$palavra);
  $palavra = str_replace('&acirc;','&Acirc;',$palavra);
  $palavra = str_replace('ã','Ã',$palavra);
  $palavra = str_replace('&atilde;','&Atilde;',$palavra);
  $palavra = str_replace('é','É',$palavra);
  $palavra = str_replace('&eacute;','&Eacute;',$palavra);
  $palavra = str_replace('ê','Ê',$palavra);
  $palavra = str_replace('&ecirc;','&Ecirc;',$palavra);
  $palavra = str_replace('í','Í',$palavra);
  $palavra = str_replace('&iacute;','&Iacute;',$palavra);
  $palavra = str_replace('ó','Ó',$palavra);
  $palavra = str_replace('&oacute;','&Oacute;',$palavra);
  $palavra = str_replace('ô','Ô',$palavra);
  $palavra = str_replace('&ocirc;','&Ocirc;',$palavra);
  $palavra = str_replace('õ','Õ',$palavra);
  $palavra = str_replace('&otilde;','&Otilde;',$palavra);
  $palavra = str_replace('ú','Ú',$palavra);
  $palavra = str_replace('&uacute;','&Uacute;',$palavra);
  $palavra = str_replace('ç','Ç',$palavra);
  $palavra = str_replace('&ccedil;','&Ccedil;',$palavra);

  return strtoupper($palavra);

}

function ImprimeMinusculo($palavra){

  $palavra = str_replace('Á','á',$palavra);
  $palavra = str_replace('&Aacute;','&aacute;',$palavra);
  $palavra = str_replace('À','À',$palavra);
  $palavra = str_replace('&Agrave;','&agrave;',$palavra);
  $palavra = str_replace('Â','â',$palavra);
  $palavra = str_replace('&Acirc;','&acirc;',$palavra);
  $palavra = str_replace('Ã','ã',$palavra);
  $palavra = str_replace('&Atilde;','&atilde;',$palavra);
  $palavra = str_replace('É','é',$palavra);
  $palavra = str_replace('&Eacute;','&eacute;',$palavra);
  $palavra = str_replace('Ê','ê',$palavra);
  $palavra = str_replace('&Ecirc;','&ecirc;',$palavra);
  $palavra = str_replace('Í','í',$palavra);
  $palavra = str_replace('&Iacute;','&iacute;',$palavra);
  $palavra = str_replace('Ó','ó',$palavra);
  $palavra = str_replace('&Oacute;','&oacute;',$palavra);
  $palavra = str_replace('Ô','ô',$palavra);
  $palavra = str_replace('&Ocirc;','&ocirc;',$palavra);
  $palavra = str_replace('Õ','õ',$palavra);
  $palavra = str_replace('&Otilde;','&otilde;',$palavra);
  $palavra = str_replace('Ú','ú',$palavra);
  $palavra = str_replace('&Uacute;','&uacute;',$palavra);
  $palavra = str_replace('Ç','ç',$palavra);
  $palavra = str_replace('&Ccedil;','&ccedil;',$palavra);

  return strtolower($palavra);

}

function Moeda($valor){
	
	if($valor != '')
  	   $valor = str_replace(",",".",str_replace(".","",$valor));
	else
	   $valor = '0.00';
	   
	return $valor;
}

function SomaSubtraiDias($operacao, $data, $dias){
	
	if($operacao == 'soma')
	   return $retorno = date('Y-m-d', strtotime("+".$dias." days",strtotime($data)));
	else
	   return date('Y-m-d', strtotime("-".$dias." days",strtotime($data)));
}

/**
 * Função que recebe um ano e retorna um boolean informando se ele é ou não bissexto.
 *
 * @params (integer) $ano - Ano que deseja saber se é ou não bissexto.
 * @return (boolean) $bissesxto - Boolean informando se é bissexto (true) ou se não é bissexto (false).
 */
function Bissexto($ano){
    $bissexto = false;
    // Divisível por 4 e não divisível por 100 ou divisível por 400
    if((($ano%4) == 0 && ($ano%100) != 0) || ($ano%400) == 0 )
       $bissexto = true;
    
	return $bissexto;
}

function IntervaloDias($inicio, $final){

   $diff =  strtotime($final) - strtotime($inicio);
   
   // 24 horas * 60 Min * 60 seg = 86400
   $dias = ceil($diff/86400);
   
   return $dias;
}

function anti_sql_injection($string){
   
     $string = @get_magic_quotes_gpc() ? @stripslashes($string) : $string;
     $string = @function_exists("mysql_real_escape_string") ? @mysql_real_escape_string($string) : @mysql_escape_string($string);
     return $string;
}

function RemoveAcentuacaoURLAmigavel($texto){
	
	$texto = str_replace(".","",$texto);
	$texto = str_replace(":","",$texto);
	$texto = str_replace(";","",$texto);
	$texto = str_replace(",","",$texto);
	$texto = str_replace("'","",$texto);
	$texto = str_replace("@","",$texto);
	$texto = str_replace("+","",$texto);
	$texto = str_replace('\'',"",$texto);
	$texto = str_replace('"','',$texto);
	$texto = str_replace('?','',$texto);
	$texto = str_replace('!','',$texto);
	$texto = str_replace('%','',$texto);
	$texto = str_replace('&','',$texto);
	$texto = str_replace('(','',$texto);
	$texto = str_replace(')','',$texto);
	$texto = str_replace('[','',$texto);
	$texto = str_replace(']','',$texto);	
	$texto = str_replace('/','',$texto);
	$texto = str_replace('-','_',$texto);
	$texto = str_replace('  ',' ',$texto);
	$texto = str_replace(' ','_',$texto);
	$texto = str_replace('á','a',$texto);
	$texto = str_replace('à','a',$texto);
	$texto = str_replace('ã','a',$texto);
	$texto = str_replace('â','a',$texto);
	$texto = str_replace('é','e',$texto);
	$texto = str_replace('è','e',$texto);
	$texto = str_replace('ê','e',$texto);
	$texto = str_replace('í','i',$texto);
	$texto = str_replace('ì','i',$texto);
	$texto = str_replace('ó','o',$texto);
	$texto = str_replace('ò','o',$texto);
	$texto = str_replace('ô','o',$texto);
	$texto = str_replace('õ','o',$texto);
	$texto = str_replace('ü','u',$texto);
	$texto = str_replace('ù','u',$texto);
	$texto = str_replace('ú','u',$texto);
	$texto = str_replace('û','u',$texto);
	$texto = str_replace('ç','c',$texto);
	$texto = str_replace('Á','a',$texto);
	$texto = str_replace('À','a',$texto);
	$texto = str_replace('Ã','a',$texto);
	$texto = str_replace('Â','a',$texto);
	$texto = str_replace('É','e',$texto);
	$texto = str_replace('È','e',$texto);
	$texto = str_replace('Ê','e',$texto);
	$texto = str_replace('Í','i',$texto);
	$texto = str_replace('Ì','i',$texto);
	$texto = str_replace('Ó','o',$texto);
	$texto = str_replace('Ò','o',$texto);
	$texto = str_replace('Ô','o',$texto);
	$texto = str_replace('Õ','o',$texto);
	$texto = str_replace('Û','u',$texto);
	$texto = str_replace('Ú','u',$texto);
	$texto = str_replace('Ú','u',$texto);
	$texto = str_replace('Ç','c',$texto);
	$texto = str_replace("$","s",$texto);
	$texto = str_replace("¹","",$texto);
	$texto = str_replace("º","o",$texto);
	$texto = str_replace("ª","a",$texto);
	$texto = str_replace("²","",$texto);
	$texto = str_replace("³","",$texto);
	$texto = str_replace("#","",$texto);
	$texto = str_replace("|","",$texto);
	$texto = str_replace("+","",$texto);
	$texto = str_replace('--','-',$texto);
	
	return strtolower($texto);
	
}

function RemoveAcentuacao($texto){
	
	$texto = strtolower($texto);
	$texto = str_replace(";","",$texto);
	$texto = str_replace(":","",$texto);
	$texto = str_replace(",","",$texto);
	$texto = str_replace("'","",$texto);
	$texto = str_replace('"','',$texto);
	$texto = str_replace('?','',$texto);
	$texto = str_replace('!','',$texto);
	$texto = str_replace('%','',$texto);
	$texto = str_replace('&','',$texto);
	$texto = str_replace('(','',$texto);
	$texto = str_replace(')','',$texto);
	$texto = str_replace('[','',$texto);
	$texto = str_replace(']','',$texto);	
	$texto = str_replace('/','',$texto);
	$texto = str_replace('  ',' ',$texto);
	$texto = str_replace('á','a',$texto);
	$texto = str_replace('à','a',$texto);
	$texto = str_replace('ã','a',$texto);
	$texto = str_replace('â','a',$texto);
	$texto = str_replace('é','e',$texto);
	$texto = str_replace('è','e',$texto);
	$texto = str_replace('ê','e',$texto);
	$texto = str_replace('í','i',$texto);
	$texto = str_replace('ì','i',$texto);
	$texto = str_replace('ó','o',$texto);
	$texto = str_replace('ò','o',$texto);
	$texto = str_replace('ô','o',$texto);
	$texto = str_replace('õ','o',$texto);
	$texto = str_replace('ü','u',$texto);
	$texto = str_replace('ù','u',$texto);
	$texto = str_replace('ú','u',$texto);
	$texto = str_replace('û','u',$texto);
	$texto = str_replace('ç','c',$texto);
	$texto = str_replace("$","s",$texto);
	$texto = str_replace("¹","1",$texto);
	$texto = str_replace("º","&ordm;",$texto);
	$texto = str_replace("ª","&ordf;",$texto);
	$texto = str_replace("²","2",$texto);
	$texto = str_replace("³","3",$texto);
	$texto = str_replace("#","",$texto);
	$texto = str_replace("|","",$texto);
	
	return $texto;
	
}

function GeraFotos($largura, $altura, $imagem, $sufixo){

   //NOME DO ARQUIVO DA MINIATURA
   $imagem_gerada = explode(".", $imagem);
   $imagem_gerada = $imagem_gerada[0]."".$sufixo.""; 

   //CRIA UMA NOVA IMAGEM
   $imagem_orig = ImageCreateFromJPEG($imagem);
   //LARGURA
   $pontoX = ImagesX($imagem_orig);
   //ALTURA
   $pontoY = ImagesY($imagem_orig); 


   //verifica tipo
   if($pontoX > $pontoY){

      //imagem paisagem

   }else{

      //imagem retrato
      $aux = $largura;
      $largura = $altura;
      $altura = $aux;    

   }

   //CRIA O THUMBNAIL
   $imagem_fin = ImageCreateTrueColor($largura, $altura); 

   //COPIA A IMAGEM ORIGINAL PARA DENTRO
   ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY); 

   //SALVA A IMAGEM
   ImageJPEG($imagem_fin, $imagem_gerada,80); 

   //LIBERA A MEMÓRIA
   ImageDestroy($imagem_orig);
   ImageDestroy($imagem_fin);
}

function formatData($val){
	$arr = @explode("-", $val);
	return @date("d/m/Y", @mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}

function Dataformat($val){
	$arr = @explode("/", $val);
	return ''.$arr[2].'-'.$arr[1].'-'.$arr[0].'';
}

function DataPontoShort($val){
	$arr = @explode("-", $val);
	return @date("d.m.y", @mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}

function DataPontoLong($val){
	$arr = @explode("-", $val);
	return @date("d.m.Y", @mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}

function formatData2($val){

  $dia = @substr($val,8,2);
  $mes = @substr($val,5,2);
  $ano = @substr($val,0,4);

  return ''.$dia.'/'.$mes.'/'.$ano.'';

}

function TipoImagem($foto){
  
   list($width, $height) = @getimagesize($foto);

   if($width > $height)
      
      $retorno = 'paisagem';
          
   if($width < $height)

      $retorno = 'retrato';
 
   return $retorno;

}


function retorna_data($data, $dia_semana, $nome_mes){

   $retorno = '';	
   
   //Bloco de códigos para dias da semana
   if($dia_semana == true){
	  
	  $week = strftime('%w',strtotime($data));
	   
      if($week == 0)     {$semana = "Domingo";}
      elseif($week == 1) {$semana = "Segunda-feira";}
      elseif($week == 2) {$semana = "Ter&ccedil;a-feira";}
      elseif($week == 3) {$semana = "Quarta-feira";}
      elseif($week == 4) {$semana = "Quinta-feira";}
      elseif($week == 5) {$semana = "Sexta-feira";}
      elseif($week == 6) {$semana = "S&aacute;bado";}
	  
	  $retorno = $semana.'@';
	  
   }
   
   //Bloco de códigos para os meses
   if($nome_mes == true){
      if(substr($data,5,2) == '01') {$mes="Janeiro";}
      elseif(substr($data,5,2) == '02') {$mes="Fevereiro";}
      elseif(substr($data,5,2) == '03') {$mes="Mar&ccedil;o";}      
      elseif(substr($data,5,2) == '04') {$mes="Abril";}
      elseif(substr($data,5,2) == '05') {$mes="Maio";}
      elseif(substr($data,5,2) == '06') {$mes="Junho";}
      elseif(substr($data,5,2) == '07') {$mes="Julho";}
      elseif(substr($data,5,2) == '08') {$mes="Agosto";}
      elseif(substr($data,5,2) == '09') {$mes="Setembro";}
      elseif(substr($data,5,2) == '10') {$mes="Outubro";}
      elseif(substr($data,5,2) == '11') {$mes="Novembro";}
      elseif(substr($data,5,2) == '12') {$mes="Dezembro";}
	  
	  $retorno .= $mes;
   }
   
   //juntando os dias da semana e os meses..tratar o retorno com explode('@',$retorno);
   return $retorno;
}

function MenuVertical($pagina){
	
	
  //buscando conteudo na tebela sub_paginas
  $SQL = "select id, cod_pagina, titulo, conteudo, destino, alvo from sub_paginas where relacao = '".$pagina."' order by titulo asc";
  $result = @mysql_query($SQL);
  

  if(@mysql_num_rows($result) > 0 ){//lista os submenus
  
     echo('<ul>');

     for($i = 1; $nivel1 = @mysql_fetch_row($result); $i++){
 
           //verificar se não é o ultimo item do menu...adiciona o estilo da borda inferior
		   if($i != @mysql_num_rows($result))
		      $borda = " style=\"border-bottom:1px solid #CCC;\"";
           else
		      $borda = '';
 
 
           //verificar se tem conteudo interno e/ou externo            
           if($nivel1[3] == "" && $nivel1[4] == "") 
              echo('<li'.$borda.'><a style="cursor:default;" href="javascript:void(0);">'.$nivel1[2].'</a>');
           else if($nivel1[3] != "" && $nivel1[4] == "")
              echo('<li'.$borda.'><a href="pagina.php?id='.$nivel1[0].'">'.$nivel1[2].'</a>');
		   else
              echo('<li'.$borda.'><a href="'.$nivel1[4].'" target="'.$nivel1[5].'">'.$nivel1[2].'</a>');

		   $SQL2 = "select id, cod_sub_pagina, titulo, destino, alvo from sub_sub_paginas where relacao = '".$pagina."' and cod_sub_pagina = '".$nivel1[0]."' order by titulo asc";
		   $result2 = @mysql_query($SQL2);
		   $total2 = @mysql_num_rows($result2);
				
		   if($total2 == 0)//nao tem subpaginas
		      echo('</li>');
		   else{
			  echo('<ul style="margin-left:-33px; margin-top:-1px;">');
		      
              for($j = 1; $nivel2 = @mysql_fetch_row($result2); $j++){

                  //verificar se não é o ultimo item do menu...adiciona o estilo da borda inferior
				  if($j != @mysql_num_rows($result2))
					 $sub_borda = " style=\"border-bottom:1px solid #CCC;\"";
				  else
					 $sub_borda = '';

                    //verificar conteudo interno ou externo
                    if($nivel2[3] == "")
                       echo('<li'.$sub_borda.'><a href="subpagina.php?id='.$nivel2[0].'">'.$nivel2[2].'</a>');
		            else
                       echo('<li'.$sub_borda.'><a href="'.$nivel2[3].'" target="'.$nivel2[4].'">'.$nivel2[2].'</a>');
					
				    echo('</li>');
				   
	 
              }//for
			  echo('</ul>');
			  echo('</li>');
		   
           }//else
   
	 }//for
     echo('</ul>');
	 
  }//if

}

function validaCPF($cpf){

	// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
	return false;
    }
	else
	{   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

function is_cnpj($str) {
		
	$sum1 = 0;
	$sum2 = 0;
	$sum3 = 0;
	$calc1 = 5;
	$calc2 = 6;

	for ($i=0; $i <= 12; $i++) {
		$calc1 = $calc1 < 2 ? 9 : $calc1;
		$calc2 = $calc2 < 2 ? 9 : $calc2;

		if ($i <= 11)
			$sum1 += $str[$i] * $calc1;

		$sum2 += $str[$i] * $calc2;
		$sum3 += $str[$i];
		$calc1--;
		$calc2--;
	}

	$sum1 %= 11;
	$sum2 %= 11;

	return ($sum3 && $str[12] == ($sum1 < 2 ? 0 : 11 - $sum1) && $str[13] == ($sum2 < 2 ? 0 : 11 - $sum2)) ? $str : false;
}

function GeraSenha($tamanho, $maiuscula, $minuscula, $numeros){

  $maius = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
  $minus = "abcdefghijklmnopqrstuwxyz";
  $numer = "0123456789";

  $base = '';

  $base .= ($maiuscula) ? $maius : '';

  $base .= ($minuscula) ? $minus : '';

  $base .= ($numeros) ? $numer : '';

  srand((float) microtime() * 10000000);

  $senha = '';

  for ($i = 0; $i < $tamanho; $i++)
      $senha .= substr($base, rand(0, strlen($base)-1), 1);

  return $senha;

}

function UrlAtual(){
   $dominio= $_SERVER['HTTP_HOST'];
   $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];
   return $url;
}

function resumo($string,$chars) {
  if (strlen($string) > $chars) {
    while (substr($string,$chars,1) <> ' ' && ($chars < strlen($string))){
      $chars++;
    }
  }
  return substr($string,0,$chars);
}

function calcula_idade($data_nascimento, $data_calcula){
    // as datas devem ser no formato aaaa-mm-dd
 
    //conversão das datas para o formato de tempo linux
    $data_nascimento = strtotime($data_nascimento." 00:00:00");
    $data_calcula = strtotime($data_calcula." 00:00:00");
 
    //cálculo da idade fazendo a diferença entre as duas datas
    $idade = floor(abs($data_calcula-$data_nascimento)/60/60/24/365);
 
    return($idade);
} 

?>