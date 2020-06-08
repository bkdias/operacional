 <div class="modal fade" id="ModalMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="ModalMail">Confirmação de Ação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Email enviado com sucesso!!
                </div>
                <div class="modal-footer">
                  <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>
              </div>
            </div>
    </div>
    <div class="modal fade" id="ModalMailErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title" id="ModalMailErro">Confirmação de Ação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Erro - Email não enviado!!
                </div>
                <div class="modal-footer">
                  <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>
              </div>
            </div>
          </div>
   </head>
<body>
<?php
//include_once '_conexao.php';
include_once 'PHPMailer.php';
include_once 'Exception.php';
include_once 'SMTP.php';

//JSON -- ESSE TRECHO BUSCA DO BD INFORMAÇÕES PARA PREENCHER INPUT AUTOMATICAMENTE 
//A PARTIR DO SELECIONADO ANTERIORMENTE.

/*function retorna($vendor,$conexao){
     $result_vendor= "SELECT nome FROM transportadora WHERE vendor = '$vendor'";
     $resultado = mysqli_query($conexao, $result_vendor);
     if($resultado->num_rows){
         $row_vendor = mysqli_fetch_assoc($resultado);
         $valor['transp'] = $row_vendor['nome'];
     }else {
         $valor['transp'] = 'Transportadora não encontrada';
     }
     return json_encode($valor); 
}
  
if(isset($_REQUEST['vendor'])){
    echo retorna($_REQUEST['vendor'], $conexao);
}

function retorna1($cpf,$conexao){
     $result_motorista= "SELECT nome FROM status_motorista WHERE cpf = '$cpf'";
     $resultado = mysqli_query($conexao, $result_motorista);
     if($resultado->num_rows){
         $row_motorista = mysqli_fetch_assoc($resultado);
         $valor['nome'] = $row_motorista['nome'];
     }else {
         $valor['nome'] = 'MOTORISTA NÃO ENCONTRADO';
     }
     return json_encode($valor); 
}
if(isset($_REQUEST['cpfmotorista'])){
    echo retorna1($_REQUEST['cpfmotorista'], $conexao);
}


function insereTransp($dados, $conexao){
  $nome = $dados[0]; $vendor = $dados[1];  
  $sql= mysqli_query($conexao, "SELECT * FROM transportadora WHERE vendor= '$vendor'");
    
//Verifica se já tem cliente transportadora com mesmo vendor - Se retornar algum registro, aborta a função;
    if(mysqli_num_rows($sql)>0) //retorna a quantidade de linhas da consulta
       return 0;
    else{
        mysqli_query($conexao, "INSERT INTO transportadora(nome,vendor)
        VALUES('$dados[0]','$dados[1]')") or die(mysqli_error($conexao));
        return 1;
    }
}
function bloqueia_motorista($dados, $conexao){
  $cpf = $dados[1]; $status = $dados[2]; $obs=$dados[3];
  $sql= mysqli_query($conexao, "SELECT * FROM status_motorista WHERE cpf= '$cpf'");
  $resp = mysqli_fetch_array($sql);  
//Verifica se já tem motorista na lista - Se retornar algum registro, aborta a função;
    if(mysqli_num_rows($sql)>0){ //retorna a quantidade de linhas da consulta
        $id= $resp['id'];
        if($status==$resp['status']){
            if($status==0)
              echo '<script> alert("MOTORISTA JÁ ESTÁ BLOQUEADO!!!")</script>';
            else
            echo '<script> alert("MOTORISTA JÁ ESTÁ LIBERADO!!!")</script>';
            return 0;
        }
        else{
        mysqli_query($conexao, "UPDATE status_motorista SET status='$status',obs='$obs' WHERE cpf='$cpf'") or die(mysqli_error($conexao));
        if($status==0)
                echo '<script> alert("MOTORISTA FOI BLOQUEADO!!!")</script>';
         else
               echo '<script> alert("MOTORISTA FOI LIBERADO!!!")</script>';
         return 1;
        }
    }
    else{
        mysqli_query($conexao, "INSERT INTO status_motorista(nome,cpf,status,obs)
        VALUES('$dados[0]','$dados[1]','$dados[2]','$dados[3]')") or die(mysqli_error($conexao));
        if($status==0)
                echo '<script> alert("MOTORISTA FOI BLOQUEADO!!!")</script>';
        return 1;
    }   
}

function getVendor($conexao){
    $sql= mysqli_query($conexao, "SELECT * FROM transportadora");
    $vendor = mysqli_fetch_array($sql);
    return $vendor;
}*/

