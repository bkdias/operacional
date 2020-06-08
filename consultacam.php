<!DOCTYPE html>
<?php
    include_once '_conexao.php';
    $conn = new conecta();
    $conn->verifica_sessao();
    if(isset($_GET['acao'])=='logout')
      @session_destroy();
    $tela="2";
    $login = $_SESSION['login'];
    
    $permissao = $conn->verificaPermissao($login, $tela);
    if(!$permissao){
       echo '<script>$("#myModalPermissao").modal("show")</script>';
       echo "<script>$('#myModalPermissao').on('hidden.bs.modal', function (e) {
                        window.location='index.php';
        })</script>";
     }
  if(isset($_REQUEST['search'])){
    $campo = $_REQUEST['consultar'];
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
    <title>Gerenciamento de Caminhões</title>
       <div class="modal fade" id="myModalPermissao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="myModalPermissao">Restrição de Acesso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Você não tem permissão para acessar este módulo!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
   </head>
     <body class="style">
      <div class="div1">
          <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
          <h5>CONTROLE DE ENTRADA E SAÍDA PARA CARREGAMENTO</h5><br>
      </div>
         <div class="p1">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="acesso.php">Controle de Acesso</a></li>
              <li class="breadcrumb-item active" aria-current="page">Saída</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
      </nav>
        <div class="container">
            <center><h5> SAÍDA DE CAMINHÃO </h5> <br>
            <?php 
              $consulta = $conn->buscaCaminhao($campo);
                if(!$consulta){
                    echo '<script>alert("Veículo/Motorista informado não está no pátio!!")</script>';
                    echo "<script>window.location='consultaccess.php';</script>";
                }
                else{
                  foreach($consulta as $resp){
                    $campo=$resp['id']; $data = $resp['data'];$motorista=$resp['motorista']; $cpf=$resp['cpf']; $cnh=$resp['cnh']; $epis=$resp['epi']; $catcnh=$resp['catcnh'];
                    $fone=$resp['fone']; $valcnh=$resp['val_cnh']; $transp=$resp['transp']; $placacv=$resp['placacv']; $placac=$resp['placac']; $status=$resp['status'];
                    $cliente=$resp['cliente']; $entradaPatio=$resp['entradaPatio']; $entradaPor=$resp['entradaPor']; $tipocam=$resp['tipocam']; $grade=$resp['grade']; $tam=$resp['tam'];
                    $mopp=$resp['mopp']; $comp=$resp['comp']; $obs=$resp['obs']; $operacao=$resp['operacao']; $pedido=$resp['pedido']; $vendor=$resp['vendor']; $frete=$resp['frete'];
                    echo '<div class="table-responsive-sm"><table class="table table-hover">
                      <thead>
                       <tr>
                      <th colspan="3"><center>YARA BRASIL FERTILIZANTES - UNIDADE CANDEIAS<br> SETOR DE EXPEDIÇÃO - CONTROLE DE ENTRADA PARA CARREGAMENTO</center></tr></thead><tbody>
                      <tr><td width="300"><strong>DATA:</strong> '.$data.'</td>
                     <td width="300"><strong>Entrada Patio:</strong> '.$resp['entradaPatio'].'</td>
                     <td width="300"><strong>Entrada Portaria:</strong> '.$resp['entradaPor'].'</td></tr>
                     <tr><td width="300"><strong>Motorista:</strong> '.$resp['motorista'].'</td>
                     <td width="300"><strong>CPF:</strong> '.$resp['cpf'].'</td>
                     <td width="300"><strong>CNH:</strong> '.$resp['cnh'].'</td></tr>
                     <tr><td width="300"><strong>Valid. CNH:</strong> '.$valcnh.'</td>
                     <td width="300"><strong>Vendor:</strong> '.$resp['vendor'].'</td>
                     <td width="300"><strong>Transp.: </strong> '.$resp['transp'].'</td></tr>
                     <tr><td width="300"><strong>Placa Cavalo:</strong> '.$resp['placacv'].'</td>
                     <td width="300"><strong>Placa Carreta:</strong> '.$resp['placac'].'</td>
                     <td width="300"><strong>Cliente:</strong> '.$resp['cliente'].'</td></tr>
                     <tr><td width="300"><strong>MOPP:</strong> '.$resp['mopp'].'</td>
                     <td width="300"><strong>Categoria:</strong> '.$resp['tipocam'].'</td>
                     <td width="300"><strong>Grade:</strong> '.$resp['grade'].'</td></tr>
                     <tr><td width="300"><strong>Comprimento:</strong> '.$resp['comp'].'</td>
                     <td width="300"><strong>Tamanho:</strong> '.$resp['tam'].'</td>
                     <td width="300"><strong>Status:</strong> '.$resp['status'].'</td></tr>
                     <tr><td width="300"><strong>Nº Pedido:</strong> '.$resp['pedido'].'</td>
                     <td width="300"><strong>Epis:</strong> '.$resp['epi'].'</td>
                     <td width="300"><strong>Tel: </strong> '.$resp['fone'].'</td></tr>';
               echo "</tbody></table>";
                echo "<br>";
                echo "<table>";
                echo'<td width="100">'
                .'<form name="edita" action="" method="post">'
                .'<input type="hidden" value="'.$motorista.'" name="motorista">'
                .'<input type="hidden" value="'.$cpf.'" name="cpf">'
                .'<input type="hidden" value="'.$cnh.'" name="cnh">'
                .'<input type="hidden" value="'.$data.'" name="data">'
                .'<input type="hidden" value="'.$fone.'" name="fone">'
                .'<input type="hidden" value="'.$valcnh.'" name="valcnh">'
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
                .'<input type="hidden" value="'.$epis.'" name="epi">'
                .'<input type="hidden" value="'.$pedido.'" name="pedido">'
                .'<input type="hidden" value="'.$catcnh.'" name="catcnh">'
                .'<input type="hidden" value="'.$vendor.'" name="vendor">'
                .'<input type="hidden" value="'.$frete.'" name="frete">'
                .'<input type="submit" value="Registrar Saída" name="editar" class="btn btn-info">'
                .'</form>'
                .'</td>'
                .'</tr>';
                echo "</table>"; 
                }
            }
            ?>
            <br>
       </div>
      </div>
      <div class="footer" >
          EQUIPE DE TI - 2019                
      </div>
    </body>
</html>