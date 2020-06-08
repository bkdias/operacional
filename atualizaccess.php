<?php
include ("funcoes.php");

if(isset($_REQUEST['atualizar'])){
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
    $tam= $_REQUEST['tam'];
    $comp=$_REQUEST['comp'];
    $transp=$_REQUEST['transp'];
    $mopp=$_REQUEST['mopp'];
    $fone=$_REQUEST['fone'];
    $op=$_REQUEST['operacao'];
    $frete=$_REQUEST['frete'];
    $valcnh=$_REQUEST['valcnh'];
    $catcnh=$_REQUEST['catcnh'];
    $vendor=$_REQUEST['vendor'];
    $tipocam=$_REQUEST['tipocam'];
    $pedido=$_REQUEST['pedido'];
    $epis= $_REQUEST['epi'];
    $epi= implode(", ", $epis);
    $reg= array($motorista,$cpf,$cnh,$valcnh,$catcnh,$placac,$cliente,$data,$entradaPatio,
            $op,$status,$obs,$fone,$placacv,$transp,$mopp,$entradaPor,
            $tipocam,$grade,$comp,$tam,$id,$frete,$pedido,$vendor,$epi);
    if(atualizaInfo($reg,$conexao)){
          echo '<script>alert("DADOS ATUALIZADOS COM SUCESSO!!!");</script>';
          echo '<script>window.location="acesso.php"</script>';
    }
    else{ 
        echo '<script>alert("ERRO! DADOS NÃO ALTERADOS!! ");</script>';
        //echo '<script>window.location="altaccess.php"</script>';
    }
  }
?>