function EnviarMail($resp,$data){
    $cliente = $resp['cliente']; $de = "hometeste9@gmail.com"; $dest1 = "rebeca.santana@yara.com"; $dest2 = "rebeca.santana@yara.com";
    $headers = "From: Atendimento Yara Candeias <".$de.">\n";
    $headers .= "Content-Type: Text/HTML; charset=UTF-8\n";
    // formatação da mensagem em HTML
    $body = '<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        Prezado cliente,<br>
        Segue informações sobre o pedido realizado.<br><br>
        
        <table border=1>
         <tr><td><strong><center>NF</center></strong></td>
             <td><strong><center>Data</center></strong></td>
             <td><strong><center>Cliente</center></strong></td>
             <td><strong><center>Material</center></strong></td>
             <td><strong><center>Qtd</center></strong></td>
             <td><strong><center>Pedido</center></strong></td>
             <td><strong><center>Destino</center></strong></td>
             <td><strong><center>Frete</center></strong></td>
         </tr>     
         <tr>
            <td>'.$resp['nf'].'</td>
             <td>'.$data.'</td>
             <td>'.$resp['cliente'].'</td>
             <td>'.$resp['material'].'</td>
             <td>'.$resp['qtd'].'ton</td>
             <td>'.$resp['pedido'].'</td>
             <td>'.$resp['destino'].'</td>
             <td>'.$resp['inter'].'</td>
       </table> <br><br>
       Atenciosamente,<br>
       <img src="cid:assinatura" alt="" />
    </body>
    </html>';
    $Mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $Mailer->CharSet= "utf8";
    //$Mailer->SMTPDebug = 3; //Exibe na tela o passo a passo do envio
    $Mailer->IsSMTP();
    $Mailer->Host = "smtp.gmail.com";
    $Mailer->SMTPAuth = true;
    $Mailer->FromName = "Atendimento Yara Candeias";
    $Mailer->From = $de;
    $Mailer->Username = "hometeste9@gmail.com";
    $Mailer->Password = "Rebec@2019Rebec@2020";
    $Mailer->addAddress($dest1);
    $Mailer->Port = 587;
    //$Mailer->addBCC($dest2);
    $Mailer->isHTML(TRUE);
    $Mailer->Subject = "Status do Pedido - '.$cliente.'";
    $Mailer->addEmbeddedImage("image/assinatura.PNG", "assinatura", "assinatura.PNG");
    $Mailer->Body = $body;
    $Mailer->SMTPOptions = array(
                            'ssl' => array(
                                      'verify_peer' => false,
                                      'verify_peer_name' => false,
                                      'allow_self_signed' => true
                                     )
                            );
    
    if($Mailer->send()){
      echo '<script>$("#ModalMail").modal("show")</script>';
      echo "<script>$('#ModalMail').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";
        
      return true;
    }
    else {
      echo '<script>$("#ModalMailErro").modal("show")</script>';
      echo "<script>$('#ModalMailErro').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";
      return false;
       
    }
 }

 function EnviaAlerta($resp){
    $de = "portaria1.candeias@yara.com"; $dest1 = "sidmar.araujo@yara.com"; $dest2 = "rebeca.santana@yara.com";
    $headers = "From: Portaria 1 <".$de.">\n"; $data=converte_data($resp[7]);
    $headers .= "Content-Type: Text/HTML; charset=UTF-8\n";
    // formatação da mensagem em HTML
    $body = '<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        Prezados,<br><br>
        Segue informações sobre Desistencia:<br><br>
        
        <table border=1>
         <tr><td><strong><center>Motorista</center></strong></td>
             <td><strong><center>Data/Hora Saída</center></strong></td>
             <td><strong><center>Nº Pedido</center></strong></td>
             <td><strong><center>Transportadora</center></strong></td>
        </tr>         
         <tr>
             <td>'.$resp[1].'</td>
             <td>'.$data.'/'.$resp[26].'</td>
             <td>'.$resp[25].'</td>
             <td>'.$resp[15].'</td>
        </table> <br><br>
       Atenciosamente,<br>
       <img src="cid:assinatura" alt="" />
    </body>
    </html>';
    $Mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $Mailer->CharSet= "utf8";
   // $Mailer->SMTPDebug = 3;
    $Mailer->IsSMTP();
    $Mailer->Host = "ssmtp.ad.yara.com";
    $Mailer->SMTPAuth = false;
       
    $Mailer->FromName = "Portaria I";
    $Mailer->From = $de;
    $Mailer->addAddress($dest1);
    $Mailer->addBCC($dest2);
    $Mailer->isHTML(TRUE);
    $Mailer->Subject = "DESISTENCIA CAMINHAO - PEDIDO: '.$resp[24].'";
    $Mailer->addEmbeddedImage("image/assinatura.PNG", "assinatura", "assinatura.PNG");
    $Mailer->Body = $body;
    $Mailer->SMTPOptions = array(
                            'ssl' => array(
                                      'verify_peer' => false,
                                      'verify_peer_name' => false,
                                      'allow_self_signed' => false
                                     )
                            );
    
    if($Mailer->send()){
      echo '<script>alert("EMAIL DE ALERTA ENVIADO!!");</script>';
       #Redireciona para página inicial
       echo "<script>window.location='acesso.php';</script>";
       return true;
     
    }
    else {
       echo '<script>alert("ERRO! EMAIL DE ALERTA NÃO ENVIADO!");</script>';
       echo "<script>window.location='acesso.php';</script>";
       return false;
       
    }
 }
 function EnviaAlertaBloqueio($resp){
    $de = "expedicao.candeias@yara.com"; $dest1 = "sidmar.araujo@yara.com"; $dest2 = "rebeca.santana@yara.com";
    if($resp[2]==0)
        $status="BLOQUEADO";
    else 
        $status="LIBERADO";
    
    $headers = "From: Expedição Candeias <".$de.">\n";
    $headers .= "Content-Type: Text/HTML; charset=UTF-8\n";
    // formatação da mensagem em HTML
    $body = '<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        Prezados,<br><br>
        Segue informações sobre motorista bloqueado/liberado:<br><br>
        
        <table border=1>
         <tr><td><strong> <center>Motorista</center></strong> </td>
             <td><strong> <center>CPF</center></strong> </td>
             <td><strong> <center>Status</center></strong> </td>
             <td><strong> <center>Observação</center></strong> </td>
        </tr>         
         <tr>
             <td>' .$resp[0]. '</td>
             <td>' .$resp[1]. '</td>
             <td>' .$status. '</td>
             <td>' .$resp[3]. '</td>
        </table> <br><br>
       Atenciosamente,<br>
       <img src="cid:assinatura" alt="" />
    </body>
    </html>';
    $Mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $Mailer->CharSet= "utf8";
   // $Mailer->SMTPDebug = 3;
    $Mailer->IsSMTP();
    $Mailer->Host = "ssmtp.ad.yara.com";
    $Mailer->SMTPAuth = false;
       
    $Mailer->FromName = "Expedicao Candeias";
    $Mailer->From = $de;
    $Mailer->addAddress($dest1);
    $Mailer->addBCC($dest2);
    $Mailer->isHTML(TRUE);
    $Mailer->Subject = "BLOQUEIO/LIBERAÇÃO DE MOTORISTA - TESTE";
    $Mailer->addEmbeddedImage("image/assinatura.PNG", "assinatura", "assinatura.PNG");
    $Mailer->Body = $body;
    $Mailer->SMTPOptions = array(
                            'ssl' => array(
                                      'verify_peer' => false,
                                      'verify_peer_name' => false,
                                      'allow_self_signed' => false
                                     )
                            );
    
    if($Mailer->send()){
      echo '<script>alert("EMAIL DE ALERTA ENVIADO!!");</script>';
       #Redireciona para página inicial
      echo "<script>window.location='acesso.php';</script>";
      return true;
    }
    else {
       echo '<script>alert("ERRO! EMAIL DE ALERTA NÃO ENVIADO!");</script>';
       echo "<script>window.location='acesso.php';</script>";
       return false;
    }
 }
 //Envia Alerta de chegada do caminhão.
 function EnviaAlertaChegada($resp,$data){
    $de = "portaria1.candeias@yara.com";
    $frete= $resp[23];
 if ($frete=="FOB"){
     $dest1 = "rebeca.santana@yara.com";
   //  $dest2 = "sidmar.araujo@yara.com";
 }
 else{
    $dest1 = "rebeca.santana@yara.com"; 
 } 
    $headers = "From: Portaria 1 <".$de.">\n"; 
    $headers .= "Content-Type: Text/HTML; charset=UTF-8\n";
    // formatação da mensagem em HTML
    $body = '<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        Prezados,<br>
        Segue informações sobre Chegada de Caminhão:<br><br>
        
        <table border=1>
         <tr><td><strong><center>Motorista</center></strong></td>
             <td><strong><center>Data/Hora Chegada</center></strong></td>
             <td><strong><center>Nº Pedido</center></strong></td>
             <td><strong><center>Transportadora</center></strong></td>
        </tr>     
        <tr>
             <td>'.$resp[0].'</td>
             <td>'.$data.' / '.$resp[7].'</td>
             <td>'.$resp[24].'</td>
             <td>'.$resp[14].'</td>
        </table> <br><br>
       Atenciosamente,<br>
       <img src="cid:assinatura" alt="" />
    </body>
    </html>';
    $Mailer = new \PHPMailer\PHPMailer\PHPMailer();
    $Mailer->CharSet= "utf8";
    //$Mailer->SMTPDebug = 0;
    $Mailer->IsSMTP();
    $Mailer->Host = "smtp.gmail.com";
    $Mailer->SMTPAuth = true;
    $Mailer->FromName = "Atendimento Yara Candeias";
    $Mailer->From = $de;
    $Mailer->Username = "hometeste9@gmail.com";
    $Mailer->Password = "Rebec@2019Rebec@2020";
    $Mailer->addAddress($dest1);
    $Mailer->Port = 587;
   
    //$Mailer->Host = "ssmtp.ad.yara.com";
   // $Mailer->SMTPAuth = false;
  //  $Mailer->FromName = "Portaria I";
  //  $Mailer->From = $de;
    $Mailer->addAddress($dest1);
    //$Mailer->addBCC($dest2);
    $Mailer->isHTML(TRUE);
    $Mailer->Subject = "CHEGADA DE CAMINHAO - $frete";
    $Mailer->addEmbeddedImage("image/assinatura.PNG", "assinatura", "assinatura.PNG");
    $Mailer->Body = $body;
    $Mailer->SMTPOptions = array(
                            'ssl' => array(
                                      'verify_peer' => false,
                                      'verify_peer_name' => false,
                                      'allow_self_signed' => false
                                     )
                            );
    
    if($Mailer->send()){
      return true;
    }
    else {
       return false;
    }
 }
 
 

