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
              Usuário sem permissão para acessar este módulo!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
    </div>
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
              Veículo/Motorista informado não está no pátio!!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
    </div>
<?php
if(isset($_POST['search'])){
$campo = $_POST['consultar'];
    $consulta = $conn->buscaCaminhao($campo);
        if(!$consulta){
            echo '<script>$("#myModalErro").modal("show")</script>';
            echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                        window.location='consultaccess.php';
                })</script>";
        }
        else{
          foreach($consulta as $resp){
            $id=$resp['id']; $data = $resp['data'];$motorista=$resp['motorista']; $cpf=$resp['cpf']; $cnh=$resp['cnh']; $epis=explode(", ", $resp['epi']);$resp['epi']; $catcnh=$resp['catcnh'];
            $fone=$resp['fone']; $valcnh=$resp['val_cnh']; $transp=$resp['transp']; $placacv=$resp['placacv']; $placac=$resp['placac']; $status=$resp['status'];
            $cliente=$resp['cliente']; $entradaPatio=$resp['entradaPatio']; $entradaPor=$resp['entradaPor']; $tipocam=$resp['tipocam']; $grade=$resp['grade']; $tam=$resp['tam'];
            $mopp=$resp['mopp']; $comp=$resp['comp']; $obs=$resp['obs']; $operacao=$resp['operacao']; $pedido=$resp['pedido']; $vendor=$resp['vendor']; $frete=$resp['frete'];
          }
        }
}
  ?>   
