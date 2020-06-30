<?PHP
   include_once '_conexao.php';
   if(isset($_GET['acao'])=='logout'){
      @session_destroy();
   }
    $conn = new conecta();
    $conn->verifica_sessao();
    $login= $_SESSION['login'];
    $tela=2;
    $permissao = $conn->verificaPermissao($login, $tela);
    if(!$permissao){
       echo '<script>$("#myModalPermissao").modal("show")</script>';
       echo "<script>$('#myModalPermissao').on('hidden.bs.modal', function (e) {
                        window.location='index.php';
        })</script>";
     }
    date_default_timezone_set('America/Sao_Paulo');
    $campo = isset($_GET['id']);
    $op= "";
    $stat= "";
    if(isset($_POST['search'])){
        $op = $_POST['opcao'];
        $campo = $_POST['consultar'];                
        $dataI = $_POST['dataI'];
        $dataF = $_POST['dataF'];
        $stat = $_POST['status'];
    }
?>
<html>   
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/estilo.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
    <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
   
    <script>
    $(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
            var href = $(this).attr('href');
            if(!$('#confirm-delete').length){
                    $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Excluir</a></div></div></div></div>');
            }
            $('#dataComfirmOK').attr('href', href);
            $('#confirm-delete').modal({show: true});
            return false;
		
	});
    });
    </script>
    