function excluir_acesso($conexao,$campo){
    $sql=mysqli_query($conexao, "DELETE FROM caminhao WHERE id= '$campo'") OR die(mysqli_error($conexao));
    if($sql)
      return true;
    else
     return false;
}

function excluirtransp($conexao,$campo){
   if(mysqli_query($conexao, "DELETE FROM transportadora WHERE vendor= '$campo'")>0)
      return true;
    else
     return false;
}

function atualizatransp($dados,$conexao){
   if(mysqli_query($conexao, "UPDATE transportadora SET nome='$dados[1]', vendor='$dados[2]' WHERE id='$dados[0]'")>0){
        return true;
    }
    else return false;
}

function atualizaccess($dados,$conexao){
    if($dados[0]=='Desistencia'){
        $id=$dados[2];
        $sql= mysqli_query($conexao, "SELECT * FROM caminhao WHERE id= '$id'");
        $registro= mysqli_fetch_array($sql);
        EnviaAlerta($registro );
    }
    if(mysqli_query($conexao, "UPDATE caminhao SET status='$dados[0]', saida='$dados[1]' WHERE id='$dados[2]'")>0){
        return true;
    }
    else{return false;}
} 
function atualizaInfo($dados,$conexao){
    $id=$dados[21];
    if(mysqli_query($conexao, "UPDATE caminhao SET motorista='$dados[0]',"
    . "cpf='$dados[1]', cnh='$dados[2]', val_cnh='$dados[3]', catcnh='$dados[4]',"
    . " placac='$dados[5]', cliente='$dados[6]', data='$dados[7]',"
    ."entradaPatio='$dados[8]', operacao='$dados[9]', status='$dados[10]',"
    ."obs='$dados[11]', fone='$dados[12]', placacv='$dados[13]', transp='$dados[14]',"
    ." mopp='$dados[15]', entradaPor='$dados[16]', tipocam='$dados[17]', grade='$dados[18]',"
    ."comp='$dados[19]', tam='$dados[20]', frete='$dados[22]', pedido='$dados[23]',"
    ."vendor='$dados[24]',epi='$dados[25]' WHERE id='$id'")>0){
        return 1;
    }else{
        return 0;
    }
        
}?>

</body>
</html>