<!------------------------------------------------------------------------------------>
     <title>CONTROLE DE ACESSO</title>
    </head>
    
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>  
        CONTROLE DE MARCAÇÃO<br><br>
      </div>
      <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="acesso.php">Controle de Acesso</a></li>
              <li class="breadcrumb-item active" aria-current="page">Saída</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
      </nav>
      <div class="container">
        <center><h5>Saída de Caminhão</h5></center><br>
         <form name="registro" action="checkout.php" method="post" enctype="multipart/form-data">
           <div class="form-row">
                 <div class="form-group col-md-2">
                    <label>CPF:</label><input class="form-control" type="text" name="cpf" id="cpf" size="14" readonly="readonly" value="<?php echo $cpf?>" maxlength="14" required class="form-control" data-mask-for-cpf-cnpj/>
                 </div>
                 <div class="form-group col-md-3">
                    <label>Motorista:</label><input type="text" name="motorista" id="motorista" size="30" readonly="readonly" value="<?php echo $motorista?>" required class="form-control"/>
                 </div>
               <div class="form-group col-md-2">
                   <label>CNH:</label><input type="text" name="cnh" size="15" maxlength="15" id="cnh" readonly="readonly" value="<?php echo $cnh?>" required class="form-control"/> 
               </div>
               <div class="form-group col-md-2">
                <label>Val. CNH:</label><input type="date" name="valcnh" size="10" id="valcnh" readonly="readonly" value="<?php echo $valcnh?>" required class="form-control"/>   
               </div>
               <div class="form-group col-md-1">
                      <label>Cat CNH:</label><input type="text" size="1" maxlength="1" name="catcnh" id="catcnh" onkeyup="maiuscula(this)" readonly="readonly" value="<?php echo $catcnh?>" required class="form-control"/>
               </div>
               <div class="form-group col-md-2">
                   <label>Telefone:</label> <input type="text" name="tel"size="15" maxlength="15" id="tel" required class="form-control" onkeypress="$(this).mask('(00) 0 0000-0000 / 0 0000-0000');" readonly="readonly" value="<?php echo $fone?>">
               </div>
           </div>
              <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Mopp</label><select name="mopp" id="mopp" disabled required class="form-control" >
                            <option selected><?php echo $mopp?></option>
                            <option value="SIM">SIM</option>
                            <option value="NAO">NÃO</option>
                           </select>
                  </div>
                <div class="form-group col-md-2">
                    <label>  Placa Cavalo/UF: </label><input type="text" name="placacav" id="placacav" size="10" readonly="readonly" value="<?php echo $placacv?>" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label>  Placa Carreta/UF: </label><input type="text" name="placacar" id="placacar" size="10" readonly="readonly" value="<?php echo $placac?>" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                  <label> Vendor:</label> <input type="text" name="vendor" id="vendor" size="10" readonly="readonly" value="<?php echo $vendor?>" required class="form-control"/>   
                </div>
                <div class="form-group col-md-4">
                 <label>  Transportadora:</label> <input type="text" name="transp" id="transp" size="30" readonly="readonly" value="<?php echo $transp?>" required class="form-control"/>  
                </div>
                <div class="form-group col-md-1">
                    <label>Frete:</label> <select name="frete" id="frete" disabled required class="form-control">
                                            <option selected><?php echo $frete?></option>
                                            <option value="CIF">CIF</option>
                                            <option value="FOB">FOB</option>
                                        </select>
                </div>
                </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                    <label> Cliente:</label><input type="text" id="cliente" name="cliente" size="30" readonly="readonly" value="<?php echo $cliente?>" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label>  Data:</label><input name="data" id="data" type="date" readonly="readonly" value="<?php echo $data?>" class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label> Entrada Patio:</label><input name="horapatio" id="horapatio" type="time" readonly="readonly" value="<?php echo $entradaPatio?>" class="form-control"/>  
                </div>
                <div class="form-group col-md-2">
                    <label>  Entrada Portaria:</label><input name="horaport" type="time" readonly="readonly" value="<?php echo $entradaPor?>" class="form-control"/>   
                </div>
                <div class="form-group col-md-2">
                    <label>Operação</label> <select name="operacao" id="operacao" disabled class="form-control">
                                                <option value="0" selected><?php echo $operacao?> </option>
                                                <option value="Carregamento">Carregamento</option>
                                                <option value="Descarga">Descarga</option>
                                            </select>
                </div>
              </div>
             <div class="form-row">
                <div class="form-group col-md-2">
                    <label> Tipo Cam.:</label> <select name="tipocam" id="tipocam" disabled class="form-control">
                                <option value="0" selected><?php echo $tipocam?></option>
                                <option value="TRUCK">TRUCK</option>
                                <option value="BITRUCK">BI-TRUCK</option>
                                <option value="CACAMBA">CAÇAMBA</option>
                                <option value="LS SIMPLES">LS SIMPLES</option>
                                <option value="LS TRUCK">LS TRUCK</option>
                                <option value="VANDERLEIA">VANDERLEIA</option>
                                <option value="BITREM">BITREM</option>
                                <option value="RODOTREM">RODOTREM</option>
                           </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Status:</label><select name="status" id="status" required class="form-control is-invalid">
                                            <option selected=""> </option>
                                            <option value="Concluido">Concluido</option>
                                            <option value="Desistencia">Desistencia</option>
                                           </select>
                    <div class="invalid-feedback">
                         Selecione o status
                    </div>
                </div>
                 <div class="form-group col-md-2">
                     <label> Nº Pedido:</label> <input type="text" name="pedido" size="12"readonly="readonly" value="<?php echo $pedido?>" required class="form-control"/>
                 </div>
                <div class="form-group col-md-2">
                     <label> Grade:</label> <select name="grade" id="grade" readonly="readonly" required class="form-control">
                                                <option value="0" selected><?php echo $grade?></option>
                                                <option value="ALTA">ALTA</option>
                                                <option value="BAIXA">BAIXA</option>
                                        </select>
                </div>
                <div class="form-group col-md-2">
                   <label>Comprimento:</label> <select name="comp" id="comp" readonly="readonly" class="form-control">
                                                  <option value="0" selected><?php echo $comp?> </option>
                                                  <option value="CURTO">CURTO</option>
                                                  <option value="LONGO">LONGO</option>
                                               </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Tamanho:</label> <select name="tam" id="tam" readonly="readonly" class="form-control">
                                                <option value="0" selected><?php echo $tam?></option>
                                                <option value="25MT">25MT</option>
                                                <option value="30MT">30MT</option>
                                                <option value="SIDER">SIDER</option>
                                            </select>
               </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-7">
                      <label>EPI's: </label><br>
                  <div class="form-check form-check-inline">
                      <input type="checkbox" class="form-check-input" name="epi[]" disabled value="Capacete" <?php foreach ($epis as $valor){if($valor == 'Capacete'){ echo "checked";}} ?>/>
                    <label class="form-check-label" for="epi[]">Capacete</label>
                  </div>
                   <div class="form-check form-check-inline">
                       <input type="checkbox" class="form-check-input" name="epi[]" value="Oculos" disabled <?php foreach ($epis as $valor){if($valor == 'Oculos'){echo "checked";}}?>/>
                    <label class="form-check-label" for="epi[]">Oculos</label>
                   </div>
                   <div class="form-check form-check-inline">
                       <input type="checkbox" class="form-check-input" name="epi[]" value="Sapato Fechado" disabled <?php foreach ($epis as $valor) {if($valor == 'Sapato Fechado'){ echo "checked";}} ?>/>
                    <label class="form-check-label" for="epi[]">Sapato Fechado</label>
                   </div>
                   <div class="form-check form-check-inline">
                       <input type="checkbox" class="form-check-input" name="epi[]" disabled value="Faixa Refletiva" <?php foreach ($epis as $valor) {if($valor == 'Faixa Refletiva'){ echo "checked";}} ?>/>
                    <label class="form-check-label" for="epi[]">Faixa Refletiva</label>
                   </div>
                   <div class="form-check form-check-inline">
                       <input type="checkbox" class="form-check-input" disabled name="epi[]" value="Nenhum" <?php foreach ($epis as $valor) {if($valor == 'Nenhum'){ echo "checked";}} ?>/>
                    <label class="form-check-label" for="epi[]">Nenhum</label>
                   </div>
                  </div>
              <div class="form-group col-md-3">
                       <label> OBS.:</label> <input type="text" name="obs" size="40" class="form-control"/>
              </div>
              <div class="form-group col-md-2">
                  <label> Hora Saída:</label> <input type="text" name="horasaida" value="<?php echo date('d/m/Y \à\s H:i')?>" class="form-control"/>
              </div>
            </div>
             <div class="form-row">
                <div class="form-group col-md-2"><input type="hidden" name="id" value="<?php echo $id?>" /></div>
                <div class="form-group col-md-2"></div>
                  <div class="form-group col-md-3">
                      <button type="submit" name="atualizar" class="btn btn-info">Saída</button>
                  </div>
                 <div class="form-group col-md-3">
                      <input type="reset" name="reset" value="Limpar" class="btn btn-danger"/>
                 </div>
             </div>
             </form>
          </div>
      <div  class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020             
        </div>
    </body>
</html>