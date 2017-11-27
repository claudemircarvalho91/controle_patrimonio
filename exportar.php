<?

require('includes/conexao.php');
require('includes/funcoes.php');

if(isset($_GET['data'])){
       
   if($_GET['data'] == 'export'){

      $sql1 = '';
      $sql2 = '';

      if(isset($_GET['predio'])){
         $filtroPredio = $_GET['predio'];
         $sql1 .= "AND salas.codpredio = ".$filtroPredio."";
      }

      if(isset($_GET['departamento'])){
         $filtroDepto = $_GET['departamento'];
         $sql1 .= "AND salas.sigladpto = '".$filtroDepto."'";  
      }

      if(isset($_GET['sala'])){
         $filtroSala = $_GET['sala'];
         $sql1 .= "AND salas.numero = ".$filtroSala."";
      }

      if(isset($_GET['categoria'])){
         $filtroCategoria = $_GET['categoria'];
         $sql2 .= "AND bempatrimonial.codcategoria = '".$filtroCategoria."'";
      }
   }

 }else{

   $sql1 = '';
   $sql2 = '';

 } 


   

require('includes/fpdf.php');
$pdf = new FPDF('P','mm',array(210,297));
$pdf->AliasNbPages();
$pdf->AddPage();


$query1 = "SELECT salas.numero as numerosala, salas.descricao as sala, salas.sigladpto, 
                  predios.nome as nomepredio
           FROM salas
           inner join predios on salas.codpredio = predios.codigo
           WHERE salas.numero > 0 ".$sql1."";  
$result1 = @pg_query($conexao, $query1);


$pdf->SetFont('Arial','',9);

$pdf->Ln();
$pdf->Cell(10);

$pdf->Cell(10,6,utf8_decode('NÚM'),1,0,'C');
$pdf->Cell(40,6,'BEM PATRIMONIAL',1,0,'C');
$pdf->Cell(35,6,'CATEGORIA',1,0,'C');
$pdf->Cell(30,6,utf8_decode('PRÉDIO'),1,0,'C');
$pdf->Cell(15,6,'DEPTO',1,0,'C');
$pdf->Cell(20,6,'SALA',1,0,'C');
$pdf->Cell(20,6,utf8_decode('SITUAÇÃO'),1,0,'C');


while($lista = @pg_fetch_array($result1)){

      $query2 = "SELECT bempatrimonial.numero as numbem, bempatrimonial.descricao as descricaobem, bempatrimonial.situacao as situacaobem, 
                        categorias.nome as categoria, categorias.vidautil 
                 FROM bempatrimonial 
                 inner join categorias on bempatrimonial.codcategoria = categorias.codigo
                 WHERE bempatrimonial.numsala = '".$lista['numerosala']."' ".$sql2."";
  
      $result2 = @pg_query($conexao, $query2); 
      $objeto = @pg_fetch_assoc($result2);

      if(@pg_affected_rows($result2) > 0){

         $pdf->Ln();
         $pdf->Cell(10);

         $pdf->Cell(10,6,$objeto['numbem'],1,0,'C');
         $pdf->Cell(40,6,utf8_decode($objeto['descricaobem']),1,0,'L');
         $pdf->Cell(35,6,utf8_decode($objeto['categoria']),1,0,'L');
         $pdf->Cell(30,6,utf8_decode($lista['nomepredio']),1,0,'LC');
         $pdf->Cell(15,6,$lista['sigladpto'],1,0,'C');
         $pdf->Cell(20,6,$lista['numerosala'],1,0,'C');
         $pdf->Cell(20,6,$objeto['situacaobem'],1,0,'C');


      }
}

$pdf->Output();









