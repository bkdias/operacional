<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <script type="text/javascript">
            window.onload = window.print();
        </script>
    </head>
    <body class="estilo">
<?php

if(isset($_REQUEST['print'])){
    $motorista= $_REQUEST['motorista'];
    $cpf= $_REQUEST['cpf'];
    $cnh= $_REQUEST['cnh'];
    $valcnh= $_REQUEST['valcnh'];
    $data= $_REQUEST['data'];
    $cliente= $_REQUEST['cliente'];
    $entradaPor= $_REQUEST['entradaPor'];
    $entradaPatio= $_REQUEST['entradaPatio'];
    $status= $_REQUEST['status'];
    $obs= $_REQUEST['obs'];
    $id= $_REQUEST['id'];
    $placac= $_REQUEST['placac'];
    $placacv= $_REQUEST['placacv'];
    $grade= $_REQUEST['grade'];
    $tipocam= $_REQUEST['tipocam'];
    $tam= $_REQUEST['tam'];
    $comp=$_REQUEST['comp'];
    $transp=$_REQUEST['transp'];
    $mopp=$_REQUEST['mopp'];
    $fone=$_REQUEST['fone'];
    $operacao=$_REQUEST['operacao'];
    $pedido=$_REQUEST['pedido'];
    $catcnh=$_REQUEST['catcnh'];
    $epis= $_REQUEST['epi'];
    $vendor=$_REQUEST['vendor'];
    $frete=$_REQUEST['frete'];
    $saida=$_REQUEST['saida'];
    
   
}

echo "<center><table border='1'>";
    echo"<tr><td width='912'><strong><center>YARA BRASIL FERTILIZANTES - UNIDADE CANDEIAS<br>SETOR DE EXPEDIÇÃO - CONTROLE DE ENTRADA PARA CARREGAMENTO</center></strong></tr></td></table>";
    echo "<table border='1'>";
    echo'<tr><td width="300"><font size="1"><strong>Data:</strong> '.$data.'</td>'
     .'<td width="300"><font size="1"><strong>Entrada Patio:</strong> '.$entradaPatio.'</td>'
     .'<td width="300"><font size="1"><strong>Entrada Portaria:</strong> '.$entradaPor.'</td></tr>'
     .'<tr><td width="300"><font size="1"><font size="1"><strong>Motorista:</strong> '.$motorista.'</td>'
     .'<td width="300"><font size="1"><strong>CPF:</strong> '.$cpf.'</td>'
     .'<td width="300"><font size="1"><strong>CNH:</strong> '.$cnh.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Valid. CNH:</strong> '.$valcnh.'</td>'
     .'<td width="300"><font size="1"><strong>Cat. CNH:</strong> '.$catcnh.'</td>'
     .'<td width="300"><font size="1"><strong>Transp.: </strong> '.$transp.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Placa Cavalo:</strong> '.$placacv.'</td>'
     .'<td width="300"><font size="1"><strong>Placa Carreta:</strong> '.$placac.'</td>'
     .'<td width="300"><font size="1"><strong>Cliente:</strong> '.$cliente.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>MOPP:</strong> '.$mopp.'</td>'
     .'<td width="300"><font size="1"><strong>Categoria:</strong> '.$tipocam.'</td>'
     .'<td width="300"><font size="1"><strong>Grade:</strong> '.$grade.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Comprimento:</strong> '.$comp.'</td>'
     .'<td width="300"><font size="1"><strong>Tamanho:</strong> '.$tam.'</td>'
     .'<td width="300"><font size="1"><strong>Status:</strong> '.$status.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Nº Pedido:</strong> '.$pedido.'</td>'
     .'<td width="300"><font size="1"><strong>Epis:</strong> '.$epis.'</td>'
     .'<td width="300"><font size="1"><strong>Tel: </strong> '.$fone.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Vendor: </strong> '.$vendor.'</td>'
     .'<td width="300"><font size="1"><strong>Frete: </strong> '.$frete.'</td>'
     .'<td width="300"><font size="1"><strong>Operação: </strong> '.$operacao.'</td></tr>'
     .'<tr><td width="300"><font size="1"><strong>Observação: </strong> '.$obs.'</td>'
     .'<td width="300"><font size="1"><strong>Saída: </strong> '.$saida.'</td></tr>';
    echo "</table></center>";
?>
    <br><br><center>
        <input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
        </center>
        
   </body>
</html>