</head>
<div class="modal fade" id="myModalErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="myModalErro">Restrição de Acesso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Não existe registro com o dado informado!!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
    </div>
  </div>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/> 
        <h5>CONTROLE DE MARCAÇÃO</h5><br>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
          <li class="breadcrumb-item"><a href="acesso.php">Controle de Acesso</a></li>
          <li class="breadcrumb-item active" aria-current="page">Consulta</li>
          <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
        </ol>
      </nav>
       <div class="container">
           <center><h5>REGISTROS DE ENTRADA E SAÍDA DE CAMINHÃO</h5> <br><br>
            <center>
            <?php 
             if($op!='periodo'){
              if($op=='status'){
                $consulta = $conn->buscaCamStatus($stat);
                if(!$consulta){
                    echo '<script>$("#myModalErro").modal("show")</script>';
                    echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                            window.location='listagem.php';
                        })</script>";
                }
                else{
                  foreach($consulta as $resp){
                    $id=$resp['id']; $motorista=$resp['motorista']; $cpf=$resp['cpf']; $cnh=$resp['cnh']; $data=$conn->converte_data($resp['data']);$epi=$resp['epi']; $catcnh=$resp['catcnh'];
                    $fone=$resp['fone']; $valcnh= $conn->converte_data($resp['val_cnh']); $transp=$resp['transp']; $placacv=$resp['placacv']; $placac=$resp['placac']; $status=$resp['status']; $saida=$conn->converte_dataTime($resp['saida']);
                    $cliente=$resp['cliente']; $entradaPatio=$resp['entradaPatio']; $entradaPor=$resp['entradaPor']; $tipocam=$resp['tipocam']; $grade=$resp['grade']; $tam=$resp['tam'];
                    $mopp=$resp['mopp']; $comp=$resp['comp']; $obs=$resp['obs']; $operacao=$resp['operacao']; $pedido=$resp['pedido']; $vendor=$resp['vendor']; $frete=$resp['frete'];
                    echo '<div class="table-responsive-sm"><table class="table table-hover">
                    <thead>
                     <tr>
                     <th colspan="3"><cellspacing="1"><center>YARA BRASIL FERTILIZANTES - UNIDADE CANDEIAS<br> SETOR DE EXPEDIÇÃO - CONTROLE DE ENTRADA PARA CARREGAMENTO</center></th></tr></thead><tbody>
                     <tr><center><td width="100"><font size="2"><strong>Data:</strong> '.$data.'</td>
                     <td width="100"><font size="2"><strong>Entrada Patio:</strong> '.$resp['entradaPatio'].'</td>
                     <td width="100"><font size="2"><strong>Entrada Portaria:</strong> '.$resp['entradaPor'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Motorista:</strong> '.$resp['motorista'].'</td>
                     <td width="100"><font size="2"><strong>CPF:</strong> '.$resp['cpf'].'</td>
                     <td width="100"><font size="2"><strong>CNH:</strong> '.$resp['cnh'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Valid. CNH:</strong> '.$valcnh.'</td>
                     <td width="100"><font size="2"><strong>Cat. CNH:</strong> '.$resp['catcnh'].'</td>
                     <td width="100"><font size="2"><strong>Transp.: </strong> '.$resp['transp'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Placa Cavalo:</strong> '.$resp['placacv'].'</td>
                     <td width="100"><font size="2"><strong>Placa Carreta:</strong> '.$resp['placac'].'</td>
                     <td width="100"><font size="2"><strong>Cliente:</strong> '.$resp['cliente'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>MOPP:</strong> '.$resp['mopp'].'</td>
                     <td width="100"><font size="2"><strong>Categoria:</strong> '.$resp['tipocam'].'</td>
                     <td width="100"><font size="2"><strong>Grade:</strong> '.$resp['grade'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Comprimento:</strong> '.$resp['comp'].'</td>
                     <td width="100"><font size="2"><strong>Tamanho:</strong> '.$resp['tam'].'</td>
                     <td width="100"><font size="2"><strong>Status:</strong> '.$resp['status'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Nº Pedido:</strong> '.$resp['pedido'].'</td>
                     <td width="100"><font size="2"><strong>Epis:</strong> '.$resp['epi'].'</td>
                     <td width="100"><font size="2"><strong>Tel: </strong> '.$resp['fone'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Vendor: </strong> '.$resp['vendor'].'</td>
                     <td width="100"><font size="2"><strong>Frete: </strong> '.$resp['frete'].'</td>
                     <td width="100"><font size="2"><strong>Operação: </strong> '.$resp['operacao'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Observação: </strong> '.$resp['obs'].'</td>
                     <td width="100"><font size="2"><strong>Saída: </strong> '.$saida.'</td>
                     <td width="100"><font size="2"> </td></tr>';
                    echo "</tbody></table>";
                    echo "<br>";
                    echo '<table><tr><form name="altera" action="deleteaccess.php" method="post">'
                     .'<input type="hidden" name="excluir">'
                     .'<input type="hidden" name="id">'
                     .'<td width="100"><center><a href="deleteaccess.php?id='.$id.'" class="btn btn-danger" data-confirm=" " data-dismiss="modal">Excluir</a></center></td></form>'
                     
                     .'<form target="_blank" name="print" action="print.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['val_cnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$valcnh.'" name="valcnh">'
                     .'<input type="hidden" value="'.$id.'" name="id">'
                     .'<input type="hidden" value="'.$saida.'" name="saida">'
                     .'<td width="100"><center><input type="submit" class= "btn btn-secondary" name="print" value="Imprimir"/></center></td></form>'
                     
                     .'<form name="altera1" action="editaccess.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['val_cnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$id.'" name="id">'
                     .'<input type="hidden" value="'.$saida.'" name="saida">';
                     if($stat=='Aguardando'){
                       echo '<td width="100"><center><input type="submit" value="Editar" name="editar" class="btn btn-primary"></td>';
                     }
                     echo '</form>';
                     
                 echo "</table>"; 
                 echo "<br><br>";
                } 
              }
              }
              else{  
              $consulta = $conn->buscaCamCPF($campo);
                if(!$consulta){
                    echo '<script>$("#myModalErro").modal("show")</script>';
                    echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                            window.location='listagem.php';
                        })</script>";
                }
                else{
                  foreach($consulta as $resp){
                    $id=$resp['id']; $motorista=$resp['motorista']; $cpf=$resp['cpf']; $cnh=$resp['cnh']; $data=$conn->converte_data($resp['data']);$epi=$resp['epi']; $catcnh=$resp['catcnh'];
                    $fone=$resp['fone']; $valcnh= $conn->converte_data($resp['val_cnh']); $transp=$resp['transp']; $placacv=$resp['placacv']; $placac=$resp['placac']; $status=$resp['status']; $saida=$conn->converte_dataTime($resp['saida']);
                    $cliente=$resp['cliente']; $entradaPatio=$resp['entradaPatio']; $entradaPor=$resp['entradaPor']; $tipocam=$resp['tipocam']; $grade=$resp['grade']; $tam=$resp['tam'];
                    $mopp=$resp['mopp']; $comp=$resp['comp']; $obs=$resp['obs']; $operacao=$resp['operacao']; $pedido=$resp['pedido']; $vendor=$resp['vendor']; $frete=$resp['frete'];
                    echo '<div class="table-responsive-sm"><table class="table table-hover">
                    <thead>
                     <tr>
                     <th colspan="3"><cellspacing="1"><center>YARA BRASIL FERTILIZANTES - UNIDADE CANDEIAS<br> SETOR DE EXPEDIÇÃO - CONTROLE DE ENTRADA PARA CARREGAMENTO</center></th></tr></thead><tbody>
                     <tr><center><td width="100"><font size="2"><strong>Data:</strong> '.$data.'</td>
                     <td width="100"><font size="2"><strong>Entrada Patio:</strong> '.$resp['entradaPatio'].'</td>
                     <td width="100"><font size="2"><strong>Entrada Portaria:</strong> '.$resp['entradaPor'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Motorista:</strong> '.$resp['motorista'].'</td>
                     <td width="100"><font size="2"><strong>CPF:</strong> '.$resp['cpf'].'</td>
                     <td width="100"><font size="2"><strong>CNH:</strong> '.$resp['cnh'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Valid. CNH:</strong> '.$valcnh.'</td>
                     <td width="100"><font size="2"><strong>Cat. CNH:</strong> '.$resp['catcnh'].'</td>
                     <td width="100"><font size="2"><strong>Transp.: </strong> '.$resp['transp'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Placa Cavalo:</strong> '.$resp['placacv'].'</td>
                     <td width="100"><font size="2"><strong>Placa Carreta:</strong> '.$resp['placac'].'</td>
                     <td width="100"><font size="2"><strong>Cliente:</strong> '.$resp['cliente'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>MOPP:</strong> '.$resp['mopp'].'</td>
                     <td width="100"><font size="2"><strong>Categoria:</strong> '.$resp['tipocam'].'</td>
                     <td width="100"><font size="2"><strong>Grade:</strong> '.$resp['grade'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Comprimento:</strong> '.$resp['comp'].'</td>
                     <td width="100"><font size="2"><strong>Tamanho:</strong> '.$resp['tam'].'</td>
                     <td width="100"><font size="2"><strong>Status:</strong> '.$resp['status'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Nº Pedido:</strong> '.$resp['pedido'].'</td>
                     <td width="100"><font size="2"><strong>Epis:</strong> '.$resp['epi'].'</td>
                     <td width="100"><font size="2"><strong>Tel: </strong> '.$resp['fone'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Vendor: </strong> '.$resp['vendor'].'</td>
                     <td width="100"><font size="2"><strong>Frete: </strong> '.$resp['frete'].'</td>
                     <td width="100"><font size="2"><strong>Operação: </strong> '.$resp['operacao'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Observação: </strong> '.$resp['obs'].'</td>
                     <td width="100"><font size="2"><strong>Saída: </strong> '.$saida.'</td>
                     <td width="100"><font size="2"> </td></tr>';
                     echo "</tbody></table>";
                     echo "<br>";
                     echo '<table><tr><form name="altera" action="deleteaccess.php" method="post">'
                     .'<input type="hidden" name="excluir">'
                     .'<input type="hidden" name="campo1">'
                     .'<td width="100"><center><a href="deleteaccess.php?id='.$id.'" class="btn btn-danger" data-confirm=" " data-dismiss="modal">Excluir</a></center></td>.</form>'
                     .'<form target="_blank" name="print" action="print.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['val_cnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$id.'" name="id">'
                     .'<input type="hidden" value="'.$saida.'" name="saida">'
                     .'<td width="100"><center><input type="submit" class= "btn btn-secondary" name="print" value="Imprimir"/></center></td></form>'
                     
                     .'<form name="altera1" action="editaccess.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['val_cnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$id.'" name="id">'
                     .'<td width="100"><center><input type="submit" value="Editar" name="editar" class="btn btn-primary"></td>'
                     .'</form>';
                     
                echo "</table>"; 
                echo "<br><br>";
                }
              }
             }
            }
             else{
                $sql = mysqli_query($conexao,"SELECT * FROM caminhao WHERE data >= CAST('$dataI' AS DATE) AND data<= CAST('$dataF' AS DATE) ORDER by data")or die(mysqli_error($conexao));
                if(mysqli_num_rows($sql)==0){
                    echo '<script>alert("REGISTROS NÃO ENCONTRADOS PARA A DATA INFORMADA!!")</script>';
                    echo "<script>window.location='listagem.php';</script>";
                }
                else{
                  while($resp = mysqli_fetch_array($sql)){
                  $id=$resp['id']; $motorista=$resp['motorista']; $cpf=$resp['cpf']; $cnh=$resp['cnh']; $data=$conn->converte_data($resp['data']);$epi=$resp['epi']; $catcnh=$resp['catcnh'];
                    $fone=$resp['fone']; $valcnh= $conn->converte_data($resp['val_cnh']); $transp=$resp['transp']; $placacv=$resp['placacv']; $placac=$resp['placac']; $status=$resp['status']; $saida=$conn->converte_dataTime($resp['saida']);
                    $cliente=$resp['cliente']; $entradaPatio=$resp['entradaPatio']; $entradaPor=$resp['entradaPor']; $tipocam=$resp['tipocam']; $grade=$resp['grade']; $tam=$resp['tam'];
                    $mopp=$resp['mopp']; $comp=$resp['comp']; $obs=$resp['obs']; $operacao=$resp['operacao']; $pedido=$resp['pedido']; $vendor=$resp['vendor']; $frete=$resp['frete'];
                    echo '<div class="table-responsive-sm"><table class="table table-hover">
                    <thead>
                     <tr>
                     <th colspan="3"><cellspacing="1"><center>YARA BRASIL FERTILIZANTES - UNIDADE CANDEIAS<br> SETOR DE EXPEDIÇÃO - CONTROLE DE ENTRADA PARA CARREGAMENTO</center></th></tr></thead><tbody>
                     <tr><center><td width="100"><font size="2"><strong>Data:</strong> '.$data.'</td>
                     <td width="100"><font size="2"><strong>Entrada Patio:</strong> '.$resp['entradaPatio'].'</td>
                     <td width="100"><font size="2"><strong>Entrada Portaria:</strong> '.$resp['entradaPor'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Motorista:</strong> '.$resp['motorista'].'</td>
                     <td width="100"><font size="2"><strong>CPF:</strong> '.$resp['cpf'].'</td>
                     <td width="100"><font size="2"><strong>CNH:</strong> '.$resp['cnh'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Valid. CNH:</strong> '.$valcnh.'</td>
                     <td width="100"><font size="2"><strong>Cat. CNH:</strong> '.$resp['catcnh'].'</td>
                     <td width="100"><font size="2"><strong>Transp.: </strong> '.$resp['transp'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Placa Cavalo:</strong> '.$resp['placacv'].'</td>
                     <td width="100"><font size="2"><strong>Placa Carreta:</strong> '.$resp['placac'].'</td>
                     <td width="100"><font size="2"><strong>Cliente:</strong> '.$resp['cliente'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>MOPP:</strong> '.$resp['mopp'].'</td>
                     <td width="100"><font size="2"><strong>Categoria:</strong> '.$resp['tipocam'].'</td>
                     <td width="100"><font size="2"><strong>Grade:</strong> '.$resp['grade'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Comprimento:</strong> '.$resp['comp'].'</td>
                     <td width="100"><font size="2"><strong>Tamanho:</strong> '.$resp['tam'].'</td>
                     <td width="100"><font size="2"><strong>Status:</strong> '.$resp['status'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Nº Pedido:</strong> '.$resp['pedido'].'</td>
                     <td width="100"><font size="2"><strong>Epis:</strong> '.$resp['epi'].'</td>
                     <td width="100"><font size="2"><strong>Tel: </strong> '.$resp['fone'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Vendor: </strong> '.$resp['vendor'].'</td>
                     <td width="100"><font size="2"><strong>Frete: </strong> '.$resp['frete'].'</td>
                     <td width="100"><font size="2"><strong>Operação: </strong> '.$resp['operacao'].'</td></tr>
                     <tr><center><td width="100"><font size="2"><strong>Observação: </strong> '.$resp['obs'].'</td>
                     <td width="100"><font size="2"><strong>Saída: </strong> '.$saida.'</td>
                     <td width="100"><font size="2"> </td></tr>'; 
                echo "</table>";
                echo "<br><br>";
                echo '<table><tr><form name="altera" action="deleteaccess.php" method="post">'
                     .'<input type="hidden" name="excluir">'
                     .'<input type="hidden" name="campo1">'
                     .'<td width="100"><center><a href="deleteaccess.php?id='.$id.'" class="btn btn-danger btn-sm" data-confirm=" " data-dismiss="modal">Excluir</a></center></td></form>'
                     
                     .'<form target="_blank" name="print" action="print.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['valcnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$id.'" name="id">'
                     .'<input type="hidden" value="'.$saida.'" name="saida">'
                     .'<td width="100"><center><input type="submit" class= "btn btn-secondary" name="print" value="Imprimir"/></center></td></form>'
                     
                     .'<form name="altera1" action="editaccess.php" method="post">'
                     .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                     .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                     .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                     .'<input type="hidden" value="'.$resp['data'].'" name="data">'
                     .'<input type="hidden" value="'.$fone.'" name="fone">'
                     .'<input type="hidden" value="'.$resp['val_cnh'].'" name="valcnh">'
                     .'<input type="hidden" value="'.$transp.'" name="transp">'
                     .'<input type="hidden" value="'.$placacv.'" name="placacv">'
                     .'<input type="hidden" value="'.$placac.'" name="placac">'
                     .'<input type="hidden" value="'.$status.'" name="status">'
                     .'<input type="hidden" value="'.$cliente.'" name="cliente">'
                     .'<input type="hidden" value="'.$entradaPatio.'" name="entradaPatio">'
                     .'<input type="hidden" value="'.$entradaPor.'" name="entradaPor">'
                     .'<input type="hidden" value="'.$tipocam.'" name="tipocam">'
                     .'<input type="hidden" value="'.$grade.'" name="grade">'
                     .'<input type="hidden" value="'.$tam.'" name="tam">'
                     .'<input type="hidden" value="'.$mopp.'" name="mopp">'
                     .'<input type="hidden" value="'.$comp.'" name="comp">'
                     .'<input type="hidden" value="'.$obs.'" name="obs">'
                     .'<input type="hidden" value="'.$campo.'" name="id">'
                     .'<input type="hidden" value="'.$operacao.'" name="operacao">'
                     .'<input type="hidden" value="'.$epi.'" name="epi">'
                     .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                     .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                     .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                     .'<input type="hidden" value="'.$frete.'" name="frete">'
                     .'<input type="hidden" value="'.$id.'" name="id">';
                     if($stat=='Aguardando'){
                       echo '<td width="100"><center><input type="submit" value="Editar" name="editar" class="btn btn-primary"></td>';
                     }
                     echo '</form>';
               echo "</table>"; 
                echo "<br><br>";
                }
                }
             } 
            ?>
    </center>
              </div>                   
        </div>
      <div  class="footer" >
         <img class="img-fluid" src="image/copyright.png"/>
         POWERED BY REBECA SANTANA - 2020             
      </div>
           
    </body>
</html>