/*



$pdf->SetFillColor(210);
$pdf->RoundedRect(10, 53, 30, 6, 1, '14', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(40, 53, 86, 6, 0, '0', 'DF');
$pdf->SetFillColor(210);
$pdf->RoundedRect(126, 53, 29, 6, 0, '0', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(155, 53, 45, 6, 1, '23', 'DF');

$pdf->Ln(7);

$pdf->Cell(30,5,'EMPRESA',0,0,'C');
$pdf->Cell(86,5,strtoupper($ordemServico['empresa']),0,0,'L',0);
$pdf->Cell(29,5,'CONTATO',0,0,'C',0);
$pdf->Cell(45,5,strtoupper($ordemServico['nome_contato']),0,0,'C',0);


$pdf->SetFillColor(210);
$pdf->RoundedRect(10, 59, 30, 6, 1, '14', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(40, 59, 86, 6, 0, '0', 'DF');
$pdf->SetFillColor(210);
$pdf->RoundedRect(126, 59, 29, 6, 0, '0', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(155, 59, 45, 6, 1, '23', 'DF');

$pdf->Ln(6);

$pdf->Cell(30,5,'CNPJ',0,0,'C');
$pdf->Cell(86,5,strtoupper($ordemServico['cnpj']),0,0,'L',0);
$pdf->Cell(29,5,'TELEFONE',0,0,'C',0);
$pdf->Cell(45,5,strtoupper($ordemServico['telefone']),0,0,'C',0);


$pdf->SetFillColor(210);
$pdf->RoundedRect(10, 67, 35, 6, 1, '1', 'DF');
$pdf->RoundedRect(45, 67, 35, 6, 1, '0', 'DF');
$pdf->RoundedRect(80, 67, 40, 6, 1, '0', 'DF');
$pdf->RoundedRect(120, 67, 40, 6, 1, '0', 'DF');
$pdf->RoundedRect(160, 67, 40, 6, 1, '2', 'DF');

$pdf->Ln(8);

$pdf->Cell(35,5,'PLACA',0,0,'C');
$pdf->Cell(35,5,'MARCA',0,0,'C');
$pdf->Cell(40,5,'MODELO',0,0,'C');
$pdf->Cell(40,5,utf8_decode('NÚMERO DE SÉRIE'),0,0,'C');
$pdf->Cell(40,5,'DATA EQUIPAMENTO',0,0,'C');

$pdf->SetFillColor(250);
$pdf->RoundedRect(10, 73, 35, 6, 1, '4', 'DF');
$pdf->RoundedRect(45, 73, 35, 6, 1, '0', 'DF');
$pdf->RoundedRect(80, 73, 40, 6, 1, '0', 'DF');
$pdf->RoundedRect(120, 73, 40, 6, 1, '0', 'DF');
$pdf->RoundedRect(160, 73, 40, 6, 1, '3', 'DF');

$pdf->Ln(6);

$pdf->Cell(35,5,strtoupper($ordemServico['placa']),0,0,'C',0);
$pdf->Cell(35,5,strtoupper($ordemServico['marca']),0,0,'C',0);
$pdf->Cell(40,5,strtoupper($ordemServico['modelo']),0,0,'C',0);
$pdf->Cell(40,5,strtoupper($ordemServico['numero_serie']),0,0,'C',0);
$pdf->Cell(40,5,formatData($ordemServico['data_equipamento']),0,0,'C',0);


$pdf->SetFillColor(210);
$pdf->RoundedRect(10, 81, 120, 6, 1, '1', 'DF');
$pdf->RoundedRect(125, 81, 38, 6, 1, '0', 'DF');
$pdf->RoundedRect(163, 81, 37, 6, 1, '2', 'DF');

$pdf->Ln(8);

$pdf->Cell(3,5,'',0,0,'L');
$pdf->Cell(112,5,utf8_decode('SERVIÇO'),0,0,'L');
$pdf->Cell(38,5,'QUANTIDADE',0,0,'C');
$pdf->Cell(37,5,'VALOR',0,0,'C');


$pdf->SetFillColor(255);

//incio do for
$result3 = $mysqli->query("select servico, quantidade, valor from servicos_ordem where id_ordem_servico = '".$acao."' order by servico asc");  

$totalServicos = 0;

$posicao = 87;

if($result3->num_rows > 0){

   for($i = 0; $servicos = $result3->fetch_array(); $i++){

       $pdf->RoundedRect(10, $posicao, 115, 6, 1, '0', 'DF');
       $pdf->RoundedRect(125, $posicao, 38, 6, 1, '0', 'DF');
       $pdf->RoundedRect(163, $posicao, 37, 6, 1, '0', 'DF');

       $subTotalServicos = $servicos['quantidade'] * $servicos['valor'];

       $pdf->Ln(6);
       $pdf->Cell(3,5,'',0,0,'L',0);
       $pdf->Cell(115,5,strtoupper($servicos['servico']),0,0,'L',0);
       $pdf->Cell(32,5,$servicos['quantidade'],0,0,'C',0);
       $pdf->Cell(6,6,'',0,0,'L',0);
       $pdf->Cell(24,5,'R$ '.number_format($subTotalServicos,2,',','.'),0,0,'R',0);

       $totalServicos += $subTotalServicos;
       
       $posicao += 6;   
   } 

}else
   $i = 0;

$totalLinhas = 20;
$diferenca = $totalLinhas - $i;

for($j = 0; $j < $diferenca; $j++){

  if($j == ($diferenca - 1)){

       $pdf->RoundedRect(10, $posicao, 115, 6, 1, '4', 'DF');
       $pdf->RoundedRect(125, $posicao, 38, 6, 1, '0', 'DF');
       $pdf->RoundedRect(163, $posicao, 37, 6, 1, '3', 'DF');

  }else{

       $pdf->RoundedRect(10, $posicao, 115, 6, 1, '0', 'DF');
       $pdf->RoundedRect(125, $posicao, 38, 6, 1, '0', 'DF');
       $pdf->RoundedRect(163, $posicao, 37, 6, 1, '0', 'DF');
    
    }
    
    $posicao += 6;  
}

$pdf->SetFillColor(210);
$pdf->RoundedRect(10, 210, 30, 6, 1, '1', 'DF');
$pdf->RoundedRect(40, 210, 30, 6, 1, '2', 'DF');

$pdf->RoundedRect(75, 210, 70, 6, 1, '1', 'DF');
$pdf->RoundedRect(145, 210, 28, 6, 1, '0', 'DF');
$pdf->RoundedRect(173, 210, 27, 6, 1, '2', 'DF');

if($i == 0)
   $pdf->Ln(129);
else if($i == 1)
   $pdf->Ln(123); 
else if($i == 2)
   $pdf->Ln(117);  
else if($i == 3)
   $pdf->Ln(111); 
else if($i == 4)
   $pdf->Ln(105); 
else if($i == 5)
   $pdf->Ln(99); 
else if($i == 6)
   $pdf->Ln(93); 
else if($i == 7)
   $pdf->Ln(87); 
else if($i == 8)
   $pdf->Ln(81); 
else if($i == 9)
   $pdf->Ln(75); 
else if($i == 10)
   $pdf->Ln(69); 
else if($i == 11)
   $pdf->Ln(63); 
else if($i == 12)
   $pdf->Ln(57); 
else if($i == 13)
   $pdf->Ln(51); 
else if($i == 14)
   $pdf->Ln(45); 
else if($i == 15)
   $pdf->Ln(39); 
else if($i == 16)
   $pdf->Ln(33); 
else if($i == 17)
   $pdf->Ln(27); 
else if($i == 18)
   $pdf->Ln(21); 
else if($i == 19)
   $pdf->Ln(15); 
else if($i == 20)
   $pdf->Ln(9); 

$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,5,utf8_decode('DIAS MANUTENÇÃO'),0,0,'C',0);
$pdf->Cell(30,5,utf8_decode('TEMPO EXECUÇÃO'),0,0,'C',0);
$pdf->Cell(5,5,'',0,0,'L',0);
$pdf->Cell(70,5,utf8_decode('RELAÇÃO DE MATERIAIS GASTOS'),0,0,'L',0);
$pdf->Cell(28,5,'QUANTIDADE',0,0,'C',0);
$pdf->Cell(27,5,'VALOR',0,0,'C',0);


$result4 = $mysqli->query("select material, quantidade, valor from materiais_ordem where id_ordem_servico = '".$acao."' order by material asc");  

$totalMateriais = 0;

if($result4->num_rows > 0){

   $materiaisMaterial1   = '';
   $materiaisQuantidade1 = '';
   $materiaisSubtotal1   = '';

   $materiaisMaterial2   = '';
   $materiaisQuantidade2 = '';
   $materiaisSubtotal2   = '';

   $materiaisMaterial3   = '';
   $materiaisQuantidade3 = '';
   $materiaisSubtotal3   = '';

   $materiaisMaterial4   = '';
   $materiaisQuantidade4 = '';
   $materiaisSubtotal4   = ''; 
 
   for($i = 1; $materiais = $result4->fetch_array(); $i++){

       $subTotalMateriais = $materiais['quantidade'] * $materiais['valor'];

       if($i == 1){
          
          $materiaisMaterial1   = $materiais['material'];
          $materiaisQuantidade1 = $materiais['quantidade'];
          $materiaisSubtotal1   = 'R$ '.number_format($subTotalMateriais,2,',','.');

       }

       if($i == 2){
          
          $materiaisMaterial2   = $materiais['material'];
          $materiaisQuantidade2 = $materiais['quantidade'];
          $materiaisSubtotal2   = 'R$ '.number_format($subTotalMateriais,2,',','.');

       }

       if($i == 3){
          
          $materiaisMaterial3   = $materiais['material'];
          $materiaisQuantidade3 = $materiais['quantidade'];
          $materiaisSubtotal3   = 'R$ '.number_format($subTotalMateriais,2,',','.');

       }

       if($i == 4){
          
          $materiaisMaterial4   = $materiais['material'];
          $materiaisQuantidade4 = $materiais['quantidade'];
          $materiaisSubtotal4   = 'R$ '.number_format($subTotalMateriais,2,',','.');

       }

       $totalMateriais += $subTotalMateriais;
         
   } 
  

}

$pdf->Ln(5);
$pdf->Cell(30,5,strtoupper($ordemServico['manutencao1']),1,0,'C',0);
$pdf->Cell(30,5,strtoupper($ordemServico['execucao1']),1,0,'C',0);
$pdf->Cell(5,5,'',0,0,'L',0);
$pdf->Cell(70,5,strtoupper($materiaisMaterial1),1,0,'L',0);
$pdf->Cell(28,5,$materiaisQuantidade1,1,0,'C',0);
$pdf->Cell(27,5,$materiaisSubtotal1,1,0,'C',0);

$pdf->Ln(5);
$pdf->Cell(30,5,strtoupper($ordemServico['manutencao2']),1,0,'C',0);
$pdf->Cell(30,5,strtoupper($ordemServico['execucao2']),1,0,'C',0);
$pdf->Cell(5,5,'',0,0,'L',0);
$pdf->Cell(70,5,strtoupper($materiaisMaterial2),1,0,'L',0);
$pdf->Cell(28,5,$materiaisQuantidade2,1,0,'C',0);
$pdf->Cell(27,5,$materiaisSubtotal2,1,0,'C',0);

$pdf->Ln(5);
$pdf->Cell(30,5,strtoupper($ordemServico['manutencao3']),1,0,'C',0);
$pdf->Cell(30,5,strtoupper($ordemServico['execucao3']),1,0,'C',0);
$pdf->Cell(5,5,'',0,0,'L',0);
$pdf->Cell(70,5,strtoupper($materiaisMaterial3),1,0,'L',0);
$pdf->Cell(28,5,$materiaisQuantidade3,1,0,'C',0);
$pdf->Cell(27,5,$materiaisSubtotal3,1,0,'C',0);


$pdf->SetFillColor(255);
$pdf->RoundedRect(10, 231, 30, 5, 1, '4', 'DF');
$pdf->RoundedRect(40, 231, 30, 5, 1, '3', 'DF');
$pdf->RoundedRect(75, 231, 70, 5, 1, '4', 'DF');
$pdf->RoundedRect(145, 231, 28, 5, 1, '0', 'DF');
$pdf->RoundedRect(173, 231, 27, 5, 1, '3', 'DF');


$pdf->Ln(5);
$pdf->Cell(30,5,strtoupper($ordemServico['manutencao4']),0,0,'C',0);
$pdf->Cell(30,5,strtoupper($ordemServico['execucao4']),0,0,'C',0);
$pdf->Cell(5,5,'',0,0,'L',0);
$pdf->Cell(70,5,strtoupper($materiaisMaterial4),0,0,'L',0);
$pdf->Cell(28,5,$materiaisQuantidade4,0,0,'C',0);
$pdf->Cell(27,5,$materiaisSubtotal4,0,0,'C',0);


$pdf->SetFillColor(200);
$pdf->RoundedRect(10, 240, 40, 7, 1, '14', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(50, 240, 90, 7, 1, '0', 'DF');
$pdf->SetFillColor(0);
$pdf->RoundedRect(140, 238, 30, 11, 2, '1234', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(170, 240, 30, 7, 1, '23', 'DF');


$pdf->SetFont('Arial','B',8);

$pdf->Ln(10);
$pdf->Cell(40,6,'PRAZO DE PAGAMENTO',0,0,'C',0);

$prazo1 = '';
$prazo2 = '';
$prazo3 = '';


if($ordemServico['prazo_pagamento'] == '30')
   $prazo1 = 'X';
else if($ordemServico['prazo_pagamento'] == '30-60')
   $prazo2 = 'X';
else if($ordemServico['prazo_pagamento'] == '30-60-90')
   $prazo3 = 'X';


$pdf->Cell(24,6,'( '.$prazo1.' ) 30 DIAS',0,0,'C',0);
$pdf->Cell(30,6,'( '.$prazo2.' ) 30/60 DIAS',0,0,'C',0);
$pdf->Cell(30,6,'( '.$prazo3.' ) 30/60/90 DIAS',0,0,'C',0);

$pdf->Cell(6,5,'',0,0,'L',0);

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(255);
$pdf->Cell(30,6,'VALOR TOTAL',0,0,'C',0);

$pdf->Cell(1,5,'',0,0,'L',0);


$totalGeral = $totalMateriais + $totalServicos;

$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0);
$pdf->Cell(29,6,'R$ '.number_format($totalGeral,2,',','.'),0,0,'C',0);


$pdf->SetFillColor(200);
$pdf->RoundedRect(10, 251, 40, 7, 1, '14', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(50, 251, 40, 7, 1, '23', 'DF');
$pdf->SetFillColor(200);
$pdf->RoundedRect(100, 251, 50, 7, 1, '14', 'DF');
$pdf->SetFillColor(250);
$pdf->RoundedRect(150, 251, 50, 7, 1, '23', 'DF');

$pdf->SetFont('Arial','B',8);

$sim = '';
$nao = '';

if($ordemServico['garantia'] == 'sim')
   $sim = 'X';  
else if($ordemServico['garantia'] == 'nao')
   $nao = 'X';  

$pdf->Ln(11);
$pdf->Cell(40,6,'PRAZO DE ENTREGA',0,0,'C',0);
$pdf->Cell(40,6,$ordemServico['prazo_entrega'].' DIAS',0,0,'C',0);
$pdf->Cell(10,6,'',0,0,'C',0);
$pdf->Cell(50,6,utf8_decode('SERVIÇO EM GARANTIA'),0,0,'C',0);
$pdf->Cell(25,6,'( '.$sim.' ) SIM',0,0,'C',0);
$pdf->Cell(25,6,'( '.$nao.' ) '.utf8_decode('NÃO'),0,0,'C',0);


$pdf->SetFillColor(250);
$pdf->RoundedRect(10, 260, 190, 20, 1, '1234', 'DF');

$pdf->SetFillColor(200);
$pdf->RoundedRect(10, 260, 35, 7, 1, '13', 'DF');



$pdf->Ln(9);
$pdf->Cell(35,6,utf8_decode('OBSERVAÇÕES'),0,0,'C',0);
$pdf->Ln(7);
$pdf->Cell(6,6,'',0,0,'C',0);

$pdf->SetFont('Arial','',8);

$pdf->MultiCell(180, 4, resumo($ordemServico['observacao'],230),0,'L');



//gera pdf na memoria
$pdf->Output();

/*

//gera arquivo fisico no servidor

//$pdf->Output("arquivos/orcamento-".$orcamento['codigo_orcamento'].".pdf","F");  



*/



?>
